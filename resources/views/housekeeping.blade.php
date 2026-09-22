<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Housekeeping - Indus Resort Restaurant</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--line:#f0f0f0;--red:#ff4e52}
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
.thead,.trow{display:grid;grid-template-columns:40px .85fr 1.25fr 1.35fr .95fr .7fr 1.05fr 1.6fr 64px;align-items:center;min-width:1240px;column-gap:10px}
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
@include('partials.responsive')
@include('partials.desktop-theme')
@include('partials.mobile-theme')
<style>
@media(min-width:769px){
 .hk-sel{appearance:none;-webkit-appearance:none;border:1px solid transparent;border-radius:20px;height:32px;padding:0 28px 0 12px;font:600 12.5px Inter,Lato,Arial,sans-serif;cursor:pointer;max-width:100%;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23444' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 9px center;background-size:11px}
 .hk-sel.ready{background-color:#e6f4ea;color:#2f6b4f}
 .hk-sel.progress{background-color:#e2ecfb;color:#1e4f8f}
 .hk-sel.needs{background-color:#fde3e5;color:#b3352f}
 .hk-sel.inspect{background-color:#fdf1d3;color:#7a5400}
 .hk-sel.high{background-color:#fde3e5;color:#b3352f}
 .hk-sel.medium{background-color:#fdf1d3;color:#7a5400}
 .hk-sel.low{background-color:#eef1ef;color:#55605a}
 .hk-rn{font-weight:600;color:#123527}
 .hk-muted{color:#6b7671;font-size:13px}
 .hk-notes{color:#55605a;font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block}
 .hk-edit{height:32px;width:32px;display:inline-grid;place-items:center;border:1px solid var(--line,#e5e9e6);background:#fff;border-radius:9px;color:#55605a;cursor:pointer}
 .hk-edit:hover{background:#f7faf8;color:#123527}
 .hk-edit svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:1.9;stroke-linecap:round;stroke-linejoin:round}
 .trow .cb{width:18px!important;height:18px!important;border-radius:5px!important}
 .trow .cb.ck{background:#2f6b4f!important;border-color:#2f6b4f!important}
 .trow .cb.ck svg{stroke:#fff!important}
 .trow.on{background:#f7faf8!important}
}
</style>
<main class="main">
<section class="m-page">
@php $msAct = auth()->user()->role !== 'staff' ? '<button class="ms-add" type="button" onclick="openModal(\'addHk\')"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>Add Room</button>' : ''; @endphp
@include('partials.mobile-shell', ['msTitle'=>'Housekeeping','msSubtitle'=>'Room cleaning status and priorities','msAction'=>$msAct])
<div class="ms-filters one"><label class="ms-search"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg><input id="mSearch" type="search" placeholder="Search room, floor, etc..."></label></div>
<div class="ms-selrow"><select class="ms-sel" id="mRoom"><option value="">All Room</option>@foreach($roomTypes as $t)<option>{{ $t }}</option>@endforeach</select><select class="ms-sel" id="mStatus"><option value="">All Status</option><option value="progress">Cleaning in Progress</option><option value="ready">Ready</option><option value="needs">Needs Cleaning</option><option value="inspect">Needs Inspection</option></select><select class="ms-sel" id="mPriority"><option value="">All Priority</option><option value="high">High</option><option value="medium">Medium</option><option value="low">Low</option></select></div>
<div id="mRows"></div><div class="ms-pager" id="mPager"></div>
@include('partials.mobile-nav')
</section>
    <header class="top">
        <h1>Housekeeping</h1>
        <div class="profile">
            <span class="avatar hdr-avatar" style="cursor:pointer;overflow:hidden" onclick="openAccount()" title="My account">@if(auth()->user()->avatar)<img src="{{ asset(auth()->user()->avatar) }}" alt="">@else{{ auth()->user()->initials() }}@endif</span>
            <div class="pinfo"><b>{{ auth()->user()->name }}</b><small>{{ ucfirst(auth()->user()->role) }}</small></div>
            <div class="tools">
                <button class="tool" type="button" title="My account" onclick="openAccount()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell" type="button" title="Notifications" onclick="showNotifications()"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
            </div>
        </div>
    </header>
@include('partials.page-head', ['pgTitle'=>'Housekeeping','pgSub'=>'Cleaning status, priorities and room notes.'])
    <section class="panel">
        <div class="filters">
            <div class="searchbox"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg><input class="search" id="fSearch" placeholder="Search room, floor, etc"></div>
            <div class="fr">
                <select class="fsel lime" id="fRoom"><option value="">All Room</option>@foreach($roomTypes as $t)<option>{{ $t }}</option>@endforeach</select>
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
                <span></span>
            </div>
            <div id="rows"></div>
        </div>
        <div class="tbottom">
            <span id="hkInfo">Showing…</span>
            <div class="pages" id="hkPages"></div>
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
<script>
const hkEditIco='<svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>';
const chk='<svg viewBox="0 0 24 24"><path d="m5 12 5 5 9-9"/></svg>';
const cv='<svg class="cv" viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></svg>';
const sl={progress:'Cleaning in Progress',ready:'Ready',needs:'Needs Cleaning',inspect:'Needs Inspection'};
const pl={high:'High',medium:'Medium',low:'Low'};
const data=@json($rows);
const hkUnits=@json($units);
function hkFillRooms(type){const sel=document.getElementById('hkRoom');if(!sel)return;const list=hkUnits.filter(u=>u.type===type);sel.innerHTML=list.length?list.map(u=>'<option value="Room '+u.number+'">Room '+u.number+'</option>').join(''):'<option value="">No room numbers for this type</option>';}
document.addEventListener('DOMContentLoaded',()=>{const t=document.getElementById('hkType');if(t)hkFillRooms(t.value);});
function openHkEditor(id){const r=data.find(x=>x.id===id);if(!r)return;const f=document.getElementById('hkEditForm');f.reset();f.action='/housekeeping/'+r.id;document.getElementById('hkEditTitle').textContent='Edit '+r.room_number;f.elements.floor.value=r.floor||'';f.elements.reservation_status.value=r.reservation_status||'Available';f.elements.notes.value=r.notes||'';const d=document.getElementById('hkDelete');if(d)d.dataset.id=r.id;openModal('editHk');}
function opt(map,cur){return Object.keys(map).map(k=>`<option value="${k}"${k===cur?' selected':''}>${map[k]}</option>`).join('');}
function renderMobile(list){const el=document.getElementById('mRows');if(!el)return;el.innerHTML=list.map(r=>`<article class="ms-card"><div class="ms-top"><span class="ms-check ${r.is_checked?'on':''}" onclick="post('/housekeeping/${r.id}','POST',{is_checked:${r.is_checked?0:1}})">${chk}</span><div class="ms-name"><b>${r.room_number}</b><small>${r.room_type||''}${r.floor?' · Floor '+r.floor:''}</small></div><select class="ms-tagsel ${r.status}" onchange="post('/housekeeping/${r.id}','POST',{status:this.value})">${opt(sl,r.status)}</select></div><div class="ms-kv"><div><small>Priority</small><select class="ms-tagsel ${r.priority}" onchange="post('/housekeeping/${r.id}','POST',{priority:this.value})">${opt(pl,r.priority)}</select></div><div><small>Reservation</small><b>${r.reservation_status||'—'}</b></div><div><small>Floor</small><b>${r.floor||'—'}</b></div></div>${r.notes?`<div class="ms-note">${r.notes}</div>`:''}${CAN_MANAGE?`<div class="ms-act"><button type="button" class="ms-btn gray" onclick="openHkEditor(${r.id})">Edit</button></div>`:''}</article>`).join('')||'<div class="ms-empty">No rooms found</div>';}
function render(list){renderMobile(list);document.getElementById('rows').innerHTML=list.map(r=>`<div class="trow ${r.is_checked?'on':''}"><span><span class="cb ${r.is_checked?'ck':''}" onclick="post('/housekeeping/${r.id}','POST',{is_checked:${r.is_checked?0:1}})">${chk}</span></span><span class="hk-rn">${r.room_number}</span><span class="hk-muted">${r.room_type||'—'}</span><span><select class="hk-sel ${r.status}" onchange="post('/housekeeping/${r.id}','POST',{status:this.value})">${opt(sl,r.status)}</select></span><span><select class="hk-sel ${r.priority}" onchange="post('/housekeeping/${r.id}','POST',{priority:this.value})">${opt(pl,r.priority)}</select></span><span class="hk-muted">${r.floor||'—'}</span><span class="hk-muted">${r.reservation_status||'—'}</span><span class="hk-notes" title="${(r.notes||'').replace(/"/g,'&quot;')}">${r.notes||'—'}</span><span>${CAN_MANAGE?`<button class="hk-edit" title="Edit room" onclick="openHkEditor(${r.id})">${hkEditIco}</button>`:''}</span></div>`).join('')||'<div class="trow"><span>No results</span></div>';}
function applyFilters(){const q=(document.getElementById('fSearch').value||'').toLowerCase();const rm=document.getElementById('fRoom').value;const st=document.getElementById('fStatus').value;const pr=document.getElementById('fPriority').value;pgReset('hk');paginateRender('hk',sortList('hk',data.filter(r=>(!rm||r.room_type===rm)&&(!st||r.status===st)&&(!pr||r.priority===pr)&&(!q||[r.room_number,r.floor,r.notes,r.reservation_status].join(' ').toLowerCase().includes(q)))),8,render);}
msMirror([['mSearch','fSearch','input'],['mRoom','fRoom'],['mStatus','fStatus'],['mPriority','fPriority']]);
['fSearch','fRoom','fStatus','fPriority'].forEach(id=>document.getElementById(id).addEventListener(id==='fSearch'?'input':'change',applyFilters));
applyFilters();
</script>
<div class="modal-ov" id="addHk"><div class="modal"><h3>Add Room</h3><form method="POST" action="{{ url('/housekeeping') }}">@csrf
<div class="mrow"><div><label>Room Type</label><select name="room_type" id="hkType" onchange="hkFillRooms(this.value)">@foreach($roomTypes as $t)<option>{{ $t }}</option>@endforeach</select></div><div><label>Room Number</label><select name="room_number" id="hkRoom" required></select></div></div>
<div class="mrow"><div><label>Housekeeping Status</label><select name="status"><option value="needs">Needs Cleaning</option><option value="progress">Cleaning in Progress</option><option value="ready">Ready</option><option value="inspect">Needs Inspection</option></select></div><div><label>Priority</label><select name="priority"><option value="high">High</option><option value="medium">Medium</option><option value="low">Low</option></select></div></div>
<div class="mrow"><div><label>Floor</label><input name="floor" placeholder="1st"></div><div><label>Reservation Status</label><select name="reservation_status"><option>Checked-In</option><option>Checked-Out</option><option>Reserved</option></select></div></div>
<label>Notes</label><textarea name="notes" placeholder="Cleaning notes..."></textarea>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('addHk')">Cancel</button><button class="mbtn save">Save</button></div>
</form></div></div>
<div class="modal-ov" id="editHk"><div class="modal"><h3 id="hkEditTitle">Edit Room</h3><form id="hkEditForm" method="POST">@csrf<input type="hidden" name="_method" value="PUT">
<div class="mrow"><div><label>Floor</label><input name="floor" placeholder="Ground / First"></div><div><label>Reservation Status</label><select name="reservation_status"><option>Available</option><option>Reserved</option><option>Checked-In</option><option>Checked-Out</option></select></div></div>
<label>Notes</label><textarea name="notes" placeholder="Cleaning notes..."></textarea>
<div class="mact">@if(auth()->user()->role === 'admin')<button type="button" class="mbtn cancel" id="hkDelete" style="margin-right:auto;background:#ffe1e1;color:#b3352f" onclick="if(confirm('Remove this room from housekeeping?'))post('/housekeeping/'+this.dataset.id,'DELETE')">Delete</button>@endif<button type="button" class="mbtn cancel" onclick="closeModal('editHk')">Cancel</button><button class="mbtn save">Save</button></div>
</form></div></div>
</body>
</html>
