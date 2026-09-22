<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Staff - Indus Resort Restaurant</title>
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
.fl,.fr{display:flex;gap:12px;align-items:center}
.pill{height:44px;border:0;border-radius:11px;padding:0 16px;display:inline-flex;align-items:center;gap:9px;font-size:15px;background:#f4f4f4;color:#333;cursor:pointer;white-space:nowrap}
.pill svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.8}
.searchbox{position:relative}
.searchbox>svg{position:absolute;left:15px;top:50%;transform:translateY(-50%);width:18px;height:18px;fill:none;stroke:#b0b0b0;stroke-width:1.8}
.search{height:44px;width:290px;border:0;border-radius:11px;background:#f4f4f4;padding:0 16px 0 42px;font-size:14px;color:#333;font-family:inherit}
.search::placeholder{color:#b0b0b0}
.iconbtn{width:44px;height:44px;border:1px solid #ededed;background:#fff;border-radius:11px;display:grid;place-items:center;cursor:pointer}
.iconbtn svg{width:19px;height:19px;fill:none;stroke:#555;stroke-width:1.8}
.add{height:44px;border:0;border-radius:11px;background:var(--lime);padding:0 20px;font-size:15px;font-weight:700;color:#2f3a0c;cursor:pointer}
.tbl{width:100%;overflow-x:auto}
.thead,.trow{display:grid;grid-template-columns:1.6fr 1.1fr 1.25fr 1.25fr 1.6fr .8fr;align-items:center;min-width:1050px}
.thead{background:#eefaf3;border-radius:12px;padding:16px 24px;color:#8a8a8a;font-size:15px;font-weight:600}
.thead span{display:inline-flex;align-items:center;gap:6px}
.thead svg{width:12px;height:12px;fill:none;stroke:#b5b5b5;stroke-width:2}
.trow{padding:14px 24px;border-bottom:1px solid var(--line);font-size:15px}
.trow:last-child{border-bottom:0}
.who{display:flex;align-items:center;gap:14px}
.pic{width:46px;height:46px;border-radius:50%;background:var(--lime);display:grid;place-items:center;font-weight:700;font-size:15px;color:#2f3a0c;flex:0 0 46px}
.who b{display:block;font-size:15px}.who small{color:#9a9a9a;font-size:13px}
.sch b{display:block;font-weight:600}.sch small{color:#9a9a9a;font-size:13px}
.st{display:inline-flex;align-items:center;padding:6px 14px;border-radius:8px;font-size:14px;font-weight:600;background:var(--mint);color:#2f6b4f}
.tbottom{display:flex;justify-content:space-between;align-items:center;padding:20px 4px 16px;color:#8a8a8a;font-size:15px}
.pages{display:flex;gap:8px}
.pg{min-width:40px;height:40px;border:0;border-radius:9px;background:#f4f4f4;font-size:15px;color:#555;cursor:pointer;display:grid;place-items:center}
.pg.active{background:var(--lime);color:#2f3a0c;font-weight:700}
footer{display:flex;justify-content:space-between;align-items:center;padding:20px 6px 8px;color:#9a9a9a;font-size:14px;flex-wrap:wrap;gap:14px}
.flinks{display:flex;gap:26px}.flinks a{color:#9a9a9a;text-decoration:none}.flinks span:first-child{color:#666}
.fsoc{display:flex;gap:16px;align-items:center}.fsoc a{color:#c2c2c2}.fsoc svg{width:18px;height:18px;fill:currentColor}
@media(max-width:700px){body{zoom:1}.main{padding:18px 14px}.top h1{font-size:24px}.profile .pinfo,.tools{display:none}.filters{flex-direction:column;align-items:stretch}.fr{flex-wrap:wrap}.search{width:100%}footer{flex-direction:column;align-items:flex-start}}
</style>
</head>
<body>
@include('partials.crud')
@include('partials.sidebar')
<main class="main">
<section class="m-page">
@php $msAct = '<button class="ms-add" type="button" onclick="openModal(\'addConcierge\')"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>Add Staff</button>'; @endphp
@include('partials.mobile-shell', ['msTitle'=>'Staff','msSubtitle'=>'Concierge team and schedules','msAction'=>$msAct])
<div class="ms-filters one"><label class="ms-search"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg><input id="mSearch" type="search" placeholder="Search name, email, etc..."></label></div>
<div class="ms-selrow"><select class="ms-sel" id="mPos"><option value="">All Position</option><option>Head Concierge</option><option>Concierge</option></select><select class="ms-sel" id="mStatus"><option value="">All Status</option><option value="active">Active</option></select><select class="ms-sel" id="mSch"><option value="">All Schedule</option><option>Monday - Friday</option><option>Saturday - Sunday</option></select></div>
<div id="mRows"></div><div class="ms-pager" id="mPager"></div>
@include('partials.mobile-nav')
</section>
    <header class="top">
        <h1>Staff</h1>
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
                <select class="fsel" id="fPos"><option value="">All Position</option><option>Head Concierge</option><option>Concierge</option></select>
                <select class="fsel" id="fStatus"><option value="">All Status</option><option value="active">Active</option></select>
                <select class="fsel" id="fSch"><option value="">All Schedule</option><option>Monday - Friday</option><option>Saturday - Sunday</option></select>
            </div>
            <div class="fr">
                <div class="searchbox"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg><input class="search" id="fSearch" placeholder="Search placeholder"></div>
                <button class="iconbtn" onclick="document.getElementById('fSearch').focus()"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg></button>
                <button class="iconbtn" onclick="resetFilters()" title="Reset filters"><svg viewBox="0 0 24 24"><path d="M4 7h9M17 7h3M4 12h3M11 12h9M4 17h7M15 17h5"/><circle cx="15" cy="7" r="2"/><circle cx="9" cy="12" r="2"/><circle cx="13" cy="17" r="2"/></svg></button>
                <button class="add" onclick="openModal('addConcierge')">Add Concierge</button>
            </div>
        </div>
        <div class="tbl">
            <div class="thead">
                <span onclick="sortBy('name')" style="cursor:pointer">Name @include('partials.sort')</span>
                <span onclick="sortBy('position')" style="cursor:pointer">Position @include('partials.sort')</span>
                <span onclick="sortBy('schedule_days')" style="cursor:pointer">Schedule @include('partials.sort')</span>
                <span onclick="sortBy('contact')" style="cursor:pointer">Contact @include('partials.sort')</span>
                <span onclick="sortBy('email')" style="cursor:pointer">Email @include('partials.sort')</span>
                <span onclick="sortBy('status')" style="cursor:pointer">Status @include('partials.sort')</span>
            </div>
            <div id="rows"></div>
        </div>
        <div class="tbottom">
            <span id="conInfo">Showing…</span>
            <div class="pages" id="conPages"></div>
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
const data=@json($concierges);
const ini=n=>n.split(' ').map(w=>w[0]).slice(0,2).join('');
const mIco={pos:'<svg viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 12h18"/></svg>',clock:'<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>',phone:'<svg viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.7 2z"/></svg>',mail:'<svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 6 10 7L22 6"/></svg>'};
function renderMobile(list){const el=document.getElementById('mRows');if(!el)return;el.innerHTML=list.map((c,i)=>`<article class="ms-card"><div class="ms-top"><span class="ms-av c${(i%4)+1}">${ini(c.name)}</span><div class="ms-name"><b>${c.name}</b><small>${c.code||''}${c.position?' · '+c.position:''}</small></div><span class="ms-pill active">Active</span></div><div class="ms-meta"><span>${mIco.clock}${c.schedule_days||'—'}${c.schedule_time?', '+c.schedule_time:''}</span>${c.contact?`<span>${mIco.phone}<a href="tel:${String(c.contact).replace(/[^\d+]/g,'')}">${c.contact}</a></span>`:''}${c.email?`<span>${mIco.mail}<a href="mailto:${c.email}">${c.email}</a></span>`:''}</div></article>`).join('')||'<div class="ms-empty">No staff found</div>';}
function render(list){renderMobile(list);document.getElementById('rows').innerHTML=list.map(c=>`<div class="trow"><span class="who"><span class="pic">${ini(c.name)}</span><span><b>${c.name}</b><small>${c.code||''}</small></span></span><span>${c.position||''}</span><span class="sch"><b>${c.schedule_days||''}</b><small>${c.schedule_time||''}</small></span><span>${c.contact||''}</span><span>${c.email||''}</span><span><em class="st">Active</em></span></div>`).join('')||'<div class="trow"><span>No results</span></div>';}
let sortField='',sortAsc=true;
function sortBy(f){if(sortField===f)sortAsc=!sortAsc;else{sortField=f;sortAsc=true;}applyFilters();}
function applyFilters(){
 const q=(document.getElementById('fSearch').value||'').toLowerCase();const p=document.getElementById('fPos').value;const st=document.getElementById('fStatus').value;const sc=document.getElementById('fSch').value;
 let l=data.filter(c=>(!p||c.position===p)&&(!st||c.status===st)&&(!sc||c.schedule_days===sc)&&(!q||[c.name,c.code,c.email,c.contact].join(' ').toLowerCase().includes(q)));
 if(sortField)l=[...l].sort((a,b)=>String(a[sortField]||'').localeCompare(String(b[sortField]||''))*(sortAsc?1:-1));
 pgReset('con');paginateRender('con',l,8,render);
}
function resetFilters(){document.getElementById('fSearch').value='';document.getElementById('fPos').value='';document.getElementById('fStatus').value='';document.getElementById('fSch').value='';sortField='';applyFilters();}
msMirror([['mSearch','fSearch','input'],['mPos','fPos'],['mStatus','fStatus'],['mSch','fSch']]);
['fSearch','fPos','fStatus','fSch'].forEach(id=>document.getElementById(id).addEventListener(id==='fSearch'?'input':'change',applyFilters));
applyFilters();
</script>
<div class="modal-ov" id="addConcierge"><div class="modal"><h3>Add Concierge</h3><form method="POST" action="{{ url('/concierge') }}">@csrf
<label>Name</label><input name="name" required>
<label>Position</label><input name="position" value="Concierge">
<div class="mrow"><div><label>Schedule Days</label><input name="schedule_days" placeholder="Monday - Friday"></div><div><label>Schedule Time</label><input name="schedule_time" placeholder="8 AM - 4 PM"></div></div>
<label>Contact</label><input name="contact" placeholder="+1 (555) 000-0000">
<label>Email</label><input name="email" type="email" placeholder="name@example.com">
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('addConcierge')">Cancel</button><button class="mbtn save">Save</button></div>
</form></div></div>
<script>
</script>
</body>
</html>
