<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Expense - Lodgify</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--lime:#e8fb82;--mint:#d2f3e4;--mint-d:#b6d8cb;--olive:#cbd877;--plime:#f4fac3;--pmint:#eefbf4;--ink:#151515;--muted:#8f8f8f;--bg:#f6f6f5;--line:#f0f0f0;--red:#ff4e52}
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
/* top area: stats+earnings on left, donut on right */
.fin-top{display:grid;grid-template-columns:minmax(0,1fr) 360px;gap:20px;margin-bottom:20px}
.fin-left{display:grid;gap:20px;align-content:start}
.stat-row{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.scard{background:#fff;border-radius:16px;padding:20px}
.sc-head{display:flex;align-items:center;gap:10px;color:#7a7a7a;font-size:15px;margin-bottom:14px}
.sc-ic{width:34px;height:34px;border-radius:9px;background:var(--mint);display:grid;place-items:center;flex:0 0 34px}
.sc-ic svg{width:18px;height:18px;fill:none;stroke:#3f8b6d;stroke-width:1.8}
.sc-head .dots{margin-left:auto;color:#c4c4c4;font-size:18px;letter-spacing:1px}
.sc-body{display:flex;align-items:flex-end;justify-content:space-between;gap:8px}
.sc-num{font-size:30px;font-weight:800;letter-spacing:-.5px}
.sc-delta{text-align:right}
.sc-delta .p{display:inline-flex;align-items:center;gap:4px;padding:4px 9px;border-radius:12px;font-size:13px;font-weight:700;background:var(--lime);color:#3d4a10}
.sc-delta .p.down{background:#ffe1e1;color:#b3352f}
.sc-delta small{display:block;color:#9a9a9a;font-size:12px;margin-top:5px}
/* earnings */
.earn{background:#fff;border-radius:16px;padding:22px}
.earn-top{display:flex;justify-content:space-between;align-items:center}
.earn-top h2{font-size:19px;margin:0}
.yearsel{height:40px;border:1px solid #ededed;background:#fff;border-radius:10px;padding:0 14px;display:inline-flex;align-items:center;gap:8px;font-size:14px;cursor:pointer}
.yearsel svg{width:16px;height:16px;fill:none;stroke:#555;stroke-width:1.8}
.legend{display:flex;gap:20px;margin:14px 0 6px;font-size:14px;color:#666}
.legend i{display:inline-block;width:12px;height:12px;border-radius:3px;margin-right:7px;vertical-align:-1px}
.legend .li{background:var(--lime)}.legend .le{background:var(--mint)}
.ec{display:flex;gap:12px}
.ey{display:flex;flex-direction:column;justify-content:space-between;height:280px;font-size:12px;color:#aaa;text-align:right;flex:0 0 34px;padding:4px 0}
.eplot{position:relative;flex:1;height:280px;display:flex;align-items:stretch}
.eplot:before,.gl{content:'';position:absolute;left:0;right:0;border-top:1px dashed #ededed}
.eplot .g0{top:50%;border-top:1px dashed #d9d9d9}.eplot .g1{top:25%}.eplot .g3{top:75%}
.mo{position:relative;flex:1}
.mo .up{position:absolute;left:50%;transform:translateX(-50%);bottom:50%;width:24px;background:var(--mint);border-radius:7px 7px 0 0}
.mo .dn{position:absolute;left:50%;transform:translateX(-50%);top:50%;width:24px;background:var(--lime);border-radius:0 0 7px 7px}
.mo .ml{position:absolute;top:calc(100% + 10px);left:0;right:0;text-align:center;font-size:12px;color:#888}
.mo.hl .up,.mo.hl .dn{outline:6px solid rgba(210,243,228,.5);border-radius:8px}
.tip{position:absolute;bottom:calc(50% + 90px);left:50%;transform:translateX(-50%);background:var(--lime);border-radius:10px;padding:10px 12px;font-size:12px;white-space:nowrap;z-index:3;box-shadow:0 6px 16px rgba(0,0,0,.08)}
.tip b{font-weight:700}.tip .r{display:flex;justify-content:space-between;gap:18px;margin-top:4px}.tip .r span:first-child{color:#5b6b2f}
/* donut card */
.donut-card{background:#fff;border-radius:16px;padding:20px;display:flex;flex-direction:column}
.toggle{display:flex;background:#f4f4f4;border-radius:12px;padding:5px;margin-bottom:8px}
.toggle button{flex:1;height:40px;border:0;background:transparent;border-radius:9px;font-size:15px;font-weight:600;color:#777;cursor:pointer}
.toggle button.on{background:var(--lime);color:#2f3a0c}
.donut{width:220px;height:220px;border-radius:50%;margin:14px auto 6px;position:relative;background:conic-gradient(var(--mint) 0 50%,#fff 50% 50.7%,var(--mint-d) 50.7% 66.67%,#fff 66.67% 67.37%,var(--olive) 67.37% 80%,#fff 80% 80.7%,var(--lime) 80.7% 90%,#fff 90% 90.7%,var(--plime) 90.7% 96.67%,#fff 96.67% 97.37%,var(--pmint) 97.37% 100%)}
.donut .hole{position:absolute;inset:50px;background:#fff;border-radius:50%;display:grid;place-content:center;text-align:center}
.donut .hole b{font-size:28px;font-weight:800}.donut .hole span{font-size:13px;color:#8a8a8a}
.dlegend{margin-top:10px;display:grid;gap:14px}
.dl-row{display:grid;grid-template-columns:14px 1fr auto;align-items:center;gap:10px;font-size:14px;color:#444}
.dl-row i{width:13px;height:13px;border-radius:3px}
.dl-row .pct{color:#9a9a9a;font-size:13px}
.dl-row b{font-weight:700}
/* transactions panel */
.panel{background:#fff;border-radius:18px;padding:22px 22px 8px}
.pt{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;gap:12px;flex-wrap:wrap}
.pt h2{font-size:20px;margin:0}
.pt-r{display:flex;gap:12px;align-items:center;flex-wrap:wrap}
.pill{height:44px;border:0;border-radius:11px;padding:0 16px;display:inline-flex;align-items:center;gap:9px;font-size:15px;background:#f4f4f4;color:#333;cursor:pointer;white-space:nowrap}
.pill.lime{background:var(--lime)}
.pill svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:1.8}
.searchbox{position:relative}
.searchbox>svg{position:absolute;left:15px;top:50%;transform:translateY(-50%);width:18px;height:18px;fill:none;stroke:#b0b0b0;stroke-width:1.8}
.search{height:44px;width:250px;border:0;border-radius:11px;background:#f4f4f4;padding:0 16px 0 42px;font-size:14px;color:#333;font-family:inherit}
.search::placeholder{color:#b0b0b0}
.tbl{width:100%;overflow-x:auto}
.thead,.trow{display:grid;grid-template-columns:1.4fr 1.6fr .9fr 1fr 1.2fr 1.1fr 1.4fr;align-items:center;min-width:1000px}
.thead{background:#eefaf3;border-radius:12px;padding:16px 24px;color:#8a8a8a;font-size:15px;font-weight:600}
.thead span{display:inline-flex;align-items:center;gap:6px}
.thead svg{width:12px;height:12px;fill:none;stroke:#b5b5b5;stroke-width:2}
.trow{padding:18px 24px;border-bottom:1px solid var(--line);font-size:15px}
.trow:last-child{border-bottom:0}
.st{display:inline-flex;align-items:center;gap:8px;padding:6px 12px;border-radius:7px;font-size:14px;font-weight:600;width:max-content;background:var(--mint);color:#2f6b4f}
.st:before{content:'';width:9px;height:9px;border-radius:2px;background:#7cc3a0}
.act{display:flex;gap:11px;align-items:center}
.eye{width:40px;height:40px;border:1px solid #ededed;background:#fff;border-radius:9px;display:grid;place-items:center;cursor:pointer}
.eye svg{width:19px;height:19px;fill:none;stroke:#555;stroke-width:1.7}
.dl{height:40px;border:0;border-radius:9px;background:var(--lime);padding:0 16px;display:inline-flex;align-items:center;gap:7px;font-size:14px;font-weight:600;color:#2f3a0c;cursor:pointer}
.dl svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.9}
.tbottom{display:flex;justify-content:space-between;align-items:center;padding:20px 4px 16px;color:#8a8a8a;font-size:15px}
.pages{display:flex;gap:8px}
.pg{min-width:40px;height:40px;border:0;border-radius:9px;background:#f4f4f4;font-size:15px;color:#555;cursor:pointer;display:grid;place-items:center}
.pg.active{background:var(--lime);color:#2f3a0c;font-weight:700}
footer{display:flex;justify-content:space-between;align-items:center;padding:20px 6px 8px;color:#9a9a9a;font-size:14px;flex-wrap:wrap;gap:14px}
.flinks{display:flex;gap:26px}.flinks a{color:#9a9a9a;text-decoration:none}.flinks span:first-child{color:#666}
.fsoc{display:flex;gap:16px;align-items:center}.fsoc a{color:#c2c2c2}.fsoc svg{width:18px;height:18px;fill:currentColor}
@media(max-width:1000px){.fin-top{grid-template-columns:1fr}.stat-row{grid-template-columns:1fr}}
@media(max-width:700px){body{zoom:1}.main{padding:18px 14px}.top h1{font-size:24px}.profile .pinfo,.tools{display:none}footer{flex-direction:column;align-items:flex-start}}
</style>
</head>
<body>
@include('partials.crud')
@include('partials.sidebar')
<main class="main">
    <header class="top">
        <h1>Expense</h1>
        <div class="profile">
            <span class="avatar">{{ collect(explode(' ', auth()->user()->name))->map(fn($w)=>$w[0])->take(2)->implode('') }}</span>
            <div class="pinfo"><b>{{ auth()->user()->name }}</b><small>{{ ucfirst(auth()->user()->role) }}</small></div>
            <div class="tools">
                <button class="tool"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></button>
                <button class="tool bell"><svg viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></button>
            </div>
        </div>
    </header>
    <div class="fin-top">
        <div class="fin-left">
            <div class="stat-row">
                <div class="scard">
                    <div class="sc-head"><span class="sc-ic"><svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M16 12h2"/></svg></span>Total Balance<span class="dots">···</span></div>
                    <div class="sc-body"><div class="sc-num">$15,650</div><div class="sc-delta"><span class="p"><svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17 17 7M17 7H9M17 7v8"/></svg>3.56%</span><small>from last week</small></div></div>
                </div>
                <div class="scard">
                    <div class="sc-head"><span class="sc-ic"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v10M9.5 14c0 1 1 2 2.5 2s2.5-.7 2.5-2-1-1.7-2.5-2-2.5-1-2.5-2 1-2 2.5-2 2.5 1 2.5 2"/></svg></span>Total Income<span class="dots">···</span></div>
                    <div class="sc-body"><div class="sc-num">$45,650</div><div class="sc-delta"><span class="p down"><svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 7 17 17M17 17H9M17 17V9"/></svg>1.25%</span><small>from last week</small></div></div>
                </div>
                <div class="scard">
                    <div class="sc-head"><span class="sc-ic"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8 12h8M12 8l-4 4 4 4"/></svg></span>Total Expenses<span class="dots">···</span></div>
                    <div class="sc-body"><div class="sc-num">$30,000</div><div class="sc-delta"><span class="p"><svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M7 17 17 7M17 7H9M17 7v8"/></svg>4.79%</span><small>from last week</small></div></div>
                </div>
            </div>
            <div class="earn">
                <div class="earn-top"><h2>Earnings</h2><button class="yearsel"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/></svg>This Year<svg viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></svg></button></div>
                <div class="legend"><span><i class="li"></i>Income</span><span><i class="le"></i>Expense</span></div>
                <div class="ec">
                    <div class="ey"><span>30K</span><span>15K</span><span>0</span><span>-15K</span><span>-30K</span></div>
                    <div class="eplot" id="eplot"><div class="gl g1"></div><div class="gl g0"></div><div class="gl g3"></div></div>
                </div>
            </div>
        </div>
        <div class="donut-card">
            <div class="toggle"><button>Income</button><button class="on">Expense</button></div>
            <div class="donut"><div class="hole"><b>$30,000</b><span>Total Expense</span></div></div>
            <div class="dlegend">
                <div class="dl-row"><i style="background:var(--mint)"></i><span>Salaries and Wages <span class="pct">(50%)</span></span><b>$15,000</b></div>
                <div class="dl-row"><i style="background:var(--mint-d)"></i><span>Utilitie <span class="pct">(16.67%)</span></span><b>$5,000</b></div>
                <div class="dl-row"><i style="background:var(--olive)"></i><span>Maintenance and Repairs <span class="pct">(13.33%)</span></span><b>$4,000</b></div>
                <div class="dl-row"><i style="background:var(--lime)"></i><span>Supplies <span class="pct">(10%)</span></span><b>$3,000</b></div>
                <div class="dl-row"><i style="background:var(--plime)"></i><span>Marketing and Advertising <span class="pct">(6.67%)</span></span><b>$2,000</b></div>
                <div class="dl-row"><i style="background:var(--pmint)"></i><span>Miscellaneous <span class="pct">(3.33%)</span></span><b>$1,000</b></div>
            </div>
        </div>
    </div>
    <section class="panel">
        <div class="pt">
            <h2>Transactions</h2>
            <div class="pt-r">
                <div class="searchbox"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg><input class="search" id="fSearch" placeholder="Search expense"></div>
                <select class="fsel" id="fCat"><option value="">All Category</option><option>Supplies</option><option>Utilities</option><option>Marketing and Advertising</option><option>Maintenance and Repairs</option><option>Salaries and Wages</option></select>
                <select class="fsel" id="fStatus"><option value="">All Status</option><option>Completed</option></select>
                <button class="pill lime"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/></svg>{{ now()->startOfMonth()->format('j') }} - {{ now()->startOfMonth()->addDays(17)->format('j M Y') }}<svg viewBox="0 0 24 24" width="14" height="14"><path d="m6 9 6 6 6-6"/></svg></button>
                <button class="pill" style="background:var(--lime);color:#2f3a0c;font-weight:700" onclick="openModal('addExp')">+ Add Expense</button>
            </div>
        </div>
        <div class="tbl">
            <div class="thead">
                <span onclick="sortCol('exp','name',applyFilters)" style="cursor:pointer">Expense @include('partials.sort')</span>
                <span onclick="sortCol('exp','category',applyFilters)" style="cursor:pointer">Category @include('partials.sort')</span>
                <span onclick="sortCol('exp','quantity',applyFilters)" style="cursor:pointer">Quantity @include('partials.sort')</span>
                <span onclick="sortCol('exp','amount',applyFilters)" style="cursor:pointer">Amount @include('partials.sort')</span>
                <span onclick="sortCol('exp','date',applyFilters)" style="cursor:pointer">Date @include('partials.sort')</span>
                <span>Status @include('partials.sort')</span>
                <span>Action @include('partials.sort')</span>
            </div>
            <div id="rows"></div>
        </div>
        <div class="tbottom">
            <span id="expInfo">Showing…</span>
            <div class="pages" id="expPages"></div>
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
// Earnings diverging bars. [month, incomeK, expenseK, highlight]
const H=140, MAX=30;
const earn=[['Jan',22,15],['Feb',17,15],['Mar',12,16],['Apr',17,15],['May',22,18],['Jun',26,21],['Jul',21.5,15.6,1],['Aug',15,8],['Sep',20,15],['Oct',19,16],['Nov',20,15],['Dec',24,15]];
document.getElementById('eplot').insertAdjacentHTML('beforeend', earn.map(m=>{
 const up=Math.round(m[1]/MAX*H), dn=Math.round(m[2]/MAX*H);
 const tip=m[3]?`<div class="tip"><b>July 2028</b><div class="r"><span>Income</span><b>$21,500</b></div><div class="r"><span>Expense</span><b>$15,600</b></div></div>`:'';
 return `<div class="mo ${m[3]?'hl':''}">${tip}<div class="up" style="height:${up}px"></div><div class="dn" style="height:${dn}px"></div><span class="ml">${m[0]}</span></div>`;
}).join(''));
// Transactions
const eye='<svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>';
const dl='<svg viewBox="0 0 24 24"><path d="M12 3v12m0 0 4-4m-4 4-4-4M4 21h16"/></svg>';
const data=@json($expenses);
const fmt=d=>{if(!d)return'';const p=String(d).slice(0,10).split('-');const M=['January','February','March','April','May','June','July','August','September','October','November','December'];return M[+p[1]-1]+' '+(+p[2])+', '+p[0]};
function render(list){document.getElementById('rows').innerHTML=list.map(e=>`<div class="trow"><span>${e.name}</span><span>${e.category||''}</span><span>${e.quantity}</span><span>$${e.amount}</span><span>${fmt(e.date)}</span><span><em class="st">Completed</em></span><span class="act"><button class="eye" title="View" onclick="showDetail(e.name,'Category: '+(e.category||'-')+'<br>Quantity: '+e.quantity+'<br>Amount: $'+e.amount+'<br>Date: '+fmt(e.date)+'<br>Status: Completed')">${eye}</button><button class="dl" onclick="downloadFile('expense-'+e.id+'.txt','LODGIFY EXPENSE\\n===============\\nExpense: '+e.name+'\\nCategory: '+(e.category||'')+'\\nQuantity: '+e.quantity+'\\nAmount: $'+e.amount+'\\nDate: '+fmt(e.date))">${dl} Download</button>${IS_ADMIN?`<button class="eye" title="Delete" onclick="if(confirm('Delete this expense?'))post('/expenses/'+e.id,'DELETE')">🗑</button>`:''}</span></div>`).join('')||'<div class="trow"><span>No results</span></div>';}
function applyFilters(){const q=(document.getElementById('fSearch').value||'').toLowerCase();const cat=document.getElementById('fCat').value;pgReset('exp');paginateRender('exp',sortList('exp',data.filter(e=>(!cat||e.category===cat)&&(!q||[e.name,e.category].join(' ').toLowerCase().includes(q)))),8,render);}
['fSearch','fCat','fStatus'].forEach(id=>document.getElementById(id).addEventListener(id==='fSearch'?'input':'change',applyFilters));
applyFilters();
</script>
<div class="modal-ov" id="addExp"><div class="modal"><h3>Add Expense</h3><form method="POST" action="{{ url('/expenses') }}">@csrf
<label>Expense Name</label><input name="name" placeholder="Housekeeping Supplies" required>
<label>Category</label><select name="category"><option>Supplies</option><option>Utilities</option><option>Marketing and Advertising</option><option>Maintenance and Repairs</option><option>Salaries and Wages</option></select>
<div class="mrow"><div><label>Quantity</label><input type="number" name="quantity" value="1"></div><div><label>Amount ($)</label><input type="number" name="amount" value="0"></div></div>
<label>Date</label><input type="date" name="date" value="{{ now()->format('Y-m-d') }}">
<div class="mact"><button type="button" class="mbtn cancel" onclick="closeModal('addExp')">Cancel</button><button class="mbtn save">Save</button></div>
</form></div></div>
</body>
</html>
