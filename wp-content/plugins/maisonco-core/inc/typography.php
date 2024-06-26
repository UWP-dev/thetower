<?php
add_filter( 'osf_customize_colors', 'osf_typography_custom_color', 10, 7 );
function osf_typography_custom_color($cssCode, $color_primary, $color_primary_hover, $color_secondary, $color_secondary_hover, $color_body, $color_heading) {
    $cssCode .= <<<CSS

input[type="text"]::placeholder,
input[type="email"]::placeholder,
input[type="url"]::placeholder,
input[type="password"]::placeholder,
input[type="search"]::placeholder,
input[type="number"]::placeholder,
input[type="tel"]::placeholder,
input[type="range"]::placeholder,
input[type="date"]::placeholder,
input[type="month"]::placeholder,
input[type="week"]::placeholder,
input[type="time"]::placeholder,
input[type="datetime"]::placeholder,
input[type="datetime-local"]::placeholder,
input[type="color"]::placeholder,
input[type="text"],
input[type="email"],
input[type="url"],
input[type="password"],
input[type="search"],
input[type="number"],
input[type="tel"],
input[type="range"],
input[type="date"],
input[type="month"],
input[type="week"],
input[type="time"],
input[type="datetime"],
input[type="datetime-local"],
input[type="color"],
textarea::placeholder,
textarea,
a,
.mainmenu-container li a span,
.comment-metadata,
.comment-metadata a,
.widget.widget_archive a,
.widget.widget_categories a,
.widget.widget_nav_menu a,
.widget.widget_meta a,
.widget.widget_pages a,
.c-body,
.site-header-account .account-links-menu li a,
.site-header-account .account-dashboard li a,
.comment-form label,
.comment-form a,
.widget .tagcloud a,
.widget.widget_tag_cloud a {
  color: {$color_body}; }



.widget-area strong,
h1,
h2,
h3,
h4,
h5,
h6,
blockquote,
blockquote a,
th,
.main-navigation .top-menu > li > a,
.post-content .posted-on a,
.entry-meta a,
.entry-content blockquote cite a,
.entry-content strong,
.entry-content dt,
.entry-content th,
.entry-content dt a,
.entry-content th a,
body.single-post article.type-post .entry-title,
.comment-content strong,
.comment-author,
.comment-author a,
.comment-metadata a.comment-edit-link,
.comment-reply-link,
.comment-content table th,
.comment-content table td a,
.comment-content dt,
.widget a,
h2.widget-title,
h2.widgettitle,
.widget_rss .rss-date,
.widget_rss li cite,
.widget_archive li,
.widget_categories li,
.c-heading,
.form-group .form-row label,
fieldset legend,
.related-posts .related-heading,
.author-wrapper .author-name,
.page .entry-header .entry-title,
.search .site-content .page-title,
.site-header-account .login-form-title,
.opal-availabilities td span,
.elementor-widget-opal-image-hotspots .elementor-accordion .elementor-tab-title {
  color: {$color_heading}; }



.btn-link,
.button-link,
.mainmenu-container li.current-menu-parent > a,
.mainmenu-container .menu-item > a:hover,
.site-header .header-group .search-submit:hover,
.site-header .header-group .search-submit:focus,
.post-content .posted-on a:hover,
.post-thumbnail .posted-on a:hover,
.pbr-social-share a:hover,
.related-posts .related-heading:before,
.error404 .error-404 h1,
.error404 .sub-h2-1,
.breadcrumb a,
.breadcrumb a:hover,
.breadcrumb a:hover span,
.comment-author a:hover,
.comment-metadata a:hover,
.opal-comment-4 .comment-reply-link,
.widget a:hover,
.widget a:focus,
.widget.widget_archive a:hover,
.widget.widget_archive a:focus,
.widget.widget_categories a:hover,
.widget.widget_categories a:focus,
.widget.widget_nav_menu a:hover,
.widget.widget_nav_menu a:focus,
.widget.widget_meta a:hover,
.widget.widget_meta a:focus,
.widget.widget_pages a:hover,
.widget.widget_pages a:focus,
.title-with-icon:before,
.widget_recent_entries li a:hover,
.widget_recent_entries li a:active,
.widget_search button[type="submit"],
.widget .tagcloud a:hover,
.widget .tagcloud a:focus,
.widget.widget_tag_cloud a:hover,
.widget.widget_tag_cloud a:focus,
.button-outline-primary,
.elementor-element .elementor-button-outline_primary .elementor-button,
.c-primary,
.navigation-button .menu-toggle:hover,
.navigation-button .menu-toggle:focus,
.entry-title a:hover,
.entry-content blockquote cite a:hover,
.site-header-account .account-dropdown a.register-link,
.site-header-account .account-dropdown a.lostpass-link,
.site-header-account .account-links-menu li a:hover,
.site-header-account .account-dashboard li a:hover,
.comment-form a:hover,
.wp_widget_tag_cloud a:hover,
.wp_widget_tag_cloud a:focus,
#secondary .elementor-widget-container h5:first-of-type,
.elementor-nav-menu-popup .mfp-close,
#secondary .elementor-widget-wp-widget-recent-posts a,
.contactform-content .form-title,
.elementor-text-editor a,
.elementor-widget-opal-image-hotspots .elementor-accordion .elementor-tab-title.elementor-active,
.elementor-widget-opal-image-info .elementor-image-info-title a:hover,
.column-item.post-style-3 .post-inner a:hover,
.elementor-button-dft .elementor-service__button,
.opal-video-style1 .elementor-video-title,
.osf-property-article .link-more a,
.item-recent-apartments .apartments-link,
.osf-property-article-2 .property-title a:hover,
.osf-property-article-2 .link-more a {
  color: {$color_primary->toCss()}; }


.f-primary {
  fill: {$color_primary->toCss()}; }


input[type="button"]:hover,
input[type="button"]:focus,
input[type="submit"]:hover,
input[type="submit"]:focus,
button[type="submit"]:hover,
button[type="submit"]:focus,
.site-header .mainmenu-container .top-menu > li:before,
.page-numbers:not(.dots):hover,
.page-numbers:not(.dots):focus,
.page-numbers.current:not(.dots),
.comments-link span,
.post-content .posted-on:after,
body.single-post .navigation .nav-content a:hover,
.page-links a:hover .page-number,
.page-links a:focus .page-number,
.page-links > .page-number,
.error404 .return-homepage,
.wp_widget_tag_cloud a:hover:before,
.wp_widget_tag_cloud a:focus:before,
.button-primary,
input[type="reset"],
input.secondary[type="button"],
input.secondary[type="reset"],
input.secondary[type="submit"],
input[type="button"],
input[type="submit"],
button[type="submit"],
.more-link,
.page .edit-link a.post-edit-link,
.scrollup,
.elementor-element .elementor-button-primary .elementor-button,
.button-outline-primary:hover,
.button-outline-primary:active,
.button-outline-primary.active,
.show > .button-outline-primary.dropdown-toggle,
.elementor-element .elementor-button-outline_primary .elementor-button:hover,
.elementor-element .elementor-button-outline_primary .elementor-button:active,
.elementor-element .elementor-button-outline_primary .elementor-button:focus,
.bg-primary,
.owl-theme.owl-carousel .owl-dots span,
.owl-theme .products .owl-dots span,
.img-animated .elementor-image:after,
.col-animated:after,
.elementor-widget-apartment-info .list_character .character_item,
.opal-availabilities .availability_button:hover,
.opal-availabilities .availability-content-item.active .header-availabilities,
.opal-availabilities .scrollbar-inner > .scroll-element .scroll-bar,
.elementor-widget-divider .elementor-divider-separator:before,
.elementor-flip-box__front,
.elementor-widget-opal-image-hotspots .scrollbar-inner > .scroll-element .scroll-bar,
.opal-image-hotspots-main-icons .opal-image-hotspots-icon,
.elementor-widget-opal-image-info.image-info-dot-style_2 .owl-theme.owl-carousel .owl-dots .owl-dot .active,
.elementor-widget-opal-image-gallery .gallery-item-overlay,
.elementor-widget-opal-image-gallery .elementor-galerry__filter.elementor-active,
.property-variation-item .property_variation_button:hover,
.elementor-widget-opal-testimonials.testimonial-nav-style_2 .owl-theme.owl-carousel .owl-nav,
.opal-video-style1 .elementor-video-icon,
.osf-property-article .post-thumbnail {
  background-color: {$color_primary->toCss()}; }


.button-primary,
input[type="reset"],
input.secondary[type="button"],
input.secondary[type="reset"],
input.secondary[type="submit"],
input[type="button"],
input[type="submit"],
button[type="submit"],
.more-link,
.page .edit-link a.post-edit-link,
.error404 .return-homepage,
.scrollup,
.button-secondary,
.secondary-button .search-submit,
.form-group,
.form-control,
.form-control:focus,
input[type="text"],
input[type="email"],
input[type="url"],
input[type="password"],
input[type="search"],
input[type="number"],
input[type="tel"],
input[type="range"],
input[type="date"],
input[type="month"],
input[type="week"],
input[type="time"],
input[type="datetime"],
input[type="datetime-local"],
input[type="color"],
textarea,
input[type="text"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="password"]:focus,
input[type="search"]:focus,
input[type="number"]:focus,
input[type="tel"]:focus,
input[type="range"]:focus,
input[type="date"]:focus,
input[type="month"]:focus,
input[type="week"]:focus,
input[type="time"]:focus,
input[type="datetime"]:focus,
input[type="datetime-local"]:focus,
input[type="color"]:focus,
textarea:focus,
input[type="button"]:hover,
input[type="button"]:focus,
input[type="submit"]:hover,
input[type="submit"]:focus,
button[type="submit"]:hover,
button[type="submit"]:focus,
.opal-pagination-3 .page-numbers.current:not(.dots),
.opal-pagination-3 .page-numbers:not(.dots):focus,
.opal-pagination-3 .page-numbers:not(.dots):hover,
.opal-pagination-4 .page-numbers.current:not(.dots),
.opal-pagination-4 .page-numbers:not(.dots):focus,
.opal-pagination-4 .page-numbers:not(.dots):hover,
.widget .tagcloud a:hover,
.widget .tagcloud a:focus,
.widget.widget_tag_cloud a:hover,
.widget.widget_tag_cloud a:focus,
.wp_widget_tag_cloud a:hover:after,
.wp_widget_tag_cloud a:focus:after,
.wp_widget_tag_cloud a:hover,
.wp_widget_tag_cloud a:focus,
.elementor-element .elementor-button-primary .elementor-button,
.button-outline-primary,
.elementor-element .elementor-button-outline_primary .elementor-button,
.button-outline-primary:hover,
.button-outline-primary:active,
.button-outline-primary.active,
.show > .button-outline-primary.dropdown-toggle,
.elementor-element .elementor-button-outline_primary .elementor-button:hover,
.elementor-element .elementor-button-outline_primary .elementor-button:active,
.elementor-element .elementor-button-outline_primary .elementor-button:focus,
.b-primary,
.owl-theme.owl-carousel .owl-dots .owl-dot,
.owl-theme .products .owl-dots .owl-dot,
.elementor-widget-opal-image-gallery .elementor-galerry__filter.elementor-active:before {
  border-color: {$color_primary->toCss()}; }


blockquote {
  border-left-color: {$color_primary->toCss()}; }



.btn-link:focus,
.btn-link:hover,
.button-link:focus,
.button-link:hover,
a:hover,
a:active,
.widget_search button[type="submit"]:hover,
.widget_search button[type="submit"]:focus,
.elementor-button-dft .elementor-service__button:hover,
.opal-video-style1 .elementor-video-title:hover {
  color: {$color_primary_hover->toCss()}; }


.button-primary:hover,
input:hover[type="reset"],
input:hover[type="button"],
input:hover[type="submit"],
button:hover[type="submit"],
.more-link:hover,
.page .edit-link a.post-edit-link:hover,
.error404 .return-homepage:hover,
.scrollup:hover,
.button-primary:active,
input:active[type="reset"],
input:active[type="button"],
input:active[type="submit"],
button:active[type="submit"],
.more-link:active,
.page .edit-link a.post-edit-link:active,
.error404 .return-homepage:active,
.scrollup:active,
.button-primary.active,
input.active[type="reset"],
input.active[type="button"],
input.active[type="submit"],
button.active[type="submit"],
.active.more-link,
.page .edit-link a.active.post-edit-link,
.error404 .active.return-homepage,
.active.scrollup,
.show > .button-primary.dropdown-toggle,
.show > input.dropdown-toggle[type="reset"],
.show > input.dropdown-toggle[type="button"],
.show > input.dropdown-toggle[type="submit"],
.show > button.dropdown-toggle[type="submit"],
.show > .dropdown-toggle.more-link,
.page .edit-link .show > a.dropdown-toggle.post-edit-link,
.error404 .show > .dropdown-toggle.return-homepage,
.show > .dropdown-toggle.scrollup,
.elementor-element .elementor-button-primary .elementor-button:hover,
.elementor-element .elementor-button-primary .elementor-button:active,
.elementor-element .elementor-button-primary .elementor-button:focus,
.elementor-button-dft .service-style2 .elementor-service__button:hover {
  background-color: {$color_primary_hover->toCss()}; }


.button-primary:active,
input:active[type="reset"],
input:active[type="button"],
input:active[type="submit"],
button:active[type="submit"],
.more-link:active,
.page .edit-link a.post-edit-link:active,
.error404 .return-homepage:active,
.scrollup:active,
.button-primary.active,
input.active[type="reset"],
input.active[type="button"],
input.active[type="submit"],
button.active[type="submit"],
.active.more-link,
.page .edit-link a.active.post-edit-link,
.error404 .active.return-homepage,
.active.scrollup,
.show > .button-primary.dropdown-toggle,
.show > input.dropdown-toggle[type="reset"],
.show > input.dropdown-toggle[type="button"],
.show > input.dropdown-toggle[type="submit"],
.show > button.dropdown-toggle[type="submit"],
.show > .dropdown-toggle.more-link,
.page .edit-link .show > a.dropdown-toggle.post-edit-link,
.error404 .show > .dropdown-toggle.return-homepage,
.show > .dropdown-toggle.scrollup,
.button-secondary:active,
.secondary-button .search-submit:active,
.button-secondary.active,
.secondary-button .active.search-submit,
.show > .button-secondary.dropdown-toggle,
.secondary-button .show > .dropdown-toggle.search-submit,
.button-primary:hover,
input:hover[type="reset"],
input:hover[type="button"],
input:hover[type="submit"],
button:hover[type="submit"],
.more-link:hover,
.page .edit-link a.post-edit-link:hover,
.error404 .return-homepage:hover,
.scrollup:hover,
.elementor-element .elementor-button-primary .elementor-button:hover,
.elementor-element .elementor-button-primary .elementor-button:active,
.elementor-element .elementor-button-primary .elementor-button:focus,
.elementor-button-dft .service-style2 .elementor-service__button:hover {
  border-color: {$color_primary_hover->toCss()}; }



.cat-tags-links .tags-links a,
.error404 .sub-h2-2,
.error404 .error-text,
.button-outline-secondary,
.elementor-element .elementor-button-outline_secondary .elementor-button,
.c-secondary,
.author-wrapper .author-name h6,
.opal-availabilities,
.opal-availabilities .availability_button,
.contactform-content button.mfp-close,
.property-variation-item .property_variation_button,
.opal-property-variation,
.opal-video-style2 .elementor-video-title,
.opal-video-style2 .elementor-video-icon,
.osf-property-article-2 .property-title a {
  color: {$color_secondary->toCss()}; }


.button-secondary,
.secondary-button .search-submit,
.elementor-button-secondary button[type="submit"],
.elementor-button-secondary input[type="button"],
.elementor-button-secondary input[type="submit"],
.elementor-element .elementor-button-secondary .elementor-button,
.button-outline-secondary:hover,
.button-outline-secondary:active,
.button-outline-secondary.active,
.show > .button-outline-secondary.dropdown-toggle,
.elementor-element .elementor-button-outline_secondary .elementor-button:hover,
.elementor-element .elementor-button-outline_secondary .elementor-button:active,
.elementor-element .elementor-button-outline_secondary .elementor-button:focus,
.bg-secondary,
#secondary .elementor-widget-wp-widget-categories a:before,
.opal-availabilities .availability_button:hover,
.elementor-flip-box__back,
#secondary .elementor-nav-menu a:before,
.e--pointer-dot a:before {
  background-color: {$color_secondary->toCss()}; }


.button-secondary,
.secondary-button .search-submit,
.elementor-button-secondary button[type="submit"],
.elementor-button-secondary input[type="button"],
.elementor-button-secondary input[type="submit"],
.elementor-element .elementor-button-secondary .elementor-button,
.button-outline-secondary,
.elementor-element .elementor-button-outline_secondary .elementor-button,
.button-outline-secondary:hover,
.button-outline-secondary:active,
.button-outline-secondary.active,
.show > .button-outline-secondary.dropdown-toggle,
.elementor-element .elementor-button-outline_secondary .elementor-button:hover,
.elementor-element .elementor-button-outline_secondary .elementor-button:active,
.elementor-element .elementor-button-outline_secondary .elementor-button:focus,
.b-secondary {
  border-color: {$color_secondary->toCss()}; }



.button-secondary:hover,
.secondary-button .search-submit:hover,
.button-secondary:active,
.secondary-button .search-submit:active,
.button-secondary.active,
.secondary-button .active.search-submit,
.show > .button-secondary.dropdown-toggle,
.secondary-button .show > .dropdown-toggle.search-submit,
.elementor-button-secondary button[type="submit"]:hover,
.elementor-button-secondary button[type="submit"]:active,
.elementor-button-secondary button[type="submit"]:focus,
.elementor-button-secondary input[type="button"]:hover,
.elementor-button-secondary input[type="button"]:active,
.elementor-button-secondary input[type="button"]:focus,
.elementor-button-secondary input[type="submit"]:hover,
.elementor-button-secondary input[type="submit"]:active,
.elementor-button-secondary input[type="submit"]:focus,
.elementor-element .elementor-button-secondary .elementor-button:hover,
.elementor-element .elementor-button-secondary .elementor-button:active,
.elementor-element .elementor-button-secondary .elementor-button:focus {
  background-color: {$color_secondary_hover->toCss()}; }


.button-secondary:hover,
.secondary-button .search-submit:hover,
.button-secondary:active,
.secondary-button .search-submit:active,
.button-secondary.active,
.secondary-button .active.search-submit,
.show > .button-secondary.dropdown-toggle,
.secondary-button .show > .dropdown-toggle.search-submit,
.elementor-button-secondary button[type="submit"]:hover,
.elementor-button-secondary button[type="submit"]:active,
.elementor-button-secondary button[type="submit"]:focus,
.elementor-button-secondary input[type="button"]:hover,
.elementor-button-secondary input[type="button"]:active,
.elementor-button-secondary input[type="button"]:focus,
.elementor-button-secondary input[type="submit"]:hover,
.elementor-button-secondary input[type="submit"]:active,
.elementor-button-secondary input[type="submit"]:focus,
.elementor-element .elementor-button-secondary .elementor-button:hover,
.elementor-element .elementor-button-secondary .elementor-button:active,
.elementor-element .elementor-button-secondary .elementor-button:focus {
  border-color: {$color_secondary_hover->toCss()}; }


CSS;
    return $cssCode;
}
add_filter('osf_customize_grid', 'osf_typography_grid_bootstrap', 10 , 2);
function osf_typography_grid_bootstrap($cssCode, $gridGutter){
    $cssCode .= <<<CSS

.row,
body.opal-content-layout-2cl #content .wrap,
body.opal-content-layout-2cr #content .wrap,
[data-opal-columns],
.opal-archive-style-4.blog .site-main,
.opal-archive-style-4.archive .site-main,
.opal-default-content-layout-2cr .site-content .wrap,
.site-footer .widget-area,
.opal-comment-form-2 .comment-form,
.opal-comment-form-3 .comment-form,
.opal-comment-form-4 .comment-form,
.opal-comment-form-6 .comment-form,
.widget .gallery,
.elementor-element .gallery,
.entry-gallery .gallery,
.single .gallery,
[data-elementor-columns] {
    margin-right: -{$gridGutter}px;
    margin-left: -{$gridGutter}px;
}



.col-1,
.col-2,
[data-elementor-columns-mobile="6"] .column-item,
.col-3,
[data-elementor-columns-mobile="4"] .column-item,
.col-4,
.opal-comment-form-2 .comment-form .comment-form-author,
.opal-comment-form-3 .comment-form .comment-form-author,
.opal-comment-form-2 .comment-form .comment-form-email,
.opal-comment-form-3 .comment-form .comment-form-email,
.opal-comment-form-2 .comment-form .comment-form-url,
.opal-comment-form-3 .comment-form .comment-form-url,
[data-elementor-columns-mobile="3"] .column-item,
.col-5,
.col-6,
.opal-comment-form-4 .comment-form .comment-form-author,
.opal-comment-form-4 .comment-form .comment-form-email,
.opal-comment-form-4 .comment-form .comment-form-url,
.opal-comment-form-6 .comment-form .comment-form-author,
.opal-comment-form-6 .comment-form .comment-form-email,
[data-elementor-columns-mobile="2"] .column-item,
.col-7,
.col-8,
.col-9,
.col-10,
.col-11,
.col-12,
.opal-archive-style-2.opal-content-layout-2cr .post-style-2,
.related-posts .column-item,
.opal-default-content-layout-2cr .related-posts .column-item,
.opal-content-layout-2cr .related-posts .column-item,
.opal-content-layout-2cl .related-posts .column-item,
.site-footer .widget-area .widget-column,
.opal-comment-form-2 .comment-form .logged-in-as,
.opal-comment-form-3 .comment-form .logged-in-as,
.opal-comment-form-2 .comment-form .comment-notes,
.opal-comment-form-3 .comment-form .comment-notes,
.opal-comment-form-2 .comment-form .comment-form-comment,
.opal-comment-form-3 .comment-form .comment-form-comment,
.opal-comment-form-2 .comment-form .form-submit,
.opal-comment-form-3 .comment-form .form-submit,
.opal-comment-form-4 .comment-form .logged-in-as,
.opal-comment-form-4 .comment-form .comment-notes,
.opal-comment-form-4 .comment-form .comment-form-comment,
.opal-comment-form-4 .comment-form .form-submit,
.opal-comment-form-6 .comment-form .logged-in-as,
.opal-comment-form-6 .comment-form .comment-notes,
.opal-comment-form-6 .comment-form .comment-form-comment,
.opal-comment-form-6 .comment-form .comment-form-url,
.opal-comment-form-6 .comment-form .form-submit,
.widget .gallery-columns-1 .gallery-item,
.elementor-element .gallery-columns-1 .gallery-item,
.entry-gallery .gallery-columns-1 .gallery-item,
.single .gallery-columns-1 .gallery-item,
[data-elementor-columns-mobile="1"] .column-item,
.col,
body #secondary,
.col-auto,
.col-sm-1,
[data-opal-columns="12"] .column-item,
.col-sm-2,
[data-opal-columns="6"] .column-item,
.col-sm-3,
[data-opal-columns="4"] .column-item,
.col-sm-4,
[data-opal-columns="3"] .column-item,
.widget .gallery-columns-6 .gallery-item,
.elementor-element .gallery-columns-6 .gallery-item,
.entry-gallery .gallery-columns-6 .gallery-item,
.single .gallery-columns-6 .gallery-item,
.col-sm-5,
.col-sm-6,
[data-opal-columns="2"] .column-item,
.opal-archive-style-3:not(.opal-content-layout-2cr) .post-style-3,
.widget .gallery-columns-2 .gallery-item,
.elementor-element .gallery-columns-2 .gallery-item,
.entry-gallery .gallery-columns-2 .gallery-item,
.single .gallery-columns-2 .gallery-item,
.widget .gallery-columns-3 .gallery-item,
.elementor-element .gallery-columns-3 .gallery-item,
.entry-gallery .gallery-columns-3 .gallery-item,
.single .gallery-columns-3 .gallery-item,
.widget .gallery-columns-4 .gallery-item,
.elementor-element .gallery-columns-4 .gallery-item,
.entry-gallery .gallery-columns-4 .gallery-item,
.single .gallery-columns-4 .gallery-item,
.col-sm-7,
.col-sm-8,
.col-sm-9,
.col-sm-10,
.col-sm-11,
.col-sm-12,
[data-opal-columns="1"] .column-item,
.opal-archive-style-2:not(.opal-content-layout-2cr) .post-style-2,
.opal-archive-style-3.opal-content-layout-2cr .post-style-3,
.elementor-widget-opal-image-hotspots .opal-image-hotspots-accordion,
.elementor-widget-opal-image-hotspots .opal-image-hotspots-accordion + .opal-image-hotspots-container,
.col-sm,
.col-sm-auto,
.col-md-1,
.col-md-2,
[data-elementor-columns-tablet="6"] .column-item,
.col-md-3,
[data-elementor-columns-tablet="4"] .column-item,
.col-md-4,
[data-elementor-columns-tablet="3"] .column-item,
.col-md-5,
.opal-default-content-layout-2cr #secondary,
.col-md-6,
[data-elementor-columns-tablet="2"] .column-item,
.col-md-7,
.opal-default-content-layout-2cr #primary,
.col-md-8,
.col-md-9,
.col-md-10,
.col-md-11,
.col-md-12,
body.single-post .content-boxed,
[data-elementor-columns-tablet="1"] .column-item,
.col-md,
.col-md-auto,
.col-lg-1,
.col-lg-2,
[data-elementor-columns="6"] .column-item,
.col-lg-3,
[data-elementor-columns="4"] .column-item,
.col-lg-4,
[data-elementor-columns="3"] .column-item,
.col-lg-5,
.col-lg-6,
[data-elementor-columns="2"] .column-item,
.col-lg-7,
.col-lg-8,
.col-lg-9,
.col-lg-10,
.col-lg-11,
.col-lg-12,
body.single-post.opal-default-content-layout-2cr .content-boxed,
body.single-post.opal-content-layout-2cr .content-boxed,
body.single-post.opal-content-layout-2cl .content-boxed,
[data-elementor-columns="1"] .column-item,
.col-lg,
.col-lg-auto,
.col-xl-1,
.col-xl-2,
.col-xl-3,
.col-xl-4,
.col-xl-5,
.col-xl-6,
.col-xl-7,
.col-xl-8,
.col-xl-9,
.col-xl-10,
.col-xl-11,
.col-xl-12,
.col-xl,
.col-xl-auto {
    padding-right: {$gridGutter}px;
    padding-left: {$gridGutter}px;
}



.container,
#content {
    padding-right: {$gridGutter}px;
    padding-left: {$gridGutter}px;
}
  @media (min-width: 576px) {
    .container, #content {
      max-width: 540px; } }
  @media (min-width: 768px) {
    .container, #content {
      max-width: 720px; } }
  @media (min-width: 992px) {
    .container, #content {
      max-width: 960px; } }
  @media (min-width: 1200px) {
    .container, #content {
      max-width: 1140px; } }


