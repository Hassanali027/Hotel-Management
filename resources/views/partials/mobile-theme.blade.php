{{-- Mobile colour system. Mirrors the desktop green theme on phones (up to 768px) so the
     lime accents from the original mock are replaced everywhere: primary buttons, avatars,
     status pills, chips, toggles and chart bars. Layout and spacing are untouched. --}}
<style>
@media(max-width:768px){
    :root{
        --lime:#e6f4ea;--mint:#d9f5e5;--mint-d:#b9d8c7;--olive:#5d9c7b;
        --mg900:#123527;--mg800:#1e4a36;--mg700:#2f6b4f;--mg100:#e6f4ea;
    }

    /* ---------- Primary buttons ---------- */
    .ms-add,.mr-add,.ms-btn.next,.ms-btn.lime,.mr-btn.next,
    .m-page .ms-add,.mx-add{background:#1e4a36!important;color:#fff!important}
    .ms-add svg,.mr-add svg,.ms-btn.next svg,.ms-btn.lime svg,.mr-btn.next svg{stroke:#fff!important}
    .ms-btn.mint{background:#e6f4ea!important;color:#1e4a36!important}
    .ms-fab,.mr-fab{background:#1e4a36!important;color:#fff!important}

    /* ---------- Avatars ---------- */
    .ms-avatar,.md-avatar,.mr-avatar{background:#e6f4ea!important;color:#1e4a36!important}
    .ms-av.c3{background:#e6f4ea!important;color:#1e4a36!important}

    /* ---------- Chips and segmented toggles ---------- */
    .ms-chip.on{background:#1e4a36!important;color:#fff!important}
    .mx-tog button.on,.mr-cal.on,.mr-fbtn.on{background:#1e4a36!important;color:#fff!important}
    .mx-tog button.on svg,.mr-cal.on svg,.mr-fbtn.on svg{stroke:#fff!important}

    /* ---------- Status pills: "checked in" and "in progress" move to blue ---------- */
    .ms-pill.lime,.ms-pill.checked_in,.ms-pill.progress,
    .mr-st.checked_in,.gp-pill.checked_in,.bl-status.checked_in{background:#dfebfb!important;color:#1e4f8f!important}
    .ms-tagsel.progress{background-color:#dfebfb!important;color:#1e4f8f!important}
    .ms-pill.green,.ms-pill.confirmed,.ms-pill.paid,.ms-pill.ready,.ms-pill.available,
    .ms-pill.active,.ms-pill.completed{background:#e6f4ea!important;color:#2f6b4f!important}
    .gp-hist .rt.suite{background:#e6f4ea!important;color:#2f6b4f!important}
    .mr-st.reserved{background:#fdf1d3!important;color:#7a5400!important}
    .mr-st.occupied{background:#dfebfb!important;color:#1e4f8f!important}

    .md-stat .dl b{background:#e6f4ea!important;color:#1e4a36!important}
    .md-stat.down .dl b{background:#fde3e5!important;color:#b3352f!important}
    /* The pill plus "from last week" is wider than half a phone screen, so it used to
       run past the card edge. Stack them and keep every word inside the tile. */
    .md-stat .dl{flex-direction:column!important;align-items:flex-start!important;gap:5px!important;white-space:normal!important;font-size:11.5px!important;overflow:hidden}
    .md-stat .dl b{font-size:11.5px!important;padding:4px 9px!important}
    .md-stat{overflow:hidden!important}
    /* Park the chevron beside the icon so the label and the amount get the full tile width
       instead of being clipped by the space reserved for it. */
    .md-stat .go{top:14px!important;right:12px!important;transform:none!important;width:34px!important;height:34px!important}
    .md-stat .go svg{width:16px!important;height:16px!important}
    .md-stat .lb{padding-right:0!important}
    .md-stat .nm{font-size:26px!important;margin-right:0!important;white-space:nowrap!important}
    .md-stat.gold .nm{font-size:20px!important}
    @media(max-width:360px){
        .md-stat .nm{font-size:22px!important}
        .md-stat.gold .nm{font-size:17px!important}
        .md-stat .dl,.md-stat .dl b{font-size:10.5px!important}
    }

    /* ---------- Charts ---------- */
    .mx-plot .up{background:#2f6b4f!important}
    .mx-plot .dn{background:#bcd9c8!important}
    .mv-bar span i{background:#2f6b4f!important}

    /* ---------- Hamburger sheet (the sidebar menu shown as a dropdown on phones) ---------- */
    .app-sidebar .app-menu a.active{background:#e6f4ea!important;color:#1e4a36!important;font-weight:700!important}
    .app-sidebar .app-menu a.active .icon{stroke:#1e4a36!important}
    .app-sidebar .financial-submenu a.active{background:#e6f4ea!important;color:#1e4a36!important}
    .app-sidebar .app-menu a:hover{background:#f2f7f4!important;color:#1e4a36!important}
    .app-sidebar .app-brand-mark i:nth-child(2),.app-sidebar .app-brand-mark i:nth-child(3){background:#2f6b4f!important}

    /* The desktop page title is duplicated by each phone page's own header. */
    .pg-head{display:none!important}

    /* ---------- Links ----------
       "View Details", "View Room" and the inline stock action were still the default
       blue; the whole phone UI uses the brand green. */
    .md-link,.gp-link,.mx-link,.ms-meta a,.ms-link,
    .ms-card a:not(.ms-btn),.vd[style*="1d6ae5"]{color:#1e4a36!important}
    .md-link svg,.gp-link svg,.mx-link svg{stroke:#1e4a36!important}
    .ms-sec a,.ms-viewall{color:#1e4a36!important}

    /* ---------- Modals, toasts and the invoice sheet ---------- */
    .modal .mbtn.save{background:#1e4a36!important;color:#fff!important}
    .flash{background:#1e4a36!important;color:#fff!important}
    select.fsel.lime{background-color:#e6f4ea!important;color:#1e4a36!important}
    .modal label.acct-upload{background:#1e4a36!important;color:#fff!important}
    .acct-av{background:#e6f4ea!important;color:#1e4a36!important}
    .gp-btns .edit{background:#1e4a36!important;color:#fff!important}
}
</style>
