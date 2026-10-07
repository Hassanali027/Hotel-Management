<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style>
body{font-family:lato,sans-serif;color:#1b2921;font-size:10pt}
.brand{font-size:10pt;font-weight:bold;letter-spacing:1.2px;color:#2f6b4f;text-transform:uppercase}
h1{font-size:22pt;margin:5mm 0 2mm;color:#17241d}
.meta{color:#66736b;font-size:9pt;margin-bottom:7mm}
.summary{background:#eaf5ed;border-radius:3mm;padding:4mm 5mm;margin-bottom:7mm}
.summary strong{font-size:15pt;color:#1f5f3f}
h2{font-size:12pt;color:#2f6b4f;margin:7mm 0 2mm}
table{width:100%;border-collapse:collapse}
th{background:#eaf5ed;text-align:left;font-size:8.5pt;padding:3mm 2.5mm;color:#34463a}
td{border-bottom:0.25mm solid #e6ece7;padding:2.8mm 2.5mm;vertical-align:top}
.num{text-align:right;white-space:nowrap}
.daily-total td{font-weight:bold;background:#f7faf8}
.grand td{font-weight:bold;font-size:11pt;border-top:0.6mm solid #2f6b4f;border-bottom:0}
.empty{text-align:center;padding:12mm;color:#7b857e}
</style>
</head>
<body>
<div class="brand">Indus Resort Restaurant · Financial Report</div>
<h1>{{ $areaLabel }} Expenses</h1>
<div class="meta">Date range: {{ \Carbon\Carbon::parse($data['from'])->format('d M Y') }} – {{ \Carbon\Carbon::parse($data['to'])->format('d M Y') }} · Generated {{ now()->format('d M Y, g:i A') }} PKT</div>
<div class="summary">Total expenses<br><strong>PKR {{ number_format($total) }}</strong></div>
@forelse($dailyExpenses as $date => $items)
    <h2>{{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}</h2>
    <table>
        <thead><tr><th>Expense</th><th>Category</th><th class="num">Qty</th><th class="num">Amount</th></tr></thead>
        <tbody>
        @foreach($items as $expense)
            <tr><td>{{ $expense->name }}</td><td>{{ $expense->category ?: '—' }}</td><td class="num">{{ $expense->quantity ?: 1 }}</td><td class="num">PKR {{ number_format((int) $expense->amount) }}</td></tr>
        @endforeach
            <tr class="daily-total"><td colspan="3">Daily total</td><td class="num">PKR {{ number_format((int) $items->sum('amount')) }}</td></tr>
        </tbody>
    </table>
@empty
    <div class="empty">No matching expenses were recorded during this date range.</div>
@endforelse
<table style="margin-top:8mm"><tbody><tr class="grand"><td colspan="3">Total for selected dates</td><td class="num">PKR {{ number_format($total) }}</td></tr></tbody></table>
</body>
</html>
