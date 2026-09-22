<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Invoice - Indus Resort Restaurant</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--line:#f0f0f0}
*{box-sizing:border-box}
body{margin:0;display:flex;background:var(--bg);font-family:Lato,Arial,sans-serif;color:var(--ink);zoom:.9}
@media(min-width:1301px) and (max-width:1700px){body{zoom:.82}}
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
.thead,.trow{display:grid;grid-template-columns:1.1fr 1fr 1.25fr 1fr .8fr 1fr 1.25fr .95fr 1.3fr;align-items:center;min-width:1220px;column-gap:10px}
.thead{background:#eefaf3;border-radius:12px;padding:16px 24px;color:#8a8a8a;font-size:15px;font-weight:600}
.thead span{display:inline-flex;align-items:center;gap:6px}
.thead svg{width:12px;height:12px;fill:none;stroke:#b5b5b5;stroke-width:2}
.trow{padding:18px 24px;border-bottom:1px solid var(--line);font-size:15px}
.trow:last-child{border-bottom:0}
.st{display:inline-flex;align-items:center;gap:8px;padding:6px 12px;border-radius:7px;font-size:14px;font-weight:600;width:max-content}
.st:before{content:'';width:9px;height:9px;border-radius:2px}
.st.paid{background:var(--lime);color:#3d4a10}.st.paid:before{background:#aec455}
.st.unpaid{background:#ffe1e1;color:#b3352f}.st.unpaid:before{background:#ff4e52}
.st.partial{background:#fff1c8;color:#886300}.st.partial:before{background:#e5b52b}
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
@include('partials.responsive')
@include('partials.desktop-theme')
@include('partials.mobile-theme')
<style>
@media(min-width:769px){
 /* Summary strip so the page reads as a financial overview, not a lone table. */
 .iv-cards{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;margin-bottom:16px}
 .iv-card{background:#fff;border:1px solid var(--line);border-radius:14px;padding:16px;display:flex;gap:12px;align-items:flex-start}
 .iv-ic{width:36px;height:36px;border-radius:10px;display:grid;place-items:center;flex:0 0 36px;background:#e6f4ea}
 .iv-ic svg{width:18px;height:18px;fill:none;stroke:#2f6b4f;stroke-width:1.9;stroke-linecap:round;stroke-linejoin:round}
 .iv-ic.amber{background:#fdf1d3}.iv-ic.amber svg{stroke:#9a7100}
 .iv-ic.red{background:#fde3e5}.iv-ic.red svg{stroke:#b3352f}
 .iv-ic.blue{background:#dfebfb}.iv-ic.blue svg{stroke:#1e4f8f}
 .iv-card small{display:block;color:#6b7671;font-size:12.5px;margin-bottom:5px}
 .iv-card b{display:block;font-size:21px;letter-spacing:-.3px;color:#123527;line-height:1.15}
 .iv-card i{display:block;font-style:normal;color:#8b948f;font-size:11.5px;margin-top:4px}
 /* Status pills: upright, theme colours. */
 .st{font-style:normal!important;font-size:12.5px!important;padding:6px 11px!important;border-radius:20px!important}
 .st.paid{background:#e6f4ea!important;color:#2f6b4f!important}.st.paid:before{background:#2f6b4f!important;border-radius:50%!important}
 .st.partial{background:#fdf1d3!important;color:#7a5400!important}.st.partial:before{background:#d99b0b!important;border-radius:50%!important}
 .st.unpaid{background:#fde3e5!important;color:#b3352f!important}.st.unpaid:before{background:#d24b4b!important;border-radius:50%!important}
 /* Action buttons match the other tables. */
 .act{gap:8px}
 .eye{width:34px!important;height:34px!important;border-radius:9px!important;border:1px solid var(--line)!important}
 .eye svg{width:16px!important;height:16px!important;stroke:#55605a!important}
 .eye:hover{background:#f7faf8}
 .dl{height:34px!important;padding:0 13px!important;border-radius:9px!important;background:#e6f4ea!important;color:#1e4a36!important;font-size:12.5px!important;font-weight:700!important;border:1px solid #d5e8dc!important}
 .dl svg{width:14px!important;height:14px!important}
 .dl:hover{background:#daeee1!important}
 .iv-room b{display:block;font-weight:600;font-size:13.5px}
 .iv-room small{display:block;color:#9ca3af;font-size:12px;margin-top:2px}
 .iv-bal{font-weight:600}
 .iv-bal.due{color:#b3352f}
 .thead span{white-space:nowrap}
 .iv-bal.clear{color:#2f6b4f}
}
</style>

<main class="main">
<section class="m-page">
@include('partials.mobile-shell', ['msTitle'=>'Invoices','msSubtitle'=>'Payments and receipts'])
<div class="ms-filters"><label class="ms-search"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg><input id="mSearch" type="search" placeholder="Search name, room, etc..."></label><select class="ms-sel" id="mStatus"><option value="">All Status</option><option value="paid">Paid</option><option value="partial">Partial</option><option value="unpaid">Unpaid</option></select></div>
<div id="mRows"></div><div class="ms-pager" id="mPager"></div>
@include('partials.mobile-nav')
</section>
    <header class="top">
        <h1>Invoice</h1>
        <div class="profile">
            <span class="avatar hdr-avatar" style="cursor:pointer;overflow:hidden" onclick="openAccount()" title="My account">@if(auth()->user()->avatar)<img src="{{ asset(auth()->user()->avatar) }}" alt="">@else{{ auth()->user()->initials() }}@endif</span>
            <div class="pinfo"><b>{{ auth()->user()->name }}</b><small>{{ ucfirst(auth()->user()->role) }}</small></div>
            <div class="tools">
                <button class="tool" type="button" title="My account" onclick="openAccount()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell" type="button" title="Notifications" onclick="showNotifications()"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
            </div>
        </div>
    </header>
@include('partials.page-head', ['pgTitle'=>'Invoices','pgSub'=>'Booking invoices, payments and downloads.'])
    <section class="iv-cards">
        <div class="iv-card"><span class="iv-ic blue"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M9 13h6M9 17h4"/></svg></span><div><small>Total Invoiced</small><b>PKR {{ number_format($totals['invoiced']) }}</b><i>{{ $bookings->count() }} {{ $bookings->count() === 1 ? 'invoice' : 'invoices' }}</i></div></div>
        <div class="iv-card"><span class="iv-ic"><svg viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg></span><div><small>Collected</small><b>PKR {{ number_format($totals['collected']) }}</b><i>{{ $totals['invoiced'] > 0 ? round($totals['collected'] / $totals['invoiced'] * 100) : 0 }}% of total</i></div></div>
        <div class="iv-card"><span class="iv-ic amber"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span><div><small>Outstanding</small><b>PKR {{ number_format($totals['outstanding']) }}</b><i>still to collect</i></div></div>
        <div class="iv-card"><span class="iv-ic red"><svg viewBox="0 0 24 24"><path d="M12 9v4M12 17h.01"/><path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"/></svg></span><div><small>Awaiting Payment</small><b>{{ $totals['unpaid'] }}</b><i>{{ $totals['unpaid'] === 1 ? 'invoice open' : 'invoices open' }}</i></div></div>
    </section>
    <section class="panel">
        <div class="filters">
            <div class="fl">
                <div class="pill" style="padding:0 12px"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/></svg><input id="fFrom" type="date" style="border:0;background:transparent;font:inherit;color:#333;width:130px" aria-label="From"><span style="color:#9a9a9a">to</span><input id="fTo" type="date" style="border:0;background:transparent;font:inherit;color:#333;width:130px" aria-label="To"></div>
                <select class="fsel" id="fStatus"><option value="">All Status</option><option value="paid">Paid</option><option value="partial">Partial</option><option value="unpaid">Unpaid</option></select>
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
                <span onclick="sortCol('inv','price_per_night',applyFilters)" style="cursor:pointer">Price / Night @include('partials.sort')</span>
                <span onclick="sortCol('inv','duration',applyFilters)" style="cursor:pointer">Duration @include('partials.sort')</span>
                <span onclick="sortCol('inv','amount',applyFilters)" style="cursor:pointer">Amount @include('partials.sort')</span>
                <span onclick="sortCol('inv','advance_amount',applyFilters)" style="cursor:pointer">Balance Due @include('partials.sort')</span>
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
        <div class="flinks"><span>Copyright © 2026 Indus Resort Restaurant</span><a href="#">Privacy Policy</a><a href="#">Term and conditions</a><a href="#">Contact</a></div>
        <div class="fsoc">
            <a href="https://www.facebook.com/people/Indus-Resort/61590518813137/" target="_blank" rel="noopener" aria-label="Facebook"><svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
            <a href="https://wa.me/923000053333" target="_blank" rel="noopener" aria-label="WhatsApp"><svg viewBox="0 0 24 24"><path d="M20.5 11.5a8.5 8.5 0 0 1-12.6 7.5L3.5 20.5 5 16.3A8.5 8.5 0 1 1 20.5 11.5Z"/><path d="M8.4 7.8c.2-.5.5-.5.7-.5h.5c.2 0 .4.1.5.4l.8 1.8c.1.3.1.5-.1.7l-.5.6c-.1.1-.1.3 0 .4.4.8 1.1 1.5 1.9 1.9.1.1.3.1.4 0l.6-.5c.2-.2.4-.2.7-.1l1.8.8c.3.1.4.3.4.5v.5c0 .2-.1.5-.5.7-.4.2-1.2.4-2.3-.1-1-.5-2.2-1.4-3.2-2.4-1-1-1.9-2.2-2.4-3.2-.5-1.1-.3-1.9-.1-2.3Z"/></svg></a>
            <a href="https://www.instagram.com/indus_resort/" target="_blank" rel="noopener" aria-label="Instagram"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg></a>


        </div>
    </footer>
</main>
@include('partials.invoice-modal')
<script>
const eye='<svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>';
const dl='<svg viewBox="0 0 24 24"><path d="M12 3v12m0 0 4-4m-4 4-4-4M4 21h16"/></svg>';
const data=@json($bookings);

function renderMobile(list){const el=document.getElementById('mRows');if(!el)return;el.innerHTML=list.map((b,i)=>{const partial=b.invoice_status==='partial'||Number(b.advance_amount)>0;const total=Number(b.amount)||((Number(b.price_per_night)||0)*(parseInt(b.duration)||1));const advance=Math.min(total,Number(b.advance_amount||0));const finalPayment=b.invoice_status==='paid'?Math.min(Math.max(0,total-advance),Number(b.final_payment_amount||Math.max(0,total-advance))):0;const remaining=Math.max(0,total-advance-finalPayment);const status=b.invoice_status==='paid'?'Paid':b.invoice_status==='partial'?'Partial':'Unpaid';return `<article class="ms-card"><div class="ms-top"><span class="ms-av c${(i%4)+1}">${msInitials(b.guest_name)}</span><div class="ms-name"><b>${b.guest_name}</b><small>${b.code}</small></div><span class="ms-pill ${b.invoice_status}">${status}</span></div><div class="ms-kv"><div><small>Room</small><b>${b.room_label||'—'}</b></div><div><small>Duration</small><b>${b.duration||'—'}</b></div><div><small>Rate / night</small><b>${msMoney(b.price_per_night)}</b></div></div><div class="ms-kv two" style="margin-top:12px;padding-top:12px;border-top:1px solid #eee"><div><small>Total Amount</small><b style="font-size:17px">${msMoney(total)}</b></div><div><small>Remaining Balance</small><b style="font-size:17px;color:${remaining>0?'#bf501d':'#287552'}">${partial?msMoney(remaining):'—'}</b></div></div><div class="ms-act"><button type="button" class="ms-btn gray" onclick="showInvoice(${b.id})">View</button><button type="button" class="ms-btn lime" onclick="downloadInvoice(${b.id})">${dl} Download</button></div></article>`}).join('')||'<div class="ms-empty">No invoices found</div>';}
function render(list){renderMobile(list);list.forEach(b=>INV[b.id]=b);document.getElementById('rows').innerHTML=list.map(b=>{const partial=b.invoice_status==='partial'||Number(b.advance_amount)>0;const total=Number(b.amount)||((Number(b.price_per_night)||0)*(parseInt(b.duration)||1));const advance=Math.min(total,Number(b.advance_amount||0));const finalPayment=b.invoice_status==='paid'?Math.min(Math.max(0,total-advance),Number(b.final_payment_amount||Math.max(0,total-advance))):0;const remaining=Math.max(0,total-advance-finalPayment);const status=b.invoice_status==='paid'?'Paid':b.invoice_status==='partial'?'Partial':'Unpaid';return `<div class="trow" style="cursor:pointer" onclick="showInvoice(${b.id})"><span>${b.guest_name}</span><span>${b.code}</span><span class="iv-room"><b>${b.room_type||b.room_label||'—'}</b>${b.room_number?`<small>Room ${b.room_number}</small>`:''}</span><span>PKR ${Number(b.price_per_night||0).toLocaleString()}</span><span>${b.duration?b.duration+(parseInt(b.duration)===1?' Night':' Nights'):'—'}</span><span>PKR ${total.toLocaleString()}</span><span class="iv-bal ${remaining>0?'due':'clear'}">${remaining>0?'PKR '+remaining.toLocaleString():'Settled'}</span><span><em class="st ${b.invoice_status}">${status}</em></span><span class="act"><button class="eye" title="View invoice" onclick="event.stopPropagation();showInvoice(${b.id})">${eye}</button><button class="dl" onclick="event.stopPropagation();downloadInvoice(${b.id})">${dl} Download</button></span></div>`}).join('')||'<div class="trow"><span>No results</span></div>';}
function applyFilters(){const q=(document.getElementById('fSearch').value||'').toLowerCase();const st=document.getElementById('fStatus').value;pgReset('inv');paginateRender('inv',sortList('inv',data.filter(b=>(!(document.getElementById('fFrom')||{}).value||String(b.check_out||'').slice(0,10)>=document.getElementById('fFrom').value)&&(!(document.getElementById('fTo')||{}).value||String(b.check_in||'').slice(0,10)<=document.getElementById('fTo').value)&&(!st||b.invoice_status===st)&&(!q||[b.guest_name,b.code,b.room_label].join(' ').toLowerCase().includes(q)))),8,render);}
msMirror([['mSearch','fSearch','input'],['mStatus','fStatus']]);
document.getElementById('fSearch').addEventListener('input',applyFilters);
document.getElementById('fStatus').addEventListener('change',applyFilters);
['fFrom','fTo'].forEach(id=>{const el=document.getElementById(id);if(el)el.addEventListener('change',applyFilters);});
applyFilters();
</script>
</body>
</html>
