{{-- Shared phone page shell (Figma style): header with logo, title row, filter/card/pager styles.
     Usage inside a page: <section class="m-page">@include('partials.mobile-shell', ['msTitle'=>'Rooms','msSubtitle'=>'...','msAction'=>'<button ...>'])...</section>
     The shell only renders on screens up to 768px; desktop layouts are untouched. --}}
<style>
.m-page{display:none}
@media(max-width:768px){
    body{zoom:1!important;background:#f4f6f5!important;display:block!important}
    .main{padding:10px 16px 100px!important}
    .main>*:not(.m-page){display:none!important}
    .m-page{display:block;font-family:Lato,Arial,sans-serif;color:#111}
    .ms-head{display:flex;align-items:center;justify-content:space-between;padding:6px 0 14px}
    .ms-brand{display:flex;align-items:center;gap:11px}
    .ms-brand img{width:46px;height:46px;border-radius:50%;object-fit:cover;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,.08)}
    .ms-brand b{display:block;font-size:17px;font-weight:800;line-height:1.1;color:#111;white-space:nowrap}
    .ms-brand small{display:block;font-size:13px;color:#333;margin-top:2px}
    .ms-tools{display:flex;align-items:center;gap:8px}
    .ms-ib{width:44px;height:44px;border:0;border-radius:12px;background:#fff;display:grid;place-items:center;color:#222;cursor:pointer;position:relative;box-shadow:0 1px 4px rgba(0,0,0,.06)}
    .ms-ib svg{width:22px;height:22px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .ms-ib.bell:after{content:'';position:absolute;top:9px;right:10px;width:9px;height:9px;border-radius:50%;background:#ff3b30;border:2px solid #fff}
    .ms-avatar{width:48px;height:48px;border-radius:50%;background:#d7f0a0;color:#1f5f3f;display:grid;place-items:center;font-weight:800;font-size:16px;margin-left:4px}
    .ms-title{display:flex;align-items:flex-start;justify-content:space-between;gap:10px;margin:2px 0 14px}
    .ms-title h1{margin:0;font-size:30px;font-weight:800;letter-spacing:-.4px;line-height:1.1}
    .ms-title p{margin:4px 0 0;font-size:13px;color:#555}
    .ms-add{display:inline-flex;align-items:center;gap:8px;height:44px;padding:0 16px;border:0;border-radius:12px;background:#dff55f;color:#1f2a08;font:700 15px Lato,Arial,sans-serif;cursor:pointer;white-space:nowrap;flex:0 0 auto}
    .ms-add svg{width:20px;height:20px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round}
    .ms-filters{display:grid;grid-template-columns:minmax(0,1fr) auto;gap:8px;margin-bottom:12px}
    .ms-filters.one{grid-template-columns:minmax(0,1fr)}
    .ms-search{display:flex;align-items:center;gap:9px;height:50px;border-radius:14px;background:#fff;padding:0 14px;min-width:0;box-shadow:0 1px 4px rgba(0,0,0,.05)}
    .ms-search svg{width:20px;height:20px;flex:0 0 20px;fill:none;stroke:#222;stroke-width:2;stroke-linecap:round}
    .ms-search input{flex:1;min-width:0;border:0;outline:0;background:none;font:400 14px Lato,Arial,sans-serif;color:#111}
    .ms-search input::placeholder{color:#9a9a9a}
    .ms-sel{height:50px;border:0;border-radius:14px;background:#fff;padding:0 30px 0 12px;font:400 14px Lato,Arial,sans-serif;color:#111;appearance:none;-webkit-appearance:none;box-shadow:0 1px 4px rgba(0,0,0,.05);background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23222' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;background-size:14px;max-width:100%;min-width:0}
    .ms-selrow{display:flex;gap:8px;overflow-x:auto;margin:0 -16px 12px;padding:2px 16px 6px;scrollbar-width:none}
    .ms-selrow::-webkit-scrollbar{display:none}
    .ms-selrow .ms-sel{flex:0 0 auto;height:44px}
    .ms-chips{display:flex;gap:8px;overflow-x:auto;padding:2px 16px 8px;margin:0 -16px 8px;scrollbar-width:none}
    .ms-chips::-webkit-scrollbar{display:none}
    .ms-chip{flex:0 0 auto;height:40px;padding:0 18px;border:0;border-radius:20px;background:#e9ecea;color:#222;font:600 14px Lato,Arial,sans-serif;cursor:pointer;white-space:nowrap;display:inline-flex;align-items:center;gap:7px}
    .ms-chip.on{background:#1f7a4d;color:#fff}
    .ms-chip i{width:10px;height:10px;border-radius:50%;display:inline-block}
    .ms-card{background:#fff;border-radius:18px;padding:14px;margin-bottom:12px;box-shadow:0 4px 18px rgba(16,24,40,.05);border:1px solid #eef0ee}
    .ms-top{display:grid;grid-template-columns:auto minmax(0,1fr) auto;align-items:center;gap:10px}
    .ms-top.noav{grid-template-columns:minmax(0,1fr) auto}
    .ms-av{width:50px;height:50px;border-radius:50%;display:grid;place-items:center;font-weight:800;font-size:16px;color:#1f5f3f;background:#d9f5e5;overflow:hidden}
    .ms-av img{width:100%;height:100%;object-fit:cover}
    .ms-av.sq{border-radius:12px;font-size:24px;background:#f1f3f2}
    .ms-av.c1{background:#dfebfb;color:#1e4f8f}.ms-av.c2{background:#fdf3d2;color:#7a5a00}.ms-av.c3{background:#d9f5e5;color:#1f5f3f}.ms-av.c4{background:#e9e4fb;color:#4b3a8f}
    .ms-name{min-width:0}
    .ms-name b{display:block;font-size:16px;font-weight:800;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .ms-name small{display:block;font-size:13px;color:#8a8a8a;margin-top:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .ms-pill{display:inline-flex;align-items:center;gap:5px;padding:6px 11px;border-radius:14px;font-size:12px;font-weight:700;white-space:nowrap;background:#ececec;color:#555}
    .ms-pill.green,.ms-pill.confirmed,.ms-pill.paid,.ms-pill.ready,.ms-pill.available,.ms-pill.active,.ms-pill.completed{background:#d9f5e5;color:#2f6b4f}
    .ms-pill.red,.ms-pill.pending,.ms-pill.unpaid,.ms-pill.needs,.ms-pill.out,.ms-pill.high{background:#ffe1e1;color:#c0392b}
    .ms-pill.lime,.ms-pill.checked_in,.ms-pill.progress{background:#e8fb82;color:#3d4a10}
    .ms-pill.gold,.ms-pill.partial,.ms-pill.inspect,.ms-pill.low,.ms-pill.medium{background:#fdf3d2;color:#8a6200}
    .ms-pill.gray,.ms-pill.checked_out{background:#ececec;color:#666}
    .ms-pill.blue{background:#dfebfb;color:#1e4f8f}
    .ms-pill.i{font-style:italic}
    .ms-meta{display:flex;flex-wrap:wrap;gap:6px 14px;margin-top:12px;font-size:13px;color:#333}
    .ms-meta span{display:inline-flex;align-items:center;gap:6px;white-space:nowrap;min-width:0}
    .ms-meta svg{width:16px;height:16px;flex:0 0 16px;fill:none;stroke:#222;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .ms-meta a{color:#1d6ae5;text-decoration:none}
    .ms-kv{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px 0;margin-top:12px}
    .ms-kv.two{grid-template-columns:1fr 1fr}
    .ms-kv div{padding:0 10px;border-left:1px solid #e6e6e6;min-width:0}
    .ms-kv div:first-child,.ms-kv:not(.two) div:nth-child(3n+1),.ms-kv.two div:nth-child(2n+1){padding-left:0;border-left:0}
    .ms-kv small{display:block;font-size:12px;color:#666;margin-bottom:3px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .ms-kv b{display:block;font-size:14px;font-weight:700;word-break:break-word}
    .ms-note{margin-top:10px;font-size:13px;color:#555;line-height:1.4}
    .ms-act{display:flex;justify-content:flex-end;flex-wrap:wrap;gap:8px;margin-top:12px}
    .ms-btn{display:inline-flex;align-items:center;justify-content:center;gap:6px;height:38px;border:0;border-radius:10px;padding:0 16px;font:700 14px Lato,Arial,sans-serif;cursor:pointer;white-space:nowrap;text-decoration:none}
    .ms-btn.next,.ms-btn.lime{background:#dff55f;color:#1f2a08}.ms-btn.cancel{background:#ffe1e1;color:#c0392b}.ms-btn.done,.ms-btn.gray{background:#ececec;color:#666}.ms-btn.mint{background:#d9f5e5;color:#1f5f3f}
    .ms-btn.line{background:#fff;border:1px solid #e3e3e3;color:#333;width:52px;padding:0}
    .ms-btn svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .ms-tagsel{height:32px;border:0;border-radius:14px;padding:0 26px 0 11px;font:700 12px Lato,Arial,sans-serif;appearance:none;-webkit-appearance:none;background-color:#ececec;color:#555;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23555' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 9px center;background-size:12px;max-width:100%}
    .ms-tagsel.ready,.ms-tagsel.low{background-color:#d9f5e5;color:#2f6b4f}.ms-tagsel.needs,.ms-tagsel.high{background-color:#ffe1e1;color:#c0392b}.ms-tagsel.progress{background-color:#e8fb82;color:#3d4a10}.ms-tagsel.inspect,.ms-tagsel.medium{background-color:#fdf3d2;color:#8a6200}
    .ms-check{width:26px;height:26px;border-radius:50%;border:2px solid #cfd6d2;display:grid;place-items:center;background:#fff;cursor:pointer;flex:0 0 26px}
    .ms-check svg{width:14px;height:14px;fill:none;stroke:#fff;stroke-width:3;stroke-linecap:round;stroke-linejoin:round}
    .ms-check.on{background:#1f7a4d;border-color:#1f7a4d}
    .ms-empty{background:#fff;border-radius:18px;padding:28px;text-align:center;color:#888;font-size:14px}
    .ms-pager{display:flex;align-items:center;justify-content:space-between;padding:6px 4px 0;font-size:13px;color:#777}
    .ms-pager:empty{display:none}
    .ms-pager button{height:38px;padding:0 14px;border:0;border-radius:10px;background:#fff;font:700 13px Lato,Arial,sans-serif;color:#333;cursor:pointer;box-shadow:0 1px 4px rgba(0,0,0,.05)}
    .ms-pager button:disabled{opacity:.4;cursor:default}
    .ms-stats{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;margin-bottom:14px}
    .ms-stat{position:relative;border-radius:18px;padding:14px;min-height:120px;display:flex;flex-direction:column;min-width:0}
    .ms-stat.wide{grid-column:1 / -1;min-height:0}
    .ms-stat .ic{width:38px;height:38px;border-radius:11px;display:grid;place-items:center;color:#1f2d24}
    .ms-stat .ic svg{width:19px;height:19px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .ms-stat .lb{font-size:13px;color:#2d2d2d;margin-top:10px}
    .ms-stat .nm{font-size:22px;font-weight:800;line-height:1.05;margin-top:3px;letter-spacing:-.4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .ms-stat .dl{display:flex;align-items:center;gap:8px;margin-top:auto;padding-top:10px;font-size:12px;color:#666;white-space:nowrap}
    .ms-stat .dl b{display:inline-flex;align-items:center;gap:3px;background:#cdeb8c;color:#2f5b1f;border-radius:14px;padding:4px 8px;font-size:12px;font-weight:700}
    .ms-stat.down .dl b{background:#f6c3c7;color:#b02c2c}
    .ms-stat:not(.wide) .dl{font-size:11px;gap:6px}.ms-stat:not(.wide) .dl b{padding:4px 7px;font-size:11px}
    @media(max-width:419px){.ms-stat:not(.wide) .dl i{display:none}}
    .ms-stat .dl i{font-style:normal}
    .ms-stat.mint{background:#dcf5e6}.ms-stat.mint .ic{background:#b8ebcf}
    .ms-stat.blue{background:#dfebfb}.ms-stat.blue .ic{background:#bcd7f7}
    .ms-stat.pink{background:#fde2e5}.ms-stat.pink .ic{background:#f8c5cb}
    .ms-stat.gold{background:#fdf3d2}.ms-stat.gold .ic{background:#f6dc8f}
    .ms-sec{display:flex;align-items:center;justify-content:space-between;gap:10px;margin:6px 0 12px}
    .ms-sec h2{margin:0;font-size:18px;font-weight:800}
    .ms-sec .ms-sel{height:40px}
}
@media(max-width:360px){
    .m-page .ms-brand b{font-size:15px}.m-page .ms-brand small{font-size:12px}.m-page .ms-brand img{width:40px;height:40px}.m-page .ms-ib{width:40px;height:40px}.m-page .ms-avatar{width:42px;height:42px;font-size:14px}
    .m-page .ms-title h1{font-size:25px}.m-page .ms-title p{font-size:12px}.m-page .ms-add{height:40px;padding:0 12px;font-size:14px}
    .m-page .ms-kv{grid-template-columns:1fr 1fr}.m-page .ms-kv div:nth-child(3n+1){padding-left:10px;border-left:1px solid #e6e6e6}.m-page .ms-kv div:nth-child(2n+1){padding-left:0;border-left:0}
    .m-page .ms-name b{font-size:15px}.m-page .ms-btn{padding:0 12px;font-size:13px}
    .m-page .ms-top .ms-tagsel{max-width:118px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
}
</style>
<header class="ms-head">
    <div class="ms-brand"><img src="{{ asset('images/logo.png') }}" alt=""><div><b>Indus Resort</b><small>Restaurant</small></div></div>
    <div class="ms-tools">
        <button class="ms-ib" type="button" aria-label="Search" onclick="var s=document.getElementById('mSearch');if(s){s.focus();s.scrollIntoView({block:'center',behavior:'smooth'});}"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg></button>
        <button class="ms-ib bell" type="button" aria-label="Notifications" onclick="showNotifications()"><svg viewBox="0 0 24 24"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.9 1.9 0 0 0 3.4 0"/></svg></button>
        <span class="ms-avatar hdr-avatar" style="overflow:hidden;cursor:pointer" onclick="openAccount()">@if(auth()->user()->avatar)<img src="{{ asset(auth()->user()->avatar) }}" alt="">@else{{ auth()->user()->initials() }}@endif</span>
    </div>
</header>
<div class="ms-title"><div><h1>{{ $msTitle }}</h1>@if(!empty($msSubtitle))<p>{{ $msSubtitle }}</p>@endif</div>{!! $msAction ?? '' !!}</div>
<script>
/* Shared phone helpers: mirror phone inputs into the desktop filter inputs (one filter function serves both layouts),
   and draw a phone pager whenever the page paginates. */
window.msMirror=function(pairs){pairs.forEach(function(p){var me=document.getElementById(p[0]),de=document.getElementById(p[1]);if(!me||!de)return;me.addEventListener(p[2]||'change',function(){de.value=me.value;de.dispatchEvent(new Event(p[2]||'change'));});});};
window.msInitials=function(n){return String(n||'').split(' ').filter(Boolean).slice(0,2).map(function(w){return w[0].toUpperCase();}).join('');};
/* Shrink any stat figure that would not fit its card (long amounts on narrow phones). */
window.msFit=function(){document.querySelectorAll('.ms-stat .nm').forEach(function(el){if(!el.offsetWidth)return;el.style.fontSize='';var sz=parseFloat(getComputedStyle(el).fontSize);while(el.scrollWidth>el.clientWidth&&sz>11){sz-=1;el.style.fontSize=sz+'px';}});};
window.addEventListener('load',window.msFit);window.addEventListener('resize',window.msFit);if(document.fonts&&document.fonts.ready)document.fonts.ready.then(window.msFit);
window.msMoney=function(v){return 'PKR '+Number(v||0).toLocaleString();};
window.msDate=function(d){if(!d)return '';var p=String(d).slice(0,10).split('-');if(p.length<3)return String(d);var M=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];return M[+p[1]-1]+' '+(+p[2])+', '+p[0];};
(function(){var orig=window.paginateRender;if(!orig)return;window.paginateRender=function(key,list,per,fn){orig(key,list,per,fn);var pg=document.getElementById('mPager');if(!pg)return;var st=window.PGSTATE[key],pages=Math.max(1,Math.ceil(list.length/per));pg.innerHTML=pages>1?'<button type="button" '+(st.page<=1?'disabled':'')+'>‹ Prev</button><span>Page '+st.page+' of '+pages+'</span><button type="button" '+(st.page>=pages?'disabled':'')+'>Next ›</button>':'';var b=pg.querySelectorAll('button');if(b[0])b[0].onclick=function(){st.page--;window.paginateRender(key,list,per,fn);window.scrollTo({top:0,behavior:'smooth'});};if(b[1])b[1].onclick=function(){st.page++;window.paginateRender(key,list,per,fn);window.scrollTo({top:0,behavior:'smooth'});};};})();
</script>
