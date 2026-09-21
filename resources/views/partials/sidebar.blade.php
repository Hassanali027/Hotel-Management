{{-- Shared sidebar: self-contained styling so every page renders it identically. --}}
<style>
    .app-sidebar{width:230px!important;flex:0 0 230px!important;min-height:100vh;padding:28px 18px!important;background:#fff!important;display:flex!important;flex-direction:column!important;font-family:Lato,Arial,sans-serif}
    .app-sidebar .app-brand{display:flex!important;align-items:center!important;gap:9px!important;padding:0 10px 30px!important;font-size:16px!important;font-weight:800!important;line-height:1.25!important;color:#101010}
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
    @media(max-width:700px){
        .app-sidebar{width:100%!important;flex-basis:auto!important;min-height:auto!important;padding:22px 16px!important}
        .app-sidebar .app-menu{display:flex!important;overflow-x:auto}
        .app-sidebar .app-menu>a,.app-sidebar .financial-toggle{height:46px!important;white-space:nowrap}
        .app-sidebar .icon{display:none!important}
        .app-sidebar .financial-group,.app-sidebar .app-upgrade{display:none!important}
    }
</style>
<aside class="app-sidebar">
    <div class="app-brand"><span class="app-brand-mark"><i></i><i></i><i></i><i></i></span>Indus Resort Restaurant</div>
    <nav class="app-menu" aria-label="Main navigation">
        <a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}"><svg class="icon" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>Dashboard</a>
        <a class="{{ request()->is('reservation') ? 'active' : '' }}" href="{{ url('/reservation') }}"><svg class="icon" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/><path d="m9 15 2 2 4-4"/></svg>Reservation</a>
        @if(auth()->user()->can_access('rooms'))<a class="{{ request()->is('rooms') ? 'active' : '' }}" href="{{ url('/rooms') }}"><svg class="icon" viewBox="0 0 24 24"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1z"/><path d="M9 21v-7h6v7"/></svg>Rooms</a>@endif
        <a class="{{ request()->is('housekeeping') ? 'active' : '' }}" href="{{ url('/housekeeping') }}"><svg class="icon" viewBox="0 0 24 24"><path d="M4 21V9a2 2 0 0 1 2-2h2l1-3h6l1 3h2a2 2 0 0 1 2 2v12"/><path d="M4 13h16"/></svg>Housekeeping</a>
        <a class="{{ request()->is('inventory') ? 'active' : '' }}" href="{{ url('/inventory') }}"><svg class="icon" viewBox="0 0 24 24"><path d="m21 8-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8"/><path d="M12 13v8"/></svg>Inventory</a>
        <a class="{{ request()->is('calendar') ? 'active' : '' }}" href="{{ url('/calendar') }}"><svg class="icon" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/></svg>Calendar</a>
        @if(auth()->user()->can_access('invoice'))<div class="financial-group {{ (request()->is('invoice') || request()->is('expenses')) ? 'open' : '' }}">
            <a href="#" class="financial-toggle" onclick="event.preventDefault(); this.parentElement.classList.toggle('open');"><svg class="icon" viewBox="0 0 24 24"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="3"/></svg>Financials <span class="app-chevron">⌄</span></a>
            <div class="financial-submenu">
                <a class="{{ request()->is('invoice') ? 'active' : '' }}" href="{{ url('/invoice') }}">Invoice</a>
                <a class="{{ request()->is('expenses') ? 'active' : '' }}" href="{{ url('/expenses') }}">Expenses</a>
            </div>
        </div>@endif
        @if(auth()->user()->can_access('reviews'))<a class="{{ request()->is('reviews') ? 'active' : '' }}" href="{{ url('/reviews') }}"><svg class="icon" viewBox="0 0 24 24"><path d="m12 3 2.9 5.9 6.5.9-4.7 4.6 1.1 6.5L12 18l-5.8 3 1.1-6.5L2.6 9.8l6.5-.9z"/></svg>Reviews</a>@endif
        @if(auth()->user()->can_access('concierge'))<a class="{{ request()->is('concierge') ? 'active' : '' }}" href="{{ url('/concierge') }}"><svg class="icon" viewBox="0 0 24 24"><rect x="4" y="3" width="16" height="18" rx="2"/><circle cx="12" cy="10" r="2.5"/><path d="M8 17a4 4 0 0 1 8 0"/></svg>Concierge</a>@endif
    </nav>
    <form method="POST" action="{{ url('/logout') }}" style="margin-top:8px">@csrf
        <button type="submit" style="width:100%;display:flex;align-items:center;gap:12px;height:44px;border:0;border-radius:9px;padding:0 12px;background:transparent;color:#b3352f;font:600 15px Lato,Arial,sans-serif;cursor:pointer">
            <svg class="icon" viewBox="0 0 24 24" style="stroke:#b3352f"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg>Logout ({{ ucfirst(auth()->user()->role ?? '') }})
        </button>
    </form>
    <section class="app-upgrade"><img class="upgrade-visual" src="{{ asset('images/OBJECTS.png') }}" alt="Hotel illustration"><h2>Elevate Hospitality<br>Standards</h2><p>Enhanced Reporting, Faster Check-Ins, &amp; Integrated Marketing Tools</p><button>Update Now</button></section>
</aside>
