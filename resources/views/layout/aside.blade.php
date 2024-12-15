<!-- Sidenav Menu -->
<div class="app-menu">

    <!-- Sidenav Brand Logo -->
    <a href="index.html" class="logo-box">
        <!-- Light Brand Logo -->
        <div class="logo-light">
            <img src="{{ asset('assets/images/logo.png') }}" class="logo-lg h-6" alt="Light logo">
            <img src="{{ asset('assets/images/logo-sm.png') }}" class="logo-sm" alt="Small logo">
        </div>

        <!-- Dark Brand Logo -->
        <div class="logo-dark">
            <img src="{{ asset('assets/images/logo-dark.png') }}" class="logo-lg h-6" alt="Dark logo">
            <img src="{{ asset('assets/images/logo-dark-sm.png') }}" class="logo-sm" alt="Small logo">
        </div>
    </a>

    <!-- Sidenav Menu Toggle Button -->
    <button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5">
        <span class="sr-only">Menu Toggle Button</span>
        <i class="mgc_round_line text-xl"></i>
    </button>

    <!--- Menu -->
    <div class="srcollbar" data-simplebar>
        <ul class="menu" data-fc-type="accordion">
            <li class="menu-title">Menu</li>

            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <span class="menu-icon"><i class="mgc_home_3_line"></i></span>
                    <span class="menu-text font-bold"> واجهة الادمن </span>
                </a>
            </li>

            <li class="menu-title"> التصنيفات والمنتجات</li>

            <li class="menu-item">
                <a href="apps-calendar.html" class="menu-link">
                    <span class="menu-icon"><i class="mgc_calendar_line"></i></span>
                    <span class="menu-text font-bold"> جدول زمني</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('addCategory')}}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                    <span class="menu-text font-bold"> اضافة تصنيف </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{route('addProduct')}}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                    <span class="menu-text font-bold"> اضافة منتج</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="{{route('products')}}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                    <span class="menu-text font-bold"> عرض المنتجات</span>
                </a>
            </li>
            <li class="menu-title">  الموظفين</li>
            <li class="menu-item">
                <a href="{{route('addWorker')}}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                    <span class="menu-text font-bold"> اضافة موظف </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{route('workers')}}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                    <span class="menu-text font-bold"> الموظفين</span>
                </a>
            </li>
          


            <li class="menu-item">
                <a href="apps-file-manager.html" class="menu-link">
                    <span class="menu-icon"><i class="mgc_folder_2_line"></i></span>
                    <span class="menu-text"> File Manager </span>
                </a>
            </li>


            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_building_2_line"></i></span>
                    <span class="menu-text"> Universities </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="" class="menu-link">
                            <span class="menu-text">Universities</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-title">Custom</li>

            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_user_3_line"></i></span>
                    <span class="menu-text"> Auth Pages </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="auth-login.html" class="menu-link">
                            <span class="menu-text">Log In</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="auth-register.html" class="menu-link">
                            <span class="menu-text">Register</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="auth-recoverpw.html" class="menu-link">
                            <span class="menu-text">Recover Password</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="auth-lock-screen.html" class="menu-link">
                            <span class="menu-text">Lock Screen</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_box_3_line"></i></span>
                    <span class="menu-text"> Extra Pages </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="pages-starter.html" class="menu-link">
                            <span class="menu-text">Starter</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="pages-timeline.html" class="menu-link">
                            <span class="menu-text">Timeline</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="pages-invoice.html" class="menu-link">
                            <span class="menu-text">Invoice</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="pages-gallery.html" class="menu-link">
                            <span class="menu-text">Gallery</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="pages-faqs.html" class="menu-link">
                            <span class="menu-text">FAQs</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="pages-pricing.html" class="menu-link">
                            <span class="menu-text">Pricing</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="pages-maintenance.html" class="menu-link">
                            <span class="menu-text">Maintenance</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="pages-coming-soon.html" class="menu-link">
                            <span class="menu-text">Coming Soon</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="pages-404.html" class="menu-link">
                            <span class="menu-text">Error 404</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="pages-404-alt.html" class="menu-link">
                            <span class="menu-text">Error 404-alt</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="pages-500.html" class="menu-link">
                            <span class="menu-text">Error 500</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_layout_line"></i></span>
                    <span class="menu-text"> Layout </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="layout-hover-view.html" target="_blank" class="menu-link">
                            <span class="menu-text">Hovered Menu</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="layout-icon-view.html" target="_blank" class="menu-link">
                            <span class="menu-text">Icon View Menu</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="layout-compact-view.html" target="_blank" class="menu-link">
                            <span class="menu-text">Compact Menu</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="layout-mobile-view.html" target="_blank" class="menu-link">
                            <span class="menu-text">Mobile View Menu</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="layout-hidden.html" target="_blank" class="menu-link">
                            <span class="menu-text">Hidden Menu</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-title">Elements</li>

            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_classify_2_line"></i></span>
                    <span class="menu-text"> Components </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="ui-accordions.html" class="menu-link">
                            <span class="menu-text">Accordions</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-alerts.html" class="menu-link">
                            <span class="menu-text">Alerts</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-avatars.html" class="menu-link">
                            <span class="menu-text">Avatars</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-buttons.html" class="menu-link">
                            <span class="menu-text">Buttons</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-badges.html" class="menu-link">
                            <span class="menu-text">Badges</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-breadcrumbs.html" class="menu-link">
                            <span class="menu-text">Breadcrumb</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-cards.html" class="menu-link">
                            <span class="menu-text">Cards</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-collapse.html" class="menu-link">
                            <span class="menu-text">Collapse</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-dismissible.html" class="menu-link">
                            <span class="menu-text">Dismissible</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-dropdowns.html" class="menu-link">
                            <span class="menu-text">Dropdowns</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-progress.html" class="menu-link">
                            <span class="menu-text">Progress</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-skeleton.html" class="menu-link">
                            <span class="menu-text">Skeleton</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-spinners.html" class="menu-link">
                            <span class="menu-text">Spinners</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-list-group.html" class="menu-link">
                            <span class="menu-text">List Group</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-ratio.html" class="menu-link">
                            <span class="menu-text">Ratio</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-tabs.html" class="menu-link">
                            <span class="menu-text">Tab</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-modals.html" class="menu-link">
                            <span class="menu-text">Modals</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-offcanvas.html" class="menu-link">
                            <span class="menu-text">Offcanvas</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-popovers.html" class="menu-link">
                            <span class="menu-text">Popovers</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-tooltips.html" class="menu-link">
                            <span class="menu-text">Tooltips</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-typography.html" class="menu-link">
                            <span class="menu-text">Typography</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_box_3_line"></i></span>
                    <span class="menu-text"> Extended </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="extended-swiper.html" class="menu-link">
                            <span class="menu-text">Swiper</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="extended-nestable.html" class="menu-link">
                            <span class="menu-text">Nestable List</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="extended-ratings.html" class="menu-link">
                            <span class="menu-text">Ratings</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="extended-animation.html" class="menu-link">
                            <span class="menu-text">Animation</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="extended-player.html" class="menu-link">
                            <span class="menu-text">Player</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="extended-scrollbar.html" class="menu-link">
                            <span class="menu-text">Scrollbar</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="extended-sweet-alert.html" class="menu-link">
                            <span class="menu-text">Sweet Alert</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="extended-tour.html" class="menu-link">
                            <span class="menu-text">Tour Page</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="extended-tippy-tooltips.html" class="menu-link">
                            <span class="menu-text">Tippy Tooltip</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="extended-lightbox.html" class="menu-link">
                            <span class="menu-text">Lightbox</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_file_check_line"></i></span>
                    <span class="menu-text"> Forms </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="forms-elements.html" class="menu-link">
                            <span class="menu-text">Form Elements</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="forms-select.html" class="menu-link">
                            <span class="menu-text">Select</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="forms-range.html" class="menu-link">
                            <span class="menu-text">Range</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="forms-pickers.html" class="menu-link">
                            <span class="menu-text">Pickers</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="forms-masks.html" class="menu-link">
                            <span class="menu-text">Masks</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="forms-editor.html" class="menu-link">
                            <span class="menu-text">Editor</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="forms-file-uploads.html" class="menu-link">
                            <span class="menu-text">File Uploads</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="forms-validation.html" class="menu-link">
                            <span class="menu-text">Validation</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="forms-layout.html" class="menu-link">
                            <span class="menu-text">Form Layout</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_layout_grid_line"></i></span>
                    <span class="menu-text"> Tables </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="tables-basic.html" class="menu-link">
                            <span class="menu-text">Basic Tables</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="tables-datatables.html" class="menu-link">
                            <span class="menu-text">Data Tables</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_dribbble_line"></i></span>
                    <span class="menu-text"> Icons </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="icons-mingcute.html" class="menu-link">
                            <span class="menu-text">Mingcute</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="icons-feather.html" class="menu-link">
                            <span class="menu-text">Feather</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="icons-material-symbols.html" class="menu-link">
                            <span class="menu-text">Material Symbols </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="charts.html" class="menu-link">
                    <span class="menu-icon"><i class="mgc_chart_bar_line"></i></span>
                    <span class="menu-text"> Chart </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_location_line"></i></span>
                    <span class="menu-text"> Maps </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="maps-vector.html" class="menu-link">
                            <span class="menu-text">Vector Maps</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="maps-google.html" class="menu-link">
                            <span class="menu-text">Google Maps</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-title">Documentation</li>

            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_document_line"></i></span>
                    <span class="menu-text"> Documentation </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="docs-introduction.html" class="menu-link">
                            <span class="menu-text">Introduction</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="docs-installation.html" class="menu-link">
                            <span class="menu-text">Installation</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="docs-customization.html" class="menu-link">
                            <span class="menu-text">Customization</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="docs-changelog.html" class="menu-link">
                            <span class="menu-text">Changelog</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Help Box Widget -->
        <div class="my-10 mx-5">
            <div class="help-box p-6 bg-black/5 text-center rounded-md">
                <div class="flex justify-center mb-4">
                    <svg width="30" height="18" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15 0c-4 0-6.5 2-7.5 6 1.5-2 3.25-2.75 5.25-2.25 1.141.285 1.957 1.113 2.86 2.03C17.08 7.271 18.782 9 22.5 9c4 0 6.5-2 7.5-6-1.5 2-3.25 2.75-5.25 2.25-1.141-.285-1.957-1.113-2.86-2.03C20.42 1.728 18.718 0 15 0ZM7.5 9C3.5 9 1 11 0 15c1.5-2 3.25-2.75 5.25-2.25 1.141.285 1.957 1.113 2.86 2.03C9.58 16.271 11.282 18 15 18c4 0 6.5-2 7.5-6-1.5 2-3.25 2.75-5.25 2.25-1.141-.285-1.957-1.113-2.86-2.03C12.92 10.729 11.218 9 7.5 9Z" fill="#38BDF8"></path>
                    </svg>
                </div>
                <h5 class="mb-2">Unlimited Access</h5>
                <p class="mb-3">Upgrade to plan to get access to unlimited reports</p>
                <a href="javascript: void(0);" class="btn btn-sm bg-secondary text-white">Upgrade</a>
            </div>
        </div>
    </div>
</div>
<!-- Sidenav Menu End  -->