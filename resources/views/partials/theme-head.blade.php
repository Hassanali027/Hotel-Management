{{-- Critical first-paint styles.

     The sidebar partial ships its own light styles and sits in <body> before
     partials.desktop-theme, so the browser painted a white sidebar and then repainted it
     dark green. Loading the few colours that decide that first frame here, in <head>,
     removes the flash. The full theme still loads afterwards and refines everything else. --}}
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Great+Vibes&display=swap" rel="stylesheet">
<style>
/* Same-origin navigations cross-fade instead of blanking, where the browser supports it. */
@view-transition{navigation:auto}
/* The sidebar is identical on every page, so name it and give its group no animation.
   The browser then carries the same element across the navigation instead of tearing it
   down and painting it again, which is what made it flash on each page change. */
@media(min-width:769px){
    .app-sidebar{view-transition-name:app-sidebar}
    ::view-transition-group(app-sidebar){animation:none}
    ::view-transition-old(app-sidebar),::view-transition-new(app-sidebar){animation:none;mix-blend-mode:normal}
}
::view-transition-old(root),::view-transition-new(root){animation-duration:.14s}
@media(prefers-reduced-motion:reduce){
    ::view-transition-old(root),::view-transition-new(root){animation:none}
}
/* Phones: the sidebar partial shows a floating hamburger, and partials.mobile-nav hides it
   again much later in the body. That gap is why the hamburger flashed while the page
   loaded. Settling it here means it is never painted. The dropdown still opens, because
   .app-menu.open is more specific than the rule below. */
@media(max-width:768px){
    .app-menu-toggle{display:none!important}
    .app-sidebar>.app-brand{display:none!important}
    .app-sidebar .app-menu{display:none!important}
    .app-sidebar{width:100%!important;min-height:0!important;padding:0!important;position:static!important;flex:0 0 auto!important;background:transparent!important;border:0!important;height:auto!important}
    .app-sidebar::before,.app-sidebar::after{display:none!important}
}
/* Some pages scroll and some do not. Without a reserved gutter the content width
   changes between them, and that shift is what snapped on every tab switch. */
html{scrollbar-gutter:stable}
@media(min-width:769px){
    body{background:#f3f6f4}
    .app-sidebar{background:#123527!important;color:#dfe9e2!important;border-right:0!important}
    .app-sidebar>.app-brand{background:#123527!important;color:#fff!important}
    .app-sidebar .app-menu>a,.app-sidebar .financial-toggle,
    .app-sidebar .financial-submenu a{color:#c9d8ce!important;background:transparent!important}
    .app-sidebar .app-menu a.active{background:#e6f4ea!important;color:#123527!important}
    .app-sidebar .app-logout{background:transparent!important;border-top:1px solid rgba(255,255,255,.10)!important}
    .app-sidebar .app-logout button{color:#fff!important}
    .app-sidebar .app-upgrade{display:none!important}
}
</style>
