<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Reviews - Indus Resort Restaurant</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--mint-d:#b6d8cb;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--line:#f0f0f0;--red:#ff4e52;--star:#f2c94c}
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
.card{background:#fff;border-radius:18px;padding:22px}
.grid2{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px}
.chd{display:flex;justify-content:space-between;align-items:center}
.chd h2{font-size:19px;margin:0}
.sel{height:40px;border:0;border-radius:10px;background:var(--lime);padding:0 14px;display:inline-flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:#2f3a0c;cursor:pointer}
.sel svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:1.8}
.legend{display:flex;gap:20px;margin:14px 0 6px;font-size:14px;color:#666}
.legend i{display:inline-block;width:12px;height:12px;border-radius:3px;margin-right:7px;vertical-align:-1px}
.legend .lp{background:var(--mint)}.legend .ln{background:var(--lime)}
.ec{display:flex;gap:12px}
.ey{display:flex;flex-direction:column;justify-content:space-between;height:230px;font-size:12px;color:#aaa;text-align:right;flex:0 0 34px;padding:2px 0}
.eplot{position:relative;flex:1;height:230px;display:flex;align-items:stretch}
.gl{position:absolute;left:0;right:0;border-top:1px dashed #ededed}
.g0{top:50%;border-top:1px dashed #d9d9d9}.g1{top:25%}.g3{top:75%}
.mo{position:relative;flex:1}
.mo .up{position:absolute;left:50%;transform:translateX(-50%);bottom:50%;width:22px;background:var(--mint);border-radius:6px 6px 0 0}
.mo .dn{position:absolute;left:50%;transform:translateX(-50%);top:50%;width:22px;background:var(--lime);border-radius:0 0 6px 6px}
.mo .ml{position:absolute;top:calc(100% + 8px);left:0;right:0;text-align:center;font-size:12px;color:#888}
/* rating */
.rbody{display:grid;grid-template-columns:210px 1fr;gap:24px;align-items:center;margin-top:10px}
.gauge{position:relative;text-align:center}
.gauge svg{width:200px;height:118px}
.gscore{position:absolute;left:0;right:0;top:52px;text-align:center}
.gscore small{display:block;color:#8a8a8a;font-size:13px}
.gscore b{font-size:30px}.gscore b span{font-size:16px;color:#8a8a8a;font-weight:400}
.impress{margin-top:6px;background:var(--lime);border-radius:10px;padding:12px;text-align:center;font-size:16px;font-weight:700;color:#2f3a0c}
.impress small{display:block;font-weight:400;color:#5b6b2f;font-size:12px;margin-top:3px}
.rlist{display:grid;gap:16px}
.rrow{display:grid;grid-template-columns:100px 1fr 32px;gap:12px;align-items:center;font-size:14px;color:#555}
.rrow .bar{height:7px;border-radius:5px;background:#eef7f1;overflow:hidden}
.rrow .bar i{display:block;height:100%;background:var(--mint-d);border-radius:5px}
.rrow b{color:#111;font-weight:700;text-align:right}
/* country */
.country-card{margin-bottom:20px}
.clay{display:grid;grid-template-columns:minmax(0,1fr) 280px;gap:26px;margin-top:16px}
.cmap{background:#fafafa;border-radius:12px;display:flex;align-items:center;justify-content:center;overflow:hidden;min-height:360px}
.cmap img{width:100%;height:100%;object-fit:contain}
.csum small{color:#8a8a8a;font-size:14px}
.csum strong{display:block;font-size:32px;margin:6px 0 18px;padding-bottom:18px;border-bottom:1px solid var(--line)}
.clist{display:grid;gap:16px}
.crow{display:grid;grid-template-columns:14px 1fr auto;gap:12px;align-items:center;font-size:14px;color:#555}
.crow i{width:13px;height:13px;border-radius:3px}
.crow b{color:#111}
/* customer reviews */
.crhead{display:flex;justify-content:space-between;align-items:center;margin:2px 2px 16px}
.crhead h2{font-size:20px;margin:0}
.crsort{display:flex;align-items:center;gap:10px;color:#9a9a9a;font-size:14px}
.rev-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
.rev{background:#fff;border-radius:16px;padding:20px}
.person{display:flex;align-items:center;gap:12px;margin-bottom:14px}
.person .av{width:44px;height:44px;border-radius:50%;background:var(--lime);display:grid;place-items:center;font-weight:700;font-size:14px}
.person b{display:block;font-size:15px}
.stars{color:var(--star);font-size:15px;letter-spacing:1px;margin-bottom:12px}
.stars small{color:#9a9a9a;font-size:13px;letter-spacing:0;margin-left:6px}
.rev p{font-size:14px;line-height:1.6;color:#5a5a5a;margin:0}
footer{display:flex;justify-content:space-between;align-items:center;padding:20px 6px 8px;color:#9a9a9a;font-size:14px;flex-wrap:wrap;gap:14px}
.flinks{display:flex;gap:26px}.flinks a{color:#9a9a9a;text-decoration:none}.flinks span:first-child{color:#666}
.fsoc{display:flex;gap:16px;align-items:center}.fsoc a{color:#c2c2c2}.fsoc svg{width:18px;height:18px;fill:currentColor}
@media(max-width:1100px){.grid2{grid-template-columns:1fr}.clay{grid-template-columns:1fr}.rev-grid{grid-template-columns:1fr 1fr}}
@media(max-width:700px){body{zoom:1}.main{padding:18px 14px}.top h1{font-size:24px}.profile .pinfo,.tools{display:none}.rbody{grid-template-columns:1fr}.rev-grid{grid-template-columns:1fr}footer{flex-direction:column;align-items:flex-start}}
</style>
</head>
<body>
@include('partials.sidebar')
<main class="main">
    <header class="top">
        <h1>Reviews</h1>
        <div class="profile">
            <span class="avatar">{{ collect(explode(' ', auth()->user()->name))->map(fn($w)=>$w[0])->take(2)->implode('') }}</span>
            <div class="pinfo"><b>{{ auth()->user()->name }}</b><small>{{ ucfirst(auth()->user()->role) }}</small></div>
            <div class="tools">
                <button class="tool"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
            </div>
        </div>
    </header>
    <section class="grid2">
        <div class="card">
            <div class="chd"><h2>Review Statistics</h2><button class="sel"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/></svg>Last 7 Days<svg viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></svg></button></div>
            <div class="legend"><span><i class="lp"></i>Positive</span><span><i class="ln"></i>Negative</span></div>
            <div class="ec">
                <div class="ey"><span>30K</span><span>15K</span><span>0</span><span>-15K</span><span>-30K</span></div>
                <div class="eplot" id="eplot"><div class="gl g1"></div><div class="gl g0"></div><div class="gl g3"></div></div>
            </div>
        </div>
        <div class="card">
            <div class="chd"><h2>Overall Rating</h2><button class="sel">This Week<svg viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></svg></button></div>
            <div class="rbody">
                <div>
                    <div class="gauge">
                        <svg viewBox="0 0 200 118"><path d="M14 104 A86 86 0 0 1 186 104" fill="none" stroke="#e6f4ec" stroke-width="20" stroke-linecap="round"/><path d="M14 104 A86 86 0 0 1 186 104" fill="none" stroke="#bfe8d3" stroke-width="20" stroke-linecap="round" stroke-dasharray="270" stroke-dashoffset="33"/></svg>
                        <div class="gscore"><small>Rating</small><b>4.6<span>/5</span></b></div>
                    </div>
                    <div class="impress">Impressive<small>from 2546 reviews</small></div>
                </div>
                <div class="rlist">
                    <div class="rrow">Facilities<span class="bar"><i style="width:88%"></i></span><b>4.4</b></div>
                    <div class="rrow">Cleanliness<span class="bar"><i style="width:88%"></i></span><b>4.4</b></div>
                    <div class="rrow">Services<span class="bar"><i style="width:92%"></i></span><b>4.6</b></div>
                    <div class="rrow">Comfort<span class="bar"><i style="width:96%"></i></span><b>4.8</b></div>
                    <div class="rrow">Food and Dining<span class="bar"><i style="width:90%"></i></span><b>4.5</b></div>
                </div>
            </div>
        </div>
    </section>
    <section class="card country-card">
        <div class="chd"><h2>Reviews by Country</h2><span style="color:#c4c4c4;font-size:18px">···</span></div>
        <div class="clay">
            <div class="cmap"><img src="{{ asset('images/World.png') }}" alt="World reviews map"></div>
            <aside class="csum">
                <small>Total Customers</small>
                <strong>17,850</strong>
                <div class="clist">
                    <div class="crow"><i style="background:#cbd877"></i><span>United States of America</span><b>23%</b></div>
                    <div class="crow"><i style="background:#e8fb82"></i><span>China</span><b>20%</b></div>
                    <div class="crow"><i style="background:#f4fac3"></i><span>United Kingdom</span><b>18%</b></div>
                    <div class="crow"><i style="background:#b6d8cb"></i><span>Netherlands</span><b>13%</b></div>
                    <div class="crow"><i style="background:#d2f3e4"></i><span>Australia</span><b>11%</b></div>
                    <div class="crow"><i style="background:#e3f6ec"></i><span>Saudi Arabia</span><b>9%</b></div>
                    <div class="crow"><i style="background:#9a9a9a"></i><span>Uni Emirates Arab</span><b>8%</b></div>
                    <div class="crow"><i style="background:#dddddd"></i><span>Indonesia</span><b>4%</b></div>
                </div>
            </aside>
        </div>
    </section>
    <div class="crhead"><h2>Customer Reviews</h2><div class="crsort">Sort by: <select class="fsel lime" id="fSort"><option value="newest">Newest</option><option value="oldest">Oldest</option><option value="high">Highest Rated</option><option value="low">Lowest Rated</option></select> <span style="font-size:18px;color:#c4c4c4">···</span></div></div>
    <section class="rev-grid" id="revgrid"></section>
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
// diverging positive/negative bars (K). [label,posK,negK]
const H=105,MAX=30;
const _MON=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
function _day(off){const d=new Date();d.setDate(d.getDate()-6+off);return d.getDate()+' '+_MON[d.getMonth()];}
const _vals=[[28,7],[23,6],[16,9],[21,7],[24,4],[19,7],[23,9]];
const stats=_vals.map((v,i)=>[_day(i),v[0],v[1]]);
document.getElementById('eplot').insertAdjacentHTML('beforeend',stats.map(m=>`<div class="mo"><div class="up" style="height:${Math.round(m[1]/MAX*H)}px"></div><div class="dn" style="height:${Math.round(m[2]/MAX*H)}px"></div><span class="ml">${m[0]}</span></div>`).join(''));
// customer reviews
const st=n=>'★★★★★☆☆☆☆☆'.slice(5-n,10-n);
const ini=n=>n.split(' ').map(w=>w[0]).slice(0,2).join('');
const revs=@json($reviews);
function render(list){document.getElementById('revgrid').innerHTML=list.map(r=>`<article class="rev"><div class="person"><span class="av">${ini(r.customer_name)}</span><div><b>${r.customer_name}</b></div></div><div class="stars">${st(r.rating)}<small>${r.date}</small></div><p>${r.text}</p></article>`).join('');}
document.getElementById('fSort').addEventListener('change',e=>{const s=e.target.value;let l=[...revs];if(s==='newest')l.sort((a,b)=>b.id-a.id);else if(s==='oldest')l.sort((a,b)=>a.id-b.id);else if(s==='high')l.sort((a,b)=>b.rating-a.rating);else if(s==='low')l.sort((a,b)=>a.rating-b.rating);render(l);});
render(revs);
</script>
</body>
</html>
