{{-- Desktop design system (Figma): dark green sidebar, mountain header, white cards on a soft grey-green canvas,
     green primary buttons, soft status pills. Applied on screens wider than 768px; phone layouts are untouched. --}}
{{-- The Inter/Great Vibes stylesheet now loads from partials.theme-head, in <head>. --}}
<style>
@media(min-width:769px){
    :root{--g900:#123527;--g800:#1e4a36;--g700:#2f6b4f;--g600:#3b8a63;--g500:#4aa374;--g100:#e6f4ea;--g50:#f1f8f3;
          --lime:#e6f4ea;--lime2:#d3e8db;--olive:#5d9c7b;--sage:#9dc7b0;--mint:#d2f3e4;--mint-d:#b9d8c7;--mint-dark:#b9d8c7;--plime:#eef6f0;--pmint:#f1f8f3;--pevent:#bcd9c8;--ink:#111827;--muted:#6b7280;--line:#e5e9e6;--canvas:#f3f6f4;--card:#ffffff;
          --amber:#f2c14e;--amber100:#fdf3d2;--red:#e04b4b;--red100:#fde2e5;--blue:#3b82f6;--blue100:#dfebfb;--purple100:#ece7fb}
    body{background:var(--canvas)!important;font-family:Inter,Lato,Arial,sans-serif!important;color:var(--ink)!important}
    .main,.content{background:var(--canvas)!important;padding:0 0 12px!important}
    @media(max-width:1440px){.main,.content{padding:0 0 12px!important}}
    @media(max-width:1200px){.main,.content{padding:0 0 12px!important}}

    /* ---------- Sidebar ---------- */
    .app-sidebar{background:var(--g900)!important;color:#dfe9e2;padding:0!important;border-right:0;font-family:Inter,Lato,Arial,sans-serif!important}
    .app-sidebar>.app-brand{background:var(--g900)!important;color:#fff!important;padding:22px 20px 18px!important;margin:0!important;gap:12px!important;font-size:17px!important;line-height:1.1!important}
    .app-sidebar .app-brand-logo{width:38px!important;height:38px!important;flex-basis:38px!important;border-radius:50%!important;background:#fff}
    .app-sidebar>.app-menu{padding:6px 12px 0!important;gap:2px!important;top:82px}
    .app-sidebar .app-menu>a,.app-sidebar .financial-toggle{color:#c9d8ce!important;height:42px!important;border-radius:10px!important;padding:0 14px!important;font-size:14px!important;font-weight:500!important}
    .app-sidebar .app-menu>a:hover,.app-sidebar .financial-toggle:hover{background:rgba(255,255,255,.07)!important;color:#fff!important}
    /* The Financials toggle is nested in .financial-group, so it needs its own high-specificity hover. */
    .app-sidebar .app-menu a:hover,
    .app-sidebar .app-menu .financial-group a.financial-toggle:hover,
    .app-sidebar .app-menu .financial-group .financial-submenu a:hover{background:rgba(255,255,255,.08)!important;color:#fff!important}
    .app-sidebar .app-menu .financial-group a.financial-toggle:hover .icon{stroke:#fff!important}
    .app-sidebar .app-menu a.active{background:var(--lime)!important;color:var(--g900)!important;font-weight:700!important}
    .app-sidebar .icon{stroke:currentColor!important;width:19px!important;height:19px!important;flex-basis:19px!important}
    .app-sidebar .financial-submenu a{color:#b7c8bd!important;font-size:13px!important;border-radius:9px!important;height:36px!important;padding:0 12px!important}
    .app-sidebar .financial-submenu a:hover{background:rgba(255,255,255,.07)!important;color:#fff!important}
    .app-sidebar .financial-submenu a.active{background:rgba(232,251,130,.18)!important;color:#fff!important}
    .app-sidebar .app-chevron{border-color:#c9d8ce!important}
    .app-sidebar .app-logout{background:transparent!important;border-top:1px solid rgba(255,255,255,.10)!important;backdrop-filter:blur(2px)}
    .app-sidebar .app-logout button{color:#fff!important}
    .app-sidebar .app-logout button .icon{stroke:#fff!important}
    /* Pine forest artwork at the foot of the sidebar (Figma). */
    .app-sidebar::before{content:'';position:absolute;left:0;bottom:0;width:230px;height:min(430px,50vh);
        background:linear-gradient(180deg,rgba(18,53,39,.72) 0%,rgba(18,53,39,.52) 38%,rgba(18,53,39,.60) 72%,rgba(18,53,39,.86) 100%),url('{{ asset('images/rooms/resort-hero.jpg') }}') center bottom/cover no-repeat;
        filter:saturate(.7);opacity:.95;
        -webkit-mask-image:linear-gradient(180deg,transparent 0%,#000 18%,#000 100%);mask-image:linear-gradient(180deg,transparent 0%,#000 18%,#000 100%);
        pointer-events:none;z-index:0}
    .app-sidebar::after{content:'Relax · Unwind · Belong\A Indus Resort Murree';white-space:pre-line;position:absolute;left:0;bottom:104px;width:230px;text-align:center;font-size:11.5px;line-height:1.75;color:rgba(255,255,255,.88);letter-spacing:.3px;text-shadow:0 1px 10px rgba(0,0,0,.75);z-index:1;pointer-events:none}
    /* Pin the whole sidebar instead of only the menu: the brand was scrolling out of view.
       It is a flex column so Logout can sit at the very bottom without being fixed. */
    .app-sidebar{position:sticky!important;top:0!important;height:100vh!important;min-height:100vh!important;align-self:flex-start!important;
        display:flex!important;flex-direction:column!important;overflow-y:auto;overflow-x:hidden;scrollbar-width:none;padding-bottom:0!important;isolation:isolate}
    .app-sidebar::-webkit-scrollbar{width:0;display:none}
    .app-sidebar>.app-brand{position:relative!important;top:auto!important;z-index:2;flex:0 0 auto}
    /* Logout lives inside .app-menu, so the menu itself has to fill the column for the
       auto margin to push it to the bottom. */
    .app-sidebar>.app-menu{position:relative!important;top:auto!important;z-index:2;flex:1 1 auto;
        display:flex!important;flex-direction:column!important;gap:2px!important;padding-bottom:12px!important}
    .app-sidebar .app-logout{position:sticky!important;bottom:0!important;left:auto!important;right:auto!important;width:auto!important;
        margin-top:auto!important;flex:0 0 auto;z-index:3;margin-left:-12px!important;margin-right:-12px!important;padding:12px 18px 16px!important;background:rgba(18,53,39,.72)!important;backdrop-filter:blur(6px)}
    @media(max-width:1440px){.app-sidebar::after,.app-sidebar::before{left:0;width:210px}}
    @media(max-width:1200px){.app-sidebar::after{display:none}.app-sidebar::before{left:0;width:72px;height:min(260px,32vh)}}

    /* ---------- Retire the old lime accents (Figma green system) ---------- */
    .toggle button.on,.seg button.on,.pg.active,.ms-chip.on,
    .pill.lime,.dl,.add,.addr,button.pill[style*="--lime"],label[style*="--lime"]{
        background:var(--g800)!important;color:#fff!important;border-color:var(--g800)!important;font-weight:700!important}
    /* Icons follow the button's own text colour. Forcing white here turned the plus and
       download glyphs invisible on the soft-green buttons. */
    .toggle button.on svg,.seg button.on svg,.dl svg,.add svg{stroke:currentColor!important}
    .sc-delta .p{background:var(--g100)!important;color:var(--g800)!important}
    .legend .li{background:var(--g700)!important}.legend .le{background:#bcd9c8!important}
    .mo .up{background:var(--g700)!important}
    .mo .dn{background:#bcd9c8!important}
    .tip{background:var(--g900)!important;color:#fff!important}
    .avatar{background:var(--g100)!important;color:var(--g800)!important}
    .dh-btn.soft{background:var(--g100)!important;color:var(--g800)!important;border:1px solid #d5e8dc!important}
    .dh-btn.soft svg{stroke:var(--g800)!important}

    /* ---------- Laptop scaling (13"-15" screens) ----------
       Everything below shrinks type and component sizes so a 1280-1440px laptop shows
       the same layout as a large monitor instead of a zoomed-in version of it. */
    @media(max-width:1440px){
        body{font-size:14px}
        .pg-head h1{font-size:25px!important}
        .pg-head p{font-size:13px!important}
        .top{min-height:58px;padding-top:10px!important;padding-bottom:10px!important}
        .top h1,.tl h1{font-size:17px!important}
        .top .avatar{width:34px!important;height:34px!important}
        .top .search,.top .searchbox .search{height:36px!important}
        .card,.panel,.detail,.earn,.donut-card,.rcard{padding:16px!important}
        .sc-num,.stat .num{font-size:24px!important}
        .sc-head{font-size:12.5px!important}
        .sc-delta .p{font-size:11.5px!important;padding:3px 7px!important}
        .sc-delta small{font-size:11px!important}
        h2{font-size:16px!important}
        .thead{font-size:12px!important;padding:11px 16px!important}
        .trow{font-size:13px!important;padding:12px 16px!important}
        .fsel,select.fsel,.pill,.addr,.add,.search,.searchbox .search{height:36px!important;font-size:13px!important}
        .eplot,.ec .eplot{height:230px!important}
        .ey{font-size:11px!important}
        .donut{width:180px!important;height:180px!important}
        .donut .hole{inset:42px!important}
        .donut .hole b{font-size:16px!important}
        .donut .hole span{font-size:11px!important}
        .tbottom{font-size:13px!important}
        .pg{min-width:32px!important;height:32px!important;font-size:13px!important}
    }
    @media(max-width:1280px){
        body{font-size:13.5px}
        .pg-head h1{font-size:22px!important}
        .card,.panel,.detail,.earn,.donut-card{padding:14px!important}
        .sc-num,.stat .num{font-size:21px!important}
        .eplot,.ec .eplot{height:200px!important}
        .donut{width:160px!important;height:160px!important}
        .donut .hole{inset:37px!important}
        .donut .hole b{font-size:14px!important}
        .donut .hole span{font-size:10.5px!important}
        /* Stat cards stack the delta under the number instead of squeezing the amount onto two lines. */
        .sc-body{flex-wrap:wrap!important;align-items:flex-start!important}
        .sc-num{white-space:nowrap!important}
        .sc-delta{width:100%!important;text-align:left!important;margin-top:6px!important}
    }

    /* ---------- Financials: stat cards and the donut column ---------- */
    /* "PKR 44,000" plus the delta pill never fit side by side in a third of the row,
       so the amount keeps the full width and the change sits underneath it. */
    .sc-body{flex-wrap:wrap!important;align-items:flex-start!important;gap:4px!important}
    .sc-num{white-space:nowrap!important;font-size:26px!important;width:100%!important}
    .sc-delta{width:100%!important;text-align:left!important;display:flex!important;align-items:center!important;gap:8px!important;white-space:nowrap!important}
    .sc-delta .p{font-size:12px!important;padding:3px 8px!important;white-space:nowrap!important}
    .sc-delta small{font-size:11.5px!important;color:var(--muted)!important;white-space:nowrap!important}
    .sc-head{font-size:13.5px!important;margin-bottom:10px!important}
    /* The donut column is stretched by the taller left column; centre its contents
       instead of leaving a block of empty white below the legend. */
    .donut-card .donut{margin-top:auto!important}
    .donut-card .dlegend{margin-bottom:auto!important}
    .dl-row{font-size:13px!important}
    .dl-row:only-child:not(:has(i)){grid-template-columns:1fr!important;text-align:center;color:var(--muted)}
    .donut .hole b{white-space:nowrap}

    /* Modal and toast accents still used the old lime; mobile keeps its own palette. */
    .modal .mbtn.save{background:var(--g800)!important;color:#fff!important}
    .modal .mbtn.save:hover{background:var(--g900)!important}
    .flash{background:var(--g800)!important;color:#fff!important}
    select.fsel.lime{background-color:var(--g100)!important;color:var(--g800)!important}
    .modal label.acct-upload{background:var(--g800)!important;color:#fff!important}
    .acct-av{background:var(--g100)!important;color:var(--g800)!important}

    /* ---------- Filter bars stay on one line ----------
       These rows used to wrap, dropping the primary button onto a second line on
       narrower laptops. The controls shrink instead. */
        /* .rfilter is excluded: the rooms list shares its row with a 560px detail panel,
       so its controls genuinely need to wrap rather than be squeezed. */
    .pt,.pt-r,.filters,.fl,.fr,.hhead,.hh-r{flex-wrap:nowrap!important;min-width:0}
    .pt>*,.pt-r>*,.filters>*,.fl>*,.fr>*,.hh-r>*{min-width:0}
    .pt-r .searchbox,.filters .searchbox,.fr .searchbox,.hh-r .searchbox{flex:1 1 130px;min-width:0}
    .pt-r .searchbox .search,.filters .searchbox .search,.fr .searchbox .search,.hh-r .searchbox .search{width:100%!important;min-width:0}
    .pt-r .fsel,.filters .fsel,.fl .fsel,.fr .fsel{flex:0 1 auto;min-width:0;text-overflow:ellipsis}
    .pt-r .daterange,.filters .daterange{flex:0 1 auto;min-width:0}
    .pt-r input[type=date],.filters input[type=date]{min-width:0;flex:0 1 auto}
    .pt-r .pill,.pt-r .add,.pt-r .addr,.filters .pill,.filters .add,.filters .addr,.fr .add,.fr .addr{flex:0 0 auto;white-space:nowrap}
    .pt h2,.hhead h2{flex:0 0 auto;white-space:nowrap}
    @media(max-width:1400px){
        .pt-r,.filters,.fl,.fr,.hh-r{gap:8px!important}
        .pt-r .fsel,.filters .fsel{font-size:12.5px!important;padding:0 10px!important}
        .pt-r input[type=date],.filters input[type=date]{font-size:12px!important}
        .pt-r .pill,.filters .add,.filters .addr,.fr .add{font-size:12.5px!important;padding:0 12px!important}
    }

    /* ---------- Top bar ---------- */
    .top{position:sticky;top:0;z-index:20;background:var(--card)!important;border-bottom:1px solid var(--line);margin:0 0 0!important;padding:12px 28px!important;min-height:64px;align-items:center!important}
    .top h1,.tl h1{font-size:19px!important;font-weight:800!important;letter-spacing:-.2px}
    .top .actions,.top .profile{gap:12px!important;align-items:center!important}
    .top .search,.top .searchbox .search{background:var(--canvas)!important;border:1px solid var(--line)!important;border-radius:10px!important;height:40px!important;width:min(420px,32vw)!important;color:var(--ink)!important}
    .top .search input{font-size:13.5px!important}
    .top .search:before{filter:grayscale(1);opacity:.6}
    .top .avatar{width:38px!important;height:38px!important;background:var(--lime)!important;font-size:12px!important;border:2px solid #fff;box-shadow:0 0 0 1px var(--line)}
    .top .pinfo b,.top .user{font-size:13.5px!important}
    .top .pinfo small,.top .user small{font-size:11.5px!important;color:var(--muted)!important}
    .top .tool,.top .actions .act{width:38px!important;height:38px!important;border:1px solid var(--line)!important;border-radius:10px!important;background:#fff!important}
    .top .tool svg{stroke:#374151!important}
    .top .tool.bell:after,.top .actions .act:last-of-type:after{background:var(--red)!important}
    .top .tl{gap:12px!important}.top .back{border-radius:10px!important}
    .top .tl .bc{font-size:12px!important}

    /* ---------- Page body ---------- */
    :root{--gutter:28px}
    @media(max-width:1440px){:root{--gutter:22px}}
    @media(max-width:1200px){:root{--gutter:16px}}
    .page-body,.main>.panel,.main>.wrap,.main>.gtop,.main>.card,.main>.cal-wrap,.main>.fin-top,.main>.grid2,.main>.crhead,.main>.rev-grid,.main>.country-card,.main>.iv-cards,.content>.grid{margin-left:var(--gutter)!important;margin-right:var(--gutter)!important}
    .top{padding-left:var(--gutter)!important;padding-right:var(--gutter)!important}
    .main>.panel,.main>.card,.main>.wrap,.main>.gtop,.main>.cal-wrap,.main>.fin-top,.main>.grid2{margin-top:20px!important}
    .main>.crhead{margin-top:22px!important}.main>.rev-grid{margin-top:12px!important}
    .content>.grid{margin-top:0!important}
    footer,.footer{margin:22px var(--gutter) 0!important;padding:14px 0 0!important;border-top:1px solid var(--line);color:var(--muted)!important;font-size:12.5px!important}
    footer .flinks span:first-child,.footer .f-links span{color:#374151!important}


    /* ---------- Page heading ---------- */
    .pg-head{margin:20px var(--gutter) 14px}
    .pg-head h2{margin:0!important;font-size:26px!important;font-weight:800!important;letter-spacing:-.4px}
    .pg-head h2::before{display:none!important}
    .pg-head p{margin:5px 0 0;font-size:13.5px;color:var(--muted)}
    .top h1{font-size:15px!important;font-weight:600!important;color:var(--muted)!important}
    .top .tl h1{font-size:19px!important;color:var(--ink)!important;font-weight:800!important}

    /* ---------- Filter bars (panel headers) ---------- */
    .panel>.pt,.panel>.filters,.panel>.rfilter,.card>.hhead{background:#fff;border:1px solid var(--line);border-radius:14px;padding:14px!important;margin:0 0 14px!important;gap:12px!important;align-items:center!important}
    .panel>.pt>h2,.panel>.filters>h2,.card>.hhead>h2{font-size:15px!important}
    .filters .fl,.filters .fr,.pt-r,.rfilter,.hh-r{gap:10px!important;align-items:center!important}
    .search,.searchbox .search{height:44px!important;font-size:13.5px!important;border:1px solid var(--line)!important;border-radius:10px!important;background:#fff!important}
    .searchbox>svg{stroke:#9ca3af!important}
    .fsel,select.fsel,.pill,.plain,.sliders,.iconbtn,.date-filter{height:44px!important;border:1px solid var(--line)!important;border-radius:10px!important;background:#fff!important;font-size:13.5px!important;color:#111!important}
    select.fsel.lime,.fsel.lime{background:#fff!important;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E")!important;background-repeat:no-repeat!important;background-position:right 12px center!important;background-size:14px!important;color:#111!important;border-color:var(--line)!important;font-weight:500!important}
    .addr,.add,.pill.lime,button.pill[style*="lime"],.rv-add,.rs-add{height:44px!important;padding:0 18px!important;background:var(--g800)!important;color:#fff!important;border:0!important;border-radius:10px!important;font-weight:700!important;font-size:13.5px!important}
    .addr:hover,.add:hover,.pill.lime:hover{background:var(--g900)!important}
    .sortby{color:var(--muted)!important;font-size:13px!important}

    /* ---------- Data tables ---------- */
    .panel{padding:0!important;overflow:hidden}
    .panel>.pt,.panel>.filters,.panel>.rfilter{margin:14px!important;border:0!important;padding:0!important;border-radius:0!important}
    .panel>.tbl{padding:0}
    .thead{background:#f7faf8!important;border-radius:0!important;padding:13px 20px!important;border-top:1px solid var(--line);border-bottom:1px solid var(--line);font-size:12px!important}
    .trow{padding:13px 20px!important;border-bottom:1px solid #f1f4f2!important}
    .tbottom{padding:14px 20px!important;border-top:1px solid var(--line);margin:0!important;color:var(--muted)!important;font-size:13px!important}
    .pages .pg{height:34px!important;min-width:34px!important;font-size:13px!important}
    .ib,.vd,.eye,.dl,.dotbtn{border:1px solid var(--line)!important;background:#fff!important;border-radius:9px!important;color:#4b5563!important}
    .abtn,.delete-item{height:34px!important;border-radius:9px!important;font-size:12.5px!important;font-weight:700!important}
    .abtn.confirm{background:var(--g100)!important;color:var(--g800)!important;border:1px solid #cfe3d6!important}
    .abtn.done{background:#f3f5f4!important;color:var(--muted)!important}

    /* ---------- Cards & panels ---------- */
    .panel,.card,.detail,.rcard,.rev,.scard,.earn,.donut-card,.booking-list,.rooms,.revenue,.rating,.tasks,.activities,.stat{background:var(--card)!important;border:1px solid var(--line)!important;border-radius:14px!important;box-shadow:0 1px 2px rgba(16,24,40,.04)!important}
    .panel h2,.card h2,.chd h2,.pt h2,.hhead h2,.dtop h2,.earn-top h2,.crhead h2{font-size:16px!important;font-weight:700!important;display:flex;align-items:center;gap:10px}
    .card h2::before,.panel h2::before,.pt h2::before,.hhead h2::before,.earn-top h2::before{content:'';width:4px;height:18px;border-radius:2px;background:var(--g600)}
    .rcard.sel{background:var(--g50)!important;border-color:#cfe3d6!important}

    /* ---------- Tables ---------- */
    .thead{background:var(--g50)!important;color:#4b5563!important;border-radius:10px!important;font-size:12.5px!important;font-weight:600!important;text-transform:uppercase;letter-spacing:.3px}
    .trow{border-bottom:1px solid #eef1ef!important;font-size:13.5px!important}
    .trow:hover{background:#fafcfa}
    .g b,.who b{font-weight:600!important}

    /* ---------- Buttons & controls ---------- */
    .pill.lime,.addr,.add,.edit,.bbtn.edit,.mbtn.save,.rv-add,.ms-add,.viewall,.plus{background:var(--g700)!important;color:#fff!important;border:0!important;border-radius:10px!important;font-weight:600!important}
    .pill.lime:hover,.addr:hover,.add:hover,.mbtn.save:hover,.abtn.confirm:hover{background:var(--g800)!important}
    .abtn.confirm{background:var(--g100)!important;color:var(--g800)!important}
    .abtn.cancel,.bbtn.cancel,.delete-item,.rv-del,.ib.del{background:var(--red100)!important;color:#b3352f!important;border:0!important;border-radius:9px!important}
    .fsel,select.fsel,.search,.searchbox .search,.pill{background:#fff!important;border:1px solid var(--line)!important;border-radius:10px!important;color:var(--ink)!important;font-family:inherit!important}

    .pg{background:#fff!important;border:1px solid var(--line)!important;border-radius:9px!important}.pg.active{background:var(--g700)!important;color:#fff!important;border-color:var(--g700)!important}
    .modal{font-family:Inter,Lato,Arial,sans-serif!important}
    .modal .mbtn.save{background:var(--g700)!important;color:#fff!important}

    /* ---------- Status pills ---------- */
    .st,.rstatus,.av,.rt,.bl-status,.bl-type,.chip,.bconf,.psum .paid,.psum .partial,.psum .unpaid{border-radius:20px!important;font-size:12px!important;font-weight:600!important;padding:5px 11px!important}
    .st.confirmed,.st.paid,.rstatus.available,.av.available,.psum .paid,.bconf{background:var(--g100)!important;color:var(--g800)!important}
    .st.pending,.st.unpaid,.av.out,.psum .unpaid{background:var(--red100)!important;color:#b3352f!important}
    .st.checked_in,.rstatus.occupied{background:#e9f7d3!important;color:#3d5a10!important}
    .st.checked_out{background:#eceff0!important;color:#4b5563!important}
    .st.partial,.av.low,.psum .partial{background:var(--amber100)!important;color:#7a5400!important}
    .st:not([class*=" "]){background:var(--g100)!important;color:var(--g800)!important}

    /* ---------- Room-number chips, misc ---------- */
    .unit.available{background:var(--g100)!important;color:var(--g800)!important}.unit.reserved{background:var(--amber100)!important;color:#7a5400!important}.unit.occupied{background:var(--red100)!important;color:#b3352f!important}.unit.not_ready{background:#eceff0!important;color:#4b5563!important}
    .flash{background:var(--g700)!important;color:#fff!important}
}
</style>