CSS;
    return $cssCode;
}
add_filter('osf_customize_button_primary_color', 'osf_typography_button_primary_color', 10 , 11);
function osf_typography_button_primary_color($cssCode, $primary, $primary_hover, $primary_border, $primary_border_hover, $primary_color, $primary_color_hover, $border_radius, $primary_color_outline, $button_css, $font_style_code){
    $cssCode .= <<<CSS

.button-primary,
input[type="reset"],
input.secondary[type="button"],
input.secondary[type="reset"],
input.secondary[type="submit"],
input[type="button"],
input[type="submit"],
button[type="submit"],
.more-link,
.page .edit-link a.post-edit-link,
.error404 .return-homepage,
.scrollup,
.elementor-element .elementor-button-primary .elementor-button {
    background-color: {$primary};
    border-color: {$primary};
    color: {$primary_color};
    border-radius: {$border_radius}px;
    {$button_css}
    {$font_style_code}
}



.button-primary:hover,
input:hover[type="reset"],
input:hover[type="button"],
input:hover[type="submit"],
button:hover[type="submit"],
.more-link:hover,
.page .edit-link a.post-edit-link:hover,
.error404 .return-homepage:hover,
.scrollup:hover,
.button-primary:active,
input:active[type="reset"],
input:active[type="button"],
input:active[type="submit"],
button:active[type="submit"],
.more-link:active,
.page .edit-link a.post-edit-link:active,
.error404 .return-homepage:active,
.scrollup:active,
.button-primary.active,
input.active[type="reset"],
input.active[type="button"],
input.active[type="submit"],
button.active[type="submit"],
.active.more-link,
.page .edit-link a.active.post-edit-link,
.error404 .active.return-homepage,
.active.scrollup,
.show > .button-primary.dropdown-toggle,
.show > input.dropdown-toggle[type="reset"],
.show > input.dropdown-toggle[type="button"],
.show > input.dropdown-toggle[type="submit"],
.show > button.dropdown-toggle[type="submit"],
.show > .dropdown-toggle.more-link,
.page .edit-link .show > a.dropdown-toggle.post-edit-link,
.error404 .show > .dropdown-toggle.return-homepage,
.show > .dropdown-toggle.scrollup,
.elementor-element .elementor-button-primary .elementor-button:hover,
.elementor-element .elementor-button-primary .elementor-button:active,
.elementor-element .elementor-button-primary .elementor-button:focus,
.elementor-button-dft .service-style2 .elementor-service__button:hover {
    background-color: {$primary_hover};
    border-color: {$primary_hover};
    color: {$primary_color_hover};
    {$button_css}
    {$font_style_code}
}



.button-outline-primary,
.elementor-element .elementor-button-outline_primary .elementor-button {
    color: {$primary_color_outline};
    border-color: {$primary_border};
    border-radius: {$border_radius}px;
    {$button_css}
    {$font_style_code}
}



.button-outline-primary:hover,
.button-outline-primary:active,
.button-outline-primary.active,
.show > .button-outline-primary.dropdown-toggle,
.elementor-element .elementor-button-outline_primary .elementor-button:hover,
.elementor-element .elementor-button-outline_primary .elementor-button:active,
.elementor-element .elementor-button-outline_primary .elementor-button:focus {
    color: {$primary_color_hover};
    background-color: {$primary_hover};
    border-color: {$primary_border_hover};
    {$button_css}
    {$font_style_code}
}


CSS;
    return $cssCode;
}

