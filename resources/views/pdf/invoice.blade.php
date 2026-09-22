{{-- Invoice PDF (rendered with mpdf). Layout follows the Figma invoice: header band, invoice box, bill-to / booking cards,
     line items, payment history, payment status, thank-you footer and the "Stay . Dine . Relax . Explore" band. --}}
@php
    $img = fn ($n) => public_path('images/invoice/'.$n);
    $money = fn ($v) => 'PKR '.number_format((float) $v, 0);
    $paid = $booking->invoice_status === 'paid';
    $partial = !$paid && ($booking->invoice_status === 'partial' || $advance > 0);
    $statusLabel = $paid ? 'PAID' : ($partial ? 'PARTIAL' : 'UNPAID');
    $statusIcon = $paid ? 'check.svg' : ($partial ? 'clock.svg' : 'alert.svg');
    $statusBg = $paid ? '#e6f4ea' : ($partial ? '#fdf3d2' : '#fde2e5');
    $statusColor = $paid ? '#1f3d2e' : ($partial ? '#7a5400' : '#8c2620');
    $extra = (int) ($booking->extra_charges ?? 0);
    $roomCharge = max(0, $total - $extra);
    $invoiceDate = now()->format('d M Y');
    $guestPhone = $guestPhone ?? optional(\App\Models\Guest::find($booking->guest_id) ?: \App\Models\Guest::where('name', $booking->guest_name)->first())->phone;
