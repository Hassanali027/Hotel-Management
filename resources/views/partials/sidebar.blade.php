{{-- Shared sidebar: self-contained styling so every page renders it identically. --}}
<style>
    .app-sidebar{width:230px!important;flex:0 0 230px!important;min-height:100vh;padding:28px 18px!important;background:#fff!important;display:flex!important;flex-direction:column!important;font-family:Lato,Arial,sans-serif}
    .app-sidebar .app-brand{display:flex!important;align-items:center!important;gap:9px!important;padding:0 10px 30px!important;font-size:16px!important;font-weight:800!important;line-height:1.25!important;color:#101010}
    .app-sidebar .app-brand-logo{width:32px!important;height:32px!important;flex:0 0 32px!important;object-fit:contain!important;border-radius:7px!important}
    .app-sidebar .app-brand-mark{width:22px!important;height:22px!important;display:grid!important;grid-template-columns:repeat(2,1fr)!important;grid-template-rows:repeat(2,1fr)!important;gap:3px!important}
    .app-sidebar .app-brand-mark i{background:#b6d8cb!important}
    .app-sidebar .app-brand-mark i:nth-child(2),.app-sidebar .app-brand-mark i:nth-child(3){background:#e9fa86!important}
    .app-sidebar .app-menu{display:grid!important;gap:4px!important}
    .app-sidebar .app-menu>a,.app-sidebar .financial-toggle{height:44px!important;border-radius:9px!important;padding:0 12px!important;display:flex!important;align-items:center!important;gap:12px!important;color:#a6a6a6!important;text-decoration:none!important;font-size:15px!important;font-weight:500!important;transition:.18s ease}
    .app-sidebar .app-menu a:hover{background:#f7f7f7!important;color:#101010!important}
    .app-sidebar .app-menu a.active{background:#e9fa86!important;color:#101010!important;font-weight:600!important}
    .app-sidebar .icon{width:20px!important;height:20px!important;flex:0 0 20px!important;fill:none!important;stroke:currentColor!important;stroke-width:1.8!important;stroke-linecap:round;stroke-linejoin:round}
    .app-sidebar .app-badge{margin-left:auto!important;width:20px!important;height:20px!important;display:grid!important;place-items:center!important;border-radius:50%!important;background:#ff4242!important;color:#fff!important;font-size:11px!important;font-weight:700!important}
    .app-sidebar .app-chevron{margin-left:auto!important;width:6px!important;height:6px!important;flex:0 0 6px!important;font-size:0!important;border-right:1.5px solid currentColor!important;border-bottom:1.5px solid currentColor!important;transform:translateY(-2px) rotate(45deg)!important;transition:transform .2s ease!important}
    .app-sidebar .financial-group{display:block}
    .app-sidebar .financial-submenu{display:none;padding:2px 0 2px 44px}
    .app-sidebar .financial-group.open .financial-submenu{display:grid!important;gap:2px}
    .app-sidebar .financial-submenu a{height:36px!important;border-radius:8px!important;padding:0 12px!important;display:flex!important;align-items:center!important;color:#a6a6a6!important;text-decoration:none!important;font-size:14px!important;font-weight:500!important}
    .app-sidebar .financial-submenu a:hover{color:#101010!important}
    .app-sidebar .financial-submenu a.active{background:#e9fa86!important;color:#101010!important;font-weight:600!important}
    .app-sidebar .financial-group.open .financial-toggle .app-chevron{transform:translateY(2px) rotate(225deg)!important}
    .app-sidebar .app-upgrade{width:194px!important;min-height:210px!important;margin:48px auto 0!important;padding:52px 18px 16px!important;border-radius:0 0 12px 12px!important;background:#cff3e3!important;position:relative}
    .app-sidebar .upgrade-visual{position:absolute!important;z-index:1;top:-40px!important;left:50%!important;width:118px!important;height:auto!important;transform:translateX(-50%)!important}
    .app-sidebar .app-upgrade h2{margin:0 0 10px!important;font-size:16px!important;font-weight:700!important;line-height:1.35!important;color:#101010}
    .app-sidebar .app-upgrade p{margin:0 0 14px!important;font-size:10px!important;font-weight:400!important;line-height:1.5!important;color:#6a6a6a!important}
    .app-sidebar .app-upgrade button{background:#e9fa86!important;border:0!important;border-radius:9px!important;padding:11px 15px!important;font:700 12px Lato,Arial,sans-serif!important;cursor:pointer}
    .app-menu-toggle{display:none!important}
    @media(max-width:768px){
        /* One clean header on phones: brand bar removed, hamburger floats top-right,
           menu opens as a dropdown panel over the page's own header. */
        body{display:block!important;overflow-x:hidden!important}
        .app-sidebar{width:100%!important;min-height:0!important;padding:0!important;position:static!important;flex-basis:auto!important}
        .app-sidebar .app-brand{display:none!important}
        .app-menu-toggle{display:grid!important;place-items:center!important;position:fixed!important;right:14px!important;top:14px!important;width:42px!important;height:42px!important;border:0!important;border-radius:10px!important;background:#e9fa86!important;color:#2f3a0c!important;font-size:22px!important;line-height:1!important;cursor:pointer!important;z-index:1200!important;box-shadow:0 4px 14px rgba(0,0,0,.14)!important}
        .app-sidebar .app-menu{display:none!important;position:fixed!important;top:66px!important;left:12px!important;right:12px!important;z-index:1199!important;margin:0!important;padding:10px!important;background:#fff!important;border-radius:14px!important;box-shadow:0 16px 40px rgba(0,0,0,.18)!important;max-height:78vh!important;overflow:auto!important}
        .app-sidebar .app-menu.open{display:grid!important;gap:5px!important}
        .app-sidebar .app-menu>a,.app-sidebar .financial-toggle{height:46px!important;font-size:15px!important;white-space:nowrap!important}
        .app-sidebar .icon{display:block!important}
        .app-sidebar .financial-group{display:block!important}
        .app-sidebar .app-upgrade{display:none!important}
    }
</style>
<aside class="app-sidebar">
    <div class="app-brand"><img class="app-brand-logo" src="{{ asset('images/logo.png') }}" alt="Indus Resort Restaurant logo">Indus Resort Restaurant</div>
    <button class="app-menu-toggle" type="button" aria-label="Open menu" aria-expanded="false" onclick="toggleAppMenu(this)">☰</button>
    <nav class="app-menu" id="appMenu" aria-label="Main navigation">
        <a data-label="Dashboard" class="{{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}"><svg class="icon" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>Dashboard</a>
        <a data-label="Reservations" class="{{ request()->is('reservation') ? 'active' : '' }}" href="{{ url('/reservation') }}"><svg class="icon" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/><path d="m9 15 2 2 4-4"/></svg>Reservations</a>
        @if(auth()->user()->can_access('rooms'))<a data-label="Rooms" class="{{ request()->is('rooms') ? 'active' : '' }}" href="{{ url('/rooms') }}"><svg class="icon" viewBox="0 0 24 24"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1z"/><path d="M9 21v-7h6v7"/></svg>Rooms</a>@endif
        <a data-label="Housekeeping" class="{{ request()->is('housekeeping') ? 'active' : '' }}" href="{{ url('/housekeeping') }}"><svg class="icon" viewBox="0 0 24 24"><path d="M4 21V9a2 2 0 0 1 2-2h2l1-3h6l1 3h2a2 2 0 0 1 2 2v12"/><path d="M4 13h16"/></svg>Housekeeping</a>
        <a data-label="Inventory" class="{{ request()->is('inventory') ? 'active' : '' }}" href="{{ url('/inventory') }}"><svg class="icon" viewBox="0 0 24 24"><path d="m21 8-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8"/><path d="M12 13v8"/></svg>Inventory</a>
        <a data-label="Calendar" class="{{ request()->is('calendar') ? 'active' : '' }}" href="{{ url('/calendar') }}"><svg class="icon" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/></svg>Calendar</a>
        @if(auth()->user()->can_access('invoice'))<div class="financial-group {{ (request()->is('invoice') || request()->is('expenses')) ? 'open' : '' }}">
            <a href="#" class="financial-toggle" data-label="Financials" onclick="event.preventDefault(); this.parentElement.classList.toggle('open');"><svg class="icon" viewBox="0 0 24 24"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="3"/></svg>Financials <span class="app-chevron">⌄</span></a>
            <div class="financial-submenu">
                <a class="{{ request()->is('invoice') ? 'active' : '' }}" href="{{ url('/invoice') }}">Invoice</a>
                <a class="{{ request()->is('expenses') ? 'active' : '' }}" href="{{ url('/expenses') }}">Expenses</a>
            </div>
        </div>@endif
        @if(auth()->user()->can_access('reviews'))<a data-label="Reviews" class="{{ request()->is('reviews') ? 'active' : '' }}" href="{{ url('/reviews') }}"><svg class="icon" viewBox="0 0 24 24"><path d="m12 3 2.9 5.9 6.5.9-4.7 4.6 1.1 6.5L12 18l-5.8 3 1.1-6.5L2.6 9.8l6.5-.9z"/></svg>Reviews</a>@endif
        @if(auth()->user()->can_access('concierge'))<a data-label="Staff" class="{{ request()->is('concierge') ? 'active' : '' }}" href="{{ url('/concierge') }}"><svg class="icon" viewBox="0 0 24 24"><rect x="4" y="3" width="16" height="18" rx="2"/><circle cx="12" cy="10" r="2.5"/><path d="M8 17a4 4 0 0 1 8 0"/></svg>Staff</a>@endif
        <form method="POST" action="{{ url('/logout') }}" class="app-logout" style="margin-top:8px">@csrf
            <button type="submit" style="width:100%;display:flex;align-items:center;gap:12px;height:44px;border:0;border-radius:9px;padding:0 12px;background:transparent;color:#b3352f;font:600 15px Lato,Arial,sans-serif;cursor:pointer">
                <svg class="icon" viewBox="0 0 24 24" style="stroke:#b3352f"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg>Logout ({{ ucfirst(auth()->user()->role ?? '') }})
            </button>
        </form>
    </nav>
</aside>
<script>function toggleAppMenu(button){const menu=document.getElementById('appMenu');const open=menu.classList.toggle('open');button.setAttribute('aria-expanded',String(open));button.textContent=open?'×':'☰';}</script>
