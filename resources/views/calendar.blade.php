<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Calendar - Indus Resort Restaurant</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--sage:#b6d8cb;--olive:#cbd877;--pevent:#eef7c9;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--line:#eee;--red:#ff4e52}
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
.cal-wrap{display:grid;grid-template-columns:360px minmax(0,1fr);gap:20px}
.card{background:#fff;border-radius:18px;padding:22px}
/* mini calendar */
.mini-head{display:flex;align-items:center;justify-content:center;gap:auto;position:relative;margin-bottom:18px}
.mini-head b{font-size:20px;font-weight:700}
.mini-head .nav{position:absolute;width:34px;height:34px;border:0;background:#f5f5f5;border-radius:9px;display:grid;place-items:center;cursor:pointer}
.mini-head .nav.p{left:0}.mini-head .nav.n{right:0}
.mini-head .nav svg{width:16px;height:16px;fill:none;stroke:#555;stroke-width:2}
.mini-grid{display:grid;grid-template-columns:repeat(7,1fr);gap:2px 0;text-align:center}
.mini-grid .wd{color:#9a9a9a;font-size:13px;padding:8px 0}
.mini-grid .d{font-size:15px;padding:11px 0;color:#222}
.mini-grid .d.mut{color:#cfcfcf}
.cat{margin-top:30px}
.cat-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}
.cat-top h2{font-size:20px;margin:0}.cat-top .dots{color:#c4c4c4;font-size:18px}
.cat ul{list-style:none;padding:0;margin:0;display:grid;gap:16px}
.cat li{display:flex;align-items:center;gap:12px;font-size:15px;color:#444}
.cat li i{width:11px;height:11px;border-radius:50%}
/* schedule */
.sched-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;gap:12px;flex-wrap:wrap}
.sched-top h2{font-size:20px;margin:0}
.sright{display:flex;gap:12px;align-items:center}
.seg{display:flex;background:#f4f4f4;border-radius:11px;padding:4px}
.seg button{border:0;background:transparent;border-radius:8px;padding:8px 18px;font-size:15px;color:#777;cursor:pointer;font-weight:600}
.seg button.on{background:var(--lime);color:#2f3a0c}
.plain{height:42px;border:1px solid #ededed;background:#fff;border-radius:11px;padding:0 14px;display:inline-flex;align-items:center;gap:8px;font-size:15px;color:#333;cursor:pointer}
.plain svg{width:15px;height:15px;fill:none;stroke:#555;stroke-width:1.8}
.add{height:42px;border:0;border-radius:11px;background:var(--lime);padding:0 20px;font-size:15px;font-weight:700;color:#2f3a0c;cursor:pointer}
.cal-grid{border:1px solid var(--line);border-radius:12px;overflow:hidden}
.cal-grid .hrow{display:grid;grid-template-columns:repeat(7,1fr)}
.cal-grid .hrow div{padding:14px 0;text-align:center;font-size:15px;color:#333;border-right:1px solid var(--line)}
.cal-grid .hrow div:last-child{border-right:0}
.cal-body{display:grid;grid-template-columns:repeat(7,1fr)}
.cell{min-height:168px;border-top:1px solid var(--line);border-right:1px solid var(--line);padding:8px;position:relative}
.cell:nth-child(7n){border-right:0}
.cell .dn{font-size:15px;color:#333;margin-bottom:4px}
.cell.mut{background:repeating-linear-gradient(45deg,#fbfbfb 0 7px,#f4f4f4 7px 8px)}
.cell.mut .dn{color:#c4c4c4}
.ev{border-radius:9px;padding:9px 10px;font-size:12px;margin-top:5px}
.ev .t{color:#5f5f5f;font-size:11px}
.ev b{display:block;margin:4px 0;font-size:12.5px;line-height:1.25}
.ev .c{color:#6c6c6c;font-size:11px;margin-top:8px}
.ev.training{background:var(--sage)}
.ev.meeting{background:var(--mint)}
.ev.guest{background:var(--olive)}
.ev.maintenance{background:var(--lime)}
.ev.event{background:var(--pevent)}
footer{display:flex;justify-content:space-between;align-items:center;padding:20px 6px 8px;color:#9a9a9a;font-size:14px;flex-wrap:wrap;gap:14px}
.flinks{display:flex;gap:26px}.flinks a{color:#9a9a9a;text-decoration:none}.flinks span:first-child{color:#666}
.fsoc{display:flex;gap:16px;align-items:center}.fsoc a{color:#c2c2c2}.fsoc svg{width:18px;height:18px;fill:currentColor}
@media(max-width:1100px){.cal-wrap{grid-template-columns:1fr}}
@media(max-width:700px){body{zoom:1}.main{padding:18px 14px}.top h1{font-size:24px}.profile .pinfo,.tools{display:none}.cal-grid{overflow-x:auto}.cal-grid .hrow,.cal-body{min-width:840px}footer{flex-direction:column;align-items:flex-start}}
</style>
</head>
<body>
@include('partials.crud')
@include('partials.sidebar')
@include('partials.responsive')
<main class="main">
<section class="m-page">
@php $msAct = '<button class="ms-add" type="button" onclick="openScheduleCreator()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>Add Schedule</button>'; @endphp
@include('partials.mobile-shell', ['msTitle'=>'Calendar','msSubtitle'=>now()->format('F Y'),'msAction'=>$msAct])
<div style="display:flex;align-items:center;justify-content:space-between;margin:-6px 0 10px"><button class="ms-btn gray" type="button" onclick="calShift(-1)">‹ Prev</button><b id="mcTitle">{{ now()->format('F Y') }}</b><button class="ms-btn gray" type="button" onclick="calShift(1)">Next ›</button></div>
<style>@media(max-width:768px){.mc-grid{display:grid;grid-template-columns:repeat(7,minmax(0,1fr));gap:4px;text-align:center}.mc-grid .wd{font-size:11px;color:#888;font-weight:700;padding:4px 0}.mc-d{height:38px;display:grid;place-items:center;border-radius:10px;font-size:13px;position:relative;cursor:pointer;border:0;background:none;font-family:inherit;color:#111}.mc-d.mut{color:#c0c0c0}.mc-d.today{background:#d9f5e5;color:#1f5f3f;font-weight:800}.mc-d.on{background:#1f7a4d;color:#fff}.mc-d i{position:absolute;bottom:4px;width:5px;height:5px;border-radius:50%;background:#1f7a4d}.mc-d.on i{background:#fff}.mc-day{font-size:13px;font-weight:700;color:#555;margin:14px 0 8px}.mc-ev{display:grid;grid-template-columns:5px minmax(0,1fr) auto;gap:10px;align-items:center;background:#fff;border-radius:14px;padding:12px;margin-bottom:8px;box-shadow:0 4px 18px rgba(16,24,40,.05);border:1px solid #eef0ee}.mc-ev i{align-self:stretch;border-radius:4px}.mc-ev small{display:block;font-size:12px;color:#777}.mc-ev b{display:block;font-size:15px;margin-top:2px}.mc-ev em{font-style:normal;font-size:11px;font-weight:700;padding:5px 9px;border-radius:12px;background:#f1f3f2;color:#333;white-space:nowrap}}</style>
<section class="ms-card"><div class="mc-grid" id="mMini"></div></section>
<div class="ms-chips" id="mCats"><button class="ms-chip on" type="button" data-cat="">All</button><button class="ms-chip" type="button" data-cat="training"><i style="background:var(--sage)"></i>Training</button><button class="ms-chip" type="button" data-cat="meeting"><i style="background:var(--mint)"></i>Meeting</button><button class="ms-chip" type="button" data-cat="guest"><i style="background:var(--olive)"></i>Guest Service</button><button class="ms-chip" type="button" data-cat="maintenance"><i style="background:var(--lime)"></i>Maintenance</button><button class="ms-chip" type="button" data-cat="event"><i style="background:var(--pevent)"></i>Event</button></div>
<div id="mAgenda"></div>
@include('partials.mobile-nav')
</section>
    <header class="top">
        <h1>Calendar</h1>
        <div class="profile">
            <span class="avatar hdr-avatar" style="cursor:pointer;overflow:hidden" onclick="openAccount()" title="My account">@if(auth()->user()->avatar)<img src="{{ asset(auth()->user()->avatar) }}" alt="">@else{{ auth()->user()->initials() }}@endif</span>
            <div class="pinfo"><b>{{ auth()->user()->name }}</b><small>{{ ucfirst(auth()->user()->role) }}</small></div>
            <div class="tools">
                <button class="tool" type="button" title="My account" onclick="openAccount()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell" type="button" title="Notifications" onclick="showNotifications()"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
            </div>
        </div>
    </header>
    <div class="cal-wrap">
        <aside class="card">
            <div class="mini-head"><button class="nav p" type="button" onclick="calShift(-1)"><svg viewBox="0 0 24 24"><path d="m15 18-6-6 6-6"/></svg></button><b id="calTitle">{{ now()->format('F Y') }}</b><button class="nav n" type="button" onclick="calShift(1)"><svg viewBox="0 0 24 24"><path d="m9 18 6-6-6-6"/></svg></button></div>
            <div class="mini-grid" id="mini"></div>
            <div class="cat">
                <div class="cat-top"><h2>Category</h2><span class="dots">···</span></div>
                <ul>
                    <li data-cat="training" onclick="filterCat('training')" style="cursor:pointer"><i style="background:var(--sage)"></i>Training</li>
                    <li data-cat="meeting" onclick="filterCat('meeting')" style="cursor:pointer"><i style="background:var(--mint)"></i>Meeting</li>
                    <li data-cat="guest" onclick="filterCat('guest')" style="cursor:pointer"><i style="background:var(--olive)"></i>Guest Service</li>
                    <li data-cat="maintenance" onclick="filterCat('maintenance')" style="cursor:pointer"><i style="background:var(--lime)"></i>Maintenance</li>
                    <li data-cat="event" onclick="filterCat('event')" style="cursor:pointer"><i style="background:var(--pevent)"></i>Event</li>
                </ul>
            </div>
        </aside>
        <section class="card">
            <div class="sched-top">
                <h2>Schedule</h2>
                <div class="sright">
                    <div class="seg"><button type="button" onclick="calShift(0,true)">Today</button><button type="button" class="on">Month</button></div>
                    <select class="fsel" id="fCat"><option value="">All Category</option><option value="training">Training</option><option value="meeting">Meeting</option><option value="guest">Guest Service</option><option value="maintenance">Maintenance</option><option value="event">Event</option></select>
                    <button class="add" onclick="openScheduleCreator()">Add Schedule</button>
                </div>
            </div>
            <div class="cal-grid">
                <div class="hrow"><div>Sunday</div><div>Monday</div><div>Tuesday</div><div>Wednesday</div><div>Thursday</div><div>Friday</div><div>Saturday</div></div>
                <div class="cal-body" id="calbody"></div>
            </div>
        </section>
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
// June 2028 starts Thursday. Cells: 28,29,30,31(May,mut), 1..30(Jun), 1(Jul,mut) = 35
const _now=new Date();
let _Y=_now.getFullYear(),_Mo=_now.getMonth();
let cells=[];
const wd=['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
const _MN=['January','February','March','April','May','June','July','August','September','October','November','December'];
/* Build the day cells for the month currently shown; the arrows move a month at a time. */
function buildCells(){const first=new Date(_Y,_Mo,1).getDay(),dim=new Date(_Y,_Mo+1,0).getDate(),prevDim=new Date(_Y,_Mo,0).getDate();cells=[];for(let i=first-1;i>=0;i--)cells.push({d:prevDim-i,mut:1});for(let d=1;d<=dim;d++)cells.push({d,mut:0});let nx=1;while(cells.length%7!==0)cells.push({d:nx++,mut:1});
 const t=document.getElementById('calTitle');if(t)t.textContent=_MN[_Mo]+' '+_Y;const mini=document.getElementById('mini');if(mini)mini.innerHTML=wd.map(w=>`<span class="wd">${w}</span>`).join('')+cells.map(c=>`<span class="d ${c.mut?'mut':''}">${c.d}</span>`).join('');}
function calShift(n,today){if(today){_Y=_now.getFullYear();_Mo=_now.getMonth();}else{_Mo+=n;if(_Mo<0){_Mo=11;_Y--;}if(_Mo>11){_Mo=0;_Y++;}}buildCells();if(typeof mcDay!=='undefined')mcDay=0;render(document.getElementById('fCat').value);}
buildCells();
// events keyed by June day (from DB)
const clabel={training:'Training',meeting:'Meeting',guest:'Guest Service',maintenance:'Maintenance',event:'Event'};
const schedules=@json($schedules);
const mcCol={training:'var(--sage)',meeting:'var(--mint)',guest:'var(--olive)',maintenance:'var(--lime)',event:'var(--pevent)'};
let mcDay=0;
function renderMobileCal(cat){
 const mini=document.getElementById('mMini'),ag=document.getElementById('mAgenda');if(!mini||!ag)return;
 const mm=String(_Mo+1).padStart(2,'0'),ym=_Y+'-'+mm;const mt=document.getElementById('mcTitle');if(mt)mt.textContent=_MN[_Mo]+' '+_Y;
 const list=schedules.filter(s=>String(s.date).slice(0,7)===ym&&(!cat||s.category===cat)).sort((a,b)=>String(a.date).localeCompare(String(b.date)));
 const days=new Set(list.map(s=>+String(s.date).slice(8,10)));
 const today=(_now.getFullYear()===_Y&&_now.getMonth()===_Mo)?_now.getDate():0;
 mini.innerHTML=wd.map(w=>`<span class="wd">${w}</span>`).join('')+cells.map(c=>`<button type="button" class="mc-d ${c.mut?'mut':''} ${!c.mut&&c.d===today?'today':''} ${!c.mut&&c.d===mcDay?'on':''}" ${c.mut?'disabled':`onclick="mcPick(${c.d})"`}>${c.d}${(!c.mut&&days.has(c.d))?'<i></i>':''}</button>`).join('');
 const shown=mcDay?list.filter(s=>+String(s.date).slice(8,10)===mcDay):list;
 const groups={};shown.forEach(s=>{(groups[s.date]=groups[s.date]||[]).push(s);});
 const dn=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
 ag.innerHTML=Object.keys(groups).sort().map(d=>{const dt=new Date(d+'T00:00:00');return `<div class="mc-day">${dn[dt.getDay()]}, ${msDate(d)}</div>`+groups[d].map(s=>`<div class="mc-ev" onclick="openScheduleEditor(${s.id})"><i style="background:${mcCol[s.category]||'#ddd'}"></i><div><small>${(s.start_time||'')}${s.end_time?' - '+s.end_time:''}</small><b>${s.title}</b></div><em>${clabel[s.category]||s.category||''}</em></div>`).join('');}).join('')||`<div class="ms-empty">${mcDay?'Nothing scheduled on this day':'No schedules this month'}</div>`;
}
function mcPick(d){mcDay=(mcDay===d?0:d);renderMobileCal(document.getElementById('fCat').value);}
document.querySelectorAll('#mCats .ms-chip').forEach(b=>b.addEventListener('click',()=>{document.querySelectorAll('#mCats .ms-chip').forEach(x=>x.classList.remove('on'));b.classList.add('on');const sel=document.getElementById('fCat');sel.value=b.dataset.cat;render(sel.value);markLegend(sel.value);}));
function openScheduleCreator(){const f=document.getElementById('schForm');f.reset();f.action='{{ url('/schedules') }}';document.getElementById('schMethod').value='';document.getElementById('schModalTitle').textContent='Add Schedule';document.getElementById('schDelete').style.display='none';openModal('addSchedule');}
function openScheduleEditor(id){if(!window.CAN_MANAGE)return;const s=schedules.find(x=>x.id===id);if(!s)return;const f=document.getElementById('schForm');f.reset();f.action='{{ url('/schedules') }}/'+s.id;document.getElementById('schMethod').value='PUT';document.getElementById('schModalTitle').textContent='Edit Schedule';['title','category','start_time','end_time'].forEach(k=>{if(f.elements[k])f.elements[k].value=s[k]??'';});f.elements.date.value=String(s.date||'').slice(0,10);const d=document.getElementById('schDelete');d.style.display=window.IS_ADMIN?'':'none';d.dataset.id=s.id;openModal('addSchedule');}
function render(cat){
 renderMobileCal(cat);
 const ev={};
 const _ym=_Y+'-'+String(_Mo+1).padStart(2,'0');
 schedules.filter(s=>String(s.date).slice(0,7)===_ym&&(!cat||s.category===cat)).forEach(s=>{const day=+String(s.date).slice(8,10);const time=(s.start_time||'')+(s.end_time?' - '+s.end_time:'');(ev[day]=ev[day]||[]).push([time,s.title,clabel[s.category]||s.category,s.category,s.id])});
 document.getElementById('calbody').innerHTML=cells.map(c=>{
  const list=(!c.mut&&ev[c.d])?ev[c.d]:[];
  const evs=list.map(e=>`<div class="ev ${e[3]}" style="cursor:pointer" onclick="openScheduleEditor(${e[4]})"><span class="t">${e[0]}</span><b>${e[1]}</b><span class="c">${e[2]}</span></div>`).join('');
  return `<div class="cell ${c.mut?'mut':''}"><div class="dn">${c.mut?String(c.d).padStart(2,'0'):c.d}</div>${evs}</div>`;
 }).join('');
}
function markLegend(cat){document.querySelectorAll('.cat li').forEach(li=>li.style.fontWeight=(cat&&li.dataset.cat===cat)?'700':'400');}
function filterCat(c){const sel=document.getElementById('fCat');sel.value=(sel.value===c?'':c);render(sel.value);markLegend(sel.value);}
document.getElementById('fCat').addEventListener('change',e=>{render(e.target.value);markLegend(e.target.value);});
render('');
</script>
<div class="modal-ov" id="addSchedule"><div class="modal"><h3 id="schModalTitle">Add Schedule</h3><form id="schForm" method="POST" action="{{ url('/schedules') }}">@csrf<input type="hidden" name="_method" id="schMethod" value="">
<label>Title</label><input name="title" required>
<label>Category</label><select name="category"><option value="training">Training</option><option value="meeting">Meeting</option><option value="guest">Guest Service</option><option value="maintenance">Maintenance</option><option value="event">Event</option></select>
<label>Date</label><input type="date" name="date" value="{{ now()->format('Y-m-d') }}" required>
<div class="mrow"><div><label>Start Time</label><input name="start_time" placeholder="11:00 AM"></div><div><label>End Time</label><input name="end_time" placeholder="1:00 PM"></div></div>
<div class="mact"><button type="button" class="mbtn cancel" id="schDelete" style="display:none;margin-right:auto;background:#ffe1e1;color:#b3352f" onclick="if(confirm('Delete this schedule?'))post('/schedules/'+this.dataset.id,'DELETE')">Delete</button><button type="button" class="mbtn cancel" onclick="closeModal('addSchedule')">Cancel</button><button class="mbtn save">Save</button></div>
</form></div></div>
</body>
</html>
