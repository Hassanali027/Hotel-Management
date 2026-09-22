{{-- Shared desktop/laptop responsive layout. Replaces the old body{zoom} scaling: the page fills the
     viewport height, the main column scrolls, and wide grids stack on smaller laptops. Phone layouts
     (up to 768px) are handled by each page's own mobile CSS and are not touched here. --}}
<style>
@media(min-width:769px){
    /* Fill the screen: sidebar stays put, content scrolls. No empty band below the page. */
    html{height:100%}
    body{zoom:1!important;min-height:100vh;height:auto;display:flex!important;align-items:stretch}
    /* Sidebar runs the full page height; its menu stays pinned to the top while the page scrolls. */
    .app-sidebar{position:relative;height:auto!important;min-height:100vh!important;align-self:stretch!important;flex:0 0 230px!important;overflow:visible;display:block!important}
    .app-sidebar>.app-brand{position:sticky;top:0;background:#fff;z-index:2;margin:-28px -18px 0!important;padding:28px 28px 30px!important}
    .app-sidebar>.app-menu{position:sticky;top:96px}
    /* Logout pinned to the bottom-left of the sidebar, always visible. */
    .app-sidebar{padding-bottom:104px!important}
    .app-sidebar .app-logout{position:fixed!important;left:0;bottom:0;width:230px;margin:0!important;padding:10px 18px 16px;background:#fff;border-top:1px solid #f0f0f0;z-index:3}
    .main,.content{flex:1 1 auto;min-width:0;width:auto!important;max-width:none!important;min-height:100vh;display:flex;flex-direction:column}
    /* Footer sits right under the content (a little breathing room), and the page bottom stays tight. */
    .main>footer,.content>.footer{margin-top:auto;padding-top:18px!important;padding-bottom:6px!important}
    .main,.content{padding-bottom:12px!important}
    .content>.footer{margin-top:18px!important}
    /* Fluid type: a touch smaller on laptops so tables and cards fit without scaling the whole page. */
    body{font-size:15px}
    .top h1,.tl h1{font-size:clamp(20px,1.8vw,30px)!important}
    /* Component sizes scale with the viewport so a 13" laptop is not a blown-up version of a 27" screen. */
    :root{--ui:clamp(.82,calc(.55 + .03vw),1)}
    .panel,.card,.detail,.rcard,.booking-list,.rev,.scard,.earn,.donut-card{border-radius:14px}

    /* Tables: keep columns but let them shrink to the panel width before falling back to horizontal scroll. */
    .tbl{overflow-x:auto}
    .thead,.trow{min-width:0!important}
}
/* Standard laptops (1100–1440px): tighter paddings, two-column layouts stay but narrow. */
@media(min-width:769px) and (max-width:1440px){
    body{font-size:14px}
    h2{font-size:16px!important}
    .top{margin-bottom:16px!important}
    .top .avatar{width:38px!important;height:38px!important;font-size:13px!important}
    .top .pinfo b{font-size:14px!important}.top .pinfo small{font-size:12px!important}
    .top .tool{width:38px!important;height:38px!important}
    .top .search{width:240px!important;height:38px!important}
    /* rooms list + detail */
    .rcard{padding:12px!important;gap:14px!important}
    .rbody h3{font-size:17px!important;margin-bottom:8px!important}
    .rstatus{font-size:11px!important;padding:4px 10px!important}
    .specs{font-size:12.5px!important;gap:14px!important;margin-bottom:8px!important}
    .rdesc{font-size:12.5px!important;line-height:1.45!important;margin-bottom:10px!important}
    .avail{font-size:12.5px!important}.price{font-size:20px!important}.price small{font-size:12px!important}
    .dtitle h1{font-size:24px!important}.dtop h2{font-size:15px!important}.docc{font-size:13px!important}
    .ghero{height:220px!important}.gthumbs img{height:64px!important}
    .dspecs{font-size:13px!important;gap:16px!important}.ddesc{font-size:12.5px!important}
    .sec h4{font-size:14px!important}.fitem{font-size:12.5px!important}
    .edit{height:34px!important;font-size:13px!important;padding:0 14px!important}
    /* generic controls */
    .pill,.addr,.add,.fsel,select.fsel,.search{height:38px!important;font-size:13.5px!important}
    .sortby{font-size:13px!important}
    /* reservation/other tables */
    .g b{font-size:13.5px!important}.g small{font-size:12px!important}
    .st,.av,.rt{font-size:12px!important;padding:5px 10px!important}
    .abtn{height:32px!important;font-size:12.5px!important;padding:0 12px!important}
    .ib{width:32px!important;height:32px!important}
    .tbottom{font-size:13px!important;padding:14px 4px 8px!important}.pg{min-width:34px!important;height:34px!important;font-size:13px!important}
    /* dashboard */
    .stats>.stat{height:110px!important;padding:14px!important}
    .stats>.stat .num{font-size:24px!important}
    .stats>.stat .label{font-size:12.5px!important}
    .stats>.stat .tag{font-size:11px!important}
    .stats>.stat .miniicon{width:32px!important;height:32px!important}
    .rooms,.revenue{padding:18px!important}
    .rs{font-size:12px!important}.rs b{font-size:20px!important}
    .task{font-size:12px!important}
    /* expenses */
    .sc-num{font-size:22px!important}.sc-head{font-size:13px!important}
    /* reviews */
    .rev{padding:16px!important}.rev p{font-size:13px!important}
    footer,.footer{font-size:12.5px!important}
    .main{padding:20px 22px 14px!important}
    .content{padding:18px 20px!important}
    .app-sidebar{flex-basis:210px!important;width:210px!important;padding:22px 14px 80px!important}
    .app-sidebar .app-logout{width:210px;padding:10px 14px 14px}
    .app-sidebar .app-menu>a,.app-sidebar .financial-toggle{height:40px!important;font-size:14px!important}
    .app-sidebar .app-upgrade{display:none!important}
    .panel,.card,.detail{padding:18px!important}
    .thead{padding:12px 16px!important;font-size:13px!important}
    .trow{padding:12px 16px!important;font-size:13.5px!important}
    .thead,.trow{min-width:900px!important}
    .search{width:220px!important}
    .fsel,select.fsel{height:40px!important;font-size:14px!important}
    .pill,.addr,.add{height:40px!important;font-size:14px!important}
    /* Rooms: detail panel narrower */
    .wrap{grid-template-columns:minmax(0,1fr) 440px!important}
    .rimg{width:180px!important;flex-basis:180px!important;height:120px!important}
    /* Guest profile: three cards stay side by side but tighter */
    .gtop{gap:14px!important}
    /* Calendar: mini calendar narrower */
    .cal-wrap{grid-template-columns:300px minmax(0,1fr)!important}
    /* Expenses: donut column narrower */
    .fin-top{grid-template-columns:minmax(0,1fr) 320px!important}
    /* Dashboard */
    .grid{grid-template-columns:minmax(0,1fr) 260px!important;gap:16px!important}
    .stats{gap:12px!important}
    .stats>.stat{height:120px!important;padding:16px!important}
    .stats>.stat .num{font-size:28px!important}
    .stats>.stat .label{font-size:13px!important}
    .split{grid-template-columns:260px minmax(0,1fr)!important;gap:16px!important}
    .lower{gap:16px!important}
}
/* Small laptops (769–1200px): stack the side panels under the main content. */
@media(min-width:769px) and (max-width:1200px){
    body{font-size:13.5px}
    .top h1,.tl h1{font-size:20px!important}
    /* compact sidebar: icons only, labels on hover */
    .app-sidebar{flex-basis:72px!important;width:72px!important;padding:16px 10px!important}
    .app-sidebar>.app-brand{padding:12px 8px 16px!important;margin:-16px -10px 0!important;justify-content:center!important;font-size:0!important;gap:0!important}
    .app-sidebar>.app-brand .app-brand-logo{width:36px!important;height:36px!important;flex-basis:36px!important}
    .app-sidebar>.app-menu{top:70px}
    .app-sidebar .app-menu>a,.app-sidebar .financial-toggle{justify-content:center!important;padding:0!important;font-size:0!important;gap:0!important;height:42px!important;position:relative}
    .app-sidebar .app-menu>a .icon,.app-sidebar .financial-toggle .icon{width:21px!important;height:21px!important;flex-basis:21px!important}
    .app-sidebar .app-badge,.app-sidebar .app-chevron{display:none!important}
    .app-sidebar .financial-submenu{padding:2px 0 2px 0!important}
    .app-sidebar .financial-submenu a{justify-content:center!important;padding:0!important;font-size:10px!important;height:30px!important}
    .app-sidebar .app-logout{width:72px;padding:10px 10px 14px}
    .app-sidebar .app-menu form button{font-size:0!important;justify-content:center!important;padding:0!important}
    .app-sidebar .app-menu form button .icon{width:21px!important;height:21px!important}
    .app-sidebar .app-menu>a:hover::after,.app-sidebar .financial-toggle:hover::after{content:attr(data-label);position:absolute;left:calc(100% + 10px);top:50%;transform:translateY(-50%);background:#111;color:#fff;font-size:12px;padding:5px 9px;border-radius:7px;white-space:nowrap;z-index:50}
    .main{padding:16px 18px 12px!important}.content{padding:14px 16px!important}
    .wrap,.gtop,.cal-wrap,.fin-top,.grid2{grid-template-columns:minmax(0,1fr)!important}
    .grid{grid-template-columns:minmax(0,1fr)!important}
    .right{display:grid!important;grid-template-columns:repeat(3,minmax(0,1fr))!important;gap:16px!important;align-items:start}
    .right>*{height:auto!important;min-height:0!important}
    .split{grid-template-columns:minmax(0,1fr)!important}
    .rooms,.revenue{height:auto!important;min-height:0!important}
    .stat-row{gap:12px!important}
    .filters,.pt,.rfilter,.hhead{flex-wrap:wrap!important;gap:10px!important}
    .fl,.fr,.pt-r,.hh-r{flex-wrap:wrap!important}
    .search{width:200px!important}
    .rev-grid{grid-template-columns:repeat(2,minmax(0,1fr))!important}
    .rimg{width:150px!important;flex-basis:150px!important;height:100px!important}
}
@media(min-width:769px) and (max-width:1100px){
    .content{overflow-x:hidden}
    .content .top .search{width:200px!important}
    .content .top .user{display:none!important}
    .chart{min-width:0!important}.months{min-width:0!important}
    .bl-head,.bl-row{min-width:760px!important}
}
@media(min-width:769px) and (max-width:1000px){
    .right{grid-template-columns:minmax(0,1fr)!important}
    .stat-row,.stats{grid-template-columns:repeat(2,minmax(0,1fr))!important}
    .lower{grid-template-columns:minmax(0,1fr)!important}
    .rev-grid{grid-template-columns:minmax(0,1fr)!important}
    .rcard{flex-direction:column!important}.rimg{width:100%!important;flex-basis:auto!important;height:170px!important}
    .top .profile .pinfo{display:none!important}
}
</style>
