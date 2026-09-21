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
.rbody h3{font-size:22px;margin:0 0 12px}
.rstatus{position:absolute;right:0;top:2px;padding:5px 13px;border-radius:8px;font-size:13px;font-weight:600}
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
@media(max-width:1200px){.wrap{grid-template-columns:1fr}}
@media(max-width:700px){body{zoom:1}.main{padding:18px 14px}.top h1{font-size:24px}.profile .pinfo,.tools{display:none}.rcard{flex-direction:column}.rimg{width:100%;flex-basis:auto}.flist,.flist.three{grid-template-columns:1fr}footer{flex-direction:column;align-items:flex-start}}
</style>
</head>
<body>
@include('partials.crud')
@include('partials.sidebar')
<main class="main">
    <header class="top">
        <h1>Rooms</h1>
        <div class="profile">
            <span class="avatar">{{ collect(explode(' ', auth()->user()->name))->map(fn($w)=>$w[0])->take(2)->implode('') }}</span>
            <div class="pinfo"><b>{{ auth()->user()->name }}</b><small>{{ ucfirst(auth()->user()->role) }}</small></div>
            <div class="tools">
                <button class="tool"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
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
            <div class="dtop"><h2>Room Detail</h2><div style="display:flex;gap:8px"><button class="edit" onclick="openRoomEditor()">Edit</button>@if(auth()->user()->role === 'admin')<button class="edit" style="background:#ffe1e1;color:#b3352f" onclick="if(confirm('Delete this room?'))post('/rooms/'+selectedId,'DELETE')">Delete</button>@endif</div></div>
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
 function currentList(){const q=(document.getElementById('fSearch').value||'').toLowerCase();const ty=document.getElementById('fType').value;const sort=document.getElementById('fSort').value;let l=rooms.filter(r=>(!ty||r.name===ty)&&(!q||[r.name,r.description,r.bed].join(' ').toLowerCase().includes(q)));if(sort==='low')l=[...l].sort((a,b)=>a.price-b.price);else if(sort==='high')l=[...l].sort((a,b)=>b.price-a.price);return l;}
 function render(list){document.getElementById('roomlist').innerHTML=list.map((r,i)=>`<div class="rcard ${r.id===selectedId?'sel':''}" onclick="selectRoom(${r.id})" style="cursor:pointer;${i<list.length-1?'margin-bottom:16px':''}"><img class="rimg" src="{{ asset('') }}${r.image}" alt="${r.name}"><div class="rbody"><h3>${r.name}</h3><span class="rstatus ${r.status}">${r.status==='occupied'?'Occupied':'Available'}</span><div class="specs"><span>${m2}${r.size||''}</span><span>${bed}${r.bed||''}</span><span>${gst}${r.guests||''}</span></div><p class="rdesc">${r.description||''}</p><div class="rfoot"><span class="avail">Availability: <b>${r.availability_used}/${r.availability_total} Rooms</b></span><span class="price">PKR ${r.price}<small>/night</small></span></div></div></div>`).join('')||'<div style="padding:20px;color:#999">No results</div>';}
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
  const AM=r.amenities||[];document.getElementById('amenities').innerHTML=AM.length?AM.map(a=>`<div class="fitem">${ck}<span>${a}</span></div>`).join(''):'<div class="fitem" style="color:#aaa">No amenities listed</div>';
 }
 function selectRoom(id){selectedId=id;const r=rooms.find(x=>x.id===id);if(r)renderDetail(r);render(currentList());}
 function openRoomCreator(){const f=document.getElementById('roomForm');f.reset();f.action='{{ url('/rooms') }}';document.getElementById('roomMethod').value='';document.getElementById('roomModalTitle').textContent='Add Room';openModal('addRoom');}
 function openRoomEditor(){const r=rooms.find(x=>x.id===selectedId);if(!r)return;const f=document.getElementById('roomForm');f.reset();f.action='{{ url('/rooms') }}/'+r.id;document.getElementById('roomMethod').value='PUT';document.getElementById('roomModalTitle').textContent='Edit Room';['name','status','price','size','bed','guests','availability_total','availability_used','description'].forEach(k=>{if(f.elements[k])f.elements[k].value=r[k]??'';});const F=r.features||[];f.elements.feature_bedrooms.value=F.find(x=>/bedroom/i.test(x))||'';f.elements.kitchen_feature.value=F.find(x=>x==='Kitchen'||x==='No Kitchen')||'';f.querySelectorAll('[name="features[]"]').forEach(el=>{el.checked=F.includes(el.value);});openModal('addRoom');}
 function applyFilters(){render(currentList());}
 ['fSearch','fType','fSort'].forEach(id=>document.getElementById(id).addEventListener(id==='fSearch'?'input':'change',applyFilters));
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
