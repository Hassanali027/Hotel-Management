<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Rooms - Indus Resort Restaurant</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--line:#eee;--red:#ff4e52}
*{box-sizing:border-box}
body{margin:0;display:flex;background:var(--bg);font-family:Lato,Arial,sans-serif;color:var(--ink);zoom:.9}
@media(min-width:1301px) and (max-width:1700px){body{zoom:.82}}
@media(min-width:1101px) and (max-width:1300px){body{zoom:.72}}
@media(min-width:701px) and (max-width:1100px){body{zoom:.62}}
.main{flex:1;min-width:0;padding:26px 30px 16px}
.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:22px}
.top h1{font-size:30px;font-weight:800;margin:0}
.profile{display:flex;align-items:center;gap:13px}
.avatar{width:46px;height:46px;border-radius:50%;background:var(--lime);display:grid;place-items:center;font-weight:700;font-size:15px}
.pinfo b{display:block;font-size:16px;line-height:1.1}.pinfo small{color:#888;font-size:13px}
.tools{display:flex;gap:10px;margin-left:14px}
.tool{width:44px;height:44px;border:1px solid #e8e8e8;background:#fff;border-radius:11px;display:grid;place-items:center;cursor:pointer;position:relative}
.tool svg{width:20px;height:20px;fill:none;stroke:#4a4a4a;stroke-width:1.8}
.tool.bell:after{content:'';position:absolute;top:9px;right:11px;width:8px;height:8px;border-radius:50%;background:var(--red);border:2px solid #fff}
.wrap{display:grid;grid-template-columns:minmax(0,1fr) 560px;gap:20px}
.col{display:flex;flex-direction:column;gap:16px;min-width:0}
.rfilter{display:flex;align-items:center;gap:12px;flex-wrap:wrap}
.searchbox{position:relative;flex:1;min-width:200px}
.searchbox>svg{position:absolute;left:16px;top:50%;transform:translateY(-50%);width:18px;height:18px;fill:none;stroke:#b0b0b0;stroke-width:1.8}
.search{height:46px;width:100%;border:0;border-radius:11px;background:#fff;padding:0 16px 0 44px;font-size:14px;color:#333;font-family:inherit}
.search::placeholder{color:#b0b0b0}
.sortby{color:#9a9a9a;font-size:15px;white-space:nowrap}
.plain{height:44px;border:0;background:#fff;border-radius:11px;padding:0 16px;display:inline-flex;align-items:center;gap:8px;font-size:15px;color:#333;cursor:pointer;white-space:nowrap}
.plain svg{width:15px;height:15px;fill:none;stroke:#555;stroke-width:1.8}
.addr{height:44px;border:0;border-radius:11px;background:var(--lime);padding:0 20px;font-size:15px;font-weight:700;color:#2f3a0c;cursor:pointer;white-space:nowrap}
.rcard{background:#fff;border-radius:16px;padding:16px;display:flex;gap:20px;border:1.5px solid transparent}
.rcard.sel{background:#fbfbf9;border-color:#ececec}
.rimg{width:230px;height:150px;border-radius:12px;flex:0 0 230px;object-fit:cover;background:#e9e9e9}
.rbody{flex:1;min-width:0;position:relative;display:flex;flex-direction:column}
.rbody h3{font-size:22px;margin:0 0 12px;padding-right:104px}
.rstatus{position:absolute;right:0;top:2px;padding:5px 13px;border-radius:8px;font-size:13px;font-weight:600;white-space:nowrap}
.rstatus.occupied{background:var(--lime);color:#3d4a10}
.rstatus.available{background:var(--mint);color:#2f6b4f}
.specs{display:flex;gap:22px;color:#555;font-size:14px;margin-bottom:12px}
.specs span{display:inline-flex;align-items:center;gap:7px}
.specs svg{width:17px;height:17px;fill:none;stroke:#777;stroke-width:1.7}
.rdesc{color:#6a6a6a;font-size:14px;line-height:1.5;margin:0 0 14px}
.rfoot{display:flex;justify-content:space-between;align-items:flex-end;margin-top:auto}
.avail{color:#6a6a6a;font-size:14px}.avail b{color:#111}
.price{font-size:26px;font-weight:800}.price small{font-size:14px;color:#9a9a9a;font-weight:400}
/* detail */
.detail{background:#fff;border-radius:18px;padding:22px}
.dtop{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px}
.dtop h2{font-size:18px;margin:0}
.edit{height:38px;border:0;border-radius:9px;background:var(--lime);padding:0 20px;font-size:14px;font-weight:700;color:#2f3a0c;cursor:pointer}
.dtitle{display:flex;align-items:center;gap:12px;margin-bottom:6px}
.dtitle h1{font-size:34px;margin:0;font-weight:800}
.dtitle .st{padding:5px 13px;border-radius:8px;font-size:13px;font-weight:600;background:var(--mint);color:#2f6b4f}
.docc{color:#7a7a7a;font-size:15px;margin-bottom:16px}
.gallery{display:grid;grid-template-columns:1fr 120px;gap:12px;margin-bottom:18px}
.ghero{width:100%;height:330px;object-fit:cover;border-radius:14px;background:#e9e9e9}
.gthumbs{display:flex;flex-direction:column;gap:12px}
.gthumbs img{width:100%;height:88px;object-fit:cover;border-radius:11px;background:#e9e9e9}
.viewall{flex:1;border:0;border-radius:11px;background:var(--lime);font-size:14px;font-weight:700;color:#2f3a0c;cursor:pointer}
.dspecs{display:flex;gap:26px;color:#555;font-size:15px;margin-bottom:16px}
.dspecs span{display:inline-flex;align-items:center;gap:8px}
.dspecs svg{width:18px;height:18px;fill:none;stroke:#777;stroke-width:1.7}
.ddesc{color:#6a6a6a;font-size:14px;line-height:1.6;margin:0 0 22px}
.sec h4{font-size:17px;margin:0 0 14px}
.sec{margin-bottom:22px}
.flist{display:grid;grid-template-columns:1fr 1fr;gap:14px 20px}
.flist.three{grid-template-columns:1fr 1fr 1fr}
.fitem{display:flex;align-items:flex-start;gap:10px;font-size:14px;color:#3a3a3a}
.fitem .ck{width:20px;height:20px;border-radius:50%;background:#e3f6ec;display:grid;place-items:center;flex:0 0 20px;margin-top:1px}
.fitem .ck svg{width:12px;height:12px;fill:none;stroke:#3f9c74;stroke-width:2.5}
.fitem .fi{width:19px;height:19px;flex:0 0 19px;fill:none;stroke:#555;stroke-width:1.7;margin-top:1px}
footer{display:flex;justify-content:space-between;align-items:center;padding:20px 6px 8px;color:#9a9a9a;font-size:14px;flex-wrap:wrap;gap:14px}
.flinks{display:flex;gap:26px}.flinks a{color:#9a9a9a;text-decoration:none}.flinks span:first-child{color:#666}
.fsoc{display:flex;gap:16px;align-items:center}.fsoc a{color:#c2c2c2}.fsoc svg{width:18px;height:18px;fill:currentColor}
/* Room-number list in the detail panel */
.ulegend{display:flex;flex-wrap:wrap;gap:12px;font-size:12px;color:#666;margin-bottom:10px}.ulegend i{display:inline-block;width:10px;height:10px;border-radius:3px;margin-right:5px;vertical-align:middle}
.ugrid{display:flex;flex-wrap:wrap;gap:8px}.unit{min-width:64px;padding:7px 10px;border-radius:9px;font-size:13px;font-weight:700;text-align:center;cursor:pointer;line-height:1.2}
.unit.available,.ulegend .available{background:#d9f5e5;color:#1f5f3f}.unit.reserved,.ulegend .reserved{background:#fdf3d2;color:#8a6200}.unit.occupied,.ulegend .occupied{background:#ffe1e1;color:#b3352f}.unit.not_ready,.ulegend .not_ready{background:#ececec;color:#666}
.unit small{display:block;font-size:10px;font-weight:400;margin-top:2px}
.uadd{display:flex;gap:8px;margin-top:12px}.uadd input{flex:1;min-width:0;height:38px;border:1px solid #e3e3e3;border-radius:9px;padding:0 12px;font:inherit}
@media(max-width:1200px){.wrap{grid-template-columns:1fr}}
@media(max-width:700px){body{zoom:1}.main{padding:18px 14px}.top h1{font-size:24px}.profile .pinfo,.tools{display:none}.rcard{flex-direction:column}.rimg{width:100%;flex-basis:auto}.flist,.flist.three{grid-template-columns:1fr}footer{flex-direction:column;align-items:flex-start}}
</style>
</head>
<body>
@include('partials.crud')
@include('partials.sidebar')
@include('partials.responsive')
<style>
/* ===== Phone rooms (Figma clone). Only on screens up to 768px; desktop layout untouched. ===== */
.m-rooms{display:none}
.mr-close{display:none}
@media(max-width:768px){
    body{zoom:1!important;background:#f4f6f5!important;display:block!important}
    .main{padding:10px 16px 100px!important}
    .main>.top,.main>footer,.wrap>.col{display:none!important}
    .wrap{display:block!important}
    .detail{display:none}
    .detail.open{display:block!important;position:fixed;inset:0;z-index:1300;overflow:auto;border-radius:0;padding:16px 16px 60px;-webkit-overflow-scrolling:touch}
    .detail .dtop{flex-wrap:wrap;gap:10px}
    .detail .dtitle h1{font-size:26px}.detail .ghero{height:220px}.detail .gallery{grid-template-columns:1fr 90px}.detail .gthumbs img{height:62px}
    .detail .dspecs{flex-wrap:wrap;gap:12px 18px;font-size:14px}.detail .flist,.detail .flist.three{grid-template-columns:1fr}
    .mr-close{display:inline-flex;align-items:center;gap:6px;height:38px;border:0;border-radius:10px;background:#f1f3f2;padding:0 14px;font:700 14px Lato,Arial,sans-serif;color:#222;cursor:pointer}
    .m-rooms{display:block;font-family:Lato,Arial,sans-serif;color:#111}
    .mr-head{display:flex;align-items:center;justify-content:space-between;padding:6px 0 14px}
    .mr-brand{display:flex;align-items:center;gap:11px}
    .mr-brand img{width:46px;height:46px;border-radius:50%;object-fit:cover;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,.08)}
    .mr-brand b{display:block;font-size:17px;font-weight:800;line-height:1.1;color:#111;white-space:nowrap}
    .mr-brand small{display:block;font-size:13px;color:#333;margin-top:2px}
    .mr-tools{display:flex;align-items:center;gap:8px}
    .mr-ib{width:44px;height:44px;border:0;border-radius:12px;background:#fff;display:grid;place-items:center;color:#222;cursor:pointer;position:relative;box-shadow:0 1px 4px rgba(0,0,0,.06)}
    .mr-ib svg{width:22px;height:22px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .mr-ib.bell:after{content:'';position:absolute;top:9px;right:10px;width:9px;height:9px;border-radius:50%;background:#ff3b30;border:2px solid #fff}
    .mr-avatar{width:48px;height:48px;border-radius:50%;background:#d7f0a0;color:#1f5f3f;display:grid;place-items:center;font-weight:800;font-size:16px;margin-left:4px}
    .mr-title{display:flex;align-items:flex-start;justify-content:space-between;gap:10px;margin:2px 0 14px}
    .mr-title h1{margin:0;font-size:30px;font-weight:800;letter-spacing:-.4px;line-height:1.1}
    .mr-title p{margin:4px 0 0;font-size:13px;color:#555}
    .mr-add{display:inline-flex;align-items:center;gap:8px;height:44px;padding:0 16px;border:0;border-radius:12px;background:#dff55f;color:#1f2a08;font:700 15px Lato,Arial,sans-serif;cursor:pointer;white-space:nowrap;flex:0 0 auto}
    .mr-add svg{width:20px;height:20px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round}
    .mr-filters{display:grid;grid-template-columns:minmax(0,1fr) auto;gap:8px;margin-bottom:12px}
    .mr-search{display:flex;align-items:center;gap:9px;height:50px;border-radius:14px;background:#fff;padding:0 14px;min-width:0;box-shadow:0 1px 4px rgba(0,0,0,.05)}
    .mr-search svg{width:20px;height:20px;flex:0 0 20px;fill:none;stroke:#222;stroke-width:2;stroke-linecap:round}
    .mr-search input{flex:1;min-width:0;border:0;outline:0;background:none;font:400 14px Lato,Arial,sans-serif;color:#111}
    .mr-search input::placeholder{color:#9a9a9a}
    .mr-fbtn{display:inline-flex;align-items:center;gap:8px;height:50px;padding:0 16px;border:0;border-radius:14px;background:#fff;font:600 15px Lato,Arial,sans-serif;color:#111;cursor:pointer;box-shadow:0 1px 4px rgba(0,0,0,.05)}
    .mr-fbtn.on{background:#dff55f}
    .mr-fbtn svg{width:20px;height:20px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round}
    .mr-sortrow{display:none;align-items:center;gap:10px;margin:-2px 0 12px;font-size:13px;color:#666}
    .mr-sortrow.open{display:flex}
    .mr-sortrow select{flex:1;height:44px;border:0;border-radius:12px;background:#fff;padding:0 12px;font:400 14px Lato,Arial,sans-serif;color:#111;box-shadow:0 1px 4px rgba(0,0,0,.05)}
    .mr-chips{display:flex;gap:8px;overflow-x:auto;padding:2px 0 8px;margin:0 -16px 8px;padding-left:16px;padding-right:16px;scrollbar-width:none}
    .mr-chips::-webkit-scrollbar{display:none}
    .mr-chip{flex:0 0 auto;height:40px;padding:0 18px;border:0;border-radius:20px;background:#e9ecea;color:#222;font:600 14px Lato,Arial,sans-serif;cursor:pointer;white-space:nowrap}
    .mr-chip.on{background:#1f7a4d;color:#fff}
    .mr-card{display:grid;grid-template-columns:118px minmax(0,1fr);gap:12px;background:#fff;border-radius:18px;padding:12px;margin-bottom:12px;box-shadow:0 4px 18px rgba(16,24,40,.05);border:1px solid #eef0ee;cursor:pointer}
    .mr-img{width:118px;height:100%;min-height:150px;border-radius:12px;object-fit:cover;background:#e9e9e9}
    .mr-body{position:relative;display:flex;flex-direction:column;min-width:0;padding-bottom:2px}
    .mr-nm{display:flex;align-items:flex-start;justify-content:space-between;gap:8px}
    .mr-nm b{font-size:18px;font-weight:800;line-height:1.15;min-width:0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .mr-st{flex:0 0 auto;padding:5px 11px;border-radius:14px;font-size:12px;font-weight:600;white-space:nowrap}
    .mr-st.available{background:#d9f5e5;color:#2f6b4f}.mr-st.occupied{background:#fdf3d2;color:#7a5a00}
    .mr-specs{display:flex;flex-wrap:wrap;gap:4px 12px;margin-top:8px;font-size:13px;color:#333}
    .mr-specs span{display:inline-flex;align-items:center;gap:5px;white-space:nowrap}
    .mr-specs svg{width:15px;height:15px;flex:0 0 15px;fill:none;stroke:#333;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .mr-desc{margin:8px 0 0;font-size:13px;line-height:1.4;color:#666;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .mr-foot{display:flex;align-items:center;justify-content:space-between;gap:8px;margin-top:auto;padding-top:10px}
    .mr-price{font-size:19px;font-weight:800;white-space:nowrap;min-width:0;overflow:hidden;text-overflow:ellipsis}
    .mr-price small{font-size:13px;font-weight:400;color:#666}
    .mr-go{position:static;flex:0 0 42px;width:42px;height:42px;border-radius:50%;background:#d9f5e5;display:grid;place-items:center;color:#1f5f3f}
    .mr-go svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:2.4;stroke-linecap:round;stroke-linejoin:round}
    .mr-empty{background:#fff;border-radius:18px;padding:28px;text-align:center;color:#888;font-size:14px}
}
@media(max-width:360px){
    .m-rooms .mr-brand b{font-size:15px}.m-rooms .mr-brand small{font-size:12px}.m-rooms .mr-brand img{width:40px;height:40px}.m-rooms .mr-ib{width:40px;height:40px}.m-rooms .mr-avatar{width:42px;height:42px;font-size:14px}
    .m-rooms .mr-title h1{font-size:25px}.m-rooms .mr-title p{font-size:12px}.m-rooms .mr-add{height:40px;padding:0 12px;font-size:14px}
    .m-rooms .mr-card{grid-template-columns:96px minmax(0,1fr);gap:10px;padding:10px}.m-rooms .mr-img{width:96px}
    .m-rooms .mr-nm b{font-size:16px}.m-rooms .mr-specs{font-size:12px;gap:3px 9px}.m-rooms .mr-desc{font-size:12px}.m-rooms .mr-price{font-size:16px}.m-rooms .mr-go{width:36px;height:36px;flex-basis:36px}
}
</style>
<main class="main">
    <section class="m-rooms">
        <header class="mr-head">
            <div class="mr-brand"><img src="{{ asset('images/logo.png') }}" alt=""><div><b>Indus Resort</b><small>Restaurant</small></div></div>
            <div class="mr-tools">
                <button class="mr-ib" type="button" aria-label="Search" onclick="document.getElementById('mSearch').focus()"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg></button>
                <button class="mr-ib bell" type="button" aria-label="Notifications" onclick="showNotifications()"><svg viewBox="0 0 24 24"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.9 1.9 0 0 0 3.4 0"/></svg></button>
                <span class="mr-avatar hdr-avatar" style="overflow:hidden;cursor:pointer" onclick="openAccount()">@if(auth()->user()->avatar)<img src="{{ asset(auth()->user()->avatar) }}" alt="">@else{{ auth()->user()->initials() }}@endif</span>
            </div>
        </header>
        <div class="mr-title"><div><h1>Rooms</h1><p>Find the perfect room for your stay</p></div><button class="mr-add" type="button" onclick="openRoomCreator()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>Add Room</button></div>
        <div class="mr-filters">
            <label class="mr-search"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg><input id="mSearch" type="search" placeholder="Search room type, number, etc..."></label>
            <button class="mr-fbtn" id="mFilterBtn" type="button" onclick="document.getElementById('mSortRow').classList.toggle('open');this.classList.toggle('on')"><svg viewBox="0 0 24 24"><path d="M4 6h16M7 12h10M10 18h4"/></svg>Filter</button>
        </div>
        <div class="mr-sortrow" id="mSortRow"><span>Sort by</span><select id="mSort"><option value="popular">Popular</option><option value="low">Price: Low to High</option><option value="high">Price: High to Low</option></select></div>
        <div class="mr-chips" id="mChips"><button class="mr-chip on" type="button" data-type="">All</button>@foreach($rooms->pluck('name')->filter()->unique()->values() as $roomType)<button class="mr-chip" type="button" data-type="{{ $roomType }}">{{ $roomType }}</button>@endforeach</div>
        <div id="mRooms"></div>
        @include('partials.mobile-nav')
    </section>
    <header class="top">
        <h1>Rooms</h1>
        <div class="profile">
            <span class="avatar hdr-avatar" style="cursor:pointer;overflow:hidden" onclick="openAccount()" title="My account">@if(auth()->user()->avatar)<img src="{{ asset(auth()->user()->avatar) }}" alt="">@else{{ auth()->user()->initials() }}@endif</span>
            <div class="pinfo"><b>{{ auth()->user()->name }}</b><small>{{ ucfirst(auth()->user()->role) }}</small></div>
            <div class="tools">
                <button class="tool" type="button" title="My account" onclick="openAccount()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell" type="button" title="Notifications" onclick="showNotifications()"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
            </div>
        </div>
    </header>
    <div class="wrap">
        <div class="col">
            <div class="rfilter">
                <div class="searchbox"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg><input class="search" id="fSearch" placeholder="Search room type, number, etc"></div>
                <span class="sortby">Sort by:</span>
                <select class="fsel" id="fSort"><option value="popular">Popular</option><option value="low">Price: Low</option><option value="high">Price: High</option></select>
                <select class="fsel" id="fType"><option value="">All Type</option>@foreach($rooms->pluck('name')->filter()->unique()->sort()->values() as $roomType)<option value="{{ $roomType }}">{{ $roomType }}</option>@endforeach</select>
                <button class="addr" onclick="openRoomCreator()">Add Room</button>
            </div>
            <div id="roomlist"></div>
        </div>
        <aside class="detail">
            <div class="dtop"><h2>Room Detail</h2><div style="display:flex;gap:8px;flex-wrap:wrap"><button class="mr-close" type="button" onclick="document.querySelector('.detail').classList.remove('open')">‹ Back</button><button class="edit" onclick="openRoomEditor()">Edit</button>@if(auth()->user()->role === 'admin')<button class="edit" style="background:#ffe1e1;color:#b3352f" onclick="if(confirm('Delete this room?'))post('/rooms/'+selectedId,'DELETE')">Delete</button>@endif</div></div>
            <div class="dtitle"><h1 id="dName">{{ $featured->name }} Room</h1><span class="st" id="dStatus">{{ ucfirst($featured->status) }}</span></div>
            <div class="docc" id="dOcc">Occupied: {{ $featured->availability_used }}/{{ $featured->availability_total }} Rooms</div>
            <div class="gallery">
                <img class="ghero" id="dHero" src="{{ asset($featured->image) }}" alt="{{ $featured->name }} room">
                <div class="gthumbs">
                    <div id="dThumbs" style="display:flex;flex-direction:column;gap:12px"></div>
                    <button class="viewall" onclick="window.open(document.getElementById('dHero').src,'_blank')">View All</button>
                </div>
            </div>
            <div class="dspecs" id="dSpecs">
                <span><svg viewBox="0 0 24 24"><path d="M3 8V3h5M21 8V3h-5M3 16v5h5M21 16v5h-5"/></svg>{{ $featured->size }}</span>
                <span><svg viewBox="0 0 24 24"><path d="M2 10V6h20v12M2 14h20M2 18v-4M6 10V8h5v2"/></svg>{{ $featured->bed }}</span>
                <span><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20a6 6 0 0 1 12 0M15 20a5 5 0 0 1 6-1"/></svg>{{ $featured->guests }}</span>
            </div>
            <p class="ddesc" id="dDesc">{{ $featured->description }}</p>
            <div class="sec"><h4>Features</h4><div class="flist" id="features"></div></div>
            <div class="sec"><h4>Facilities</h4><div class="flist three" id="facilities"></div></div>
            <div class="sec"><h4>Amenities</h4><div class="flist" id="amenities"></div></div>
            <div class="sec"><h4 style="display:flex;justify-content:space-between;align-items:center;gap:10px">Room Numbers <small id="unitSummary" style="font-weight:400;color:#777;font-size:13px"></small></h4>
                <div class="ulegend"><span><i class="available"></i>Available</span><span><i class="reserved"></i>Reserved</span><span><i class="occupied"></i>Occupied</span><span><i class="not_ready"></i>Not Ready</span></div>
                <div class="ugrid" id="unitGrid"></div>
                @if(auth()->user()->role !== 'staff')<form class="uadd" method="POST" action="" id="unitForm">@csrf<input name="numbers" placeholder="Add room numbers, e.g. 111, 112, 113" required><button class="edit" type="submit">Add</button></form>@endif
            </div>
        </aside>
    </div>
    <footer>
        <div class="flinks"><span>Copyright © 2026 Indus Resort Restaurant</span><a href="#">Privacy Policy</a><a href="#">Term and conditions</a><a href="#">Contact</a></div>
        <div class="fsoc">
            <a href="https://www.facebook.com/people/Indus-Resort/61590518813137/" target="_blank" rel="noopener" aria-label="Facebook"><svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
            <a href="https://wa.me/923000053333" target="_blank" rel="noopener" aria-label="WhatsApp"><svg viewBox="0 0 24 24"><path d="M20.5 11.5a8.5 8.5 0 0 1-12.6 7.5L3.5 20.5 5 16.3A8.5 8.5 0 1 1 20.5 11.5Z"/><path d="M8.4 7.8c.2-.5.5-.5.7-.5h.5c.2 0 .4.1.5.4l.8 1.8c.1.3.1.5-.1.7l-.5.6c-.1.1-.1.3 0 .4.4.8 1.1 1.5 1.9 1.9.1.1.3.1.4 0l.6-.5c.2-.2.4-.2.7-.1l1.8.8c.3.1.4.3.4.5v.5c0 .2-.1.5-.5.7-.4.2-1.2.4-2.3-.1-1-.5-2.2-1.4-3.2-2.4-1-1-1.9-2.2-2.4-3.2-.5-1.1-.3-1.9-.1-2.3Z"/></svg></a>
            <a href="https://www.instagram.com/indus_resort/" target="_blank" rel="noopener" aria-label="Instagram"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg></a>


        </div>
    </footer>
</main>
<script>
const HERO="{{ asset('images/room-info-hero.jpg') }}";
const m2='<svg viewBox="0 0 24 24"><path d="M3 8V3h5M21 8V3h-5M3 16v5h5M21 16v5h-5"/></svg>';
const bed='<svg viewBox="0 0 24 24"><path d="M2 10V6h20v12M2 14h20M2 18v-4M6 10V8h5v2"/></svg>';
const gst='<svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20a6 6 0 0 1 12 0M15 20a5 5 0 0 1 6-1"/></svg>';
const rooms=@json($rooms);
 const ck='<span class="ck"><svg viewBox="0 0 24 24"><path d="m5 12 5 5 9-9"/></svg></span>';
 const facIcons={'High-speed Wi-Fi':'<path d="M5 12.5a10 10 0 0 1 14 0M8.5 16a5 5 0 0 1 7 0"/><circle cx="12" cy="19" r="1"/>','In-room safe':'<rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="13" cy="12" r="3"/>','Mini-fridge':'<rect x="6" y="2" width="12" height="20" rx="2"/><path d="M6 10h12M10 5v2M10 13v3"/>','Flat-screen TV':'<rect x="2" y="4" width="20" height="13" rx="2"/><path d="M8 21h8"/>','Air conditioning':'<rect x="2" y="4" width="20" height="9" rx="2"/><path d="M6 17v1M10 17v2M14 17v1M18 17v2"/>','Coffee/tea maker':'<path d="M4 8h13v4a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5z"/><path d="M17 9h2a2 2 0 0 1 0 4h-2M6 3v2M10 3v2M14 3v2"/>'};
 let selectedId={{ $featured->id }};
 const ULABEL={available:'Available',reserved:'Reserved',occupied:'Occupied',not_ready:'Not Ready'};
 function unitActions(id){let u=null,room=null;rooms.forEach(r=>(r.units||[]).forEach(x=>{if(x.id===id){u=x;room=r;}}));if(!u)return;const booked=u.status==='reserved'||u.status==='occupied';let html='<b>'+room.name+'</b><br>Status: <b>'+(ULABEL[u.status]||u.status)+'</b>';if(booked)html+='<p style="color:#777;font-size:13px;margin:10px 0 0">This room has an active booking. Change the booking from the Reservations page.</p>';else if(window.CAN_MANAGE){html+='<div style="display:flex;gap:8px;flex-wrap:wrap;margin-top:14px">'+(u.status==='available'?'<button class="mbtn cancel" style="flex:1" onclick="post(\'/room-units/'+u.id+'/status\',\'POST\',{status:\'not_ready\'})">Mark Not Ready</button>':'<button class="mbtn save" style="flex:1" onclick="post(\'/room-units/'+u.id+'/status\',\'POST\',{status:\'available\'})">Mark Available</button>')+(window.IS_ADMIN?'<button class="mbtn cancel" onclick="if(confirm(\'Remove Room '+u.number+'?\'))post(\'/room-units/'+u.id+'\',\'DELETE\')">Remove</button>':'')+'</div>';}showDetail('Room '+u.number,html);}
 function currentList(){const q=(document.getElementById('fSearch').value||'').toLowerCase();const ty=document.getElementById('fType').value;const sort=document.getElementById('fSort').value;let l=rooms.filter(r=>(!ty||r.name===ty)&&(!q||[r.name,r.description,r.bed].join(' ').toLowerCase().includes(q)));if(sort==='low')l=[...l].sort((a,b)=>a.price-b.price);else if(sort==='high')l=[...l].sort((a,b)=>b.price-a.price);return l;}
 function mGuests(g){g=String(g||'').trim();return /^\d+$/.test(g)?g+(g==='1'?' guest':' guests'):g;}
 function mOpenRoom(id){selectRoom(id);document.querySelector('.detail').classList.add('open');window.scrollTo(0,0);}
 function renderMobile(list){const el=document.getElementById('mRooms');if(!el)return;el.innerHTML=list.map(r=>`<article class="mr-card" onclick="mOpenRoom(${r.id})"><img class="mr-img" src="{{ asset('') }}${r.image}" alt="${r.name}"><div class="mr-body"><div class="mr-nm"><b>${r.name}</b><span class="mr-st ${r.status}">${r.status==='occupied'?'Occupied':'Available'}</span></div><div class="mr-specs">${r.size?'<span>'+m2+r.size+'</span>':''}${r.bed?'<span>'+bed+r.bed+'</span>':''}${r.guests?'<span>'+gst+mGuests(r.guests)+'</span>':''}${(r.units&&r.units.length)?'<span><svg viewBox="0 0 24 24"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M15 12h.01M4 21h16"/></svg>'+r.units.filter(u=>u.status==='available').length+' of '+r.units.length+' free</span>':''}</div><p class="mr-desc">${r.description||''}</p><div class="mr-foot"><div class="mr-price">PKR ${Number(r.price||0).toLocaleString()}<small>/night</small></div><span class="mr-go"><svg viewBox="0 0 24 24"><path d="m9 6 6 6-6 6"/></svg></span></div></div></article>`).join('')||'<div class="mr-empty">No rooms found</div>';}
 function render(list){renderMobile(list);document.getElementById('roomlist').innerHTML=list.map((r,i)=>`<div class="rcard ${r.id===selectedId?'sel':''}" onclick="selectRoom(${r.id})" style="cursor:pointer;${i<list.length-1?'margin-bottom:16px':''}"><img class="rimg" src="{{ asset('') }}${r.image}" alt="${r.name}"><div class="rbody"><h3>${r.name}</h3><span class="rstatus ${r.status}">${r.status==='occupied'?'Occupied':'Available'}</span><div class="specs"><span>${m2}${r.size||''}</span><span>${bed}${r.bed||''}</span><span>${gst}${r.guests||''}</span></div><p class="rdesc">${r.description||''}</p><div class="rfoot"><span class="avail">Availability: <b>${r.availability_used}/${r.availability_total} Rooms</b></span><span class="price">PKR ${r.price}<small>/night</small></span></div></div></div>`).join('')||'<div style="padding:20px;color:#999">No results</div>';}
 function renderDetail(r){
  document.getElementById('dName').textContent=r.name+' Room';
  document.getElementById('dStatus').textContent=(r.status||'').charAt(0).toUpperCase()+(r.status||'').slice(1);
  document.getElementById('dOcc').textContent='Occupied: '+r.availability_used+'/'+r.availability_total+' Rooms';
  const _b='{{ asset('') }}';
  document.getElementById('dHero').src=_b+r.image;
  const gal=(r.gallery&&r.gallery.length)?r.gallery:[r.image];
  document.getElementById('dThumbs').innerHTML=gal.slice(0,3).map(g=>`<img src="${_b}${g}" alt="" style="width:100%;height:88px;object-fit:cover;border-radius:11px;cursor:pointer" onclick="document.getElementById('dHero').src='${_b}${g}'">`).join('');
  document.getElementById('dSpecs').innerHTML='<span>'+m2+(r.size||'')+'</span><span>'+bed+(r.bed||'')+'</span><span>'+gst+(r.guests||'')+'</span>';
  document.getElementById('dDesc').textContent=r.description||'';
  const F=r.features||[];document.getElementById('features').innerHTML=F.length?F.map(f=>`<div class="fitem">${f==='No Kitchen'?'<span style="color:#ff4e52;font-size:20px;font-weight:800">×</span>':ck}<span>${f}</span></div>`).join(''):'<div class="fitem" style="color:#aaa">No features listed</div>';
  const FA=r.facilities||[];document.getElementById('facilities').innerHTML=FA.length?FA.map(f=>`<div class="fitem"><svg class="fi" viewBox="0 0 24 24">${facIcons[f]||'<circle cx=\"12\" cy=\"12\" r=\"8\"/>'}</svg><span>${f}</span></div>`).join(''):'<div class="fitem" style="color:#aaa">No facilities listed</div>';
  const units=r.units||[];const grid=document.getElementById('unitGrid');if(grid){grid.innerHTML=units.length?units.map(u=>`<span class="unit ${u.status}" onclick="unitActions(${u.id})">${u.number}<small>${ULABEL[u.status]||u.status}</small></span>`).join(''):'<div style="color:#aaa;font-size:13px">No room numbers yet</div>';const free=units.filter(u=>u.status==='available').length;document.getElementById('unitSummary').textContent=units.length?free+' of '+units.length+' available':'';const uf=document.getElementById('unitForm');if(uf)uf.action='{{ url('/rooms') }}/'+r.id+'/units';}
  const AM=r.amenities||[];document.getElementById('amenities').innerHTML=AM.length?AM.map(a=>`<div class="fitem">${ck}<span>${a}</span></div>`).join(''):'<div class="fitem" style="color:#aaa">No amenities listed</div>';
 }
 function selectRoom(id){selectedId=id;const r=rooms.find(x=>x.id===id);if(r)renderDetail(r);render(currentList());}
 function openRoomCreator(){const f=document.getElementById('roomForm');f.reset();f.action='{{ url('/rooms') }}';document.getElementById('roomMethod').value='';document.getElementById('roomModalTitle').textContent='Add Room';openModal('addRoom');}
 function openRoomEditor(){const r=rooms.find(x=>x.id===selectedId);if(!r)return;const f=document.getElementById('roomForm');f.reset();f.action='{{ url('/rooms') }}/'+r.id;document.getElementById('roomMethod').value='PUT';document.getElementById('roomModalTitle').textContent='Edit Room';['name','status','price','size','bed','guests','availability_total','availability_used','description'].forEach(k=>{if(f.elements[k])f.elements[k].value=r[k]??'';});const F=r.features||[];f.elements.feature_bedrooms.value=F.find(x=>/bedroom/i.test(x))||'';f.elements.kitchen_feature.value=F.find(x=>x==='Kitchen'||x==='No Kitchen')||'';f.querySelectorAll('[name="features[]"]').forEach(el=>{el.checked=F.includes(el.value);});openModal('addRoom');}
 function applyFilters(){render(currentList());}
 ['fSearch','fType','fSort'].forEach(id=>document.getElementById(id).addEventListener(id==='fSearch'?'input':'change',applyFilters));
 /* Phone controls mirror into the desktop inputs so one currentList() serves both layouts. */
 (function(){const ms=document.getElementById('mSearch'),mo=document.getElementById('mSort'),ch=document.getElementById('mChips');
  if(ms)ms.addEventListener('input',()=>{document.getElementById('fSearch').value=ms.value;applyFilters();});
  if(mo)mo.addEventListener('change',()=>{document.getElementById('fSort').value=mo.value;applyFilters();});
  if(ch)ch.querySelectorAll('.mr-chip').forEach(b=>b.addEventListener('click',()=>{ch.querySelectorAll('.mr-chip').forEach(x=>x.classList.remove('on'));b.classList.add('on');document.getElementById('fType').value=b.dataset.type;applyFilters();}));
 })();
 render(rooms);
 const _init=rooms.find(x=>x.id===selectedId)||rooms[0];if(_init)renderDetail(_init);
</script>
<div class="modal-ov" id="addRoom"><div class="modal"><h3 id="roomModalTitle">Add Room</h3><form id="roomForm" method="POST" action="{{ url('/rooms') }}" enctype="multipart/form-data">@csrf<input type="hidden" name="_method" id="roomMethod" value="">
<label>Room Images (select multiple)</label><input type="file" name="images[]" accept="image/*" multiple style="height:auto;padding:9px 12px">
<label>Room Name</label><input name="name" placeholder="Deluxe" required>
<div class="mrow"><div><label>Status</label><select name="status"><option value="available">Available</option><option value="occupied">Occupied</option></select></div><div><label>Price / night</label><input type="number" name="price" value="100"></div></div>
<div class="mrow"><div><label>Size</label><input name="size" placeholder="35 m²"></div><div><label>Bed</label><input name="bed" placeholder="King Bed"></div></div>
<div class="amenity-box"><h4>Room Features</h4><div class="mrow"><div><label>Bedrooms</label><input name="feature_bedrooms" placeholder="e.g. 3 Bedrooms"></div><div><label>Kitchen</label><select name="kitchen_feature"><option value="">Select option</option><option value="Kitchen">Kitchen</option><option value="No Kitchen">No Kitchen</option></select></div></div><div class="amenity-grid" style="margin-top:10px"><label><input type="checkbox" name="features[]" value="TV Lounge">TV Lounge</label><label><input type="checkbox" name="features[]" value="Dining Area">Dining Area</label><label><input type="checkbox" name="features[]" value="Private Lawn Access">Private Lawn Access</label><label><input type="checkbox" name="features[]" value="Balcony with Mountain View">Balcony with Mountain View</label><label><input type="checkbox" name="features[]" value="Work Desk">Work Desk</label><label><input type="checkbox" name="features[]" value="City View">City View</label><label><input type="checkbox" name="features[]" value="Modern Layout">Modern Layout</label></div></div>
<div class="mrow"><div><label>Guests</label><input name="guests" placeholder="2 guests"></div><div><label>Total Rooms</label><input type="number" name="availability_total" value="10"></div></div>
<label>Occupied (used)</label><input type="number" name="availability_used" value="0">
<label>Description</label><textarea name="description"></textarea>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('addRoom')">Cancel</button><button class="mbtn save">Save</button></div>
</form></div></div>
</body>
</html>
