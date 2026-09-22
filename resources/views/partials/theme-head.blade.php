{{-- Critical first-paint styles.

     The sidebar partial ships its own light styles and sits in <body> before
     partials.desktop-theme, so the browser painted a white sidebar and then repainted it
     dark green. Loading the few colours that decide that first frame here, in <head>,
     removes the flash. The full theme still loads afterwards and refines everything else. --}}
<style>
@media(min-width:769px){
    body{background:#f3f6f4}
    .app-sidebar{background:#123527!important;color:#dfe9e2!important;border-right:0!important}
    .app-sidebar>.app-brand{background:#123527!important;color:#fff!important}
    .app-sidebar .app-menu>a,.app-sidebar .financial-toggle,
    .app-sidebar .financial-submenu a{color:#c9d8ce!important;background:transparent!important}
    .app-sidebar .app-menu a.active{background:#e6f4ea!important;color:#123527!important}
    .app-sidebar .app-logout{background:transparent!important;border-top:1px solid rgba(255,255,255,.10)!important}
    .app-sidebar .app-logout button{color:#f1b6b6!important}
    .app-sidebar .app-upgrade{display:none!important}
}
</style>
