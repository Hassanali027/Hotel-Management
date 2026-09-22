<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Sign in - Indus Resort Restaurant</title>
<link rel="icon" href="{{ asset('favicon.ico') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Great+Vibes&display=swap" rel="stylesheet">
<style>
:root{
    --g900:#123527;--g800:#1e4a36;--g700:#2f6b4f;--g100:#e6f4ea;--g50:#f1f8f3;
    --ink:#111827;--muted:#6b7280;--line:#e5e9e6;--canvas:#f3f6f4;--red:#b3352f;
}
*{box-sizing:border-box}
html,body{height:100%}
body{margin:0;background:var(--canvas);font-family:Inter,Lato,Arial,sans-serif;color:var(--ink);-webkit-font-smoothing:antialiased}

/* ---------- Two panes: the resort on the left, the form on the right ---------- */
.auth{min-height:100vh;display:grid;grid-template-columns:1.05fr .95fr}

/* Left: photograph with the dark green wash used across the app. */
.auth-art{position:relative;overflow:hidden;display:flex;flex-direction:column;justify-content:space-between;padding:44px 48px;color:#fff}
.auth-art::before{content:'';position:absolute;inset:0;
    background:linear-gradient(180deg,rgba(18,53,39,.72) 0%,rgba(18,53,39,.55) 45%,rgba(18,53,39,.92) 100%),
               url('{{ asset('images/rooms/resort-hero.jpg') }}') center/cover no-repeat;
    filter:saturate(.75)}
.auth-art>*{position:relative;z-index:1}
.art-brand{display:flex;align-items:center;gap:12px;font-size:18px;font-weight:700;line-height:1.15}
.art-brand img{width:42px;height:42px;border-radius:50%;background:#fff;flex:0 0 42px;object-fit:cover}
.art-brand small{display:block;font-size:13px;font-weight:400;color:rgba(255,255,255,.75)}
.art-copy h2{margin:0 0 10px;font-size:34px;line-height:1.2;font-weight:700;letter-spacing:-.4px;max-width:14ch}
.art-copy p{margin:0;font-size:14.5px;line-height:1.7;color:rgba(255,255,255,.82);max-width:42ch}
.art-script{font-family:'Great Vibes',cursive;font-size:30px;color:rgba(255,255,255,.9);margin-bottom:14px;line-height:1.1}
.art-foot{display:flex;gap:26px;font-size:12.5px;color:rgba(255,255,255,.72)}
.art-foot b{display:block;font-size:19px;font-weight:700;color:#fff;margin-bottom:2px}

/* Right: the form. */
.auth-form{display:flex;align-items:center;justify-content:center;padding:40px 44px;background:#fff}
.form-inner{width:100%;max-width:400px}
.form-brand{display:none;align-items:center;gap:11px;margin-bottom:28px;font-size:16px;font-weight:700}
.form-brand img{width:40px;height:40px;border-radius:50%;flex:0 0 40px;object-fit:cover}
.form-brand small{display:block;font-size:12.5px;font-weight:400;color:var(--muted)}
h1{font-size:27px;margin:0 0 6px;letter-spacing:-.5px;font-weight:700}
.sub{color:var(--muted);font-size:14px;margin:0 0 26px}

label{display:block;font-size:13px;color:#374151;margin:0 0 7px;font-weight:600}
.field{position:relative;margin-bottom:16px}
.field>svg{position:absolute;left:15px;top:50%;transform:translateY(-50%);width:18px;height:18px;fill:none;stroke:#9ca3af;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;pointer-events:none}
input[type=email],input[type=password],input[type=text]{width:100%;height:50px;border:1px solid var(--line);border-radius:12px;padding:0 15px 0 44px;font-size:15px;font-family:inherit;color:var(--ink);background:var(--g50);transition:.15s}
input::placeholder{color:#9ca3af}
input[type=email]:focus,input[type=password]:focus,input[type=text]:focus{outline:none;border-color:var(--g700);background:#fff;box-shadow:0 0 0 3px rgba(47,107,79,.14)}
.peek{position:absolute;right:8px;top:50%;transform:translateY(-50%);width:36px;height:36px;border:0;background:none;border-radius:9px;display:grid;place-items:center;cursor:pointer;color:#9ca3af}
.peek:hover{background:var(--g50);color:var(--g700)}
.peek svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}

.row{display:flex;align-items:center;justify-content:space-between;gap:12px;margin:2px 0 22px;font-size:13.5px;color:#4b5563}
.row label{margin:0;display:flex;align-items:center;gap:9px;font-weight:400;cursor:pointer}
.row input[type=checkbox]{width:17px;height:17px;accent-color:var(--g700);cursor:pointer}
.hint{color:var(--muted);font-size:13px}

.btn{width:100%;height:50px;border:0;border-radius:12px;background:var(--g800);color:#fff;font-size:15.5px;font-weight:700;font-family:inherit;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;gap:9px;transition:.15s}
.btn:hover{background:var(--g900)}
.btn svg{width:17px;height:17px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}

.err{display:flex;align-items:flex-start;gap:10px;background:#fde3e5;color:var(--red);border-radius:11px;padding:12px 14px;font-size:13.5px;margin-bottom:20px;line-height:1.5}
.err svg{width:17px;height:17px;flex:0 0 17px;margin-top:1px;fill:none;stroke:currentColor;stroke-width:2}

.foot{margin-top:26px;padding-top:18px;border-top:1px solid var(--line);font-size:12.5px;color:var(--muted);text-align:center;line-height:1.7}

/* ---------- Tablet: the art pane becomes a header band ---------- */
@media(max-width:1000px){
    .auth{grid-template-columns:1fr;grid-template-rows:auto 1fr}
    .auth-art{padding:30px 32px;min-height:250px}
    .art-copy h2{font-size:26px;max-width:none}
    .art-script{font-size:24px}
    .auth-form{padding:36px 32px}
}

/* ---------- Phone: photo header hidden, single clean card ---------- */
@media(max-width:768px){
    body{background:var(--canvas)}
    .auth{grid-template-rows:1fr;min-height:100dvh}
    .auth-art{display:none}
    .form-brand{display:flex}
    .auth-form{background:transparent;padding:0;align-items:stretch}
    .form-inner{max-width:none;display:flex;flex-direction:column;
        background:#fff;border-radius:0;padding:32px 22px calc(28px + env(safe-area-inset-bottom));min-height:100dvh}
    h1{font-size:25px}
    .sub{margin-bottom:24px}
    input[type=email],input[type=password],input[type=text]{height:52px;font-size:16px}
    /* Side by side these two wrapped onto two lines each; stack them instead. */
    .row{flex-direction:column;align-items:flex-start;gap:10px;margin-bottom:24px}
    .row label{font-size:14px}
    .hint{font-size:12.5px}
    .btn{height:52px;margin-top:2px}
    .foot{margin-top:auto}
}
@media(max-width:360px){
    .form-inner{padding:26px 16px}
    h1{font-size:22px}
}
</style>
</head>
<body>
<div class="auth">

    <section class="auth-art">
        <div class="art-brand">
            <img src="{{ asset('images/logo.png') }}" alt="">
            <span>Indus Resort<small>Murree, Pakistan</small></span>
        </div>
        <div class="art-copy">
            <div class="art-script">Relax &middot; Unwind &middot; Belong</div>
            <h2>Mountain views, better stays</h2>
            <p>Manage reservations, rooms, housekeeping and billing for Indus Resort from a single dashboard.</p>
        </div>
        <div class="art-foot">
            <span><b>6</b>Rooms &amp; portions</span>
            <span><b>2</b>Floors</span>
            <span><b>24/7</b>Front desk</span>
        </div>
    </section>

    <section class="auth-form">
        <form class="form-inner" method="POST" action="{{ url('/login') }}">
            @csrf

            <div class="form-brand">
                <img src="{{ asset('images/logo.png') }}" alt="">
                <span>Indus Resort<small>Murree, Pakistan</small></span>
            </div>

            <h1>Welcome back</h1>
            <p class="sub">Sign in to your hotel management dashboard.</p>

            @if($errors->any())
                <div class="err">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v5M12 16h.01"/></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <label for="email">Email</label>
            <div class="field">
                <svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 6 10 7L22 6"/></svg>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="you@indusresort.com" required autofocus autocomplete="username">
            </div>

            <label for="password">Password</label>
            <div class="field">
                <svg viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                <input type="password" name="password" id="password" placeholder="Enter your password" required autocomplete="current-password">
                <button class="peek" type="button" id="peek" aria-label="Show password" title="Show password">
                    <svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>

            <div class="row">
                <label><input type="checkbox" name="remember" checked> Keep me signed in</label>
                <span class="hint">Need access? Ask an admin.</span>
            </div>

            <button class="btn" type="submit">
                <svg viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3"/></svg>
                Sign In
            </button>

            <div class="foot">Indus Resort Murree &middot; Bhurban Road<br>&copy; {{ date('Y') }} Indus Resort. All rights reserved.</div>
        </form>
    </section>

</div>

<script>
// Show/hide the password without losing what has been typed.
(function () {
    var btn = document.getElementById('peek'), input = document.getElementById('password');
    if (!btn || !input) return;
    btn.addEventListener('click', function () {
        var showing = input.type === 'text';
        input.type = showing ? 'password' : 'text';
        btn.setAttribute('aria-label', showing ? 'Show password' : 'Hide password');
        btn.title = showing ? 'Show password' : 'Hide password';
        btn.innerHTML = showing
            ? '<svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>'
            : '<svg viewBox="0 0 24 24"><path d="M3 3l18 18M10.6 10.6a3 3 0 0 0 4.2 4.2M9.9 5.2A9.6 9.6 0 0 1 12 5c6.5 0 10 7 10 7a17 17 0 0 1-3.2 4.1M6.2 6.2A17 17 0 0 0 2 12s3.5 7 10 7c1.4 0 2.7-.3 3.9-.8"/></svg>';
        input.focus();
    });
})();
</script>
</body>
</html>
