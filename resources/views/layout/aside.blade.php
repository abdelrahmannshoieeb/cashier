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

          

            <li class="menu-title"> الفواتير</li>
            <li class="menu-item">
                <a href="{{ route('addInvoice')}}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                    <span class="menu-text font-bold"> اضافة فواتير </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('unpaidInvoices')}}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                    <span class="menu-text font-bold">   الفواتير الاجله </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('partiallyPaid')}}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                    <span class="menu-text font-bold">   الفواتير المتبقي منها مبلغ </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('paidInvoices')}}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_coupon_line"></i></span>
                    <span class="menu-text font-bold">   الفواتير المدفوعة بالكامل </span>
                </a>
            </li>
            
            <li class="menu-title"> التصنيفات والمنتجات</li>
    

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
          

            <li class="menu-title">الصندوق</li>
            
            <li class="menu-item">
                <a href="{{route('boxControl')}}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_folder_2_line"></i></span>
                    <span class="menu-text font-bold"> التحكم  في الصندوق </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{route('boxoperations')}}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_folder_2_line"></i></span>
                    <span class="menu-text font-bold"> سحب واضافة الى الصندوق </span>
                </a>
            </li>
            <li class="menu-title">المصاريف</li>
            
            <li class="menu-item">
                <a href="{{route('expenses')}}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_folder_2_line"></i></span>
                    <span class="menu-text font-bold"> عرض حركة المصاريف </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{route('addExpense')}}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_folder_2_line"></i></span>
                    <span class="menu-text font-bold"> اضافة سند مصاريف </span>
                </a>
            </li>
            
            
            <li class="menu-title">العملاء</li>
            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_building_2_line"></i></span>
                    <span class="menu-text"> العملاء </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{route('customers')}}" class="menu-link">
                            <span class="menu-text"> العملاء</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('addCustomer')}}" class="menu-link">
                            <span class="menu-text">اضافة عميل</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('addCustomersBalance')}}" class="menu-link">
                            <span class="menu-text">اضافة رصيد العملاء</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('customerBonnds')}}" class="menu-link">
                            <span class="menu-text">سندات العملاء</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-title">الموردين</li>
            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_building_2_line"></i></span>
                    <span class="menu-text"> الموردين </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{route('suppliers')}}" class="menu-link">
                            <span class="menu-text"> الموردين</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('addSupplier')}}" class="menu-link">
                            <span class="menu-text">اضافة مورد</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('addSupplierBalance')}}" class="menu-link">
                            <span class="menu-text">اضافة رصيد للمورد</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('supplierBonnds')}}" class="menu-link">
                            <span class="menu-text">سندات الموردين</span>
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