<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

/**
 * Team accounts: who can sign in and what each role may open.
 * Admin only — the routes are behind `role:admin`.
 *
 * Guards that matter here:
 *  - an admin cannot change their own role or delete themselves, so the property
 *    can never be left without an administrator by accident;
 *  - the last remaining admin cannot be demoted or removed either.
 */
class UserController extends Controller
{
    public const ROLES = ['admin', 'manager', 'staff'];

    public function index()
    {
        return view('users', [
            'users' => User::orderByRaw("FIELD(role,'admin','manager','staff')")->orderBy('name')->get(),
            'roleAccess' => User::ACCESS,
        ]);
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:190|unique:users,email',
            'role' => ['required', Rule::in(self::ROLES)],
            'password' => 'required|string|min:8|max:100|confirmed',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);

        return back()->with('ok', $data['name'].' can now sign in as '.$data['role'].'.');
    }

    public function update(Request $r, $id)
    {
        $user = User::findOrFail($id);

        $data = $r->validate([
            'name' => 'required|string|max:100',
            'email' => ['required', 'email', 'max:190', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in(self::ROLES)],
        ]);

        if ($data['role'] !== $user->role) {
            if ($user->id === auth()->id()) {
                return back()->with('ok', 'You cannot change your own role. Ask another admin to do it.');
            }
            if ($user->role === 'admin' && $this->adminCount() <= 1) {
                return back()->with('ok', 'This is the only admin left, so the role cannot be changed.');
            }
        }

        $user->update($data);

        return back()->with('ok', $user->name.' updated.');
    }

    public function password(Request $r, $id)
    {
        $user = User::findOrFail($id);
        $data = $r->validate(['password' => 'required|string|min:8|max:100|confirmed']);

        $user->update(['password' => Hash::make($data['password'])]);

        return back()->with('ok', 'New password set for '.$user->name.'.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('ok', 'You cannot delete the account you are signed in with.');
        }
        if ($user->role === 'admin' && $this->adminCount() <= 1) {
            return back()->with('ok', 'This is the only admin left and cannot be removed.');
        }

        $name = $user->name;
        $user->delete();

        return back()->with('ok', $name.' removed.');
    }

    private function adminCount(): int
    {
        return User::where('role', 'admin')->count();
    }
}
