{{-- Shared phone bottom navigation (Figma). Hidden on desktop; fixed to the bottom on screens up to 768px. --}}
<style>
    .md-nav{display:none}
    @media(max-width:768px){
        .md-nav{position:fixed;left:0;right:0;bottom:0;z-index:1100;background:#fff;border-top:1px solid #ececec;display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:4px;padding:8px 10px calc(10px + env(safe-area-inset-bottom));font-family:Lato,Arial,sans-serif}
        .md-nav a,.md-nav button{display:flex;flex-direction:column;align-items:center;gap:6px;text-decoration:none;color:#555;font:600 12px Lato,Arial,sans-serif;border:0;background:none;padding:9px 2px 7px;border-radius:14px;cursor:pointer;min-width:0;white-space:nowrap}
        .md-nav svg{width:24px;height:24px;flex:0 0 24px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
        .md-nav .on{background:#d9f5e5;color:#1f5f3f}
        .md-nav .on svg{stroke:#1f5f3f}
        .app-menu-toggle{display:none!important}
        .app-sidebar .app-menu{top:auto!important;bottom:92px!important;max-height:68vh!important}
    }
    @media(max-width:360px){.md-nav a,.md-nav button{font-size:10px}}
</style>
<nav class="md-nav" aria-label="Mobile navigation">
    <a class="{{ request()->is('/') ? 'on' : '' }}" href="{{ url('/') }}"><svg viewBox="0 0 24 24"><path d="m3 11 9-8 9 8v9a2 2 0 0 1-2 2h-4v-6h-6v6H5a2 2 0 0 1-2-2z"/></svg>Dashboard</a>
    <a class="{{ request()->is('reservation') ? 'on' : '' }}" href="{{ url('/reservation') }}"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 10h18M8 2v4M16 2v4"/></svg>Reservations</a>
    @if(auth()->user()->can_access('rooms'))<a class="{{ request()->is('rooms') ? 'on' : '' }}" href="{{ url('/rooms') }}"><svg viewBox="0 0 24 24"><path d="M3 18V8M3 14h18v4M21 14v-3a2 2 0 0 0-2-2h-8v5"/><path d="M5 11a2.5 2.5 0 0 1 5 0"/></svg>Rooms</a>@else<a class="{{ request()->is('housekeeping') ? 'on' : '' }}" href="{{ url('/housekeeping') }}"><svg viewBox="0 0 24 24"><path d="M3 18V8M3 14h18v4M21 14v-3a2 2 0 0 0-2-2h-8v5"/><path d="M5 11a2.5 2.5 0 0 1 5 0"/></svg>Rooms</a>@endif
    <button type="button" onclick="document.getElementById('appMenu').classList.toggle('open')"><svg viewBox="0 0 24 24" style="fill:currentColor;stroke:none"><circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/></svg>More</button>
</nav>
