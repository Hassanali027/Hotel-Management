<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Inventory - Lodgify</title>
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
.sortby{color:#9a9a9a;font-size:15px}
.plain{height:44px;border:1px solid #ededed;background:#fff;border-radius:11px;padding:0 14px;display:inline-flex;align-items:center;gap:8px;font-size:15px;color:#333;cursor:pointer;white-space:nowrap}
.pill{height:44px;border:0;border-radius:11px;padding:0 16px;display:inline-flex;align-items:center;gap:9px;font-size:15px;background:var(--lime);color:#2f3a0c;cursor:pointer;white-space:nowrap;font-weight:600}
.pill svg,.plain svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.8}
.tbl{width:100%;overflow-x:auto}
.thead,.trow{display:grid;grid-template-columns:44px 1.6fr 1.1fr 1.1fr 1.2fr 1.3fr 1.5fr;align-items:center;min-width:1100px}
.thead{background:#eefaf3;border-radius:12px;padding:16px 20px;color:#8a8a8a;font-size:15px;font-weight:600}
.thead span{display:inline-flex;align-items:center;gap:6px}
.thead svg{width:12px;height:12px;fill:none;stroke:#b5b5b5;stroke-width:2}
.trow{padding:14px 20px;border-bottom:1px solid var(--line);font-size:15px}
.trow:last-child{border-bottom:0}
.trow.on{background:#fafdfb}
.cb{width:20px;height:20px;border:1.6px solid #cfcfcf;border-radius:5px;display:grid;place-items:center;cursor:pointer}
.cb.ck{background:var(--lime);border-color:var(--lime)}
.cb svg{width:13px;height:13px;fill:none;stroke:#2f3a0c;stroke-width:3;display:none}
.cb.ck svg{display:block}
.item{display:flex;align-items:center;gap:14px}
.thumb{width:46px;height:46px;border-radius:11px;background:#eef8c9;display:grid;place-items:center;font-size:22px;flex:0 0 46px}
.av{display:inline-flex;align-items:center;padding:6px 12px;border-radius:8px;font-size:14px;font-weight:600;width:max-content}
.av.available{background:var(--lime);color:#3d4a10}
.av.low{background:var(--mint);color:#2f6b4f}
.av.out{background:#ffe1e1;color:#b3352f}
.act{display:flex;gap:14px;align-items:center}
.vd{border:0;background:none;color:#555;font-size:15px;cursor:pointer;padding:0}
.reorder{height:40px;border:0;border-radius:9px;background:var(--lime);padding:0 20px;font-size:14px;font-weight:700;color:#2f3a0c;cursor:pointer}
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
        <h1>Inventory</h1>
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
            <div class="searchbox"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg><input class="search" id="fSearch" placeholder="Search item, category, etc"></div>
            <div class="fr">
                <span class="sortby">Sort by:</span>
                <select class="fsel" id="fSort"><option value="newest">Newest</option><option value="oldest">Oldest</option><option value="name">Name</option><option value="stock">Stock</option></select>
                <select class="fsel" id="fCat"><option value="">All Category</option><option>Linen</option><option>Toiletries</option><option>Refreshments</option><option>Electronics</option><option>Housekeeping</option><option>Guest Comfort</option><option>Kitchen</option></select>
                @if(auth()->user()->role !== 'staff')<button class="pill" onclick="openModal('addItem')">Add Item</button>@endif
            </div>
        </div>
        <div class="tbl">
            <div class="thead">
                <span></span>
                <span onclick="sortCol('inv','name',applyFilters)" style="cursor:pointer">Item @include('partials.sort')</span>
                <span onclick="sortCol('inv','category',applyFilters)" style="cursor:pointer">Category @include('partials.sort')</span>
                <span onclick="sortCol('inv','availability',applyFilters)" style="cursor:pointer">Availability @include('partials.sort')</span>
                <span onclick="sortCol('inv','quantity_stock',applyFilters)" style="cursor:pointer">Quantity in Stock @include('partials.sort')</span>
                <span onclick="sortCol('inv','quantity_reorder',applyFilters)" style="cursor:pointer">Quantity in Reorder @include('partials.sort')</span>
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
const avl={available:'Available',low:'Low',out:'Out of Stock'};
const data=@json($items);
function render(list){
 document.getElementById('rows').innerHTML=list.map(r=>`<div class="trow ${r.is_checked?'on':''}"><span><span class="cb ${r.is_checked?'ck':''}">${chk}</span></span><span class="item"><span class="thumb">${r.emoji||''}</span>${r.name}</span><span>${r.category||''}</span><span><em class="av ${r.availability}">${avl[r.availability]}</em></span><span>${r.quantity_stock}</span><span>${r.quantity_reorder}</span><span class="act"><button class="vd" onclick="showDetail(r.emoji+' '+r.name,'Category: '+(r.category||'-')+'<br>Availability: '+avl[r.availability]+'<br>Quantity in Stock: '+r.quantity_stock+'<br>Quantity in Reorder: '+r.quantity_reorder)">View Detail</button><button class="reorder" onclick="post('/inventory/${r.id}/reorder','POST')">Reorder</button>${IS_ADMIN?`<button class="vd" title="Delete" onclick="if(confirm('Delete this item?'))post('/inventory/${r.id}','DELETE')">🗑</button>`:''}</span></div>`).join('')||'<div class="trow"><span>No results</span></div>';
 document.querySelectorAll('.cb').forEach(c=>c.onclick=()=>{c.classList.toggle('ck');c.closest('.trow').classList.toggle('on')});
}
function applyFilters(){
 const q=(document.getElementById('fSearch').value||'').toLowerCase();const cat=document.getElementById('fCat').value;const sort=document.getElementById('fSort').value;
 let l=data.filter(r=>(!cat||r.category===cat)&&(!q||[r.name,r.category].join(' ').toLowerCase().includes(q)));
 if(sort==='oldest')l=[...l].sort((a,b)=>a.id-b.id);else if(sort==='newest')l=[...l].sort((a,b)=>b.id-a.id);else if(sort==='name')l=[...l].sort((a,b)=>a.name.localeCompare(b.name));else if(sort==='stock')l=[...l].sort((a,b)=>b.quantity_stock-a.quantity_stock);
 pgReset('inv');paginateRender('inv',sortList('inv',l),8,render);
}
['fSearch','fCat','fSort'].forEach(id=>document.getElementById(id).addEventListener(id==='fSearch'?'input':'change',applyFilters));
applyFilters();
</script>
<div class="modal-ov" id="addItem"><div class="modal"><h3>Add Item</h3><form method="POST" action="{{ url('/inventory') }}">@csrf
<label>Item Name</label><input name="name" required>
<div class="mrow"><div><label>Emoji</label><input name="emoji" placeholder="📦"></div><div><label>Category</label><input name="category" placeholder="Supplies"></div></div>
<label>Availability</label><select name="availability"><option value="available">Available</option><option value="low">Low</option><option value="out">Out of Stock</option></select>
<div class="mrow"><div><label>Quantity in Stock</label><input type="number" name="quantity_stock" value="0"></div><div><label>Quantity in Reorder</label><input type="number" name="quantity_reorder" value="0"></div></div>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('addItem')">Cancel</button><button class="mbtn save">Save</button></div>
</form></div></div>
</body>
</html>
