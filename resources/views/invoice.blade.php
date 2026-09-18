<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Invoice - HotelPro</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--line:#f0f0f0}
*{box-sizing:border-box}
body{margin:0;display:flex;background:var(--bg);font-family:Lato,Arial,sans-serif;color:var(--ink);zoom:.9}
@media(min-width:1301px) and (max-width:1550px){body{zoom:.82}}
@media(min-width:1101px) and (max-width:1300px){body{zoom:.72}}
@media(min-width:701px) and (max-width:1100px){body{zoom:.62}}
.main{flex:1;min-width:0;padding:26px 30px 16px}
.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:22px}
.top h1{font-size:30px;font-weight:800;margin:0}
.profile{display:flex;align-items:center;gap:13px}
.avatar{width:46px;height:46px;border-radius:50%;background:var(--lime);display:grid;place-items:center;font-weight:700;font-size:15px;overflow:hidden}
.avatar img{width:100%;height:100%;object-fit:cover}
.pinfo b{display:block;font-size:16px;line-height:1.1}.pinfo small{color:#888;font-size:13px}
.tools{display:flex;gap:10px;margin-left:14px}
.tool{width:44px;height:44px;border:1px solid #e8e8e8;background:#fff;border-radius:11px;display:grid;place-items:center;cursor:pointer;position:relative}
.tool svg{width:20px;height:20px;fill:none;stroke:#4a4a4a;stroke-width:1.8}
.tool.bell:after{content:'';position:absolute;top:9px;right:11px;width:8px;height:8px;border-radius:50%;background:#ff4e52;border:2px solid #fff}
.panel{background:#fff;border-radius:18px;padding:22px 22px 8px}
.filters{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;gap:12px;flex-wrap:wrap}
.fl,.fr{display:flex;gap:12px;align-items:center}
.pill{height:44px;border:0;border-radius:11px;padding:0 16px;display:inline-flex;align-items:center;gap:9px;font-size:15px;background:#f4f4f4;color:#333;cursor:pointer;white-space:nowrap}
.pill.lime{background:var(--lime)}
.pill svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:1.8}
.searchbox{position:relative}
.searchbox svg{position:absolute;left:15px;top:50%;transform:translateY(-50%);width:18px;height:18px;fill:none;stroke:#b0b0b0;stroke-width:1.8}
.search{height:44px;width:300px;border:0;border-radius:11px;background:#f4f4f4;padding:0 16px 0 42px;font-size:14px;color:#333;font-family:inherit}
.search::placeholder{color:#b0b0b0}
.sliders{width:44px;height:44px;border:0;border-radius:11px;background:var(--lime);display:grid;place-items:center;cursor:pointer}
.sliders svg{width:20px;height:20px;fill:none;stroke:#222;stroke-width:1.8}
.tbl{width:100%;overflow-x:auto}
.thead,.trow{display:grid;grid-template-columns:1.25fr 1.1fr 1.05fr 1.35fr 1.05fr 1fr 1.05fr 1.4fr;align-items:center;min-width:1050px}
.thead{background:#eefaf3;border-radius:12px;padding:16px 24px;color:#8a8a8a;font-size:15px;font-weight:600}
.thead span{display:inline-flex;align-items:center;gap:6px}
.thead svg{width:12px;height:12px;fill:none;stroke:#b5b5b5;stroke-width:2}
.trow{padding:18px 24px;border-bottom:1px solid var(--line);font-size:15px}
.trow:last-child{border-bottom:0}
.st{display:inline-flex;align-items:center;gap:8px;padding:6px 12px;border-radius:7px;font-size:14px;font-weight:600;width:max-content}
.st:before{content:'';width:9px;height:9px;border-radius:2px}
.st.paid{background:var(--lime);color:#3d4a10}.st.paid:before{background:#aec455}
.st.unpaid{background:#ffe1e1;color:#b3352f}.st.unpaid:before{background:#ff4e52}
.act{display:flex;gap:11px;align-items:center}
.eye{width:40px;height:40px;border:1px solid #ededed;background:#fff;border-radius:9px;display:grid;place-items:center;cursor:pointer}
.eye svg{width:19px;height:19px;fill:none;stroke:#555;stroke-width:1.7}
.dl{height:40px;border:0;border-radius:9px;background:var(--lime);padding:0 16px;display:inline-flex;align-items:center;gap:7px;font-size:14px;font-weight:600;color:#2f3a0c;cursor:pointer}
.dl svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.9}
.tbottom{display:flex;justify-content:space-between;align-items:center;padding:20px 4px 16px;color:#8a8a8a;font-size:15px}
.pages{display:flex;gap:8px}
.pg{min-width:40px;height:40px;border:0;border-radius:9px;background:#f4f4f4;font-size:15px;color:#555;cursor:pointer;display:grid;place-items:center}
.pg.active{background:var(--lime);color:#2f3a0c;font-weight:700}
footer{display:flex;justify-content:space-between;align-items:center;padding:20px 6px 8px;color:#9a9a9a;font-size:14px;flex-wrap:wrap;gap:14px}
.flinks{display:flex;gap:26px}.flinks a{color:#9a9a9a;text-decoration:none}.flinks span:first-child{color:#666}
.fsoc{display:flex;gap:16px;align-items:center}.fsoc a{color:#c2c2c2}.fsoc svg{width:18px;height:18px;fill:currentColor}
@media(max-width:700px){body{zoom:1}.main{padding:18px 14px}.top h1{font-size:24px}.profile .pinfo,.tools{display:none}.filters{flex-direction:column;align-items:stretch}.fr{flex-direction:column;align-items:stretch}.search{width:100%}footer{flex-direction:column;align-items:flex-start}}
</style>
</head>
<body>
@include('partials.crud')
@include('partials.sidebar')
<main class="main">
    <header class="top">
        <h1>Invoice</h1>
        <div class="profile">
            <span class="avatar">{{ collect(explode(' ', auth()->user()->name))->map(fn($w)=>$w[0])->take(2)->implode('') }}</span>
            <div class="pinfo"><b>{{ auth()->user()->name }}</b><small>{{ ucfirst(auth()->user()->role) }}</small></div>
            <div class="tools">
                <button class="tool"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
            </div>
        </div>
    </header>
    <section class="panel">
        <div class="filters">
            <div class="fl">
                <button class="pill lime"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/></svg>{{ now()->startOfMonth()->addDays(4)->format('j M') }} - {{ now()->startOfMonth()->addDays(15)->format('j M Y') }}<svg viewBox="0 0 24 24" width="14" height="14"><path d="m6 9 6 6 6-6"/></svg></button>
                <select class="fsel" id="fStatus"><option value="">All Status</option><option value="paid">Paid</option><option value="unpaid">Unpaid</option></select>
            </div>
            <div class="fr">
                <div class="searchbox"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg><input class="search" id="fSearch" placeholder="Search name, room, etc"></div>
                <button class="sliders"><svg viewBox="0 0 24 24"><path d="M4 7h9M17 7h3M4 12h3M11 12h9M4 17h7M15 17h5"/><circle cx="15" cy="7" r="2"/><circle cx="9" cy="12" r="2"/><circle cx="13" cy="17" r="2"/></svg></button>
            </div>
        </div>
        <div class="tbl">
            <div class="thead">
                <span onclick="sortCol('inv','guest_name',applyFilters)" style="cursor:pointer">Guest Name @include('partials.sort')</span>
                <span onclick="sortCol('inv','code',applyFilters)" style="cursor:pointer">Booking ID @include('partials.sort')</span>
                <span onclick="sortCol('inv','room_label',applyFilters)" style="cursor:pointer">Room @include('partials.sort')</span>
                <span onclick="sortCol('inv','price_per_night',applyFilters)" style="cursor:pointer">Price (per night) @include('partials.sort')</span>
                <span onclick="sortCol('inv','duration',applyFilters)" style="cursor:pointer">Duration @include('partials.sort')</span>
                <span onclick="sortCol('inv','amount',applyFilters)" style="cursor:pointer">Amount @include('partials.sort')</span>
                <span onclick="sortCol('inv','invoice_status',applyFilters)" style="cursor:pointer">Status @include('partials.sort')</span>
                <span>Action @include('partials.sort')</span>
            </div>
            <div id="rows"></div>
        </div>
        <div class="tbottom">
            <span id="invInfo">Showing…</span>
            <div class="pages" id="invPages"></div>
        </div>
    </section>
    <footer>
        <div class="flinks"><span>Copyright © 2024 HotelPro</span><a href="#">Privacy Policy</a><a href="#">Term and conditions</a><a href="#">Contact</a></div>
        <div class="fsoc">
            <a href="#"><svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
            <a href="#"><svg viewBox="0 0 24 24"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg></a>
            <a href="#"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
            <a href="#"><svg viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="#fff"/></svg></a>
            <a href="#"><svg viewBox="0 0 24 24"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg></a>
        </div>
    </footer>
</main>
<script>
const eye='<svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>';
const dl='<svg viewBox="0 0 24 24"><path d="M12 3v12m0 0 4-4m-4 4-4-4M4 21h16"/></svg>';
const data=@json($bookings);
function money(n){return 'PKR '+Number(n).toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2});}
function invCalc(b){const room=+b.amount||0;const vat=+(room*0.08).toFixed(2);const nights=parseInt(b.duration)||1;const city=+(nights*16.5).toFixed(2);const total=+(room+vat+city).toFixed(2);return{room,vat,city,total,nights};}
window.INV={};
function showInvoice(id){const b=INV[id];const c=invCalc(b);const paid=b.invoice_status==='paid';
 const html=`<div style="font-size:13px;color:#333">
  <div style="display:flex;justify-content:space-between;align-items:flex-start;border-bottom:3px solid #e8fb82;padding-bottom:12px;margin-bottom:14px">
   <div><div style="font-size:20px;font-weight:800;color:#151515">HotelPro</div><div style="color:#999;font-size:11px">Hotel Management System</div></div>
   <div style="text-align:right"><div style="font-weight:800;letter-spacing:1px">INVOICE</div><div style="color:#666">${b.code}</div><div style="color:#999;font-size:11px">${new Date().toLocaleDateString()}</div></div>
  </div>
  <div style="display:flex;justify-content:space-between;margin-bottom:14px">
   <div><div style="color:#999;font-size:11px;margin-bottom:2px">BILL TO</div><b style="font-size:14px">${b.guest_name}</b></div>
   <div style="text-align:right"><div style="color:#999;font-size:11px;margin-bottom:2px">STATUS</div><span style="font-weight:800;padding:3px 10px;border-radius:6px;background:${paid?'#e8fb82':'#ffe1e1'};color:${paid?'#3d4a10':'#b3352f'}">${paid?'PAID':'UNPAID'}</span></div>
  </div>
  <div style="background:#f7f9f2;border-radius:10px;padding:12px 14px;margin-bottom:14px">
   <div style="display:flex;justify-content:space-between;margin:3px 0"><span style="color:#777">Room</span><b>${b.room_label||''}</b></div>
   <div style="display:flex;justify-content:space-between;margin:3px 0"><span style="color:#777">Duration</span><b>${b.duration||''}</b></div>
   <div style="display:flex;justify-content:space-between;margin:3px 0"><span style="color:#777">Rate / night</span><b>PKR ${b.price_per_night}</b></div>
  </div>
  <div>
   <div style="display:flex;justify-content:space-between;margin:6px 0"><span>Room charge (${c.nights} night${c.nights>1?'s':''})</span><span>${money(c.room)}</span></div>
   <div style="display:flex;justify-content:space-between;margin:6px 0"><span>VAT (8%)</span><span>${money(c.vat)}</span></div>
   <div style="display:flex;justify-content:space-between;margin:6px 0"><span>City tax</span><span>${money(c.city)}</span></div>
   <div style="display:flex;justify-content:space-between;margin-top:10px;padding-top:10px;border-top:2px solid #eee;font-size:16px;font-weight:800"><span>Total</span><span>${money(c.total)}</span></div>
  </div>
  <div style="margin-top:16px;display:flex;gap:8px">
   <button class="mbtn save" style="flex:1" onclick="downloadInvoice(${b.id})">⤓ Download</button>
   @if(auth()->user()->role!=='staff')<button class="mbtn cancel" style="flex:1" onclick="post('/invoices/${b.id}/toggle','POST')">${paid?'Mark Unpaid':'Mark Paid'}</button>@endif
  </div>
 </div>`;
 showDetail('', html);
}
function downloadInvoice(id){const b=INV[id];const c=invCalc(b);
 const t=['HOTELPRO  —  INVOICE','================================','','Invoice No : '+b.code,'Date       : '+new Date().toLocaleDateString(),'Bill To    : '+b.guest_name,'Room       : '+(b.room_label||''),'Duration   : '+(b.duration||''),'Rate/night : PKR '+b.price_per_night,'','--------------------------------','Room charge ('+c.nights+' nights)   '+money(c.room),'VAT (8%)                 '+money(c.vat),'City tax                 '+money(c.city),'--------------------------------','TOTAL                    '+money(c.total),'','Status     : '+(b.invoice_status==='paid'?'PAID':'UNPAID'),'','Thank you for staying with HotelPro.'].join('\n');
 downloadFile('invoice-'+b.code+'.txt',t);
}
function render(list){list.forEach(b=>INV[b.id]=b);document.getElementById('rows').innerHTML=list.map(b=>{const paid=b.invoice_status==='paid';return `<div class="trow"><span>${b.guest_name}</span><span>${b.code}</span><span>${b.room_label||''}</span><span>PKR ${b.price_per_night}</span><span>${b.duration||''}</span><span>PKR ${b.amount}</span><span><em class="st ${paid?'paid':'unpaid'}">${paid?'Paid':'Unpaid'}</em></span><span class="act"><button class="eye" title="View invoice" onclick="showInvoice(${b.id})">${eye}</button><button class="dl" onclick="downloadInvoice(${b.id})">${dl} Download</button></span></div>`}).join('')||'<div class="trow"><span>No results</span></div>';}
function applyFilters(){const q=(document.getElementById('fSearch').value||'').toLowerCase();const st=document.getElementById('fStatus').value;pgReset('inv');paginateRender('inv',sortList('inv',data.filter(b=>(!st||b.invoice_status===st)&&(!q||[b.guest_name,b.code,b.room_label].join(' ').toLowerCase().includes(q)))),8,render);}
document.getElementById('fSearch').addEventListener('input',applyFilters);
document.getElementById('fStatus').addEventListener('change',applyFilters);
applyFilters();
</script>
</body>
</html>