@endphp
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style>
    @page { margin: 0; }
    body { font-family: lato, sans-serif; color: #1a1f1c; font-size: 10.5pt; margin: 0; }
    .band { background: #eef2ee; height: 38mm; }
    .band-inner { padding: 6mm 12mm 0 12mm; }
    .brand-name { font-family: latoblack, lato, sans-serif; font-size: 23pt; color: #2f5a45; letter-spacing: 1.5px; line-height: 1; }
    .brand-sub { font-size: 10pt; letter-spacing: 5.5px; color: #2f5a45; margin-top: 1.5mm; }
    .brand-tag { font-family: lato; font-style: italic; font-size: 10.5pt; color: #5b6a62; margin-top: 1.5mm; }
    .ct { padding: 1.1mm 0; font-size: 9.5pt; color: #1a1f1c; vertical-align: middle; line-height: 1.3; }
    .ci { padding: 1.1mm 3mm 1.1mm 0; vertical-align: middle; }
    .wrap { padding: 6mm 12mm 0 12mm; }
    .h-invoice { font-family: latoblack, lato, sans-serif; font-size: 30pt; line-height: 1; color: #111; }
    .h-sub { font-size: 12pt; color: #6b756f; margin-top: 2mm; }
    .invbox { background: #e6f4ea; border-radius: 3mm; }
    .invbox td { background: #e6f4ea; }
    .inv-lbl { font-size: 9.5pt; color: #3d4a43; }
    .inv-val { font-family: latoblack, lato, sans-serif; font-size: 18pt; color: #111; line-height: 1.6; }
    .inv-date { font-family: latoblack, lato, sans-serif; font-size: 12pt; color: #111; line-height: 2.2; }
    td.card { border: 0.4mm solid #e1e7e2; border-radius: 3.5mm; padding: 4.5mm 5mm; }
    .card-title { font-family: latoblack, lato, sans-serif; font-size: 10.5pt; letter-spacing: 0.5px; color: #111; }
    .card-big { font-family: latoblack, lato, sans-serif; font-size: 17pt; color: #111; margin-top: 2mm; }
    .card-muted { font-size: 10pt; color: #5b6a62; margin-top: 1.5mm; }
    .kv td { padding: 0.8mm 0; font-size: 10.5pt; }
    .kv td.k { color: #3d4a43; width: 22mm; }
    .kv td.c { width: 4mm; color: #3d4a43; }
    .kv td.v { white-space: nowrap; }
    .items { width: 100%; border-collapse: separate; border-spacing: 0; border: 0.4mm solid #e1e7e2; border-radius: 3.5mm; overflow: hidden; }
    .items th { background: #e6f4ea; font-family: latoblack, lato, sans-serif; font-size: 9.5pt; letter-spacing: 0.6px; color: #111; padding: 3.8mm 5mm; text-align: left; }
    .items td { padding: 3.8mm 5mm; font-size: 10.5pt; border-top: 0.3mm solid #eef2ee; }
    .r { text-align: right; }
    .c { text-align: center; }
    .pay { border: 0.4mm solid #e1e7e2; border-radius: 3.5mm; padding: 4mm 5mm 3.5mm 5mm; }
    .pay .head td { padding-bottom: 2mm; }
    .pay-title { font-family: latoblack, lato, sans-serif; font-size: 13pt; letter-spacing: 0.5px; color: #111; }
    .pay .rows td { padding: 2.4mm 0; font-size: 10.5pt; border-bottom: 0.3mm solid #e9eeea; }
    .pay .rows tr.last td { border-bottom: 0; }
    .pay .rows td.amt { text-align: right; font-weight: bold; }
    .remaining { background: #dff2e3; border-radius: 2.5mm; padding: 3mm 4mm; margin-top: 2.5mm; }
    .rem-l { font-family: latoblack, lato, sans-serif; font-size: 11pt; color: #1f3d2e; letter-spacing: 0.5px; }
    .rem-v { font-family: latoblack, lato, sans-serif; font-size: 15pt; color: #1f3d2e; text-align: right; }
    .status { border-radius: 3.5mm; padding: 4mm 6mm; }
    .st-lbl { font-family: latoblack, lato, sans-serif; font-size: 9.5pt; letter-spacing: 0.6px; }
    .st-val { font-family: latoblack, lato, sans-serif; font-size: 18pt; margin-top: 1mm; }
    .thanks { font-family: greatvibes, lato, sans-serif; font-size: 27pt; color: #111; line-height: 1; }
    .thanks-txt { font-size: 10.5pt; color: #1a1f1c; margin-top: 1.5mm; line-height: 1.3; }
    .gen { font-size: 8.5pt; color: #5b6a62; margin-top: 1.5mm; }
    .quote { font-family: lato; font-style: italic; font-size: 11pt; color: #5b6a62; line-height: 1.35; }
    .quote-line { width: 14mm; border-top: 0.4mm solid #9aa79f; margin-top: 3mm; }
    .resort { font-family: latoblack, lato, sans-serif; font-size: 12pt; letter-spacing: 2px; color: #2f5a45; }
    .resort-sub { font-family: lato; font-size: 8pt; letter-spacing: 3px; color: #5b6a62; }
    .foot { position: absolute; left: 0; top: 283mm; width: 210mm; height: 14mm; background: #2f5a45; }
    .foot-t { color: #ffffff; font-size: 9.5pt; letter-spacing: 4px; text-align: center; padding-top: 4.6mm; }
    .foot-img { width: 4mm; height: 4mm; vertical-align: middle; }
</style>
</head>
<body>

<div style="position:absolute; left:164mm; top:0; width:46mm; height:38mm;"><img src="{{ $img('mountains-top.svg') }}" style="width:46mm; height:38mm;"></div>
<div class="band">
    <div class="band-inner">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td width="52%" valign="middle">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td valign="middle" style="padding-right:5mm"><img src="{{ $img('logo-round.png') }}" style="width:25mm;height:25mm;"></td>
                            <td valign="middle">
                                <div class="brand-name">INDUS RESORT</div>
                                <div class="brand-sub">RESTAURANT</div>
                                <div class="brand-tag">Your Perfect Stay in Murree</div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="48%" valign="middle" style="padding-left:2mm">
                    <table cellpadding="0" cellspacing="0">
                        <tr><td class="ci"><img src="{{ $img('pin.svg') }}" style="width:6mm;height:6mm"></td><td class="ct">Governor House Road, Aliot Bazar,<br>Kohala Road, Murree</td></tr>
                        <tr><td class="ci"><img src="{{ $img('phone.svg') }}" style="width:6mm;height:6mm"></td><td class="ct">0300-0053333</td></tr>
                        <tr><td class="ci"><img src="{{ $img('mail.svg') }}" style="width:6mm;height:6mm"></td><td class="ct">indusresort7861@gmail.com</td></tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="wrap">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td width="52%" valign="middle">
                <div class="h-invoice">INVOICE</div>
                <div class="h-sub">Professional stay invoice</div>
            </td>
            <td width="48%" valign="middle">
                <table width="100%" cellpadding="0" cellspacing="0" class="invbox">
                    <tr>
                        <td width="52%" style="padding:5mm 4mm 5mm 6mm; border-right:0.4mm solid #c9dccf">
                            <span class="inv-lbl">Invoice No.</span><br>
                            <span class="inv-val">{{ $booking->code }}</span>
                        </td>
                        <td style="padding:5mm 5mm 5mm 5mm">
                            <span class="inv-lbl">Invoice Date</span><br>
                            <span class="inv-date">{{ $invoiceDate }}</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:5mm">
        <tr>
            <td width="49%" valign="top" class="card">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td valign="top" style="padding-right:5mm"><img src="{{ $img('user.svg') }}" style="width:14mm;height:14mm"></td>
                            <td valign="top">
                                <div class="card-title">BILL TO</div>
                                <table class="kv" cellpadding="0" cellspacing="0" style="margin-top:1.5mm">
                                    <tr><td class="k">Name</td><td class="c">:</td><td class="v">{{ $booking->guest_name }}</td></tr>
                                    <tr><td class="k">CNIC</td><td class="c">:</td><td class="v">{{ $booking->cnic ?: '-' }}</td></tr>
                                    <tr><td class="k">Phone</td><td class="c">:</td><td class="v">{{ $guestPhone ?: '-' }}</td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
            </td>
            <td width="2%"></td>
            <td width="49%" valign="top" class="card">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td valign="top" style="padding-right:5mm"><img src="{{ $img('bed.svg') }}" style="width:14mm;height:14mm"></td>
                            <td valign="top">
                                <div class="card-title">BOOKING DETAILS</div>
                                <table class="kv" cellpadding="0" cellspacing="0" style="margin-top:1.5mm">
                                    <tr><td class="k">Room</td><td class="c">:</td><td class="v">{{ $booking->room_label ?: 'Room' }}</td></tr>
                                    <tr><td class="k">Stay</td><td class="c">:</td><td class="v">{{ $nights }} {{ $nights === 1 ? 'night' : 'nights' }}</td></tr>
                                    <tr><td class="k">Invoice date</td><td class="c">:</td><td class="v">{{ $invoiceDate }}</td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
    </table>

    <table class="items" style="margin-top:4.5mm">
        <tr>
            <th width="46%">DESCRIPTION</th>
            <th width="18%" class="c">RATE</th>
            <th width="16%" class="c">NIGHTS</th>
            <th width="20%" class="r">AMOUNT</th>
        </tr>
        <tr>
            <td>Accommodation - {{ $booking->room_label ?: 'Room' }}</td>
            <td class="c">{{ $money($booking->price_per_night) }}</td>
            <td class="c">{{ $nights }}</td>
            <td class="r">{{ $money($roomCharge) }}</td>
        </tr>
        @if($extra > 0)
        <tr>
            <td>Extra charges</td>
            <td class="c">-</td>
            <td class="c">-</td>
            <td class="r">{{ $money($extra) }}</td>
        </tr>
        @endif
    </table>

    <div class="pay" style="margin-top:4.5mm">
        <table class="head" cellpadding="0" cellspacing="0">
            <tr>
                <td valign="middle" style="padding-right:4mm"><img src="{{ $img('card.svg') }}" style="width:11mm;height:11mm"></td>
                <td valign="middle"><div class="pay-title">PAYMENT HISTORY</div></td>
            </tr>
        </table>
        <table class="rows" width="100%" cellpadding="0" cellspacing="0">
            <tr><td>Total booking amount</td><td class="amt">{{ $money($total) }}</td></tr>
            <tr><td>Advance paid{{ $advance > 0 ? ' - '.$booking->created_at->format('d M Y') : '' }}</td><td class="amt">{{ $money($advance) }}</td></tr>
            <tr class="{{ $paid ? '' : 'last' }}"><td>Balance after advance</td><td class="amt">{{ $money(max(0, $total - $advance)) }}</td></tr>
            @if($paid)
            <tr class="last"><td>Final payment{{ $booking->final_payment_paid_at ? ' - '.\Carbon\Carbon::parse($booking->final_payment_paid_at)->format('d M Y') : '' }}</td><td class="amt">{{ $money($finalPayment) }}</td></tr>
            @endif
        </table>
        <div class="remaining">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr><td class="rem-l">REMAINING BALANCE</td><td class="rem-v">{{ $money($remaining) }}</td></tr>
            </table>
        </div>
    </div>

    <div class="status" style="margin-top:4.5mm; background: {{ $statusBg }}">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td valign="middle" style="padding-right:6mm"><img src="{{ $img($statusIcon) }}" style="width:14mm;height:14mm"></td>
                <td valign="middle">
                    <div class="st-lbl" style="color: {{ $statusColor }}">PAYMENT STATUS</div>
                    <div class="st-val" style="color: {{ $statusColor }}">{{ $statusLabel }}</div>
                </td>
            </tr>
        </table>
    </div>

    <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:5mm">
        <tr>
            <td width="38%" valign="top" style="border-right:0.4mm solid #e1e7e2; padding-right:5mm">
                <div class="thanks">Thank you!</div>
                <div class="thanks-txt">Thank you for choosing<br>Indus Resort Restaurant.</div>
                <div class="gen">This is a computer-generated invoice.</div>
            </td>
            <td width="27%" valign="top" style="padding: 3mm 0 0 6mm">
                <div class="quote">&ldquo;Great stays create<br>brighter tomorrows.&rdquo;</div>
                <div class="quote-line"></div>
            </td>
            <td width="35%" valign="top" style="text-align:right">
                <img src="{{ $img('mountains-bottom.svg') }}" style="width:46mm;height:19mm">
                <div class="resort" style="text-align:right;padding-right:2mm;margin-top:1mm">INDUS RESORT</div><div class="resort-sub" style="text-align:right;padding-right:2mm">MURREE</div>
            </td>
        </tr>
    </table>
</div>

<div class="foot">
    <div class="foot-t"><img class="foot-img" src="{{ $img('leaf.svg') }}">&nbsp;&nbsp;&nbsp;STAY &nbsp;&bull;&nbsp; DINE &nbsp;&bull;&nbsp; RELAX &nbsp;&bull;&nbsp; EXPLORE&nbsp;&nbsp;&nbsp;<img class="foot-img" src="{{ $img('leaf.svg') }}"></div>
</div>

</body>
</html>
