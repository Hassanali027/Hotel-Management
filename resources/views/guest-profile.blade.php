<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Guest Profile - Lodgify Hotel Management System">
    <title>Guest Profile - Lodgify</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ===== LODGIFY DESIGN SYSTEM TOKENS ===== */
        :root {
            --blue-dark:   #8CD9CA;
            --blue-00:     #D5F6E5;
            --blue-10:     #EAFBF2;
            --blue-subtle: #F5FDF9;
            --lime-dark:   #CCD97E;
            --lime-00:     #E7F68E;
            --lime-10:     #F3F9C7;
            --lime-subtle: #F9FDE9;
            --red:         #FD4242;
            --red-light:   #FFC7C7;
            --red-subtle:  #FFEEEE;
            --black:       #0D0E0D;
            --white:       #FFFFFF;
            --gray-10:     #6E6E6E;
            --gray-bg:     #F8F8F8;
            --gray-line:   #E7E7E7;
            --gray-10:     #6E6E6E;
            --gray-20:     #838383;
            --primary:     #8CD9CA;
            --font:        'Lato', sans-serif;
        }

        /* ===== RESET ===== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { font-family: var(--font); background-color: var(--gray-bg); color: var(--black); font-size: 14px; }
        body { min-height: 100vh; }
        a { text-decoration: none; color: inherit; }

        /* ===== TOP HEADER BAR ===== */
        .top-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            height: 60px;
            background: var(--white);
            border-bottom: 1px solid var(--gray-line);
        }
        .header-left { display: flex; align-items: center; gap: 12px; }
        .back-arrow { font-size: 16px; color: var(--black); cursor: pointer; background: none; border: none; padding: 4px; }
        .page-title-group { display: flex; flex-direction: column; }
        .page-title { font-size: 18px; font-weight: 700; color: var(--black); line-height: 1.2; }
        .page-breadcrumb { font-size: 11px; color: var(--gray-20); }
        .page-breadcrumb a { color: var(--primary); }
        .header-right { display: flex; align-items: center; gap: 16px; }
        .header-user { display: flex; align-items: center; gap: 10px; }
        .header-user-avatar { width: 36px; height: 36px; border-radius: 50%; overflow: hidden; }
        .header-user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .header-user-info { display: flex; flex-direction: column; }
        .header-user-name { font-size: 13px; font-weight: 700; color: var(--black); line-height: 1.2; }
        .header-user-role { font-size: 11px; color: var(--gray-20); }
        .header-icon-btn { width: 36px; height: 36px; border-radius: 8px; border: 1px solid var(--gray-line); background: var(--white); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--gray-10); font-size: 15px; }

        /* ===== PAGE CONTAINER — 1248px Hug ===== */
        .page-wrapper { padding: 20px 24px; max-width: 1248px; margin: 0 auto; width: 100%; }

        /* ===== 2-COLUMN GRID: Left Profile + Right Content Container ===== */
        .main-grid {
            display: grid;
            grid-template-columns: 305px 1fr;
            gap: 20px;
            align-items: stretch;
        }
        .booking-room-container {
            display: grid;
            grid-template-columns: 1fr 288px;
            gap: 20px;
            align-items: start;
        }

        /* ===== CARD BASE ===== */
        .card {
            background: var(--white);
            border: 1px solid var(--gray-line);
            border-radius: 12px;
            overflow: hidden;
        }
        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px 10px;
        }
        .card-header h2 { font-size: 16px; font-weight: 500; color: var(--black); line-height: 125%; letter-spacing: 0; }
        .card-menu-btn { background: none; border: none; cursor: pointer; color: var(--gray-20); font-size: 18px; line-height: 1; padding: 2px 4px; border-radius: 4px; }
        .card-divider { height: 1px; background: var(--gray-line); margin: 0 16px; }
        .card-body { padding: 16px; }

        /* ===== LEFT COL — PROFILE CARD (305 × 557 Fill) ===== */
        .profile-card {
            min-height: 557px;
            border-radius: 12px;
            padding: 0;
            background-color: #FFFFFF;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .profile-card .card-body {
            display: flex;
            flex-direction: column;
            gap: 10px;
            justify-content: space-between;
            padding: 16px;
            flex: 1;
        }
        .profile-top { display: flex; align-items: center; gap: 12px; }
        .guest-avatar { width: 68px; height: 68px; border-radius: 50%; overflow: hidden; flex-shrink: 0; background-color: var(--lime-00); display: flex; align-items: center; justify-content: center; }
        .guest-avatar img { width: 100%; height: 100%; object-fit: cover; object-position: center; }
        .guest-name { font-size: 22px; font-weight: 700; color: #0F1113; line-height: 120%; }
        .guest-id { font-size: 11px; color: var(--gray-20); margin-top: 2px; }
        .contact-list { list-style: none; display: flex; flex-direction: column; gap: 9px; }
        .contact-item { display: flex; align-items: center; gap: 10px; font-size: 12px; font-weight: 400; line-height: 140%; letter-spacing: 0; color: var(--black); }
        .contact-icon { width: 22px; height: 22px; border-radius: 4px; background-color: var(--blue-00); display: flex; align-items: center; justify-content: center; font-size: 11px; color: var(--black); flex-shrink: 0; border: none; }
        .section-divider { height: 1px; background-color: var(--gray-line); margin: 16px 0; }
        .section-label { font-size: 14px; font-weight: 600; line-height: 140%; letter-spacing: 0; color: var(--black); margin-bottom: 8px; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px 10px; }
        .info-item label { display: block; font-size: 10px; font-weight: 400; line-height: 140%; letter-spacing: 0; color: var(--gray-10); margin-bottom: 1px; }
        .info-item span { display: block; font-size: 12px; font-weight: 400; line-height: 140%; letter-spacing: 0; color: var(--black); }

        /* Loyalty */
        .loyalty-section { }
        .loyalty-badge {
            display: inline-flex;
            align-items: center;
            background: var(--lime-00);
            color: var(--black);
            border-radius: 4px;
            padding: 2px 6px 3px 6px;
            font-size: 12px;
            font-weight: 400;
            line-height: 140%;
            letter-spacing: 0;
            margin: 4px 0 0px;
        }
        .loyalty-meta { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }

        /* ===== CENTER COL — BOOKING CARD (535 Fill × 525 Hug) ===== */
        .booking-card { height: 100%; display: flex; flex-direction: column; }
        .booking-card .card-body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex: 1;
        }
        .booking-confirmed-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: var(--blue-00);
            color: var(--black);
            border-radius: 4px;
            padding: 3px 6px;
            font-size: 10px;
            font-weight: 600;
            line-height: 140%;
            letter-spacing: 0;
            width: fit-content;
        }
        .booking-confirmed-badge i { font-size: 10px; }
        .booking-id-title { font-size: 22px; font-weight: 400; color: #0F1113; line-height: 120%; letter-spacing: 0; margin-bottom: 2px; }
        .booking-id-title span { font-weight: 700; }
        .booking-date-sub { font-size: 11px; font-weight: 400; line-height: 140%; color: var(--gray-10); margin-bottom: 12px; }
        .booking-details-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px 20px; }
        .booking-detail label { display: block; font-size: 10px; font-weight: 400; line-height: 140%; color: var(--gray-10); margin-bottom: 3px; }
        .booking-detail span { font-size: 12px; font-weight: 400; line-height: 140%; color: var(--black); }
        .booking-divider { height: 1px; background: var(--gray-line); margin: 14px -16px; }
        .notes-section { margin-top: 4px; }
        .notes-section label { display: block; font-size: 10px; font-weight: 400; line-height: 140%; color: var(--gray-10); margin-bottom: 3px; }
        .notes-section p { font-size: 12px; font-weight: 400; line-height: 140%; color: var(--black); margin: 0; }
        .extras-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
        .extras-col label { display: block; font-size: 10px; font-weight: 400; line-height: 140%; color: var(--gray-10); margin-bottom: 3px; }
        .extras-col span { font-size: 12px; font-weight: 400; line-height: 140%; color: var(--black); }
        .amenity-item { display: flex; align-items: center; gap: 6px; font-size: 11px; font-weight: 400; line-height: 140%; color: var(--black); margin-bottom: 6px; }
        .amenity-item i { color: #CDDC39; font-size: 10px; }
        .booking-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 18px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; height: 30px; padding: 0 12px; border-radius: 6px; font-size: 12px; font-weight: 500; line-height: 110%; cursor: pointer; transition: all 0.2s; font-family: var(--font); border: none; }
        .btn-outline { background: var(--gray-bg); border: 1px solid var(--gray-line); color: var(--black); }
        .btn-outline:hover { background: #E0E0E0; }
        .btn-danger { background: #FFEEEE; border: 1px solid var(--red); color: var(--red); }
        .btn-danger:hover { background: #FFD6D6; }

        /* ===== RIGHT COL — ROOM INFO (288 Fixed × 525 Fill) ===== */
        .right-col { display: flex; flex-direction: column; gap: 16px; height: 100%; }
        .right-col .card { border-radius: 8px; height: 100%; }
        .right-col .card-header { padding: 12px 16px 8px; }
        .right-col .card-divider { margin: 0 16px; }
        .view-detail-link { font-size: 12px; font-weight: 500; line-height: 110%; color: var(--gray-10); cursor: pointer; }
        .room-image-container { margin: 12px 16px; border-radius: 8px; overflow: hidden; height: 163px; }
        .room-image-container img { width: 100%; height: 100%; object-fit: cover; }
        .room-specs { display: flex; align-items: center; gap: 25px; padding: 0 16px 14px; flex-wrap: wrap; }
        .spec-item { display: flex; align-items: center; gap: 5px; font-size: 12px; color: var(--gray-10); }
        .spec-item i { color: var(--gray-20); font-size: 13px; }

        /* Price Summary */
        .price-summary-header { display: flex; align-items: center; gap: 5px; padding: 12px 16px 8px; }
        .price-summary-title { font-size: 14px; font-weight: 600; line-height: 140%; color: var(--black); }
        .paid-badge { display: inline-flex; align-items: center; padding: 3px 8px; border-radius: 4px; background: var(--lime-00); color: var(--black); font-size: 11px; font-weight: 600; }
        .price-rows { padding: 8px 16px; display: flex; flex-direction: column; gap: 6px; }
        .price-row { display: flex; justify-content: space-between; align-items: center; font-size: 12px; font-weight: 400; line-height: 140%; color: var(--gray-10); }
        .price-row .amount { font-weight: 400; color: var(--black); }
        .price-row.total { border-top: 1px solid var(--gray-line); padding-top: 8px; margin-top: 4px; font-weight: 700; color: var(--black); font-size: 14px; }
        .price-notes { padding: 10px 16px 14px; font-size: 11px; color: var(--gray-20); line-height: 1.5; }
        .price-notes strong { color: var(--gray-10); display: block; margin-bottom: 3px; font-size: 10px; }

        /* ===== BOOKING HISTORY TABLE ===== */
        .history-section { margin-top: 20px; width:1201px; }
        .history-card { background: var(--white); border-radius: 12px; border: 1px solid var(--gray-line); overflow: hidden; }
        .history-header { display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; }
        .history-header h2 { font-size: 16px; font-weight: 700; color: var(--black); }
        .history-controls { display: flex; align-items: center; gap: 10px; }
        .search-box { display: flex; align-items: center; gap: 8px; background: var(--white); border: 1px solid var(--gray-line); border-radius: 8px; padding: 6px 12px; font-size: 12px; color: var(--gray-20); min-width: 200px; }
        .date-filter { display: flex; align-items: center; gap: 6px; background: var(--white); border: 1px solid var(--gray-line); border-radius: 8px; padding: 6px 12px; font-size: 12px; color: var(--black); font-weight: 500; cursor: pointer; }
        .date-filter i { font-size: 13px; color: var(--gray-20); }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: var(--gray-bg); border-bottom: 1px solid var(--gray-line); }
        thead th { padding: 10px 14px; text-align: left; font-size: 11px; font-weight: 700; color: var(--gray-10); white-space: nowrap; }
        tbody tr { border-bottom: 1px solid var(--gray-line); transition: background 0.15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #FAFAFA; }
        tbody td { padding: 12px 14px; font-size: 12px; color: var(--black); vertical-align: middle; }
        .room-thumb { width: 60px; height: 44px; border-radius: 8px; overflow: hidden; }
        .room-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .booking-id-cell { font-weight: 700; font-size: 13px; }
        .date-cell .date { font-size: 12px; font-weight: 600; }
        .date-cell .time { font-size: 11px; color: var(--gray-20); }
        .badge { display: inline-flex; align-items: center; gap: 4px; border-radius: 6px; padding: 3px 9px; font-size: 11px; font-weight: 700; }
        .badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
        .badge-deluxe { background: #E8F5E9; color: #388E3C; }
        .badge-deluxe::before { background: #388E3C; }
        .badge-suite { background: #E3F2FD; color: #1565C0; }
        .badge-suite::before { background: #1565C0; }
        .row-menu-btn { background: none; border: none; cursor: pointer; color: var(--gray-20); font-size: 18px; padding: 4px 6px; border-radius: 4px; }
        .sort-arrows { display: inline-block; margin-left: 4px; font-size: 9px; color: var(--gray-20); vertical-align: middle; }

        /* ===== FOOTER ===== */
        .footer {
            background: var(--white);
            border-top: 1px solid var(--gray-line);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
        }
        .footer-copy { font-size: 12px; color: var(--gray-20); }
        .footer-links { display: flex; align-items: center; gap: 20px; }
        .footer-links a { font-size: 12px; color: var(--gray-10); transition: color 0.2s; }
        .footer-links a:hover { color: var(--primary); }
        .footer-socials { display: flex; align-items: center; gap: 14px; }
        .footer-socials a { font-size: 15px; color: var(--gray-20); transition: color 0.2s; }
        .footer-socials a:hover { color: var(--primary); }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1100px) { .main-grid { grid-template-columns: 305px 1fr; } .right-col { display: none; } }
        @media (max-width: 768px) { .main-grid { grid-template-columns: 1fr; } .booking-details-grid { grid-template-columns: 1fr 1fr; } }
    </style>
</head>
<body>

<!-- ===== TOP HEADER ===== -->
<!-- <header class="top-header">
    <div class="header-left">
        <button class="back-arrow"><i class="fa-solid fa-arrow-left"></i></button>
        <div class="page-title-group">
            <span class="page-title">Guest Profile</span>
            <span class="page-breadcrumb"><a href="#">Reservation</a> / Guest Profile</span>
        </div>
    </div>
    <div class="header-right">
        <div class="header-user">
            <div class="header-user-avatar">
                <img src="https://i.pravatar.cc/80?img=11" alt="Jaylon Dorwart">
            </div>
            <div class="header-user-info">
                <span class="header-user-name">Jaylon Dorwart</span>
                <span class="header-user-role">Admin</span>
            </div>
        </div>
        <button class="header-icon-btn"><i class="fa-solid fa-gear"></i></button>
        <button class="header-icon-btn"><i class="fa-solid fa-bell"></i></button>
    </div>
</header> -->

<!-- ===== PAGE BODY ===== -->
<main class="page-wrapper">
    <div class="main-grid">

        <!-- LEFT: PROFILE CARD (305 × 557) -->
        <aside>
            <div class="card profile-card">
                <div class="card-header">
                    <h2>Profile</h2>
                    <button class="card-menu-btn">&#8943;</button>
                </div>
                <div class="card-body">
                    <div class="profile-top">
                        <div class="guest-avatar">
                            <img src="/images/guset-image.png" alt="Angus Copper">
                        </div>
                        <div>
                            <div class="guest-name">Angus Copper</div>
                            <div class="guest-id">G011-987654321</div>
                        </div>
                    </div>
                    <div class="section-divider"></div>
                    <ul class="contact-list">
                        <li class="contact-item">
                            <div class="contact-icon">
                                <img src="/images/phone-icon.svg" style="width: 11px; height: 11px;" alt="Phone">
                            </div>
                            +1 (555) 789-1234
                        </li>
                        <li class="contact-item">
                            <div class="contact-icon">
                                <img src="/images/mail-icon.svg" style="width: 11px; height: 11px;" alt="Mail">
                            </div>
                            angus.copper@example.com
                        </li>
                    </ul>
                    <div class="section-divider"></div>
                    <div>
                        <div class="section-label">Personal Information</div>
                        <div class="info-grid">
                            <div class="info-item"><label>Date of Birth</label><span>June 15, 1985</span></div>
                            <div class="info-item"><label>Gender</label><span>Male</span></div>
                            <div class="info-item"><label>Nationality</label><span>American</span></div>
                            <div class="info-item"><label>Passport No.</label><span>A12345678</span></div>
                        </div>
                    </div>
                    <div class="section-divider"></div>
                    <div class="loyalty-section">
                        <div class="section-label">Loyalty Program</div>
                        <div><span style="font-size:10px; font-weight:400; line-height:140%; color:var(--gray-10);">Membership Status</span></div>
                        <div class="loyalty-badge">Platinum Member</div>
                        <div class="loyalty-meta">
                            <div class="info-item"><label>Points Balance</label><span>15,000 points</span></div>
                            <div class="info-item"><label>Tier Level</label><span style="display: inline-flex; align-items: center;"><img src="/images/elite-icon.svg" alt="Elite" style="width: 13px; height: 13px; margin-right: 4px;">Elite</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- CENTER: BOOKING & ROOM INFO IN ONE CARD -->
        <section>
            <div class="card booking-card">
                <div class="card-body" style="display: grid; grid-template-columns: 1fr 288px; gap: 20px;">
                    <div class="booking-details-container" style="display: flex; flex-direction: column; gap: 10px;">
                        <div class="card-header" style="padding: 0; border: none; margin-bottom: 4px;">
                            <h2>Booking Info</h2>
                            <button class="card-menu-btn">&#8230;</button>
                        </div>
                        <div class="booking-confirmed-badge">
                        <i class="fa-solid fa-check"></i> Booking Confirmed
                    </div>
                    <div class="booking-id-title">Booking ID: <span>LG-B00109</span></div>
                    <div class="booking-date-sub">June 17, 2024, 9.46 AM</div>
                    <div class="booking-details-grid">
                        <div class="booking-detail"><label>Room Type</label><span>Deluxe</span></div>
                        <div class="booking-detail"><label>Room Number</label><span>101</span></div>
                        <div class="booking-detail"><label>Price</label><span>$150<span style="font-size:10px;color:var(--gray-20);font-weight:400;">/night</span></span></div>
                    </div>
                    <div class="booking-details-grid">
                        <div class="booking-detail"><label>Guests</label><span>2 Adults</span></div>
                        <div class="booking-detail"><label>Requests</label><span>Late Check-Out</span></div>
                    </div>
                    <div class="booking-details-grid" style="margin-top:4px;">
                        <div class="booking-detail"><label>Check In</label><span>June 19, 2024<br><span style="font-size:11px;color:var(--gray-20);font-weight:400;">1:45 PM</span></span></div>
                        <div class="booking-detail"><label>Check Out</label><span>June 22, 2024<br><span style="font-size:11px;color:var(--gray-20);font-weight:400;">11:45 AM</span></span></div>
                        <div class="booking-detail"><label>Duration</label><span>3 nights</span></div>
                    </div>
                    <div class="notes-section">
                        <label>Notes</label>
                        <p>Guest requested extra pillows and towels. Ensure room service is available upon arrival.</p>
                    </div>
                    <div class="booking-divider"></div>
                    <div class="extras-grid">
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <div class="extras-col"><label>Loyalty Program</label><span>Platinum Member</span></div>
                            <div class="extras-col"><label>Transportation</label><span>Airport pickup arranged</span></div>
                        </div>
                        <div class="extras-col">
                            <label>Special Amenities</label>
                            <div class="amenity-item"><i class="fa-solid fa-check"></i> Complimentary breakfast</div>
                            <div class="amenity-item"><i class="fa-solid fa-check"></i> Free Wi-Fi</div>
                            <div class="amenity-item"><i class="fa-solid fa-check"></i> Access to gym and pool</div>
                        </div>
                        <div class="extras-col"><label>Extras</label><span>-</span></div>
                    </div>
                        <div class="booking-actions">
                            <button class="btn btn-outline">Edit</button>
                            <button class="btn btn-danger">Cancel Booking</button>
                        </div>
                    </div> <!-- End booking-details-container -->

                    <!-- RIGHT: ROOM INFO + PRICE SUMMARY -->
                    <aside class="right-col">
                        <div style="background-color: var(--gray-bg); border-radius: 8px; padding: 16px; height: 100%;">
                            <div class="card-header" style="padding: 0 0 10px 0;">
                    <span style="font-size:14px;font-weight:600;line-height:140%;color:var(--black);">Room Info</span>
                    <a href="#" class="view-detail-link">View Detail</a>
                </div>
                <div class="card-divider"></div>
                <div class="room-image-container">
                    <img src="images/room-info-hero.jpg" alt="Deluxe Room 101">
                </div>
                <div class="room-specs">
                    <div class="spec-item"><img src="images/square-icon.svg" alt="Area" style="width: 12.75px; height: 12.75px;"> 35 m²</div>
                    <div class="spec-item"><img src="images/room-king-icon.svg" alt="Bed" style="width: 12.75px; height: 12.75px;"> King Bed</div>
                    <div class="spec-item"><img src="images/two-guest.svg" alt="Guests" style="width: 12.75px; height: 12.75px;"> 2 guests</div>
                </div>
                <div class="card-divider" style="margin-top:0;"></div>
                <div class="price-summary-header">
                    <span class="price-summary-title">Price Summary</span>
                    <span class="paid-badge">Paid</span>
                </div>
                <div class="price-rows">
                    <div class="price-row"><span>Room and offer</span><span class="amount">$450.00</span></div>
                    <div class="price-row"><span>Extras</span><span class="amount">$0.00</span></div>
                    <div class="price-row"><span>8% VAT</span><span class="amount">$36.00</span></div>
                    <div class="price-row"><span>City Tax</span><span class="amount">$49.50</span></div>
                    <div class="price-row total"><span>Total Price</span><span>$535.50</span></div>
                </div>
                <div class="price-notes">
                    <strong>Notes</strong>
                    Invoice sent to corporate account; payment confirmed by BIG Corporation
                </div>
                </div>
                </div> <!-- End card-body -->
            </div>
        </section>

    <!-- BOOKING HISTORY -->
    <div class="history-section">
        <div class="history-card">
        <div class="history-header">
            <h2>Booking History</h2>
            <div class="history-controls">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Search guest, status, etc.</span>
                </div>
                <div class="date-filter">
                    <i class="fa-regular fa-calendar"></i>
                    19 - 24 June, 2028
                    <i class="fa-solid fa-chevron-down" style="margin-left:4px;color:var(--gray-20);"></i>
                </div>
            </div>
        </div>
        <div class="history-table">
            <table>
                <thead>
                    <tr>
                        <th>Image <span class="sort-arrows">&#8597;</span></th>
                        <th>Booking ID <span class="sort-arrows">&#8597;</span></th>
                        <th>Booking Date <span class="sort-arrows">&#8597;</span></th>
                        <th>Room Type <span class="sort-arrows">&#8597;</span></th>
                        <th>Room Number <span class="sort-arrows">&#8597;</span></th>
                        <th>Check-In <span class="sort-arrows">&#8597;</span></th>
                        <th>Check-Out <span class="sort-arrows">&#8597;</span></th>
                        <th>Guests <span class="sort-arrows">&#8597;</span></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="room-thumb">
                                <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=120&q=70" alt="Room">
                            </div>
                        </td>
                        <td><span class="booking-id-cell">LG-B00109</span></td>
                        <td><div class="date-cell"><div class="date">June 09, 2028</div><div class="time">9:08 AM</div></div></td>
                        <td><span class="badge badge-deluxe">Deluxe</span></td>
                        <td>Room 101</td>
                        <td><div class="date-cell"><div class="date">June 19, 2024</div><div class="time">1:45 PM</div></div></td>
                        <td><div class="date-cell"><div class="date">June 21, 2024</div><div class="time">11:45 AM</div></div></td>
                        <td>2 Guests</td>
                        <td><button class="row-menu-btn">&#8942;</button></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="room-thumb">
                                <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=120&q=70" alt="Room">
                            </div>
                        </td>
                        <td><span class="booking-id-cell">LG-B00085</span></td>
                        <td><div class="date-cell"><div class="date">March 20, 2028</div><div class="time">9:08 AM</div></div></td>
                        <td><span class="badge badge-suite">Suite</span></td>
                        <td>Room 305</td>
                        <td><div class="date-cell"><div class="date">March 25, 2028</div><div class="time">1:45 PM</div></div></td>
                        <td><div class="date-cell"><div class="date">March 30, 2028</div><div class="time">11:45 AM</div></div></td>
                        <td>1 Guest</td>
                        <td><button class="row-menu-btn">&#8942;</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</main>

<!-- ===== FOOTER ===== -->
<!-- <footer class="footer">
    <div class="footer-copy">Copyright &copy; 2024 Lodgify</div>
    <div class="footer-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Term and conditions</a>
        <a href="#">Contact</a>
    </div>
    <div class="footer-socials">
        <a href="#" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#" title="Twitter/X"><i class="fa-brands fa-x-twitter"></i></a>
        <a href="#" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
        <a href="#" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
    </div>
</footer> -->

</body>
</html>