add_filter('osf_customize_button_secondary_color', 'osf_typography_button_secondary_color', 10 , 11);
function osf_typography_button_secondary_color($cssCode, $secondary, $secondary_hover, $secondary_border, $secondary_border_hover, $secondary_color, $secondary_color_hover, $border_radius, $secondary_color_outline, $button_css, $font_style_code){
    $cssCode .= <<<CSS

.button-secondary,
.secondary-button .search-submit,
.elementor-button-secondary button[type="submit"],
.elementor-button-secondary input[type="button"],
.elementor-button-secondary input[type="submit"],
.elementor-element .elementor-button-secondary .elementor-button {
    background-color: {$secondary};
    border-color: {$secondary};
    color: {$secondary_color};
    border-radius: {$border_radius}px;
    {$button_css}
    {$font_style_code}
}



.button-secondary:hover,
.secondary-button .search-submit:hover,
.button-secondary:active,
.secondary-button .search-submit:active,
.button-secondary.active,
.secondary-button .active.search-submit,
.show > .button-secondary.dropdown-toggle,
.secondary-button .show > .dropdown-toggle.search-submit,
.elementor-button-secondary button[type="submit"]:hover,
.elementor-button-secondary button[type="submit"]:active,
.elementor-button-secondary button[type="submit"]:focus,
.elementor-button-secondary input[type="button"]:hover,
.elementor-button-secondary input[type="button"]:active,
.elementor-button-secondary input[type="button"]:focus,
.elementor-button-secondary input[type="submit"]:hover,
.elementor-button-secondary input[type="submit"]:active,
.elementor-button-secondary input[type="submit"]:focus,
.elementor-element .elementor-button-secondary .elementor-button:hover,
.elementor-element .elementor-button-secondary .elementor-button:active,
.elementor-element .elementor-button-secondary .elementor-button:focus {
    background-color: {$secondary_hover};
    border-color: {$secondary_hover};
    color: {$secondary_color};
    {$button_css}
    {$font_style_code}
}



.button-outline-secondary,
.elementor-element .elementor-button-outline_secondary .elementor-button {
    color: {$secondary_color_outline};
    border-color: {$secondary_border};
    border-radius: {$border_radius}px;
    {$button_css}
    {$font_style_code}
}



.button-outline-secondary:hover,
.button-outline-secondary:active,
.button-outline-secondary.active,
.show > .button-outline-secondary.dropdown-toggle,
.elementor-element .elementor-button-outline_secondary .elementor-button:hover,
.elementor-element .elementor-button-outline_secondary .elementor-button:active,
.elementor-element .elementor-button-outline_secondary .elementor-button:focus {
    color: {$secondary_color_hover};
    background-color: {$secondary_hover};
    border-color: {$secondary_border_hover};
    border-radius: {$border_radius}px;
    {$button_css}
    {$font_style_code}
}


CSS;
    return $cssCode;
}
add_filter('osf_customize_typo_heading', 'osf_typography_custom_typo_heading', 10 , 2);
function osf_typography_custom_typo_heading($cssCode, $heading_css){
    $cssCode .= <<<CSS

.typo-heading,
h1,
h2,
h3,
h4,
h5,
h6,
.author-wrapper .author-name,
.error404 .error-404 h1,
.error404 .error-404-subtitle h2,
h2.widget-title,
h2.widgettitle,
#secondary .elementor-widget-container h5:first-of-type,
.contactform-content .form-title,
.osf-property-article .property-title {
    {$heading_css}
}


CSS;
    return $cssCode;
}
