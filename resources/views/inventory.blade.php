<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Inventory - Indus Resort Restaurant</title>
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
.thumb{width:46px;height:46px;border-radius:11px;background:#eef8c9;display:grid;place-items:center;font-size:22px;overflow:hidden;flex:0 0 46px}.thumb img{width:100%;height:100%;object-fit:cover}
.av{display:inline-flex;align-items:center;padding:6px 12px;border-radius:8px;font-size:14px;font-weight:600;width:max-content}
.av.available{background:var(--lime);color:#3d4a10}
.av.low{background:var(--mint);color:#2f6b4f}
.av.out{background:#ffe1e1;color:#b3352f}
.act{display:flex;gap:14px;align-items:center}
.vd{border:0;background:none;color:#555;font-size:15px;cursor:pointer;padding:0}
.add-stock{height:40px;border:0;border-radius:9px;background:var(--lime);padding:0 20px;font-size:14px;font-weight:700;color:#2f3a0c;cursor:pointer}
.delete-item{height:40px;border:1px solid #ffc7c7;background:#fff1f1;color:#b3352f;padding:0 15px;border-radius:9px;font-size:14px;font-weight:700;cursor:pointer;line-height:1}.delete-item:hover{background:#ffe1e1}
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
<main class="main">
<section class="m-page">
@php $msAct = auth()->user()->role !== 'staff' ? '<button class="ms-add" type="button" onclick="openItemCreator()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>Add Item</button>' : ''; @endphp
@include('partials.mobile-shell', ['msTitle'=>'Inventory','msSubtitle'=>'Stock levels and reorders','msAction'=>$msAct])
<div class="ms-filters one"><label class="ms-search"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg><input id="mSearch" type="search" placeholder="Search item, category, etc..."></label></div>
<div class="ms-selrow"><select class="ms-sel" id="mSort"><option value="newest">Newest</option><option value="oldest">Oldest</option><option value="name">Name</option><option value="stock">Stock</option></select><select class="ms-sel" id="mCat"><option value="">All Category</option><option>Linen</option><option>Toiletries</option><option>Refreshments</option><option>Electronics</option><option>Housekeeping</option><option>Guest Comfort</option><option>Kitchen</option></select></div>
<div id="mRows"></div><div class="ms-pager" id="mPager"></div>
@include('partials.mobile-nav')
</section>
    <header class="top">
        <h1>Inventory</h1>
        <div class="profile">
            <span class="avatar hdr-avatar" style="cursor:pointer;overflow:hidden" onclick="openAccount()" title="My account">@if(auth()->user()->avatar)<img src="{{ asset(auth()->user()->avatar) }}" alt="">@else{{ auth()->user()->initials() }}@endif</span>
            <div class="pinfo"><b>{{ auth()->user()->name }}</b><small>{{ ucfirst(auth()->user()->role) }}</small></div>
            <div class="tools">
                <button class="tool" type="button" title="My account" onclick="openAccount()"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell" type="button" title="Notifications" onclick="showNotifications()"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
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
                @if(auth()->user()->role !== 'staff')<button class="pill" onclick="openItemCreator()">Add Item</button>@endif
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
        <div class="flinks"><span>Copyright © 2026 Indus Resort Restaurant</span><a href="#">Privacy Policy</a><a href="#">Term and conditions</a><a href="#">Contact</a></div>
        <div class="fsoc">
            <a href="https://www.facebook.com/people/Indus-Resort/61590518813137/" target="_blank" rel="noopener" aria-label="Facebook"><svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
            <a href="https://wa.me/923000053333" target="_blank" rel="noopener" aria-label="WhatsApp"><svg viewBox="0 0 24 24"><path d="M20.5 11.5a8.5 8.5 0 0 1-12.6 7.5L3.5 20.5 5 16.3A8.5 8.5 0 1 1 20.5 11.5Z"/><path d="M8.4 7.8c.2-.5.5-.5.7-.5h.5c.2 0 .4.1.5.4l.8 1.8c.1.3.1.5-.1.7l-.5.6c-.1.1-.1.3 0 .4.4.8 1.1 1.5 1.9 1.9.1.1.3.1.4 0l.6-.5c.2-.2.4-.2.7-.1l1.8.8c.3.1.4.3.4.5v.5c0 .2-.1.5-.5.7-.4.2-1.2.4-2.3-.1-1-.5-2.2-1.4-3.2-2.4-1-1-1.9-2.2-2.4-3.2-.5-1.1-.3-1.9-.1-2.3Z"/></svg></a>
            <a href="https://www.instagram.com/indus_resort/" target="_blank" rel="noopener" aria-label="Instagram"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg></a>


        </div>
    </footer>
</main>
<script>
const chk='<svg viewBox="0 0 24 24"><path d="m5 12 5 5 9-9"/></svg>';
const avl={available:'Available',low:'Low',out:'Out of Stock'};
const data=@json($items);
function itemVisual(item){return item.image_path?'<img src="/'+item.image_path+'" alt="">':(item.emoji||'');}
function invDetailHtml(r){const moves=(r.recent||[]);const hist=moves.length?'<div style="margin-top:12px"><b>Recent stock changes</b>'+moves.map(m=>'<div style="display:flex;justify-content:space-between;gap:10px;font-size:13px;margin-top:6px"><span>'+m.reason+(m.reference?' · '+m.reference:'')+'<br><small style="color:#999">'+m.at+'</small></span><b style="color:'+(m.change<0?'#b3352f':'#287552')+'">'+(m.change>0?'+':'')+m.change+'</b></div>').join('')+'</div>':'<div style="margin-top:12px;color:#999;font-size:13px">No stock changes recorded yet.</div>';const auto=Number(r.per_checkin||0);const setBtn=window.CAN_MANAGE?' <button class="vd" style="color:#1d6ae5;font-size:13px" onclick="const v=prompt(\'Quantity handed out automatically at every check-in (0 = off)\','+auto+');if(v!==null&&v!==\'\')post(\'/inventory/'+r.id+'/settings\',\'POST\',{per_checkin:parseInt(v,10)||0})">Change</button>':'';return 'Category: '+(r.category||'-')+'<br>Availability: '+avl[r.availability]+'<br>Quantity in Stock: '+r.quantity_stock+'<br>Quantity in Reorder: '+r.quantity_reorder+'<br>Used per check-in: <b>'+auto+'</b>'+setBtn+hist;}
function mInvDetail(id){const r=data.find(x=>x.id===id);if(r)showDetail(r.name,invDetailHtml(r));}
function openUseStock(id){const r=data.find(x=>x.id===id);if(!r)return;document.getElementById('useStockForm').action='/inventory/'+id+'/use-stock';document.getElementById('useStockTitle').textContent='Use Stock — '+r.name+' ('+r.quantity_stock+' in stock)';document.getElementById('useStockQuantity').value='';document.getElementById('useStockQuantity').max=r.quantity_stock;openModal('useStock');}
function renderMobile(list){const el=document.getElementById('mRows');if(!el)return;el.innerHTML=list.map(r=>`<article class="ms-card"><div class="ms-top"><span class="ms-av sq">${itemVisual(r)}</span><div class="ms-name"><b>${r.name}</b><small>${r.category||''}</small></div><span class="ms-pill ${r.availability}">${avl[r.availability]||''}</span></div><div class="ms-kv two"><div><small>Quantity in Stock</small><b>${r.quantity_stock}</b></div><div><small>Quantity in Reorder</small><b>${r.quantity_reorder}</b></div></div><div class="ms-act"><button type="button" class="ms-btn gray" onclick="mInvDetail(${r.id})">Details</button>${CAN_MANAGE?`<button type="button" class="ms-btn gray" onclick="openItemEditor(${r.id})">Edit</button>`:''}<button type="button" class="ms-btn lime" onclick="openAddStock(${r.id},${JSON.stringify(r.name).replace(/"/g,'&quot;')})">Add Stock</button><button type="button" class="ms-btn mint" onclick="openUseStock(${r.id})">Use Stock</button>${IS_ADMIN?`<button type="button" class="ms-btn cancel" onclick="if(confirm('Delete this item?'))post('/inventory/${r.id}','DELETE')">Delete</button>`:''}</div></article>`).join('')||'<div class="ms-empty">No items found</div>';}
function render(list){
 renderMobile(list);
 document.getElementById('rows').innerHTML=list.map(r=>`<div class="trow ${r.is_checked?'on':''}"><span><span class="cb ${r.is_checked?'ck':''}">${chk}</span></span><span class="item"><span class="thumb">${itemVisual(r)}</span>${r.name}</span><span>${r.category||''}</span><span><em class="av ${r.availability}">${avl[r.availability]}</em></span><span>${r.quantity_stock}</span><span>${r.quantity_reorder}</span><span class="act"><button type="button" class="vd" onclick="mInvDetail(${r.id})">View Detail</button>${CAN_MANAGE?`<button type="button" class="vd" style="color:#1d6ae5" onclick="openItemEditor(${r.id})">Edit</button>`:''}<button type="button" class="add-stock" data-item-id="${r.id}" data-item-name="${r.name}">Add Stock</button><button type="button" class="add-stock" style="background:#d9f5e5;color:#1f5f3f" onclick="openUseStock(${r.id})">Use Stock</button>${IS_ADMIN?`<button type="button" class="delete-item" data-item-id="${r.id}">Delete</button>`:''}</span></div>`).join('')||'<div class="trow"><span>No results</span></div>';
 document.querySelectorAll('.cb').forEach(c=>c.onclick=()=>{c.classList.toggle('ck');c.closest('.trow').classList.toggle('on')});
 document.querySelectorAll('.add-stock').forEach(button=>button.onclick=()=>openAddStock(button.dataset.itemId,button.dataset.itemName));
 document.querySelectorAll('.delete-item').forEach(button=>button.onclick=()=>{if(confirm('Delete this item?'))post('/inventory/'+button.dataset.itemId,'DELETE')});
}
function applyFilters(){
 const q=(document.getElementById('fSearch').value||'').toLowerCase();const cat=document.getElementById('fCat').value;const sort=document.getElementById('fSort').value;
 let l=data.filter(r=>(!cat||r.category===cat)&&(!q||[r.name,r.category].join(' ').toLowerCase().includes(q)));
 if(sort==='oldest')l=[...l].sort((a,b)=>a.id-b.id);else if(sort==='newest')l=[...l].sort((a,b)=>b.id-a.id);else if(sort==='name')l=[...l].sort((a,b)=>a.name.localeCompare(b.name));else if(sort==='stock')l=[...l].sort((a,b)=>b.quantity_stock-a.quantity_stock);
 pgReset('inv');paginateRender('inv',sortList('inv',l),8,render);
}
msMirror([['mSearch','fSearch','input'],['mCat','fCat'],['mSort','fSort']]);
['fSearch','fCat','fSort'].forEach(id=>document.getElementById(id).addEventListener(id==='fSearch'?'input':'change',applyFilters));
applyFilters();
function openItemCreator(){const f=document.getElementById('itemForm');f.reset();f.action='{{ url('/inventory') }}';document.getElementById('itemMethod').value='';document.getElementById('itemModalTitle').textContent='Add Item';f.querySelectorAll('[data-edit-hide]').forEach(el=>el.style.display='');openModal('addItem');}
function openItemEditor(id){const r=data.find(x=>x.id===id);if(!r)return;const f=document.getElementById('itemForm');f.reset();f.action='{{ url('/inventory') }}/'+r.id;document.getElementById('itemMethod').value='PUT';document.getElementById('itemModalTitle').textContent='Edit Item';['name','category','quantity_reorder','per_checkin'].forEach(k=>{if(f.elements[k])f.elements[k].value=r[k]??'';});f.querySelectorAll('[data-edit-hide]').forEach(el=>el.style.display='none');openModal('addItem');}
function openAddStock(id,name){
 document.getElementById('addStockForm').action='/inventory/'+id+'/add-stock';
 document.getElementById('addStockTitle').textContent='Add Stock — '+name;
 document.getElementById('addStockQuantity').value='';
 openModal('addStock');
}
</script>
<div class="modal-ov" id="addItem"><div class="modal"><h3 id="itemModalTitle">Add Item</h3><form id="itemForm" method="POST" action="{{ url('/inventory') }}" enctype="multipart/form-data">@csrf<input type="hidden" name="_method" id="itemMethod" value="">
<label>Item Name</label><input name="name" required>
<div class="mrow"><div><label>Item Image</label><label for="inventoryImage" style="margin:0;background:var(--lime);color:#2f3a0c;border-radius:8px;padding:10px 12px;font-weight:700;cursor:pointer">Upload Image</label><span id="inventoryImageName" style="display:block;margin-top:6px;color:#777;font-size:12px">No image selected</span><input id="inventoryImage" type="file" name="image" accept="image/*" style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0)" onchange="document.getElementById('inventoryImageName').textContent=this.files[0]?.name||'No image selected'"></div><div><label>Category</label><input name="category" placeholder="Supplies"></div></div>
<div data-edit-hide><label>Availability</label><select name="availability"><option value="available">Available</option><option value="low">Low</option><option value="out">Out of Stock</option></select>
</div><div class="mrow"><div data-edit-hide><label>Quantity in Stock</label><input type="number" name="quantity_stock" value="0"></div><div><label>Quantity in Reorder</label><input type="number" name="quantity_reorder" value="0"></div></div>
<label>Used automatically per check-in</label><input type="number" name="per_checkin" value="0" min="0" placeholder="0 = not automatic">
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('addItem')">Cancel</button><button class="mbtn save">Save</button></div>
</form></div></div>
<div class="modal-ov" id="useStock"><div class="modal"><h3 id="useStockTitle">Use Stock</h3><form id="useStockForm" method="POST">@csrf
<label>Quantity used</label><input id="useStockQuantity" type="number" name="quantity" min="1" required placeholder="e.g. 5">
<label>Reason</label><input name="reason" maxlength="120" placeholder="e.g. Room 204 restock, kitchen, damaged">
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('useStock')">Cancel</button><button class="mbtn save">Use Stock</button></div>
</form></div></div>
<div class="modal-ov" id="addStock"><div class="modal"><h3 id="addStockTitle">Add Stock</h3><form id="addStockForm" method="POST">@csrf
<label>Quantity to add</label><input id="addStockQuantity" type="number" name="quantity" min="1" required autofocus placeholder="e.g. 25">
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('addStock')">Cancel</button><button class="mbtn save">Add Stock</button></div>
</form></div></div>
</body>
</html>
