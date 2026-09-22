<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Team - Indus Resort Restaurant</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--line:#f0f0f0;--red:#ff4e52}
*{box-sizing:border-box}
body{margin:0;display:flex;background:var(--bg);font-family:Lato,Arial,sans-serif;color:var(--ink)}
.main{flex:1;min-width:0;padding:26px 30px 16px}
.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:22px}
.top h1{font-size:30px;font-weight:800;margin:0}
.profile{display:flex;align-items:center;gap:13px}
.avatar{width:46px;height:46px;border-radius:50%;background:var(--lime);display:grid;place-items:center;font-weight:700;font-size:15px;overflow:hidden}
.avatar img{width:100%;height:100%;object-fit:cover}
.pinfo b{display:block;font-size:16px;line-height:1.1}.pinfo small{color:#888;font-size:13px}
.tools{display:flex;gap:10px;margin-left:14px}
.tool{width:44px;height:44px;border:1px solid #e8e8e8;background:#fff;border-radius:11px;display:grid;place-items:center;cursor:pointer;position:relative}
.tool svg{width:20px;height:20px;fill:none;stroke:#4a4a4a;stroke-width:1.8}
.tool.bell:after{content:'';position:absolute;top:9px;right:11px;width:8px;height:8px;border-radius:50%;background:var(--red);border:2px solid #fff}
.panel{background:#fff;border-radius:18px;padding:22px 22px 8px}
.filters{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;gap:12px;flex-wrap:wrap}
.fl,.fr{display:flex;gap:12px;align-items:center}
.searchbox{position:relative}
.searchbox>svg{position:absolute;left:15px;top:50%;transform:translateY(-50%);width:18px;height:18px;fill:none;stroke:#b0b0b0;stroke-width:1.8}
.search{height:44px;width:290px;border:0;border-radius:11px;background:#f4f4f4;padding:0 16px 0 42px;font-size:14px;color:#333;font-family:inherit}
.search::placeholder{color:#b0b0b0}
.fsel{height:44px;border:0;border-radius:11px;background:#f4f4f4;padding:0 14px;font-size:14px;color:#333;font-family:inherit;cursor:pointer}
.add{height:44px;border:0;border-radius:11px;background:var(--lime);padding:0 20px;font-size:15px;font-weight:700;color:#2f3a0c;cursor:pointer}
.tbl{width:100%;overflow-x:auto}
.thead,.trow{display:grid;grid-template-columns:1.9fr 2fr 1fr 1.1fr 140px;align-items:center;min-width:940px;column-gap:12px}
.thead{background:#eefaf3;border-radius:12px;padding:16px 24px;color:#8a8a8a;font-size:15px;font-weight:600}
.thead span{display:inline-flex;align-items:center;gap:6px}
.thead svg{width:12px;height:12px;fill:none;stroke:#b5b5b5;stroke-width:2}
.trow{padding:14px 24px;border-bottom:1px solid var(--line);font-size:15px}
.trow:last-child{border-bottom:0}
.who{display:flex;align-items:center;gap:14px;min-width:0}
.pic{width:44px;height:44px;border-radius:50%;background:var(--mint);display:grid;place-items:center;font-weight:700;font-size:14px;color:#2f6b4f;flex:0 0 44px;overflow:hidden}
.pic img{width:100%;height:100%;object-fit:cover}
.who b{display:block;font-size:15px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.who small{color:#9a9a9a;font-size:13px}
.uemail{color:#555;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.rl{display:inline-flex;align-items:center;gap:7px;padding:6px 12px;border-radius:20px;font-size:12.5px;font-weight:700;width:max-content}
.rl:before{content:'';width:7px;height:7px;border-radius:50%;background:currentColor}
.rl.admin{background:#e6f4ea;color:#1e4a36}
.rl.manager{background:#dfebfb;color:#1e4f8f}
.rl.staff{background:#fdf1d3;color:#7a5400}
.you{margin-left:8px;font-size:11.5px;color:#8b948f;font-weight:600}
.act{display:flex;gap:8px;align-items:center;justify-content:flex-end}
.ib{width:34px;height:34px;border:1px solid #ededed;background:#fff;border-radius:9px;display:inline-grid;place-items:center;cursor:pointer;color:#555;transition:.15s}
.ib:hover{background:#f6f6f6}
.ib svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.ib.del{color:#b3352f;border-color:#f3d4d4;background:#fff7f7}.ib.del:hover{background:#ffe1e1}
.ib[disabled]{opacity:.35;cursor:not-allowed}
.tbottom{display:flex;justify-content:space-between;align-items:center;padding:20px 4px 16px;color:#8a8a8a;font-size:15px}
/* What each role can open, as compact chips so the three cards stay the same height. */
.roles{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px;margin-top:18px;align-items:stretch}
.rcard{background:#fff;border:1px solid var(--line);border-radius:16px;padding:18px;display:flex;flex-direction:column}
.rcard-h{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:4px}
.rcard-h b{font-size:12.5px;color:#8b948f;font-weight:600;white-space:nowrap}
.rcard p{margin:0 0 14px;color:#8b948f;font-size:12.5px}
.rchips{display:flex;flex-wrap:wrap;gap:7px;margin-top:auto}
.rchip{background:#f4f8f5;border:1px solid #e3ece6;border-radius:8px;padding:5px 10px;font-size:12px;color:#3f4f47;white-space:nowrap}
.rchip.off{background:#fafafa;border-color:#f0f0f0;color:#c2c8c4;text-decoration:line-through}
footer{display:flex;justify-content:space-between;align-items:center;padding:20px 6px 8px;color:#9a9a9a;font-size:14px;flex-wrap:wrap;gap:14px}
.flinks{display:flex;gap:26px}.flinks a{color:#9a9a9a;text-decoration:none}.flinks span:first-child{color:#666}
.fsoc{display:flex;gap:16px;align-items:center}.fsoc a{color:#c2c2c2}.fsoc svg{width:18px;height:18px;fill:currentColor}
@media(max-width:1100px){.roles{grid-template-columns:1fr}}
@media(max-width:700px){.main{padding:18px 14px}.top h1{font-size:24px}.profile .pinfo,.tools{display:none}.filters{flex-direction:column;align-items:stretch}.search{width:100%}footer{flex-direction:column;align-items:flex-start}}
</style>
</head>
<body>
@include('partials.crud')
@include('partials.sidebar')
@include('partials.responsive')
@include('partials.desktop-theme')
@include('partials.mobile-theme')
<style>
@media(min-width:769px){
 .us-hint{display:flex;align-items:flex-start;gap:10px;background:#f4f8f5;border:1px solid var(--line);border-radius:12px;padding:12px 14px;margin-bottom:16px;color:#55605a;font-size:13px}
 .us-hint svg{width:16px;height:16px;flex:0 0 16px;margin-top:1px;fill:none;stroke:#2f6b4f;stroke-width:1.9}
}
@media(max-width:768px){
 .us-hint{display:none}
 .ms-role{display:inline-flex;align-items:center;padding:5px 11px;border-radius:14px;font-size:12px;font-weight:700}
 .ms-role.admin{background:#e6f4ea;color:#1e4a36}
 .ms-role.manager{background:#dfebfb;color:#1e4f8f}
 .ms-role.staff{background:#fdf1d3;color:#7a5400}
}
</style>
<main class="main">
<section class="m-page">
@php $msAct = '<button class="ms-add" type="button" onclick="openUserCreator()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>Add User</button>'; @endphp
@include('partials.mobile-shell', ['msTitle'=>'Team','msSubtitle'=>'Logins and what each role can open','msAction'=>$msAct])
<div class="ms-filters one"><label class="ms-search"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg><input id="mSearch" type="search" placeholder="Search name or email..."></label></div>
<div class="ms-selrow"><select class="ms-sel" id="mRole"><option value="">All Roles</option><option value="admin">Admin</option><option value="manager">Manager</option><option value="staff">Staff</option></select></div>
<div id="mRows"></div>
@include('partials.mobile-nav')
</section>
    <header class="top">
        <h1>Team</h1>
        <div class="profile">
            <span class="avatar hdr-avatar" style="cursor:pointer" onclick="openAccount()" title="My account">@if(auth()->user()->avatar)<img src="{{ asset(auth()->user()->avatar) }}" alt="">@else{{ auth()->user()->initials() }}@endif</span>
            <div class="pinfo"><b>{{ auth()->user()->name }}</b><small>{{ ucfirst(auth()->user()->role) }}</small></div>
            <div class="tools">
                <button class="tool" type="button" title="My account" onclick="openAccount()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell" type="button" title="Notifications" onclick="showNotifications()"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
            </div>
        </div>
    </header>
@include('partials.page-head', ['pgTitle'=>'Team','pgSub'=>'Who can sign in, and what each role is allowed to open.'])
    <section class="panel">
        <div class="us-hint">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 16v-4M12 8h.01"/></svg>
            <span>A new user signs in with the email and password you set here. You cannot change your own role or delete your own account, and the last remaining admin is protected.</span>
        </div>
        <div class="filters">
            <div class="fl">
                <select class="fsel" id="fRole"><option value="">All Roles</option><option value="admin">Admin</option><option value="manager">Manager</option><option value="staff">Staff</option></select>
            </div>
            <div class="fr">
                <div class="searchbox"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg><input class="search" id="fSearch" placeholder="Search name or email"></div>
                <button class="add" onclick="openUserCreator()">Add User</button>
            </div>
        </div>
        <div class="tbl">
            <div class="thead">
                <span onclick="sortCol('us','name',applyFilters)" style="cursor:pointer">Name @include('partials.sort')</span>
                <span onclick="sortCol('us','email',applyFilters)" style="cursor:pointer">Email @include('partials.sort')</span>
                <span onclick="sortCol('us','role',applyFilters)" style="cursor:pointer">Role @include('partials.sort')</span>
                <span onclick="sortCol('us','created_at',applyFilters)" style="cursor:pointer">Added @include('partials.sort')</span>
                <span style="justify-content:flex-end">Action</span>
            </div>
            <div id="rows"></div>
        </div>
        <div class="tbottom"><span id="usInfo">Showing…</span><div class="pages" id="usPages"></div></div>
    </section>

    <section class="roles">
        @foreach($roleAccess as $role => $tabs)
        <article class="rcard">
            <div class="rcard-h">
                <span class="rl {{ $role }}">{{ ucfirst($role) }}</span>
                <b>{{ count($tabs) }} of {{ count($roleAccess['admin']) }}</b>
            </div>
            <p>{{ $role === 'admin' ? 'Full access, including delete rights.' : ($role === 'manager' ? 'Every section, but deletes stay with admin.' : 'Day-to-day operations only.') }}</p>
            <div class="rchips">
                @foreach($roleAccess['admin'] as $tab)
                    <span class="rchip {{ in_array($tab, $tabs) ? '' : 'off' }}">{{ ucwords(str_replace('-', ' ', $tab)) }}</span>
                @endforeach
            </div>
        </article>
        @endforeach
    </section>

    <footer>
        <div class="flinks"><span>Copyright © 2026 Indus Resort Restaurant</span><a href="#">Privacy Policy</a><a href="#">Term and conditions</a><a href="#">Contact</a></div>
        <div class="fsoc">
            <a href="https://www.facebook.com/people/Indus-Resort/61590518813137/" target="_blank" rel="noopener" aria-label="Facebook"><svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
            <a href="https://wa.me/923000053333" target="_blank" rel="noopener" aria-label="WhatsApp"><svg viewBox="0 0 24 24"><path d="M20.5 11.5a8.5 8.5 0 0 1-12.6 7.5L3.5 20.5 5 16.3A8.5 8.5 0 1 1 20.5 11.5Z"/><path d="M8.4 7.8c.2-.5.5-.5.7-.5h.5c.2 0 .4.1.5.4l.8 1.8c.1.3.1.5-.1.7l-.5.6c-.1.1-.1.3 0 .4.4.8 1.1 1.5 1.9 1.9.1.1.3.1.4 0l.6-.5c.2-.2.4-.2.7-.1l1.8.8c.3.1.4.3.4.5v.5c0 .2-.1.5-.5.7-.4.2-1.2.4-2.3-.1-1-.5-2.2-1.4-3.2-2.4-1-1-1.9-2.2-2.4-3.2-.5-1.1-.3-1.9-.1-2.3Z"/></svg></a>
            <a href="https://www.instagram.com/indus_resort/" target="_blank" rel="noopener" aria-label="Instagram"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg></a>
        </div>
    </footer>
</main>

{{-- Add user --}}
<div class="modal-ov" id="addUser"><div class="modal"><h3>Add User</h3>
<form method="POST" action="{{ url('/users') }}">@csrf
<div class="mrow"><div><label>Full Name *</label><input name="name" required placeholder="e.g. Ali Raza"></div><div><label>Role *</label><select name="role" required><option value="staff">Staff</option><option value="manager">Manager</option><option value="admin">Admin</option></select></div></div>
<label>Email *</label><input type="email" name="email" required placeholder="name@indusresort.com">
<div class="mrow"><div><label>Password *</label><input type="password" name="password" required minlength="8" placeholder="At least 8 characters"></div><div><label>Confirm Password *</label><input type="password" name="password_confirmation" required minlength="8" placeholder="Repeat password"></div></div>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('addUser')">Cancel</button><button class="mbtn save">Create User</button></div>
</form></div></div>

{{-- Edit user --}}
<div class="modal-ov" id="editUser"><div class="modal"><h3 id="editUserTitle">Edit User</h3>
<form method="POST" id="editUserForm">@csrf @method('PUT')
<div class="mrow"><div><label>Full Name *</label><input name="name" required></div><div><label>Role *</label><select name="role" id="editUserRole" required><option value="staff">Staff</option><option value="manager">Manager</option><option value="admin">Admin</option></select></div></div>
<label>Email *</label><input type="email" name="email" required>
<p id="editUserNote" style="margin:10px 0 0;font-size:12.5px;color:#8b948f;display:none"></p>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('editUser')">Cancel</button><button class="mbtn save">Save Changes</button></div>
</form></div></div>

{{-- Reset password --}}
<div class="modal-ov" id="resetPw"><div class="modal"><h3 id="resetPwTitle">Set New Password</h3>
<form method="POST" id="resetPwForm">@csrf
<div class="mrow"><div><label>New Password *</label><input type="password" name="password" required minlength="8" placeholder="At least 8 characters"></div><div><label>Confirm Password *</label><input type="password" name="password_confirmation" required minlength="8" placeholder="Repeat password"></div></div>
<p style="margin:10px 0 0;font-size:12.5px;color:#8b948f">The user is not signed out. Tell them the new password so they can sign in next time.</p>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('resetPw')">Cancel</button><button class="mbtn save">Set Password</button></div>
</form></div></div>

@php
    $usersJson = $users->map(fn ($u) => [
        'id' => $u->id,
        'name' => $u->name,
        'email' => $u->email,
        'role' => $u->role,
        'avatar' => $u->avatar,
        'initials' => $u->initials(),
        'created_at' => optional($u->created_at)->format('M j, Y'),
    ])->values();
    $adminCount = $users->where('role', 'admin')->count();
@endphp
<script>
const users = @json($usersJson);
const ME = {{ auth()->id() }};
const ADMINS = {{ $adminCount }};
const RLABEL = {admin:'Admin', manager:'Manager', staff:'Staff'};

const editIco = '<svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>';
const keyIco  = '<svg viewBox="0 0 24 24"><circle cx="8" cy="15" r="4"/><path d="m10.8 12.2 8-8M17 6l2 2M15 8l2 2"/></svg>';
const delIco  = '<svg viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2M6 6l1 14h10l1-14M10 11v6M14 11v6"/></svg>';

/** The last admin, and your own account, must stay in place. */
function locked(u){
    if (u.id === ME) return 'This is the account you are signed in with.';
    if (u.role === 'admin' && ADMINS <= 1) return 'This is the only admin left.';
    return '';
}
function pic(u){
    return u.avatar ? `<span class="pic"><img src="/${u.avatar}" alt=""></span>` : `<span class="pic">${u.initials}</span>`;
}

function render(list){
    renderMobile(list);
    document.getElementById('rows').innerHTML = list.map(u => {
        const lock = locked(u);
        const dis = lock ? `disabled title="${lock}"` : '';
        return `<div class="trow">
            <span class="who">${pic(u)}<div><b>${u.name}${u.id === ME ? '<span class="you">You</span>' : ''}</b><small>${RLABEL[u.role]}</small></div></span>
            <span class="uemail">${u.email}</span>
            <span><em class="rl ${u.role}" style="font-style:normal">${RLABEL[u.role]}</em></span>
            <span>${u.created_at || '—'}</span>
            <span class="act">
                <button class="ib" title="Edit user" onclick="openUserEditor(${u.id})">${editIco}</button>
                <button class="ib" title="Set new password" onclick="openPwReset(${u.id})">${keyIco}</button>
                <button class="ib del" ${dis} onclick="deleteUser(${u.id})">${delIco}</button>
            </span>
        </div>`;
    }).join('') || '<div class="trow"><span>No users found</span></div>';
}

function renderMobile(list){
    const el = document.getElementById('mRows');
    if (!el) return;
    el.innerHTML = list.map(u => {
        const lock = locked(u);
        return `<article class="ms-card">
            <div class="ms-top"><span class="ms-av">${u.initials}</span><div class="ms-name"><b>${u.name}</b><small>${u.email}</small></div><span class="ms-role ${u.role}">${RLABEL[u.role]}</span></div>
            <div class="ms-act">
                <button type="button" class="ms-btn gray" onclick="openUserEditor(${u.id})">Edit</button>
                <button type="button" class="ms-btn gray" onclick="openPwReset(${u.id})">Password</button>
                ${lock ? '' : `<button type="button" class="ms-btn cancel" onclick="deleteUser(${u.id})">Delete</button>`}
            </div>
        </article>`;
    }).join('') || '<div class="ms-empty">No users found</div>';
}

function openUserCreator(){ document.querySelector('#addUser form').reset(); openModal('addUser'); }

function openUserEditor(id){
    const u = users.find(x => x.id === id);
    if (!u) return;
    const f = document.getElementById('editUserForm');
    f.action = '/users/' + u.id;
    f.elements.name.value = u.name;
    f.elements.email.value = u.email;
    f.elements.role.value = u.role;
    document.getElementById('editUserTitle').textContent = 'Edit ' + u.name;
    const note = document.getElementById('editUserNote');
    const roleSel = document.getElementById('editUserRole');
    const lock = locked(u);
    roleSel.disabled = !!lock;
    note.style.display = lock ? 'block' : 'none';
    note.textContent = lock ? lock + ' Its role cannot be changed here.' : '';
    openModal('editUser');
}

function openPwReset(id){
    const u = users.find(x => x.id === id);
    if (!u) return;
    const f = document.getElementById('resetPwForm');
    f.reset();
    f.action = '/users/' + u.id + '/password';
    document.getElementById('resetPwTitle').textContent = 'New Password for ' + u.name;
    openModal('resetPw');
}

function deleteUser(id){
    const u = users.find(x => x.id === id);
    if (!u || locked(u)) return;
    if (confirm('Remove ' + u.name + '? They will no longer be able to sign in.')) post('/users/' + id, 'DELETE');
}

function applyFilters(){
    const q = (document.getElementById('fSearch').value || '').toLowerCase();
    const role = document.getElementById('fRole').value;
    let list = users.filter(u =>
        (!role || u.role === role) &&
        (!q || (u.name + ' ' + u.email).toLowerCase().includes(q))
    );
    list = sortList('us', list);
    paginateRender('us', list, 10, render);
}

msMirror([['mSearch','fSearch'], ['mRole','fRole']]);
['fSearch','fRole'].forEach(id => document.getElementById(id).addEventListener('input', applyFilters));
applyFilters();
</script>
</body>
</html>
