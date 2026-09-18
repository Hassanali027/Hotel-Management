<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation - Lodgify</title>
    
    <!-- Google Fonts: Lato -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400;1,700&display=swap" rel="stylesheet">
    
    <style>
        /* ==========================================
           1. COLOR PALETTE SYSTEM (IMAGE 2 COPIED)
           ========================================== */
        :root {
            /* Blue Palette */
            --color-blue-dark: #B5D9CA;
            --color-blue-00: #D1F4E5;
            --color-blue-10: #EAFBF3;
            --color-blue-subtle: #F3FDF9;

            /* Lime Palette */
            --color-lime-dark: #CCD97E;
            --color-lime-00: #E7F6A8;
            --color-lime-10: #F3FCC7;
            --color-lime-subtle: #F9FDE3;

            /* Red Palette */
            --color-red: #FF4D4D;
            --color-red-light: #FFC7C7;
            --color-red-subtle: #FFEEEE;

            /* Neutral Palette */
            --color-black: #0D0D0D;
            --color-white: #FFFFFF;
            --color-gray-10: #656565;
            --color-gray-20: #9A9A9A;
            --color-gray-line: #E7E7E7;
            --color-gray-bg: #F8F8F8;
        }

        /* ==========================================
           2. TYPOGRAPHY SYSTEM (IMAGE 3 COPIED)
           ========================================== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Lato', sans-serif;
        }

        body {
            background-color: var(--color-gray-bg);
            color: var(--color-black);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px 16px;
            -webkit-font-smoothing: antialiased;
        }

        /* Typography Helper Classes */
        .display-1 { font-size: 32px; font-weight: 600; line-height: 1.2; }
        .display-2 { font-size: 28px; font-weight: 600; line-height: 1.2; }
        .display-3 { font-size: 26px; font-weight: 600; line-height: 1.3; }
        .display-4 { font-size: 24px; font-weight: 500; line-height: 1.3; }
        .title-1   { font-size: 22px; font-weight: 700; line-height: 1.3; }
        .title-2   { font-size: 20px; font-weight: 600; line-height: 1.4; }
        .title-3   { font-size: 18px; font-weight: 500; line-height: 1.4; }
        .title-4   { font-size: 16px; font-weight: 600; line-height: 1.4; }
        .body-regular { font-size: 14px; font-weight: 400; line-height: 1.5; }
        .body-bold    { font-size: 14px; font-weight: 700; line-height: 1.5; }
        .small-regular  { font-size: 14px; font-weight: 400; }
        .small-semibold { font-size: 14px; font-weight: 600; }
        .xsmall-regular  { font-size: 12px; font-weight: 400; }
        .xsmall-medium   { font-size: 12px; font-weight: 500; }
        .xsmall-semibold { font-size: 12px; font-weight: 600; }
        .xsmall-caps     { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }

        /* ==========================================
           3. LAYOUT & CANVAS (IMAGE 1: 1200 Fill)
           ========================================== */
        .page-container {
            width: 100%;
            max-width: 1200px;
            height: 903px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Top Header Bar */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--color-black);
            letter-spacing: -0.3px;
        }

        .header-profile-section {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            background-color: var(--color-blue-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--color-black);
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--color-black);
            line-height: 1.2;
        }

        .user-role {
            font-size: 12px;
            color: var(--color-gray-10);
        }

        .icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: var(--color-white);
            border: 1px solid var(--color-gray-line);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
        }

        .icon-btn:hover {
            background-color: var(--color-gray-bg);
            border-color: var(--color-gray-20);
        }

        .icon-btn .badge-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background-color: var(--color-red);
            border-radius: 50%;
            border: 1.5px solid var(--color-white);
        }

        /* Main Card Container (Figma 1200 x 903 Hug) */
        .reservation-card {
            background-color: var(--color-white);
            border-radius: 16px;
            border: 1px solid var(--color-gray-line);
            box-shadow: 0px 4px 24px rgba(0, 0, 0, 0.03);
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Action Bar / Control Bar */
        .card-action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .card-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--color-black);
        }

        .action-controls {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* Search Input */
        .search-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-box svg {
            position: absolute;
            left: 12px;
            color: var(--color-gray-20);
            pointer-events: none;
        }

        .search-input {
            background-color: var(--color-gray-bg);
            border: 1px solid var(--color-gray-line);
            border-radius: 8px;
            padding: 9px 12px 9px 36px;
            font-size: 13px;
            color: var(--color-black);
            width: 240px;
            outline: none;
            transition: all 0.2s ease;
        }

        .search-input:focus {
            border-color: var(--color-blue-dark);
            background-color: var(--color-white);
            box-shadow: 0 0 0 3px rgba(181, 217, 202, 0.25);
        }

        .search-input::placeholder {
            color: var(--color-gray-20);
        }

        /* Custom Dropdown Buttons */
        .dropdown-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background-color: var(--color-white);
            border: 1px solid var(--color-gray-line);
            border-radius: 8px;
            padding: 8px 14px;
            font-size: 13px;
            font-weight: 600;
            color: #000;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
            user-select: none;
        }

        .dropdown-btn:hover {
            border-color: var(--color-gray-20);
            background-color: var(--color-gray-bg);
        }

        .dropdown-btn svg {
            color: #6E6E6E;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 6px;
            background-color: var(--color-white);
            border: 1px solid var(--color-gray-line);
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            width: 170px;
            display: none;
            flex-direction: column;
            z-index: 50;
            overflow: hidden;
        }

        .dropdown-menu.active {
            display: flex;
        }

        .dropdown-item {
            padding: 10px 14px;
            font-size: 13px;
            color: var(--color-black);
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .dropdown-item:hover {
            background-color: var(--color-blue-subtle);
            color: var(--color-black);
            font-weight: 600;
        }

        /* Primary Add Booking Button */
        .btn-add-booking {
            display: flex;
            align-items: center;
            gap: 6px;
            background-color: var(--color-lime-00);
            border: none;
            border-radius: 8px;
            padding: 9px 18px;
            font-size: 14px;
            font-weight: 700;
            color: var(--color-black);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-add-booking:hover {
            background-color: var(--color-lime-dark);
            transform: translateY(-1px);
        }

        .btn-add-booking:active {
            transform: translateY(0);
        }

        /* ==========================================
           4. DATA TABLE STYLING
           ========================================== */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border-radius: 8px;
        }

        .reservation-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            min-width: 950px;
        }

        .reservation-table th {
            background-color: var(--color-blue-subtle);
            padding: 0 30px;
            height: 47px;
            font-size: 13px;
            font-weight: 600;
            color: #6E6E6E;
            border-bottom: none;
            cursor: pointer;
            user-select: none;
            transition: background 0.15s ease;
        }

        .reservation-table th:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .reservation-table th:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .reservation-table th:hover {
            background-color: var(--color-blue-10);
            color: var(--color-black);
        }

        .reservation-table th .sort-icon {
            display: inline-block;
            margin-left: 4px;
            font-size: 11px;
            color: var(--color-gray-20);
        }

        .reservation-table td {
            padding: 14px 30px;
            font-size: 12px;
            font-weight: 400;
            line-height: 1.4;
            color: var(--color-black);
            border-bottom: 1px solid var(--color-gray-line);
            vertical-align: middle;
        }

        .reservation-table tbody tr {
            transition: background-color 0.15s ease;
        }

        .reservation-table tbody tr:hover {
            background-color: var(--color-blue-subtle);
        }

        /* Guest Column Styling */
        .guest-name {
            font-weight: 400;
            font-size: 12px;
            color: var(--color-black);
        }

        .guest-id {
            font-size: 12px;
            color: var(--color-gray-20);
            margin-top: 2px;
        }

        .text-subtle {
            color: var(--color-gray-10);
        }

        /* ==========================================
           5. BADGES SYSTEM (IMAGE 4 COPIED)
           ========================================== */
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 400;
            width: 70px;
            height: 20px;
        }

        .badge-confirmed, .badge-active, .badge-available {
            background-color: var(--color-blue-00);
            /* color: #0F6B40; */
        }

        .badge-pending, .badge-inactive, .badge-out-of-stock {
            background-color: var(--color-red-subtle);
            width: 51px;
            /* color: #D93838; */
        }

        .badge-deluxe, .badge-checked-in, .badge-ready {
            background-color: var(--color-lime-00);
            color: #4C5D08;
        }

        .badge-standard {
            background-color: var(--color-blue-10);
            color: #176043;
        }

        .badge-suite {
            background-color: var(--color-lime-10);
            color: #556608;
        }

        /* Action Column Layout & Buttons */
        .action-cell {
            display: flex;
            align-items: center;
        }

        .action-icon-btn {
            background-color: var(--color-gray-bg);
            border: none;
            cursor: pointer;
            color: var(--color-gray-20);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            padding: 0;
            transition: all 0.2s ease;
        }

        .action-icon-btn:nth-child(1) {
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
            border-right: 2px solid var(--color-white);
        }

        .action-icon-btn:nth-child(2) {
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
            margin-right: 13px;
        }

        .action-icon-btn:hover {
            color: var(--color-black);
            background-color: var(--color-gray-line);
        }

        .btn-action-cancel {
            background-color: var(--color-red-subtle);
            color: #6E6E6E;
            border: none;
            border-radius: 6px;
            padding: 0;
            width: 65px;
            height: 30px;
            font-size: 13px;
            font-weight: 400;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-action-cancel:hover {
            background-color: var(--color-red-light);
        }

        .btn-action-confirm {
            background-color: var(--color-lime-00);
            color: #000;
            border: none;
            border-radius: 6px;
            padding: 0;
            width: 65px;
            height: 30px;
            font-size: 13px;
            font-weight: 400;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-action-confirm:hover {
            background-color: var(--color-lime-dark);
        }

        /* ==========================================
           6. PAGINATION FOOTER
           ========================================== */
        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 4px;
        }

        .showing-text {
            font-size: 13px;
            color: var(--color-gray-20);
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-btn {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            border: none;
            background-color: #F8F8F8;
            font-size: 13px;
            font-weight: 400;
            color: var(--color-black);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
            user-select: none;
        }

        .page-btn:hover:not(.active):not(.disabled) {
            background-color: var(--color-gray-line);
        }

        .page-btn.active {
            background-color: #E7F68E;
            color: var(--color-black);
        }

        .page-btn.disabled {
            color: var(--color-black);
            cursor: default;
        }

        /* ==========================================
           7. PAGE FOOTER
           ========================================== */
        .page-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 12px 0 24px 0;
            font-size: 12px;
            color: var(--color-gray-20);
            border-top: 1px dotted var(--color-gray-line);
            margin-top: 8px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-links {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .footer-links a {
            color: var(--color-gray-20);
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .footer-links a:hover {
            color: var(--color-black);
        }

        .social-icons {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .social-icon {
            color: var(--color-gray-20);
            text-decoration: none;
            transition: color 0.15s ease;
            display: flex;
            align-items: center;
        }

        .social-icon:hover {
            color: var(--color-black);
        }

        /* ==========================================
           8. MODAL DIALOGS
           ========================================== */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(13, 13, 13, 0.4);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 100;
            padding: 16px;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-card {
            background-color: var(--color-white);
            border-radius: 16px;
            width: 100%;
            max-width: 500px;
            padding: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            gap: 20px;
            animation: modalFadeIn 0.2s ease-out;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.96); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--color-black);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            color: var(--color-gray-20);
            cursor: pointer;
            padding: 4px;
        }

        .modal-close:hover {
            color: var(--color-black);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--color-black);
        }

        .form-input, .form-select {
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid var(--color-gray-line);
            font-size: 14px;
            outline: none;
            background-color: var(--color-gray-bg);
            transition: all 0.2s ease;
        }

        .form-input:focus, .form-select:focus {
            border-color: var(--color-blue-dark);
            background-color: var(--color-white);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 8px;
        }

        .btn-secondary {
            background-color: var(--color-gray-bg);
            border: 1px solid var(--color-gray-line);
            padding: 9px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background-color: var(--color-gray-line);
        }
    </style>
</head>
<body>

    <div class="page-container">
        <!-- 2. MAIN RESERVATION LIST CARD (1200 x 903 HUG) -->
        <main class="reservation-card">
            
            <!-- Card Header Controls -->
            <div class="card-action-bar">
                <h2 class="card-title">Reservation List</h2>

                <div class="action-controls">
                    <!-- Search Input -->
                    <div class="search-box">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" id="searchInput" class="search-input" placeholder="Search guest, Status, etc.">
                    </div>

                    <!-- Filter Status Dropdown -->
                    <div style="position: relative;">
                        <button class="dropdown-btn" id="statusFilterBtn">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                            <span id="statusFilterLabel">All Status</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>

                        <div class="dropdown-menu" id="statusDropdownMenu">
                            <div class="dropdown-item" onclick="filterByStatus('All Status')">All Status</div>
                            <div class="dropdown-item" onclick="filterByStatus('Confirmed')">Confirmed</div>
                            <div class="dropdown-item" onclick="filterByStatus('Pending')">Pending</div>
                        </div>
                    </div>

                    <!-- Date Range Dropdown -->
                    <div style="position: relative;">
                        <button class="dropdown-btn" id="dateFilterBtn">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span id="dateFilterLabel">19 - 24 June, 2028</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>

                        <div class="dropdown-menu" id="dateDropdownMenu">
                            <div class="dropdown-item" onclick="setDateFilter('19 - 24 June, 2028')">19 - 24 June, 2028</div>
                            <div class="dropdown-item" onclick="setDateFilter('All Dates')">All Dates</div>
                            <div class="dropdown-item" onclick="setDateFilter('This Week')">This Week</div>
                        </div>
                    </div>

                    <!-- Add Booking Button -->
                    <button class="btn-add-booking" onclick="openAddBookingModal()">
                        Add Booking
                    </button>
                </div>
            </div>

            <!-- 3. RESERVATION DATA TABLE (12 EXACT FIGMA ROWS) -->
            <div class="table-responsive">
                <table class="reservation-table" id="reservationTable">
                    <thead>
                        <tr>
                            <th onclick="sortTable(0)">Guest <span class="sort-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle; margin-bottom: 2px;"><polyline points="7 15 12 20 17 15"></polyline><polyline points="7 9 12 4 17 9"></polyline></svg></span></th>
                            <th onclick="sortTable(1)">Room <span class="sort-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle; margin-bottom: 2px;"><polyline points="7 15 12 20 17 15"></polyline><polyline points="7 9 12 4 17 9"></polyline></svg></span></th>
                            <th onclick="sortTable(2)">Request <span class="sort-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle; margin-bottom: 2px;"><polyline points="7 15 12 20 17 15"></polyline><polyline points="7 9 12 4 17 9"></polyline></svg></span></th>
                            <th onclick="sortTable(3)">Duration <span class="sort-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle; margin-bottom: 2px;"><polyline points="7 15 12 20 17 15"></polyline><polyline points="7 9 12 4 17 9"></polyline></svg></span></th>
                            <th onclick="sortTable(4)">Check-In & Check-Out <span class="sort-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle; margin-bottom: 2px;"><polyline points="7 15 12 20 17 15"></polyline><polyline points="7 9 12 4 17 9"></polyline></svg></span></th>
                            <th onclick="sortTable(5)">Status <span class="sort-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle; margin-bottom: 2px;"><polyline points="7 15 12 20 17 15"></polyline><polyline points="7 9 12 4 17 9"></polyline></svg></span></th>
                            <th>Action <span class="sort-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle; margin-bottom: 2px;"><polyline points="7 15 12 20 17 15"></polyline><polyline points="7 9 12 4 17 9"></polyline></svg></span></th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Row 1 -->
                        <tr data-status="Confirmed">
                            <td>
                                <div class="guest-name">Angus Copper</div>
                                <div class="guest-id">ID-890009</div>
                            </td>
                            <td>Deluxe 101</td>
                            <td>Late Check-Out</td>
                            <td>3 nights</td>
                            <td>June 19, 2028 &nbsp;–&nbsp; June 22, 2028</td>
                            <td><span class="badge badge-confirmed">Confirmed</span></td>
                            <td>
                                <div class="action-cell">
                                    <button class="action-icon-btn" onclick="viewDetails('Angus Copper', 'ID-890009', 'Deluxe 101', 'Confirmed')" title="View">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </button>
                                    <button class="action-icon-btn" onclick="editRow(this)" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button class="btn-action-cancel" onclick="toggleRowStatus(this)">Cancel</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr data-status="Confirmed">
                            <td>
                                <div class="guest-name">Catherine Lapp</div>
                                <div class="guest-id">ID-890010</div>
                            </td>
                            <td>Standard 202</td>
                            <td>None</td>
                            <td>2 nights</td>
                            <td>June 19, 2028 &nbsp;–&nbsp; June 21, 2028</td>
                            <td><span class="badge badge-confirmed">Confirmed</span></td>
                            <td>
                                <div class="action-cell">
                                    <button class="action-icon-btn" onclick="viewDetails('Catherine Lapp', 'ID-890010', 'Standard 202', 'Confirmed')" title="View">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </button>
                                    <button class="action-icon-btn" onclick="editRow(this)" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button class="btn-action-cancel" onclick="toggleRowStatus(this)">Cancel</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr data-status="Pending">
                            <td>
                                <div class="guest-name">Edgar Irving</div>
                                <div class="guest-id">ID-890011</div>
                            </td>
                            <td>Suite 303</td>
                            <td>Extra Pillow</td>
                            <td>5 nights</td>
                            <td>June 19, 2028 &nbsp;–&nbsp; June 24, 2028</td>
                            <td><span class="badge badge-pending">Pending</span></td>
                            <td>
                                <div class="action-cell">
                                    <button class="action-icon-btn" onclick="viewDetails('Edgar Irving', 'ID-890011', 'Suite 303', 'Pending')" title="View">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </button>
                                    <button class="action-icon-btn" onclick="editRow(this)" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button class="btn-action-confirm" onclick="toggleRowStatus(this)">Confirm</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr data-status="Confirmed">
                            <td>
                                <div class="guest-name">Gertrude Bbie</div>
                                <div class="guest-id">ID-890012</div>
                            </td>
                            <td>Standard 204</td>
                            <td>Early Check-In</td>
                            <td>1 nights</td>
                            <td>June 19, 2028 &nbsp;–&nbsp; June 20, 2028</td>
                            <td><span class="badge badge-confirmed">Confirmed</span></td>
                            <td>
                                <div class="action-cell">
                                    <button class="action-icon-btn" onclick="viewDetails('Gertrude Bbie', 'ID-890012', 'Standard 204', 'Confirmed')" title="View">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </button>
                                    <button class="action-icon-btn" onclick="editRow(this)" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button class="btn-action-cancel" onclick="toggleRowStatus(this)">Cancel</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 5 -->
                        <tr data-status="Pending">
                            <td>
                                <div class="guest-name">Iza S. Holsnd</div>
                                <div class="guest-id">ID-890013</div>
                            </td>
                            <td>Deluxe 105</td>
                            <td>Airport Pickup</td>
                            <td>4 nights</td>
                            <td>June 19, 2028 &nbsp;–&nbsp; June 23, 2028</td>
                            <td><span class="badge badge-pending">Pending</span></td>
                            <td>
                                <div class="action-cell">
                                    <button class="action-icon-btn" onclick="viewDetails('Iza S. Holsnd', 'ID-890013', 'Deluxe 105', 'Pending')" title="View">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </button>
                                    <button class="action-icon-btn" onclick="editRow(this)" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button class="btn-action-confirm" onclick="toggleRowStatus(this)">Confirm</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 6 -->
                        <tr data-status="Confirmed">
                            <td>
                                <div class="guest-name">Sarah Johnson</div>
                                <div class="guest-id">ID-890014</div>
                            </td>
                            <td>Standard 205</td>
                            <td>High Floor</td>
                            <td>2 nights</td>
                            <td>June 20, 2028 &nbsp;–&nbsp; June 22, 2028</td>
                            <td><span class="badge badge-confirmed">Confirmed</span></td>
                            <td>
                                <div class="action-cell">
                                    <button class="action-icon-btn" onclick="viewDetails('Sarah Johnson', 'ID-890014', 'Standard 205', 'Confirmed')" title="View">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </button>
                                    <button class="action-icon-btn" onclick="editRow(this)" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button class="btn-action-cancel" onclick="toggleRowStatus(this)">Cancel</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 7 -->
                        <tr data-status="Confirmed">
                            <td>
                                <div class="guest-name">Kevin Lee</div>
                                <div class="guest-id">ID-890015</div>
                            </td>
                            <td>Suite 306</td>
                            <td>None</td>
                            <td>3 nights</td>
                            <td>June 20, 2028 &nbsp;–&nbsp; June 23, 2028</td>
                            <td><span class="badge badge-confirmed">Confirmed</span></td>
                            <td>
                                <div class="action-cell">
                                    <button class="action-icon-btn" onclick="viewDetails('Kevin Lee', 'ID-890015', 'Suite 306', 'Confirmed')" title="View">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </button>
                                    <button class="action-icon-btn" onclick="editRow(this)" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button class="btn-action-cancel" onclick="toggleRowStatus(this)">Cancel</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 8 -->
                        <tr data-status="Confirmed">
                            <td>
                                <div class="guest-name">Laura Martin</div>
                                <div class="guest-id">ID-890016</div>
                            </td>
                            <td>Deluxe 107</td>
                            <td>Extra Towels</td>
                            <td>1 nights</td>
                            <td>June 20, 2028 &nbsp;–&nbsp; June 21, 2028</td>
                            <td><span class="badge badge-confirmed">Confirmed</span></td>
                            <td>
                                <div class="action-cell">
                                    <button class="action-icon-btn" onclick="viewDetails('Laura Martin', 'ID-890016', 'Deluxe 107', 'Confirmed')" title="View">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </button>
                                    <button class="action-icon-btn" onclick="editRow(this)" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button class="btn-action-cancel" onclick="toggleRowStatus(this)">Cancel</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 9 -->
                        <tr data-status="Pending">
                            <td>
                                <div class="guest-name">Robert King</div>
                                <div class="guest-id">ID-890017</div>
                            </td>
                            <td>Standard 208</td>
                            <td>Late Check-Out</td>
                            <td>2 nights</td>
                            <td>June 21, 2028 &nbsp;–&nbsp; June 23, 2028</td>
                            <td><span class="badge badge-pending">Pending</span></td>
                            <td>
                                <div class="action-cell">
                                    <button class="action-icon-btn" onclick="viewDetails('Robert King', 'ID-890017', 'Standard 208', 'Pending')" title="View">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </button>
                                    <button class="action-icon-btn" onclick="editRow(this)" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button class="btn-action-confirm" onclick="toggleRowStatus(this)">Confirm</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 10 -->
                        <tr data-status="Confirmed">
                            <td>
                                <div class="guest-name">Olivia White</div>
                                <div class="guest-id">ID-890018</div>
                            </td>
                            <td>Suite 309</td>
                            <td>Airport Pickup</td>
                            <td>4 nights</td>
                            <td>June 21, 2028 &nbsp;–&nbsp; June 25, 2028</td>
                            <td><span class="badge badge-confirmed">Confirmed</span></td>
                            <td>
                                <div class="action-cell">
                                    <button class="action-icon-btn" onclick="viewDetails('Olivia White', 'ID-890018', 'Suite 309', 'Confirmed')" title="View">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </button>
                                    <button class="action-icon-btn" onclick="editRow(this)" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button class="btn-action-cancel" onclick="toggleRowStatus(this)">Cancel</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 11 -->
                        <tr data-status="Pending">
                            <td>
                                <div class="guest-name">Davis Sepson</div>
                                <div class="guest-id">ID-890019</div>
                            </td>
                            <td>Deluxe 110</td>
                            <td>Early Check-In</td>
                            <td>3 nights</td>
                            <td>June 21, 2028 &nbsp;–&nbsp; June 24, 2028</td>
                            <td><span class="badge badge-pending">Pending</span></td>
                            <td>
                                <div class="action-cell">
                                    <button class="action-icon-btn" onclick="viewDetails('Davis Sepson', 'ID-890019', 'Deluxe 110', 'Pending')" title="View">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </button>
                                    <button class="action-icon-btn" onclick="editRow(this)" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button class="btn-action-confirm" onclick="toggleRowStatus(this)">Confirm</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 12 -->
                        <tr data-status="Confirmed">
                            <td>
                                <div class="guest-name">Martin Curtis</div>
                                <div class="guest-id">ID-890020</div>
                            </td>
                            <td>Standard 211</td>
                            <td>None</td>
                            <td>5 nights</td>
                            <td>June 22, 2028 &nbsp;–&nbsp; June 27, 2028</td>
                            <td><span class="badge badge-confirmed">Confirmed</span></td>
                            <td>
                                <div class="action-cell">
                                    <button class="action-icon-btn" onclick="viewDetails('Martin Curtis', 'ID-890020', 'Standard 211', 'Confirmed')" title="View">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </button>
                                    <button class="action-icon-btn" onclick="editRow(this)" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button class="btn-action-cancel" onclick="toggleRowStatus(this)">Cancel</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- 4. PAGINATION FOOTER -->
            <div class="card-footer">
                <span class="showing-text" id="showingText">Showing 1-12 of 390</span>
                
                <div class="pagination">
                    <button class="page-btn active" onclick="setPage(1, this)">1</button>
                    <button class="page-btn" onclick="setPage(2, this)">2</button>
                    <button class="page-btn" onclick="setPage(3, this)">3</button>
                    <span class="page-btn disabled">...</span>
                    <button class="page-btn" onclick="setPage(8, this)">8</button>
                    <button class="page-btn" onclick="changePage(this)"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg></button>
                </div>
            </div>

        </main>



    </div>

    <!-- 6. ADD BOOKING MODAL -->
    <div class="modal-overlay" id="addBookingModal">
        <div class="modal-card">
            <div class="modal-header">
                <h3 class="modal-title">Add New Booking</h3>
                <button class="modal-close" onclick="closeModal('addBookingModal')">✕</button>
            </div>
            
            <form id="addBookingForm" onsubmit="submitNewBooking(event)">
                <div class="form-group" style="margin-bottom: 12px;">
                    <label class="form-label">Guest Full Name</label>
                    <input type="text" id="modalGuestName" class="form-input" placeholder="e.g. Eleanor Vance" required>
                </div>

                <div class="form-grid" style="margin-bottom: 12px;">
                    <div class="form-group">
                        <label class="form-label">Room Type</label>
                        <select id="modalRoom" class="form-select" required>
                            <option value="Deluxe 112">Deluxe 112</option>
                            <option value="Standard 215">Standard 215</option>
                            <option value="Suite 310">Suite 310</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Special Request</label>
                        <input type="text" id="modalRequest" class="form-input" placeholder="e.g. Late Check-Out">
                    </div>
                </div>

                <div class="form-grid" style="margin-bottom: 12px;">
                    <div class="form-group">
                        <label class="form-label">Duration</label>
                        <input type="text" id="modalDuration" class="form-input" placeholder="e.g. 3 nights" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select id="modalStatus" class="form-select">
                            <option value="Confirmed">Confirmed</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label">Check-In & Check-Out Dates</label>
                    <input type="text" id="modalDates" class="form-input" placeholder="e.g. June 25, 2028 – June 28, 2028" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal('addBookingModal')">Cancel</button>
                    <button type="submit" class="btn-add-booking">Save Booking</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 7. VIEW DETAILS MODAL -->
    <div class="modal-overlay" id="viewModal">
        <div class="modal-card">
            <div class="modal-header">
                <h3 class="modal-title">Reservation Details</h3>
                <button class="modal-close" onclick="closeModal('viewModal')">✕</button>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <div style="background-color: var(--color-blue-subtle); padding: 14px; border-radius: 8px;">
                    <h4 style="font-size: 16px; font-weight: 700;" id="viewGuestName">Guest Name</h4>
                    <p style="font-size: 12px; color: var(--color-gray-10);" id="viewGuestId">ID-000000</p>
                </div>
                <p><strong>Room:</strong> <span id="viewRoom">Standard 101</span></p>
                <p><strong>Status:</strong> <span id="viewStatusBadge" class="badge">Confirmed</span></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-add-booking" onclick="closeModal('viewModal')">Close</button>
            </div>
        </div>
    </div>

    <!-- ==========================================
       8. INTERACTIVE JAVASCRIPT LOGIC
       ========================================== -->
    <script>
        // Dropdown toggles
        const statusFilterBtn = document.getElementById('statusFilterBtn');
        const statusDropdownMenu = document.getElementById('statusDropdownMenu');
        const dateFilterBtn = document.getElementById('dateFilterBtn');
        const dateDropdownMenu = document.getElementById('dateDropdownMenu');

        statusFilterBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            statusDropdownMenu.classList.toggle('active');
            dateDropdownMenu.classList.remove('active');
        });

        dateFilterBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dateDropdownMenu.classList.toggle('active');
            statusDropdownMenu.classList.remove('active');
        });

        document.addEventListener('click', () => {
            statusDropdownMenu.classList.remove('active');
            dateDropdownMenu.classList.remove('active');
        });

        // Search Input Filter
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');

        searchInput.addEventListener('keyup', filterTable);

        function filterTable() {
            const query = searchInput.value.toLowerCase().trim();
            const rows = tableBody.getElementsByTagName('tr');

            let visibleCount = 0;
            for (let row of rows) {
                const text = row.innerText.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }

            document.getElementById('showingText').innerText = `Showing 1-${visibleCount} of 390`;
        }

        // Filter by status dropdown
        function filterByStatus(status) {
            document.getElementById('statusFilterLabel').innerText = status;
            statusDropdownMenu.classList.remove('active');

            const rows = tableBody.getElementsByTagName('tr');
            let visibleCount = 0;
            for (let row of rows) {
                const rowStatus = row.getAttribute('data-status');
                if (status === 'All Status' || rowStatus === status) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }
            document.getElementById('showingText').innerText = `Showing 1-${visibleCount} of 390`;
        }

        // Date filter selection
        function setDateFilter(label) {
            document.getElementById('dateFilterLabel').innerText = label;
            dateDropdownMenu.classList.remove('active');
        }

        // Toggle Status (Confirm / Cancel)
        function toggleRowStatus(btn) {
            const row = btn.closest('tr');
            const badge = row.querySelector('.badge');

            if (btn.classList.contains('btn-action-cancel')) {
                // Change to Pending
                badge.className = 'badge badge-pending';
                badge.innerText = 'Pending';
                row.setAttribute('data-status', 'Pending');
                btn.className = 'btn-action-confirm';
                btn.innerText = 'Confirm';
            } else {
                // Change to Confirmed
                badge.className = 'badge badge-confirmed';
                badge.innerText = 'Confirmed';
                row.setAttribute('data-status', 'Confirmed');
                btn.className = 'btn-action-cancel';
                btn.innerText = 'Cancel';
            }
        }

        // Modal controls
        function openAddBookingModal() {
            document.getElementById('addBookingModal').classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        function submitNewBooking(e) {
            e.preventDefault();
            const name = document.getElementById('modalGuestName').value;
            const room = document.getElementById('modalRoom').value;
            const request = document.getElementById('modalRequest').value || 'None';
            const duration = document.getElementById('modalDuration').value;
            const status = document.getElementById('modalStatus').value;
            const dates = document.getElementById('modalDates').value;

            const randomId = 'ID-' + Math.floor(100000 + Math.random() * 900000);
            const isConfirmed = status === 'Confirmed';

            const newRow = document.createElement('tr');
            newRow.setAttribute('data-status', status);
            newRow.innerHTML = `
                <td>
                    <div class="guest-name">${name}</div>
                    <div class="guest-id">${randomId}</div>
                </td>
                <td>${room}</td>
                <td>${request}</td>
                <td>${duration}</td>
                <td>${dates}</td>
                <td><span class="badge badge-${status.toLowerCase()}">${status}</span></td>
                <td>
                    <div class="action-cell">
                        <button class="action-icon-btn" onclick="viewDetails('${name}', '${randomId}', '${room}', '${status}')" title="View">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                        <button class="action-icon-btn" onclick="editRow(this)" title="Edit">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </button>
                        <button class="${isConfirmed ? 'btn-action-cancel' : 'btn-action-confirm'}" onclick="toggleRowStatus(this)">
                            ${isConfirmed ? 'Cancel' : 'Confirm'}
                        </button>
                    </div>
                </td>
            `;

            tableBody.insertBefore(newRow, tableBody.firstChild);
            closeModal('addBookingModal');
            document.getElementById('addBookingForm').reset();
        }

        function viewDetails(name, id, room, status) {
            document.getElementById('viewGuestName').innerText = name;
            document.getElementById('viewGuestId').innerText = id;
            document.getElementById('viewRoom').innerText = room;

            const badge = document.getElementById('viewStatusBadge');
            badge.innerText = status;
            badge.className = `badge badge-${status.toLowerCase()}`;

            document.getElementById('viewModal').classList.add('active');
        }

        function editRow(btn) {
            const row = btn.closest('tr');
            const name = row.querySelector('.guest-name').innerText;
            alert('Edit mode activated for ' + name);
        }

        // Table column sorting
        let sortAsc = true;
        function sortTable(columnIndex) {
            const rows = Array.from(tableBody.querySelectorAll('tr'));
            
            rows.sort((a, b) => {
                const cellA = a.children[columnIndex].innerText.trim().toLowerCase();
                const cellB = b.children[columnIndex].innerText.trim().toLowerCase();
                
                return sortAsc ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
            });

            sortAsc = !sortAsc;
            rows.forEach(row => tableBody.appendChild(row));
        }

        // Pagination buttons
        function setPage(pageNum, el) {
            document.querySelectorAll('.page-btn').forEach(b => b.classList.remove('active'));
            el.classList.add('active');
        }
    </script>
</body>
</html>
