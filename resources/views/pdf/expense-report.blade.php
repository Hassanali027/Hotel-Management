@php
    $img = fn ($name) => public_path('images/invoice/'.$name);
    $rangeLabel = \Carbon\Carbon::parse($data['from'])->format('d M Y').' – '.\Carbon\Carbon::parse($data['to'])->format('d M Y');
@endphp
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style>
@page{margin:42mm 12mm 18mm 12mm;header:html_reportHeader;footer:html_reportFooter}
body{font-family:lato,sans-serif;color:#1a1f1c;font-size:9.5pt}
table{width:100%;border-collapse:collapse}
.header{width:100%;background:#eef2ee;border-bottom:1px solid #dce6df}
.header td{vertical-align:middle}
.brand{font-size:17pt;font-weight:bold;letter-spacing:1px;color:#2f5a45;line-height:1.1}
.brand-sub{font-size:8pt;letter-spacing:4px;color:#2f5a45;margin-top:1mm}
.tag{font-size:8pt;font-style:italic;color:#5b6a62;margin-top:1.5mm}
.contact{font-size:8pt;line-height:1.6;color:#3d4a43}
.title{font-size:24pt;font-weight:bold;color:#111;margin:0 0 1mm}
.muted{font-size:9pt;color:#68756d}
.meta{background:#f5f8f5;border:1px solid #e1e7e2;border-radius:3mm;padding:3mm 4mm;margin-top:5mm}
.cards{margin-top:5mm}
.card{background:#e6f4ea;border:1px solid #d5e8da;border-radius:3mm;padding:3.5mm 4mm}
.card-label{font-size:8pt;color:#53665a}
.card-value{font-size:15pt;font-weight:bold;color:#1f5f3f;margin-top:1mm}
.section{font-size:11pt;font-weight:bold;color:#2f5a45;margin:7mm 0 2mm}
.items{border:1px solid #e1e7e2;border-radius:2mm}
.items th{background:#e6f4ea;color:#26362c;text-align:left;font-size:8pt;padding:2.5mm 2.5mm;border-bottom:1px solid #d9e6dc}
.items td{padding:2.5mm 2.5mm;border-bottom:1px solid #e9eeea;vertical-align:top}
.items tr:last-child td{border-bottom:0}
.num{text-align:right;white-space:nowrap}
.daily-total td{background:#f5f8f5;font-weight:bold;color:#345443}
.grand{margin-top:6mm;border-top:2px solid #2f5a45}
.grand td{padding:3mm 2mm;font-weight:bold;font-size:11pt;color:#1f3d2e}
.empty{text-align:center;padding:12mm 5mm;background:#f5f8f5;border-radius:3mm;color:#68756d;margin-top:4mm}
.footer{border-top:1px solid #dce6df;color:#647269;font-size:8pt;padding-top:2mm}
</style>
</head>
<body>
<htmlpageheader name="reportHeader">
<table class="header" cellpadding="0" cellspacing="0">
<tr>
<td width="16%" style="padding:4mm 3mm 4mm 0"><img src="{{ $img('logo-round.png') }}" style="width:22mm;height:22mm"></td>
<td width="49%" style="padding:4mm 2mm">
<div class="brand">INDUS RESORT</div><div class="brand-sub">RESTAURANT</div><div class="tag">Your Perfect Stay in Murree</div>
</td>
<td width="35%" class="contact" style="padding:4mm 0 4mm 3mm">Governor House Road, Aliot Bazar,<br>Kohala Road, Murree<br>0300-0053333<br>indusresort7861@gmail.com</td>
</tr></table>
</htmlpageheader>
<htmlpagefooter name="reportFooter"><table class="footer"><tr><td>INDUS RESORT RESTAURANT · EXPENSES</td><td class="num">Page {PAGENO} of {nbpg}</td></tr></table></htmlpagefooter>
<sethtmlpageheader name="reportHeader" value="on" show-this-page="1" />
<sethtmlpagefooter name="reportFooter" value="on" />

<div class="title">{{ $areaLabel }} Expenses</div>
<div class="muted">Date-wise expense report · Generated {{ now()->format('d M Y, g:i A') }} PKT</div>
<div class="meta"><strong>Report period:</strong> {{ $rangeLabel }} &nbsp;&nbsp; <strong>Area:</strong> {{ $areaLabel }}</div>
<table class="cards" cellpadding="0" cellspacing="0"><tr>
<td width="33%" style="padding-right:2mm"><div class="card"><div class="card-label">TOTAL EXPENSES</div><div class="card-value">PKR {{ number_format($total) }}</div></div></td>
<td width="33%" style="padding:0 1mm"><div class="card"><div class="card-label">RECORDS</div><div class="card-value">{{ number_format($dailyExpenses->flatten(1)->count()) }}</div></div></td>
<td width="34%" style="padding-left:2mm"><div class="card"><div class="card-label">DAYS WITH EXPENSES</div><div class="card-value">{{ number_format($dailyExpenses->count()) }}</div></div></td>
</tr></table>
@forelse($dailyExpenses as $date => $items)
<div class="section">{{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}</div>
<table class="items"><thead><tr><th width="35%">EXPENSE</th><th width="30%">CATEGORY</th><th width="12%" class="num">QTY</th><th width="23%" class="num">AMOUNT</th></tr></thead><tbody>
@foreach($items as $expense)
<tr><td>{{ $expense->name }}</td><td>{{ $expense->category ?: '—' }}</td><td class="num">{{ $expense->quantity ?: 1 }}</td><td class="num">PKR {{ number_format((int) $expense->amount) }}</td></tr>
@endforeach
<tr class="daily-total"><td colspan="3">Daily total</td><td class="num">PKR {{ number_format((int) $items->sum('amount')) }}</td></tr>
</tbody></table>
@empty
<div class="empty">There are no matching expenses in this date range.</div>
@endforelse
<table class="grand"><tr><td>Total for selected dates</td><td class="num">PKR {{ number_format($total) }}</td></tr></table>
</body>
</html>
