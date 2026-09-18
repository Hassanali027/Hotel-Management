<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Housekeeping - Lodgify</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--line:#f0f0f0;--red:#ff4e52}
*{box-sizing:border-box}
body{margin:0;display:flex;background:var(--bg);font-family:Lato,Arial,sans-serif;color:var(--ink);zoom:.9}
@media(min-width:1301px) and (max-width:1550px){body{zoom:.82}}
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
.panel{background:#fff;border-radius:18px;padding:22px 22px 8px}
.filters{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;gap:12px;flex-wrap:wrap}
.searchbox{position:relative;flex:1;max-width:560px}
.searchbox>svg{position:absolute;left:16px;top:50%;transform:translateY(-50%);width:18px;height:18px;fill:none;stroke:#b0b0b0;stroke-width:1.8}
.search{height:46px;width:100%;border:0;border-radius:11px;background:#f4f4f4;padding:0 16px 0 44px;font-size:14px;color:#333;font-family:inherit}
.search::placeholder{color:#b0b0b0}
.fr{display:flex;gap:12px;align-items:center}
.pill{height:44px;border:0;border-radius:11px;padding:0 16px;display:inline-flex;align-items:center;gap:9px;font-size:15px;background:var(--lime);color:#2f3a0c;cursor:pointer;white-space:nowrap;font-weight:600}
.pill svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.8}
.tbl{width:100%;overflow-x:auto}
.thead,.trow{display:grid;grid-template-columns:44px 1fr .85fr 1.6fr 1.1fr .6fr 1.15fr 1.9fr;align-items:center;min-width:1300px}
.thead{background:#eefaf3;border-radius:12px;padding:16px 20px;color:#8a8a8a;font-size:15px;font-weight:600}
.thead span{display:inline-flex;align-items:center;gap:6px}
.thead svg{width:12px;height:12px;fill:none;stroke:#b5b5b5;stroke-width:2}
.trow{padding:16px 20px;border-bottom:1px solid var(--line);font-size:15px}
.trow:last-child{border-bottom:0}
.trow.on{background:#fafdfb}
.cb{width:20px;height:20px;border:1.6px solid #cfcfcf;border-radius:5px;display:grid;place-items:center;cursor:pointer}
.cb.ck{background:var(--lime);border-color:var(--lime)}
.cb svg{width:13px;height:13px;fill:none;stroke:#2f3a0c;stroke-width:3;display:none}
.cb.ck svg{display:block}
.tag{display:inline-flex;align-items:center;gap:8px;padding:6px 11px;border-radius:8px;font-size:14px;font-weight:600;width:max-content;cursor:pointer}
.tag .cv{width:12px;height:12px;fill:none;stroke:currentColor;stroke-width:2.2;margin-left:2px}
.hs.progress{background:var(--mint);color:#2f6b4f}
.hs.ready{background:var(--lime);color:#3d4a10}
.hs.needs{background:#ffe1e1;color:#b3352f}
.hs.inspect{background:#f1f1f1;color:#666}
.pr{background:#f4f7f2;color:#333}
.pr .dot{width:8px;height:8px;border-radius:50%}
.pr.high .dot{background:var(--red)}.pr.medium .dot{background:#b7c95a}.pr.low .dot{background:#79c79c}
select.tsel{font:600 14px Lato,Arial,sans-serif;border:0;cursor:pointer;padding:6px 10px;max-width:100%}
select.tsel:focus{outline:2px solid rgba(0,0,0,.08)}
.tbottom{display:flex;justify-content:space-between;align-items:center;padding:20px 4px 16px;color:#8a8a8a;font-size:15px}
.pages{display:flex;gap:8px}
.pg{min-width:40px;height:40px;border:0;border-radius:9px;background:#f4f4f4;font-size:15px;color:#555;cursor:pointer;display:grid;place-items:center}
.pg.active{background:var(--lime);color:#2f3a0c;font-weight:700}
footer{display:flex;justify-content:space-between;align-items:center;padding:20px 6px 8px;color:#9a9a9a;font-size:14px;flex-wrap:wrap;gap:14px}
.flinks{display:flex;gap:26px}.flinks a{color:#9a9a9a;text-decoration:none}.flinks span:first-child{color:#666}
.fsoc{display:flex;gap:16px;align-items:center}.fsoc a{color:#c2c2c2}.fsoc svg{width:18px;height:18px;fill:currentColor}
@media(max-width:700px){body{zoom:1}.main{padding:18px 14px}.top h1{font-size:24px}.profile .pinfo,.tools{display:none}.searchbox{max-width:none}footer{flex-direction:column;align-items:flex-start}}
</style>
</head>
<body>
@include('partials.crud')
@include('partials.sidebar')
<main class="main">
    <header class="top">
        <h1>Housekeeping</h1>
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
            <div class="searchbox"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg><input class="search" id="fSearch" placeholder="Search room, floor, etc"></div>
            <div class="fr">
                <select class="fsel lime" id="fRoom"><option value="">All Room</option><option>Deluxe</option><option>Standard</option><option>Suite</option></select>
                <select class="fsel lime" id="fStatus"><option value="">All Status</option><option value="progress">Cleaning in Progress</option><option value="ready">Ready</option><option value="needs">Needs Cleaning</option><option value="inspect">Needs Inspection</option></select>
                <select class="fsel lime" id="fPriority"><option value="">All Priority</option><option value="high">High</option><option value="medium">Medium</option><option value="low">Low</option></select>
                @if(auth()->user()->role !== 'staff')<button class="pill" style="background:var(--lime);color:#2f3a0c;font-weight:700" onclick="openModal('addHk')">+ Add Room</button>@endif
            </div>
        </div>
        <div class="tbl">
            <div class="thead">
                <span></span>
                <span onclick="sortCol('hk','room_number',applyFilters)" style="cursor:pointer">Room Number @include('partials.sort')</span>
                <span onclick="sortCol('hk','room_type',applyFilters)" style="cursor:pointer">Room Type @include('partials.sort')</span>
                <span onclick="sortCol('hk','status',applyFilters)" style="cursor:pointer">Housekeeping Status @include('partials.sort')</span>
                <span onclick="sortCol('hk','priority',applyFilters)" style="cursor:pointer">Priority @include('partials.sort')</span>
                <span onclick="sortCol('hk','floor',applyFilters)" style="cursor:pointer">Floor @include('partials.sort')</span>
                <span onclick="sortCol('hk','reservation_status',applyFilters)" style="cursor:pointer">Reservation Status @include('partials.sort')</span>
                <span onclick="sortCol('hk','notes',applyFilters)" style="cursor:pointer">Notes @include('partials.sort')</span>
            </div>
            <div id="rows"></div>
        </div>
        <div class="tbottom">
            <span id="hkInfo">Showing…</span>
            <div class="pages" id="hkPages"></div>
        </div>
    </section>
    <footer>
        <div class="flinks"><span>Copyright © 2024 Lodgify</span><a href="#">Privacy Policy</a><a href="#">Term and conditions</a><a href="#">Contact</a></div>
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
const chk='<svg viewBox="0 0 24 24"><path d="m5 12 5 5 9-9"/></svg>';
const cv='<svg class="cv" viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></svg>';
const sl={progress:'Cleaning in Progress',ready:'Ready',needs:'Needs Cleaning',inspect:'Needs Inspection'};
const pl={high:'High',medium:'Medium',low:'Low'};
const data=@json($rows);
function opt(map,cur){return Object.keys(map).map(k=>`<option value="${k}"${k===cur?' selected':''}>${map[k]}</option>`).join('');}
function render(list){document.getElementById('rows').innerHTML=list.map(r=>`<div class="trow ${r.is_checked?'on':''}"><span><span class="cb ${r.is_checked?'ck':''}" onclick="post('/housekeeping/${r.id}','POST',{is_checked:${r.is_checked?0:1}})">${chk}</span></span><span>${r.room_number}</span><span>${r.room_type||''}</span><span><select class="tag hs ${r.status} tsel" onchange="post('/housekeeping/${r.id}','POST',{status:this.value})">${opt(sl,r.status)}</select></span><span><select class="tag pr ${r.priority} tsel" onchange="post('/housekeeping/${r.id}','POST',{priority:this.value})">${opt(pl,r.priority)}</select></span><span>${r.floor||''}</span><span>${r.reservation_status||''}</span><span>${r.notes||''}</span></div>`).join('')||'<div class="trow"><span>No results</span></div>';}
function applyFilters(){const q=(document.getElementById('fSearch').value||'').toLowerCase();const rm=document.getElementById('fRoom').value;const st=document.getElementById('fStatus').value;const pr=document.getElementById('fPriority').value;pgReset('hk');paginateRender('hk',sortList('hk',data.filter(r=>(!rm||r.room_type===rm)&&(!st||r.status===st)&&(!pr||r.priority===pr)&&(!q||[r.room_number,r.floor,r.notes,r.reservation_status].join(' ').toLowerCase().includes(q)))),8,render);}
['fSearch','fRoom','fStatus','fPriority'].forEach(id=>document.getElementById(id).addEventListener(id==='fSearch'?'input':'change',applyFilters));
applyFilters();
</script>
<div class="modal-ov" id="addHk"><div class="modal"><h3>Add Room</h3><form method="POST" action="{{ url('/housekeeping') }}">@csrf
<div class="mrow"><div><label>Room Number</label><input name="room_number" placeholder="Room 101" required></div><div><label>Room Type</label><select name="room_type"><option>Deluxe</option><option>Standard</option><option>Suite</option></select></div></div>
<div class="mrow"><div><label>Housekeeping Status</label><select name="status"><option value="needs">Needs Cleaning</option><option value="progress">Cleaning in Progress</option><option value="ready">Ready</option><option value="inspect">Needs Inspection</option></select></div><div><label>Priority</label><select name="priority"><option value="high">High</option><option value="medium">Medium</option><option value="low">Low</option></select></div></div>
<div class="mrow"><div><label>Floor</label><input name="floor" placeholder="1st"></div><div><label>Reservation Status</label><select name="reservation_status"><option>Checked-In</option><option>Checked-Out</option><option>Reserved</option></select></div></div>
<label>Notes</label><textarea name="notes" placeholder="Cleaning notes..."></textarea>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('addHk')">Cancel</button><button class="mbtn save">Save</button></div>
</form></div></div>
</body>
</html>
