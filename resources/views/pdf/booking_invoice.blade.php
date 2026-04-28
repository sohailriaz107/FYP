<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Booking Invoice #{{ $booking->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            color: #2d2d2d;
            background: #fff;
            font-size: 13px;
            line-height: 1.5;
        }

        /* ---- HEADER ---- */
        .header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            padding: 35px 40px;
            position: relative;
            overflow: hidden;
        }

        .header-top {
            display: table;
            width: 100%;
        }

        .hotel-brand {
            display: table-cell;
            vertical-align: middle;
            width: 60%;
        }

        .hotel-name {
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .hotel-tagline {
            color: #a0c4ff;
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 4px;
        }

        .invoice-meta {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 40%;
        }

        .invoice-title {
            font-size: 22px;
            font-weight: 700;
            color: #e2b96f;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .invoice-number {
            color: #a0c4ff;
            font-size: 12px;
            margin-top: 5px;
        }

        .invoice-date {
            color: #ccc;
            font-size: 11px;
            margin-top: 3px;
        }

        /* Gold accent bar */
        .accent-bar {
            height: 4px;
            background: linear-gradient(90deg, #e2b96f, #f0d080, #e2b96f);
        }

        /* ---- STATUS BANNER ---- */
        .status-banner {
            padding: 12px 40px;
            display: table;
            width: 100%;
        }

        .status-confirmed { background-color: #d4edda; border-left: 5px solid #28a745; }
        .status-pending   { background-color: #fff3cd; border-left: 5px solid #ffc107; }
        .status-cancelled { background-color: #f8d7da; border-left: 5px solid #dc3545; }
        .status-complete  { background-color: #cce5ff; border-left: 5px solid #004085; }

        .status-banner-cell {
            display: table-cell;
            vertical-align: middle;
        }

        .status-text {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .status-confirmed .status-text { color: #155724; }
        .status-pending   .status-text { color: #856404; }
        .status-cancelled .status-text { color: #721c24; }
        .status-complete  .status-text { color: #004085; }

        /* ---- BODY CONTENT ---- */
        .content {
            padding: 30px 40px;
        }

        /* GUEST & HOTEL INFO */
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .info-box {
            display: table-cell;
            vertical-align: top;
            width: 48%;
        }

        .info-box:last-child {
            text-align: right;
        }

        .info-box-title {
            font-size: 10px;
            font-weight: 700;
            color: #e2b96f;
            letter-spacing: 2px;
            text-transform: uppercase;
            border-bottom: 1px solid #e2b96f;
            padding-bottom: 6px;
            margin-bottom: 10px;
        }

        .info-box-name {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 4px;
        }

        .info-box-detail {
            color: #555;
            font-size: 12px;
            margin-bottom: 3px;
        }

        /* DATES ROW */
        .dates-row {
            background: #f8f9ff;
            border: 1px solid #e0e6ff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            display: table;
            width: 100%;
        }

        .date-cell {
            display: table-cell;
            text-align: center;
            width: 33.33%;
            vertical-align: middle;
        }

        .date-divider {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            width: 5%;
            color: #1a1a2e;
            font-size: 18px;
        }

        .date-label {
            font-size: 10px;
            font-weight: 700;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .date-value {
            font-size: 15px;
            font-weight: 700;
            color: #1a1a2e;
        }

        .nights-badge {
            background: #1a1a2e;
            color: #e2b96f;
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
        }

        /* DETAILS TABLE */
        .section-heading {
            font-size: 11px;
            font-weight: 700;
            color: #e2b96f;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 12px;
            padding-bottom: 6px;
            border-bottom: 2px solid #1a1a2e;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .details-table thead tr {
            background: #1a1a2e;
            color: #fff;
        }

        .details-table thead th {
            padding: 12px 15px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .details-table tbody tr {
            border-bottom: 1px solid #eee;
        }

        .details-table tbody tr:last-child {
            border-bottom: none;
        }

        .details-table tbody td {
            padding: 14px 15px;
            color: #333;
        }

        .details-table tbody tr:nth-child(even) {
            background: #f8f9ff;
        }

        /* TOTAL SECTION */
        .total-section {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }

        .total-left {
            display: table-cell;
            width: 55%;
            vertical-align: top;
        }

        .total-right {
            display: table-cell;
            width: 45%;
            vertical-align: top;
        }

        .total-box {
            background: #1a1a2e;
            border-radius: 8px;
            padding: 20px 25px;
        }

        .total-row {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .total-row:last-child {
            margin-bottom: 0;
        }

        .total-row-label {
            display: table-cell;
            color: #a0c4ff;
            font-size: 12px;
        }

        .total-row-value {
            display: table-cell;
            text-align: right;
            color: #fff;
            font-size: 12px;
        }

        .total-divider-line {
            border: none;
            border-top: 1px solid #2d4a7a;
            margin: 10px 0;
        }

        .grand-total-label {
            color: #e2b96f;
            font-size: 14px;
            font-weight: 700;
        }

        .grand-total-value {
            color: #e2b96f;
            font-size: 18px;
            font-weight: 700;
        }

        /* NOTE BOX */
        .note-box {
            background: #fffbf0;
            border: 1px solid #f0d080;
            border-left: 4px solid #e2b96f;
            border-radius: 6px;
            padding: 14px 18px;
            font-size: 11px;
            color: #6b5900;
            line-height: 1.6;
        }

        /* POLICIES */
        .policies {
            background: #f8f9ff;
            border: 1px solid #e0e6ff;
            border-radius: 8px;
            padding: 18px 22px;
            margin-bottom: 25px;
        }

        .policy-item {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .policy-bullet {
            display: table-cell;
            width: 20px;
            color: #e2b96f;
            font-size: 14px;
            vertical-align: top;
        }

        .policy-text {
            display: table-cell;
            color: #445;
            font-size: 11px;
            line-height: 1.5;
        }

        /* QR/BOOKING ID SECTION */
        .booking-id-box {
            border: 2px dashed #1a1a2e;
            border-radius: 8px;
            padding: 15px 20px;
        }

        .booking-id-label {
            font-size: 10px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .booking-id-value {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a2e;
            letter-spacing: 3px;
        }

        /* FOOTER */
        .footer {
            background: #1a1a2e;
            padding: 20px 40px;
            display: table;
            width: 100%;
            margin-top: 10px;
        }

        .footer-left {
            display: table-cell;
            vertical-align: middle;
            width: 60%;
        }

        .footer-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 40%;
        }

        .footer-hotel-name {
            color: #e2b96f;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .footer-text {
            color: #a0c4ff;
            font-size: 10px;
            margin-top: 4px;
        }

        .footer-thanks {
            color: #fff;
            font-size: 12px;
            font-weight: 600;
        }

        .footer-sub {
            color: #888;
            font-size: 10px;
            margin-top: 3px;
        }

        /* WATERMARK for cancelled */
        .watermark {
            position: fixed;
            top: 40%;
            left: 50%;
            transform: translateX(-50%) rotate(-30deg);
            font-size: 80px;
            font-weight: 900;
            color: rgba(220, 53, 69, 0.08);
            text-transform: uppercase;
            letter-spacing: 10px;
            pointer-events: none;
            z-index: 0;
        }
    </style>
</head>
<body>

    @if($booking->status == 'cancelled')
    <div class="watermark">CANCELLED</div>
    @endif

    <!-- ==================== HEADER ==================== -->
    <div class="header">
        <div class="header-top">
            <div class="hotel-brand">
                <div class="hotel-name">&#9733; StayEase</div>
                <div class="hotel-tagline">Luxury Hotel &amp; Suites &mdash; Where Comfort Meets Class</div>
            </div>
            <div class="invoice-meta">
                <div class="invoice-title">Invoice</div>
                <div class="invoice-number">REF# SE-{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>
                <div class="invoice-date">Issued: {{ now()->format('d M Y') }}</div>
            </div>
        </div>
    </div>
    <div class="accent-bar"></div>

    <!-- ==================== STATUS BANNER ==================== -->
    @php
        $statusClass = match($booking->status) {
            'booked'    => 'status-confirmed',
            'pending'   => 'status-pending',
            'cancelled' => 'status-cancelled',
            'complete'  => 'status-complete',
            default     => 'status-pending',
        };
        $statusIcon = match($booking->status) {
            'booked'    => '&#10003; BOOKING CONFIRMED',
            'pending'   => '&#9201; BOOKING PENDING CONFIRMATION',
            'cancelled' => '&#10005; BOOKING CANCELLED',
            'complete'  => '&#9734; STAY COMPLETED',
            default     => '&#9201; PENDING',
        };
    @endphp
    <div class="status-banner {{ $statusClass }}">
        <div class="status-banner-cell">
            <span class="status-text">{!! $statusIcon !!}</span>
        </div>
        <div class="status-banner-cell" style="text-align:right;">
            <span style="font-size:11px; color:#666;">Booking ID: <strong>#{{ $booking->id }}</strong></span>
        </div>
    </div>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="content">

        <!-- GUEST BILLED TO / HOTEL INFO -->
        <div class="info-row">
            <div class="info-box">
                <div class="info-box-title">Billed To</div>
                <div class="info-box-name">{{ $booking->Guest }}</div>
                <div class="info-box-detail">{{ $booking->email ?? 'N/A' }}</div>
            </div>
            <div class="info-box">
                <div class="info-box-title">Hotel Details</div>
                <div class="info-box-name">StayEase Hotel</div>
                @if($admin)
                    <div class="info-box-detail">{{ $admin->address ?? '123 Luxury Avenue, Suite City' }}</div>
                    <div class="info-box-detail">{{ $admin->email ?? 'info@stayease.com' }}</div>
                    <div class="info-box-detail">{{ $admin->phone ?? 'N/A' }}</div>
                @else
                    <div class="info-box-detail">123 Luxury Avenue, Suite City</div>
                    <div class="info-box-detail">info@stayease.com</div>
                    <div class="info-box-detail">+92-300-0000000</div>
                @endif
            </div>
        </div>

        <!-- CHECK-IN / CHECK-OUT DATES -->
        <div class="dates-row">
            <div class="date-cell">
                <div class="date-label">Check-In</div>
                <div class="date-value">{{ \Carbon\Carbon::parse($booking->Check_in)->format('d M Y') }}</div>
                <div style="color:#888; font-size:11px; margin-top:3px;">From 2:00 PM</div>
            </div>
            <div class="date-divider">&#8594;</div>
            <div class="date-cell">
                <div class="date-label">Duration</div>
                <span class="nights-badge">{{ $booking->night }} Night{{ $booking->night > 1 ? 's' : '' }}</span>
            </div>
            <div class="date-divider">&#8594;</div>
            <div class="date-cell">
                <div class="date-label">Check-Out</div>
                <div class="date-value">{{ \Carbon\Carbon::parse($booking->Check_out)->format('d M Y') }}</div>
                <div style="color:#888; font-size:11px; margin-top:3px;">Until 12:00 PM</div>
            </div>
        </div>

        <!-- BOOKING DETAILS TABLE -->
        <div class="section-heading">Booking Details</div>
        <table class="details-table">
            <thead>
                <tr>
                    <th style="text-align:left;">Description</th>
                    <th style="text-align:center;">Room No.</th>
                    <th style="text-align:center;">Nights</th>
                    <th style="text-align:right;">Rate/Night</th>
                    <th style="text-align:right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $ratePerNight = $booking->night > 0 ? $booking->total_price / $booking->night : $booking->total_price;
                @endphp
                <tr>
                    <td>
                        <strong>{{ $booking->RoomType }}</strong><br>
                        <span style="color:#888; font-size:11px;">Comfortable stay with all amenities</span>
                    </td>
                    <td style="text-align:center;">
                        <strong>{{ $booking->RoomNo }}</strong>
                    </td>
                    <td style="text-align:center;">{{ $booking->night }}</td>
                    <td style="text-align:right;">${{ number_format($ratePerNight, 2) }}</td>
                    <td style="text-align:right;"><strong>${{ number_format($booking->total_price, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- TOTAL + NOTE -->
        <div class="total-section">
            <div class="total-left">
                <div class="note-box">
                    <strong>&#9432; Important Note:</strong><br>
                    This invoice is generated for your records. Please present this document at the front desk during check-in.
                    All prices are in USD. Taxes and service charges may apply at checkout.
                </div>
            </div>
            <div class="total-right">
                <div class="total-box">
                    <div class="total-row">
                        <span class="total-row-label">Subtotal</span>
                        <span class="total-row-value">${{ number_format($booking->total_price, 2) }}</span>
                    </div>
                    <div class="total-row">
                        <span class="total-row-label">Tax &amp; Service (0%)</span>
                        <span class="total-row-value">$0.00</span>
                    </div>
                    <hr class="total-divider-line">
                    <div class="total-row">
                        <span class="total-row-label grand-total-label">Total Amount</span>
                        <span class="total-row-value grand-total-value">${{ number_format($booking->total_price, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- HOTEL POLICIES -->
        <div class="section-heading">Hotel Policies</div>
        <div class="policies">
            <div class="policy-item">
                <span class="policy-bullet">&#8250;</span>
                <span class="policy-text">Check-in time starts at 2:00 PM. Early check-in is subject to availability.</span>
            </div>
            <div class="policy-item">
                <span class="policy-bullet">&#8250;</span>
                <span class="policy-text">Check-out time is 12:00 PM (noon). Late check-out may incur additional charges.</span>
            </div>
            <div class="policy-item">
                <span class="policy-bullet">&#8250;</span>
                <span class="policy-text">Cancellations made 24 hours before check-in are eligible for a full refund.</span>
            </div>
            <div class="policy-item">
                <span class="policy-bullet">&#8250;</span>
                <span class="policy-text">A valid government-issued photo ID is required at check-in.</span>
            </div>
            <div class="policy-item">
                <span class="policy-bullet">&#8250;</span>
                <span class="policy-text">Pets are not allowed on the premises.</span>
            </div>
        </div>

        <!-- BOOKING REFERENCE -->
        <div class="booking-id-box">
            <div class="booking-id-label">Booking Reference Number</div>
            <div class="booking-id-value">SE-{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>
            <div style="color:#888; font-size:11px; margin-top:5px;">Keep this reference for all future inquiries.</div>
        </div>

    </div>

    <!-- ==================== FOOTER ==================== -->
    <div class="footer">
        <div class="footer-left">
            <div class="footer-hotel-name">&#9733; STAYEASE HOTEL</div>
            <div class="footer-text">
                {{ $admin->address ?? '123 Luxury Avenue, Suite City' }} &bull;
                {{ $admin->email ?? 'info@stayease.com' }} &bull;
                {{ $admin->phone ?? 'N/A' }}
            </div>
        </div>
        <div class="footer-right">
            <div class="footer-thanks">Thank you for choosing us!</div>
            <div class="footer-sub">Generated on {{ now()->format('d M Y, h:i A') }}</div>
        </div>
    </div>

</body>
</html>
