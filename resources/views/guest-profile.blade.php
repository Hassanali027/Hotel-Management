<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Guest Profile - Lodgify</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--line:#eee;--red:#ff4e52;--label:#9a9a9a}
*{box-sizing:border-box}
body{margin:0;display:flex;background:var(--bg);font-family:Lato,Arial,sans-serif;color:var(--ink);zoom:.9}
@media(min-width:1301px) and (max-width:1550px){body{zoom:.82}}
@media(min-width:1101px) and (max-width:1300px){body{zoom:.72}}
@media(min-width:701px) and (max-width:1100px){body{zoom:.62}}
.main{flex:1;min-width:0;padding:26px 30px 16px}
.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:22px}
.tl{display:flex;align-items:center;gap:14px}
.back{width:42px;height:42px;border:1px solid #e8e8e8;background:#fff;border-radius:11px;display:grid;place-items:center;cursor:pointer}
.back svg{width:20px;height:20px;fill:none;stroke:#333;stroke-width:2}
.tl h1{font-size:28px;font-weight:800;margin:0;line-height:1.1}
.tl .bc{font-size:13px;color:var(--label);margin-top:3px}
.tl .bc a{color:#8bbf3a;text-decoration:none}
.profile{display:flex;align-items:center;gap:13px}
.avatar{width:46px;height:46px;border-radius:50%;background:var(--lime);display:grid;place-items:center;font-weight:700;font-size:15px}
.pinfo b{display:block;font-size:16px;line-height:1.1}.pinfo small{color:#888;font-size:13px}
.tools{display:flex;gap:10px;margin-left:14px}
.tool{width:44px;height:44px;border:1px solid #e8e8e8;background:#fff;border-radius:11px;display:grid;place-items:center;cursor:pointer;position:relative}
.tool svg{width:20px;height:20px;fill:none;stroke:#4a4a4a;stroke-width:1.8}
.tool.bell:after{content:'';position:absolute;top:9px;right:11px;width:8px;height:8px;border-radius:50%;background:var(--red);border:2px solid #fff}
.gtop{display:grid;grid-template-columns:1fr 1.75fr 1fr;gap:20px;margin-bottom:20px;align-items:start}
.card{background:#fff;border-radius:18px;padding:22px}
.chd{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}
.chd h2{font-size:18px;margin:0}
.chd .dots{color:#c4c4c4;font-size:18px}
.chd .vd{color:#333;font-size:14px;text-decoration:none}
.who{display:flex;align-items:center;gap:16px;margin-bottom:18px}
.who img,.who .ph{width:70px;height:70px;border-radius:50%;object-fit:cover;background:var(--lime);display:grid;place-items:center;font-weight:800;font-size:22px}
.who b{font-size:24px;display:block}
.who small{color:var(--label);font-size:14px}
.contact{display:grid;gap:12px;padding-bottom:18px;border-bottom:1px solid var(--line)}
.contact div{display:flex;align-items:center;gap:12px;font-size:14px}
.contact .ci{width:34px;height:34px;border-radius:9px;background:var(--mint);display:grid;place-items:center;flex:0 0 34px}
.contact .ci svg{width:17px;height:17px;fill:none;stroke:#3f8b6d;stroke-width:1.8}
.sec{padding:18px 0;border-bottom:1px solid var(--line)}
.sec:last-child{border-bottom:0;padding-bottom:0}
.sec h3{font-size:16px;margin:0 0 14px}
.pairs{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.pair .l{color:var(--label);font-size:13px;margin-bottom:4px}
.pair .v{font-size:15px}
.chip{display:inline-block;background:var(--lime);color:#2f3a0c;border-radius:8px;padding:6px 12px;font-size:14px;font-weight:600}
/* booking info */
.bconf{display:inline-flex;align-items:center;gap:8px;background:var(--mint);color:#2f6b4f;border-radius:8px;padding:6px 12px;font-size:14px;font-weight:600;margin-bottom:14px}
.bconf svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:2.5}
.bid{font-size:26px;font-weight:800;margin:0 0 4px}
.bdate{color:var(--label);font-size:14px;margin-bottom:20px}
.brow{display:grid;grid-template-columns:1fr 1fr 1fr;gap:18px;margin-bottom:20px}
.notes-l{color:var(--label);font-size:13px;margin-bottom:5px}
.divider{border-top:1px solid var(--line);margin:6px 0 20px}
.binfo-btns{display:flex;justify-content:flex-end;gap:12px;margin-top:20px}
.bbtn{height:40px;border:0;border-radius:9px;padding:0 22px;font-size:14px;font-weight:700;cursor:pointer}
.bbtn.edit{background:#f2f2f2;color:#333}
.bbtn.cancel{background:#ffe1e1;color:#b3352f}
.amen{display:grid;gap:9px}
.amen div{display:flex;align-items:center;gap:9px;font-size:14px}
.amen svg{width:15px;height:15px;fill:none;stroke:#5aa17e;stroke-width:2.5}
/* room info */
.roominfo{background:#fbfbfb}
.rimg{width:100%;height:190px;object-fit:cover;border-radius:12px;margin-bottom:16px}
.rspecs{display:flex;gap:18px;color:#555;font-size:14px;padding-bottom:16px;border-bottom:1px solid var(--line)}
.rspecs span{display:inline-flex;align-items:center;gap:7px}
.rspecs svg{width:17px;height:17px;fill:none;stroke:#777;stroke-width:1.7}
.psum{display:flex;align-items:center;gap:10px;margin:18px 0 14px}
.psum h3{font-size:17px;margin:0}
.psum .paid{background:var(--lime);color:#2f3a0c;border-radius:7px;padding:3px 10px;font-size:12px;font-weight:700}
.pline{display:flex;justify-content:space-between;font-size:14px;color:#555;margin-bottom:12px}
.ptotal{display:flex;justify-content:space-between;font-size:16px;font-weight:800;padding-top:12px;border-top:1px solid var(--line);margin-bottom:16px}
.pnote-l{color:var(--label);font-size:13px;margin-bottom:5px}
.pnote{font-size:13px;color:#555;line-height:1.5}
/* history */
.hhead{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;gap:12px;flex-wrap:wrap}
.hhead h2{font-size:20px;margin:0}
.hh-r{display:flex;gap:12px;align-items:center}
.searchbox{position:relative}
.searchbox>svg{position:absolute;left:15px;top:50%;transform:translateY(-50%);width:18px;height:18px;fill:none;stroke:#b0b0b0;stroke-width:1.8}
.search{height:44px;width:240px;border:0;border-radius:11px;background:#f4f4f4;padding:0 16px 0 42px;font-size:14px;color:#333;font-family:inherit}
.search::placeholder{color:#b0b0b0}
.pill{height:44px;border:0;border-radius:11px;padding:0 16px;display:inline-flex;align-items:center;gap:9px;font-size:15px;background:#f4f4f4;color:#333;cursor:pointer;white-space:nowrap}
.pill svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.8}
.tbl{width:100%;overflow-x:auto}
.thead,.trow{display:grid;grid-template-columns:.8fr 1.1fr 1.2fr 1fr 1fr 1.2fr 1.2fr .9fr .4fr;align-items:center;min-width:1050px}
.thead{background:#eefaf3;border-radius:12px;padding:16px 22px;color:#8a8a8a;font-size:15px;font-weight:600}
.thead span{display:inline-flex;align-items:center;gap:6px}
.thead svg{width:12px;height:12px;fill:none;stroke:#b5b5b5;stroke-width:2}
.trow{padding:14px 22px;border-bottom:1px solid var(--line);font-size:15px}
.trow:last-child{border-bottom:0}
.trow img{width:56px;height:44px;border-radius:9px;object-fit:cover}
.rt{display:inline-flex;align-items:center;padding:5px 12px;border-radius:8px;font-size:13px;font-weight:600;background:var(--lime);color:#2f3a0c;width:max-content}
.sub{color:var(--label);font-size:13px}
.dotbtn{border:0;background:none;color:#c4c4c4;font-size:18px;cursor:pointer}
footer{display:flex;justify-content:space-between;align-items:center;padding:20px 6px 8px;color:#9a9a9a;font-size:14px;flex-wrap:wrap;gap:14px}
.flinks{display:flex;gap:26px}.flinks a{color:#9a9a9a;text-decoration:none}.flinks span:first-child{color:#666}
.fsoc{display:flex;gap:16px;align-items:center}.fsoc a{color:#c2c2c2}.fsoc svg{width:18px;height:18px;fill:currentColor}
@media(max-width:1200px){.gtop{grid-template-columns:1fr}}
@media(max-width:700px){body{zoom:1}.main{padding:18px 14px}.tl h1{font-size:22px}.profile .pinfo,.tools{display:none}.brow,.pairs{grid-template-columns:1fr}footer{flex-direction:column;align-items:flex-start}}
</style>
</head>
<body>
@include('partials.crud')
@include('partials.sidebar')
<main class="main">
    <header class="top">
        <div class="tl">
            <button class="back" onclick="history.length>1?history.back():location.href='{{ url('/reservation') }}'"><svg viewBox="0 0 24 24"><path d="m15 18-6-6 6-6"/></svg></button>
            <div><h1>Guest Profile</h1><div class="bc"><a href="{{ url('/reservation') }}">Reservation</a> / Guest Profile</div></div>
        </div>
        <div class="profile">
            <span class="avatar">JD</span>
            <div class="pinfo"><b>Jaylon Dorwart</b><small>Admin</small></div>
            <div class="tools">
                <button class="tool"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
            </div>
        </div>
    </header>
    <div class="gtop">
        <section class="card">
            <div class="chd"><h2>Profile</h2><span class="dots">···</span></div>
            <div class="who"><span class="ph">{{ collect(explode(' ', $guest->name))->map(fn($w)=>$w[0])->take(2)->implode('') }}</span><div><b>{{ $guest->name }}</b><small>{{ $guest->code }}</small></div></div>
            <div class="contact">
                <div><span class="ci"><svg viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.7 2z"/></svg></span>{{ $guest->phone }}</div>
                <div><span class="ci"><svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 6 10 7L22 6"/></svg></span>{{ $guest->email }}</div>
            </div>
            <div class="sec"><h3>Personal Information</h3><div class="pairs"><div class="pair"><div class="l">Date of Birth</div><div class="v">{{ $guest->dob }}</div></div><div class="pair"><div class="l">Gender</div><div class="v">{{ $guest->gender }}</div></div><div class="pair"><div class="l">Nationality</div><div class="v">{{ $guest->nationality }}</div></div><div class="pair"><div class="l">Passport No.</div><div class="v">{{ $guest->passport_no }}</div></div></div></div>
            <div class="sec"><h3>Loyalty Program</h3><div class="pair" style="margin-bottom:16px"><div class="l">Membership Status</div><span class="chip">{{ $guest->membership_status }}</span></div><div class="pairs"><div class="pair"><div class="l">Points Balance</div><div class="v">{{ $guest->points_balance }}</div></div><div class="pair"><div class="l">Tier Level</div><div class="v">🏅 {{ $guest->tier_level }}</div></div></div></div>
        </section>
        <section class="card">
            <div class="chd"><h2>Booking Info</h2><span class="dots">···</span></div>
            <span class="bconf"><svg viewBox="0 0 24 24"><path d="m5 12 5 5 9-9"/></svg>Booking Confirmed</span>
            <h3 class="bid">Booking ID: {{ $booking->code }}</h3>
            <div class="bdate">{{ \Carbon\Carbon::parse($booking->created_at)->format('F j, Y, g.i A') }}</div>
            <div class="brow">
                <div class="pair"><div class="l">Room Type</div><div class="v">{{ $booking->room_type }}</div></div>
                <div class="pair"><div class="l">Room Number</div><div class="v">{{ $booking->room_number }}</div></div>
                <div class="pair"><div class="l">Price</div><div class="v">${{ $booking->price_per_night }}<span style="color:var(--label);font-size:13px">/night</span></div></div>
            </div>
            <div class="brow">
                <div class="pair"><div class="l">Guests</div><div class="v">2 Adults</div></div>
                <div class="pair"><div class="l">Requests</div><div class="v">{{ $booking->request }}</div></div>
                <div></div>
            </div>
            <div class="brow">
                <div class="pair"><div class="l">Check In</div><div class="v">{{ \Carbon\Carbon::parse($booking->check_in)->format('F j, Y') }}</div><div class="sub">1.45 PM</div></div>
                <div class="pair"><div class="l">Check Out</div><div class="v">{{ \Carbon\Carbon::parse($booking->check_out)->format('F j, Y') }}</div><div class="sub">11.45 AM</div></div>
                <div class="pair"><div class="l">Duration</div><div class="v">{{ $booking->duration }}</div></div>
            </div>
            <div class="pair" style="margin-bottom:20px"><div class="notes-l">Notes</div><div class="v" style="font-size:14px">Guest requested extra pillows and towels. Ensure room service is available upon arrival.</div></div>
            <div class="divider"></div>
            <div class="brow">
                <div>
                    <div class="pair" style="margin-bottom:18px"><div class="l">Loyalty Program</div><div class="v">Platinum Member</div></div>
                    <div class="pair"><div class="l">Transportation</div><div class="v">Airport pickup arranged</div></div>
                </div>
                <div class="pair"><div class="l">Special Amenities</div><div class="amen"><div><svg viewBox="0 0 24 24"><path d="m5 12 5 5 9-9"/></svg>Complimentary breakfast</div><div><svg viewBox="0 0 24 24"><path d="m5 12 5 5 9-9"/></svg>Free Wi-Fi</div><div><svg viewBox="0 0 24 24"><path d="m5 12 5 5 9-9"/></svg>Access to gym and pool</div></div></div>
                <div class="pair"><div class="l">Extras</div><div class="v">-</div></div>
            </div>
            <div class="binfo-btns"><button class="bbtn edit" onclick="location.href='{{ url('/reservation') }}'">Edit</button><button class="bbtn cancel" onclick="if(confirm('Cancel this booking?'))post('/bookings/{{ $booking->id }}','DELETE')">Cancel Booking</button></div>
        </section>
        <section class="card roominfo">
            <div class="chd"><h2>Room Info</h2><a href="{{ url('/rooms') }}" class="vd">View Detail</a></div>
            <img class="rimg" src="{{ asset('images/room-info-hero.jpg') }}" alt="Room">
            <div class="rspecs"><span><svg viewBox="0 0 24 24"><path d="M3 8V3h5M21 8V3h-5M3 16v5h5M21 16v5h-5"/></svg>35 m²</span><span><svg viewBox="0 0 24 24"><path d="M2 10V6h20v12M2 14h20"/></svg>King Bed</span><span><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20a6 6 0 0 1 12 0"/></svg>2 guests</span></div>
            <div class="psum"><h3>Price Summary</h3><span class="paid">Paid</span></div>
            <div class="pline"><span>Room and offer</span><span>$450.00</span></div>
            <div class="pline"><span>Extras</span><span>$0.00</span></div>
            <div class="pline"><span>8% VAT</span><span>$36.00</span></div>
            <div class="pline"><span>City Tax</span><span>$49.50</span></div>
            <div class="ptotal"><span>Total Price</span><span>$535.50</span></div>
            <div class="pnote-l">Notes</div>
            <div class="pnote">Invoice sent to corporate account; payment confirmed by BIG Corporation</div>
        </section>
    </div>
    <section class="card">
        <div class="hhead">
            <h2>Booking History</h2>
            <div class="hh-r">
                <div class="searchbox"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg><input class="search" placeholder="Search guest, status, etc"></div>
                <button class="pill"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/></svg>{{ now()->startOfMonth()->addDays(18)->format('j') }} - {{ now()->startOfMonth()->addDays(23)->format('j M, Y') }}<svg viewBox="0 0 24 24" width="14" height="14"><path d="m6 9 6 6 6-6"/></svg></button>
            </div>
        </div>
        <div class="tbl">
            <div class="thead">
                <span>Image @include('partials.sort')</span>
                <span>Booking ID @include('partials.sort')</span>
                <span>Booking Date @include('partials.sort')</span>
                <span>Room Type @include('partials.sort')</span>
                <span>Room Number @include('partials.sort')</span>
                <span>Check-In @include('partials.sort')</span>
                <span>Check-Out @include('partials.sort')</span>
                <span>Guests @include('partials.sort')</span>
                <span></span>
            </div>
            <div id="rows"></div>
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
const HERO="{{ asset('images/room-info-hero.jpg') }}";
const fmt=d=>{if(!d)return'';const p=String(d).slice(0,10).split('-');const M=['January','February','March','April','May','June','July','August','September','October','November','December'];return M[+p[1]-1]+' '+(+p[2])+', '+p[0]};
const data=@json($history);
document.getElementById('rows').innerHTML=data.map(b=>`<div class="trow"><span><img src="${HERO}" alt=""></span><span>${b.code}</span><span>${fmt(b.created_at)}<div class="sub">9.08 AM</div></span><span><em class="rt">${b.room_type||''}</em></span><span>Room ${b.room_number||''}</span><span>${fmt(b.check_in)}<div class="sub">1.45 PM</div></span><span>${fmt(b.check_out)}<div class="sub">11.45 AM</div></span><span>2 Guests</span><span><button class="dotbtn">···</button></span></div>`).join('');
</script>
</body>
</html>
