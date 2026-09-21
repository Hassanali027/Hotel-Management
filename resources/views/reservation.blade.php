<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Reservation - Indus Resort Restaurant</title>
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
.pt{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;gap:12px;flex-wrap:wrap}
.pt h2{font-size:20px;margin:0}
.pt-r{display:flex;gap:12px;align-items:center;flex-wrap:wrap}
.pill{height:44px;border:0;border-radius:11px;padding:0 16px;display:inline-flex;align-items:center;gap:9px;font-size:15px;background:#f4f4f4;color:#333;cursor:pointer;white-space:nowrap}
.pill.lime{background:var(--lime);color:#2f3a0c;font-weight:700}
.pill svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.8}
.searchbox{position:relative}
.searchbox>svg{position:absolute;left:15px;top:50%;transform:translateY(-50%);width:18px;height:18px;fill:none;stroke:#b0b0b0;stroke-width:1.8}
.search{height:44px;width:280px;border:0;border-radius:11px;background:#f4f4f4;padding:0 16px 0 42px;font-size:14px;color:#333;font-family:inherit}
.search::placeholder{color:#b0b0b0}
.date-filter{padding:0 12px!important}.date-filter input{width:112px;border:0;background:transparent;outline:0;color:#333;font:inherit;cursor:pointer}.date-filter .date-separator{color:#9a9a9a;font-size:13px}
.tbl{width:100%;overflow-x:auto}
.thead,.trow{display:grid;grid-template-columns:1.15fr .8fr .95fr .7fr 2.15fr .85fr 1.55fr;align-items:center;min-width:1250px}
.trow>span:nth-child(5){white-space:nowrap}
.thead{background:#eefaf3;border-radius:12px;padding:16px 22px;color:#8a8a8a;font-size:15px;font-weight:600}
.thead span{display:inline-flex;align-items:center;gap:6px}
.thead svg{width:12px;height:12px;fill:none;stroke:#b5b5b5;stroke-width:2}
.trow{padding:15px 22px;border-bottom:1px solid var(--line);font-size:15px}
.trow:last-child{border-bottom:0}
.g b{display:block;font-size:15px}.g small{color:#9a9a9a;font-size:13px}
.st{display:inline-flex;align-items:center;padding:6px 14px;border-radius:8px;font-size:14px;font-weight:600;width:max-content}
.st.confirmed{background:var(--mint);color:#2f6b4f}
.st.pending{background:#ffe1e1;color:#b3352f}
.st.checked_in{background:var(--lime);color:#3d4a10}
.st.checked_out{background:#ececec;color:#666}
.abtn.done{background:#ececec;color:#888;display:inline-flex;align-items:center;justify-content:center;padding:0 18px;height:38px;border-radius:9px;font-weight:700}
.act{display:flex;gap:8px;align-items:center}
.ib{width:36px;height:36px;flex:0 0 36px;border:1px solid #ededed;background:#fff;border-radius:9px;display:grid;place-items:center;cursor:pointer}
.ib svg{width:17px;height:17px;fill:none;stroke:#555;stroke-width:1.7}
.abtn{height:36px;border:0;border-radius:9px;padding:0 14px;font-size:13.5px;font-weight:700;cursor:pointer;white-space:nowrap}
.abtn.cancel{background:#ffe1e1;color:#b3352f}
.abtn.confirm{background:var(--lime);color:#2f3a0c}
.tbottom{display:flex;justify-content:space-between;align-items:center;padding:20px 4px 16px;color:#8a8a8a;font-size:15px}
.pages{display:flex;gap:8px}
.pg{min-width:40px;height:40px;border:0;border-radius:9px;background:#f4f4f4;font-size:15px;color:#555;cursor:pointer;display:grid;place-items:center}
.pg.active{background:var(--lime);color:#2f3a0c;font-weight:700}
footer{display:flex;justify-content:space-between;align-items:center;padding:20px 6px 8px;color:#9a9a9a;font-size:14px;flex-wrap:wrap;gap:14px}
.flinks{display:flex;gap:26px}.flinks a{color:#9a9a9a;text-decoration:none}.flinks span:first-child{color:#666}
.fsoc{display:flex;gap:16px;align-items:center}.fsoc a{color:#c2c2c2}.fsoc svg{width:18px;height:18px;fill:currentColor}
@media(max-width:700px){body{zoom:1}.main{padding:18px 14px}.top h1{font-size:24px}.profile .pinfo,.tools{display:none}.pt-r{width:100%}.search{width:100%}footer{flex-direction:column;align-items:flex-start}}
</style>
</head>
<body>
@include('partials.crud')
@include('partials.sidebar')
<main class="main">
    <header class="top">
        <h1>Reservation</h1>
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
        <div class="pt">
            <h2>Reservation List</h2>
            <div class="pt-r">
                <div class="searchbox"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg><input class="search" id="fSearch" placeholder="Search guest, status, etc"></div>
                <select class="fsel" id="fStatus"><option value="">All Status</option><option value="pending">Pending</option><option value="confirmed">Confirmed</option><option value="checked_in">Checked-In</option><option value="checked_out">Checked-Out</option></select>
                <div class="pill date-filter"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/></svg><input id="fDateStart" type="date" aria-label="Start date"><span class="date-separator">to</span><input id="fDateEnd" type="date" aria-label="End date"></div>
                @if(auth()->user()->role !== 'staff')<button class="pill lime" onclick="openModal('addBooking')">Add Booking</button>@endif
            </div>
        </div>
        <div class="tbl">
            <div class="thead">
                <span onclick="sortCol('res','guest_name',applyFilters)" style="cursor:pointer">Guest @include('partials.sort')</span>
                <span onclick="sortCol('res','room_label',applyFilters)" style="cursor:pointer">Room @include('partials.sort')</span>
                <span onclick="sortCol('res','request',applyFilters)" style="cursor:pointer">Request @include('partials.sort')</span>
                <span onclick="sortCol('res','duration',applyFilters)" style="cursor:pointer">Duration @include('partials.sort')</span>
                <span onclick="sortCol('res','check_in',applyFilters)" style="cursor:pointer">Check-In &amp; Check-Out @include('partials.sort')</span>
                <span onclick="sortCol('res','status',applyFilters)" style="cursor:pointer">Status @include('partials.sort')</span>
                <span>Action @include('partials.sort')</span>
            </div>
            <div id="rows"></div>
        </div>
        <div class="tbottom">
            <span id="resInfo">Showing…</span>
            <div class="pages" id="resPages"></div>
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
const eye='<svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>';
const edit='<svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>';
const data=@json($bookings);
const roomRates=@json($rooms->pluck('price','name'));
function fillRoomPrice(roomType){const rate=roomRates[roomType];if(rate!==undefined)document.getElementById('bookingPrice').value=rate;}
const fmt=d=>{if(!d)return'';const p=String(d).slice(0,10).split('-');const M=['January','February','March','April','May','June','July','August','September','October','November','December'];return M[+p[1]-1]+' '+(+p[2])+', '+p[0]};
const STL={pending:'Pending',confirmed:'Confirmed',checked_in:'Checked-In',checked_out:'Checked-Out'};
const NEXT={pending:['confirmed','Confirm'],confirmed:['checked_in','Check-In'],checked_in:['checked_out','Check-Out']};
function render(list){
 document.getElementById('rows').innerHTML=list.map(b=>{
  let action;
  if(NEXT[b.status])action=`<button class="abtn confirm" onclick="event.stopPropagation();post('/bookings/${b.id}/status/${NEXT[b.status][0]}','POST')">${NEXT[b.status][1]}</button>`;
  else action=`<span class="abtn done">Done</span>`;
  const cancel=(IS_ADMIN&&(b.status==='pending'||b.status==='confirmed'))?`<button class="abtn cancel" onclick="event.stopPropagation();if(confirm('Cancel this booking?'))post('/bookings/${b.id}','DELETE')">Cancel</button>`:'';
  return `<div class="trow" style="cursor:pointer" onclick="location.href='/guest-profile?id=${b.id}'"><span class="g"><b>${b.guest_name}</b><small>${b.code}</small></span><span>${b.room_label||''}</span><span>${b.request||''}</span><span>${b.duration||''}</span><span>${fmt(b.check_in)} &nbsp;-&nbsp; ${fmt(b.check_out)}</span><span><em class="st ${b.status}">${STL[b.status]||b.status}</em></span><span class="act"><button class="ib" title="View guest profile" onclick="event.stopPropagation();location.href='/guest-profile?id=${b.id}'">${eye}</button>${action}${cancel}</span></div>`;
 }).join('')||'<div class="trow"><span>No results</span></div>';
}
function applyFilters(){
 const q=(document.getElementById('fSearch').value||'').toLowerCase();
 const st=document.getElementById('fStatus').value;
 const from=document.getElementById('fDateStart').value;
 const to=document.getElementById('fDateEnd').value;
 pgReset('res');paginateRender('res',sortList('res',data.filter(b=>{const matchesText=!q||[b.guest_name,b.code,b.room_label,b.request].join(' ').toLowerCase().includes(q);const matchesStatus=!st||b.status===st;const matchesDate=(!from||String(b.check_out||'')>=from)&&(!to||String(b.check_in||'')<=to);return matchesText&&matchesStatus&&matchesDate;})),8,render);
}
document.getElementById('fSearch').addEventListener('input',applyFilters);
document.getElementById('fStatus').addEventListener('change',applyFilters);
document.getElementById('fDateStart').addEventListener('change',applyFilters);
document.getElementById('fDateEnd').addEventListener('change',applyFilters);
applyFilters();
</script>
<div class="modal-ov" id="addBooking"><div class="modal"><h3>Add Booking</h3><form method="POST" action="{{ url('/bookings') }}" enctype="multipart/form-data">@csrf
@if($errors->any())<div style="margin:0 0 12px;padding:10px 12px;border-radius:9px;background:#fff0f0;color:#b3352f;font-size:13px">Please check the highlighted details below. @foreach($errors->all() as $error)<div style="margin-top:3px">• {{ $error }}</div>@endforeach</div>@endif
<label>Guest Name</label><input name="guest_name" required>
<label>CNIC</label><input name="cnic" inputmode="numeric" maxlength="20" placeholder="12345-1234567-1">
<div class="mrow"><div><label>Phone Number</label><input name="phone" type="tel" placeholder="+92 300 0000000"></div><div><label>Email Address</label><input name="email" type="email" placeholder="guest@example.com"></div></div>
<div class="mrow"><div><label>Date of Birth</label><input name="dob" type="date"></div><div><label>Gender</label><select name="gender"><option value="">Select gender</option><option>Male</option><option>Female</option><option>Other</option></select></div></div>
<div class="mrow"><div><label>Nationality</label><input name="nationality" placeholder="Pakistani"></div><div><label>Passport No.</label><input name="passport_no" placeholder="Optional"></div></div>
<div class="mrow"><div><label>Room Type</label><select name="room_type" onchange="fillRoomPrice(this.value)" required><option value="">Select room type</option>@foreach($rooms->pluck('name')->filter()->unique()->values() as $roomType)<option value="{{ $roomType }}">{{ $roomType }}</option>@endforeach</select></div><div><label>Room Number</label><input name="room_number" placeholder="101"></div></div>
<div class="amenity-box"><h4>Room Features, Facilities &amp; Amenities</h4><div class="amenity-grid"><label><input type="checkbox" name="amenities[]" value="Free Wi-Fi">Free Wi-Fi</label><label><input type="checkbox" name="amenities[]" value="Air Conditioning">Air Conditioning</label><label><input type="checkbox" name="amenities[]" value="Smart TV">Smart TV</label><label><input type="checkbox" name="amenities[]" value="Mini Fridge">Mini Fridge</label><label><input type="checkbox" name="amenities[]" value="Coffee / Tea Maker">Coffee / Tea Maker</label><label><input type="checkbox" name="amenities[]" value="In-room Safe">In-room Safe</label><label><input type="checkbox" name="amenities[]" value="24-hour Room Service">24-hour Room Service</label><label><input type="checkbox" name="amenities[]" value="Balcony / City View">Balcony / City View</label></div><label style="margin-top:10px">Other facility or amenity</label><input name="amenity_notes" placeholder="e.g. Extra bed, hairdryer, work desk"></div>
<label>Request</label><input name="request" placeholder="None">
<div class="mrow"><div><label>Duration</label><input name="duration" placeholder="3 nights"></div><div><label>Status</label><select name="status"><option value="pending">Pending</option><option value="confirmed">Confirmed</option></select></div></div>
<div class="mrow"><div><label>Check In</label><input type="date" name="check_in"></div><div><label>Check Out</label><input type="date" name="check_out"></div></div>
<div class="mrow"><div><label>Price / night</label><input id="bookingPrice" type="number" name="price_per_night" min="1" required placeholder="Select a room type"></div><div><label>Amount</label><input type="number" name="amount" value="0"></div></div>
<label class="partial-payment-toggle"><input type="checkbox" name="partial_payment" value="1" onchange="document.getElementById('partialPaymentFields').style.display=this.checked?'block':'none'"><span><b>Partial Payment</b><small>Record the advance payment received from the guest</small></span></label>
<div id="partialPaymentFields" class="partial-payment-fields">
<label>Advance Amount (PKR)</label><input type="number" name="advance_amount" min="0" placeholder="Enter advance amount">
<label style="margin-top:12px!important">Advance Payment Receipt / Picture</label><label class="receipt-upload"><span>Upload receipt</span><small id="advanceReceiptName">No file selected</small><input type="file" name="advance_receipt" accept="image/*" onchange="document.getElementById('advanceReceiptName').textContent=this.files[0]?this.files[0].name:'No file selected'"></label>
</div>
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('addBooking')">Cancel</button><button class="mbtn save">Save</button></div>
</form></div></div>
@if($errors->any())<script>document.addEventListener('DOMContentLoaded',function(){openModal('addBooking');});</script>@endif
</body>
</html>
