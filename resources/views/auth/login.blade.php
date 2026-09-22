<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Sign in - Indus Resort Restaurant</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--red:#ff4e52}
*{box-sizing:border-box}
body{margin:0;min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#eafbf2,#f6f6f5);font-family:Lato,Arial,sans-serif;color:var(--ink);padding:24px}
.card{background:#fff;border-radius:20px;padding:38px 34px;width:420px;max-width:100%;box-shadow:0 18px 50px rgba(0,0,0,.08)}
.brand{display:flex;align-items:center;gap:10px;font-size:24px;font-weight:800;margin-bottom:6px}
.brand-mark{width:24px;height:24px;display:grid;grid-template-columns:repeat(2,1fr);grid-template-rows:repeat(2,1fr);gap:3px}
.brand-mark i{background:#b6d8cb;border-radius:2px}.brand-mark i:nth-child(2),.brand-mark i:nth-child(3){background:var(--lime)}
h1{font-size:22px;margin:22px 0 4px}
.sub{color:var(--muted);font-size:14px;margin-bottom:22px}
label{display:block;font-size:13px;color:#555;margin:14px 0 6px;font-weight:600}
input{width:100%;height:48px;border:1px solid #e4e4e4;border-radius:11px;padding:0 14px;font-size:15px;font-family:inherit;color:#222}
input:focus{outline:2px solid var(--lime);border-color:var(--lime)}
.row{display:flex;align-items:center;justify-content:space-between;margin-top:14px;font-size:13px;color:#666}
.row label{margin:0;display:flex;align-items:center;gap:7px;font-weight:400}
.row input{width:auto;height:auto}
.btn{width:100%;height:50px;border:0;border-radius:12px;background:var(--lime);color:#2f3a0c;font-size:16px;font-weight:800;cursor:pointer;margin-top:22px}
.btn:hover{filter:brightness(.97)}
.err{background:#ffe1e1;color:#b3352f;border-radius:10px;padding:11px 14px;font-size:13px;margin-bottom:16px}
.demo{margin-top:22px;border-top:1px solid #eee;padding-top:16px;font-size:12.5px;color:#888}
.demo b{color:#444}
.demo .r{display:flex;justify-content:space-between;margin-top:6px;cursor:pointer;padding:5px 8px;border-radius:8px}
.demo .r:hover{background:#f6f9ee}
</style>
</head>
<body>
<form class="card" method="POST" action="{{ url('/login') }}">
    @csrf
    <div class="brand"><span class="brand-mark"><i></i><i></i><i></i><i></i></span>Indus Resort Restaurant</div>
    <h1>Welcome back</h1>
    <div class="sub">Sign in to your hotel management dashboard</div>
    @if($errors->any())<div class="err">{{ $errors->first() }}</div>@endif
    <label>Email</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="you@lodgify.com" required autofocus>
    <label>Password</label>
    <input type="password" name="password" id="password" placeholder="••••••••" required>
    <div class="row"><label><input type="checkbox" name="remember" checked> Keep me signed in</label></div>
    <button class="btn" type="submit">Sign In</button>
</form>
</body>
</html>
