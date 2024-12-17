<div>
    <main class="flex-grow p-6">
        <div class="grid lg:grid-cols-1 gap-6">
            <div class="lg:col-span-3 space-y-6">
                <div class="card" style="padding-top: 15px; padding-bottom: 15px; padding-right: 90px; padding-left: 90px;">
                    <div class="flex justify-between items-center mb-4">
                        <p class="card-title">التحكم في الصندوق</p>
                        <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                            <i class="mgc_transfer_line"></i>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <h6 class="text-sm mb-2">اضافة مبالغ العملاء للصندوق</h6>
                            <div class="flex flex-col gap-2">
                                <div class="form-check">
                                    <input wire:model="adding_customers_fund_to_box" value="1"
                                        type="radio" class="form-radio text-primary" name="formRadio1" id="formRadio1_01" checked>
                                    <label class="ms-1.5" for="formRadio1_01">نعم</label>
                                </div>
                                <div class="form-check">
                                    <input wire:model="adding_customers_fund_to_box" value="0"
                                        type="radio" class="form-radio text-primary" name="formRadio1" id="formRadio1_02">
                                    <label class="ms-1.5" for="formRadio1_02">لا</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h6 class="text-sm mb-2">اضافة المبيعات للصدندوق</h6>
                            <div class="flex flex-col gap-2">
                                <div class="form-check">
                                    <input wire:model="adding_sellers_fund_to_box" value="1"
                                        type="radio" class="form-radio text-primary" name="formRadio3" id="formRadio3_01" checked>
                                    <label class="ms-1.5" for="formRadio3_01">نعم</label>
                                </div>
                                <div class="form-check">
                                    <input wire:model="adding_sellers_fund_to_box" value="0"
                                        type="radio" class="form-radio text-primary" name="formRadio3" id="formRadio3_02">
                                    <label class="ms-1.5" for="formRadio3_02">لا</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h6 class="text-sm mb-2">خصم المشتريات من الصندوق</h6>
                            <div class="flex flex-col gap-2">
                                <div class="form-check">
                                    <input wire:model="subtract_Suppliers_fund_from_box" value="1"
                                        type="radio" class="form-radio text-primary" name="formRadio2" id="formRadio2_01" checked>
                                    <label class="ms-1.5" for="formRadio2_01">نعم</label>
                                </div>
                                <div class="form-check">
                                    <input wire:model="subtract_Suppliers_fund_from_box" value="0"
                                        type="radio" class="form-radio text-primary" name="formRadio2" id="formRadio2_02">
                                    <label class="ms-1.5" for="formRadio2_02">لا</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h6 class="text-sm mb-2">خصم مبالغ الموردين من الصندوق</h6>
                            <div class="flex flex-col gap-2">
                                <div class="form-check">
                                    <input wire:model="subtract_Procurement_fund_from_box" value="1"
                                        type="radio" class="form-radio text-primary" name="formRadio4" id="formRadio4_01" checked>
                                    <label class="ms-1.5" for="formRadio4_01">نعم</label>
                                </div>
                                <div class="form-check">
                                    <input wire:model="subtract_Procurement_fund_from_box" value="0"
                                        type="radio" class="form-radio text-primary" name="formRadio4" id="formRadio4_02">
                                    <label class="ms-1.5" for="formRadio4_02">لا</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h6 class="text-sm mb-2">خصم المصروفات من المصاريف</h6>
                            <div class="flex flex-col gap-2">
                                <div class="form-check">
                                    <input wire:model="subtract_Expenses_from_box" value="1"
                                        type="radio" class="form-radio text-primary" name="formRadio5" id="formRadio5_01" checked>
                                    <label class="ms-1.5" for="formRadio5_01">نعم</label>
                                </div>
                                <div class="form-check">
                                    <input wire:model="subtract_Expenses_from_box" value="0"
                                        type="radio" class="form-radio text-primary" name="formRadio5" id="formRadio5_02">
                                    <label class="ms-1.5" for="formRadio5_02">لا</label>
                                </div>
                            </div>
                        </div>

                        <div>
                        <button wire:click="update" style="position: relative; top: 40px;  font-size: 18px;" type="button" class="btn bg-success text-white rounded-full" >تحديث</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>



    </main>

    <main class="flex-grow p-6">
        <div class="grid lg:grid-cols-1 gap-6">
            <div class="lg:col-span-3 space-y-6">
                <div class="card" style="padding-top: 15px; padding-bottom: 15px; padding-right: 90px; padding-left: 90px;">
                    <div class="flex justify-between items-center mb-4">
                        <p class="card-title">تفاصيل الصندوق</p>
                        <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                            <i class="mgc_transfer_line"></i>
                        </div>
                    </div>

                    <nav class="flex space-x-2 border-b border-gray-200 dark:border-gray-700" aria-label="Tabs" role="tablist">
                        <button id="card-type-tab-item-1" aria-controls="card-type-tab-1" type="button" class="fc-tab-active:bg-white fc-tab-active:border-b-transparent fc-tab-active:text-primary dark:fc-tab-active:bg-gray-800 dark:fc-tab-active:border-b-gray-800 dark:fc-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400 active" role="tab">
                            المبلغ في الصندوق
                        </button>
                        <button id="card-type-tab-item-2" aria-controls="card-type-tab-2" type="button" class="fc-tab-active:bg-white fc-tab-active:border-b-transparent fc-tab-active:text-primary dark:fc-tab-active:bg-gray-800 dark:fc-tab-active:border-b-gray-800 dark:fc-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-gray-300" role="tab">
                            اعدادات الصندوق الحالية
                        </button>
                        <button id="card-type-tab-item-3" aria-controls="card-type-tab-3" type="button" class="fc-tab-active:bg-white fc-tab-active:border-b-transparent fc-tab-active:text-primary dark:fc-tab-active:bg-gray-800 dark:fc-tab-active:border-b-gray-800 dark:fc-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-gray-300" role="tab">
                            Tab 3
                        </button>
                    </nav>
                    <div class="mt-3">
                        <div id="card-type-tab-1" role="tabpanel" aria-labelledby="card-type-tab-item-1">
                            <p class="text-gray-500 text-center dark:text-gray-700" style="font-size: 30px;">
                                {{ $settings->box_value }}
                            </p>
                        </div>
                        <div id="card-type-tab-2" class="hidden flex justify-between gap-5" role="tabpanel" aria-labelledby="card-type-tab-item-2">
                            <p class="text-gray-700 text-center dark:text-gray-400 " style="font-size: 18px;">
                                اضافة مبالغ العملاء للصندوق :
                                @if ($settings->adding_customers_fund_to_box == 1)
                                <span class="text-green-600">مفعل</span>
                                @else
                                <br><span class="text-red-600">غير مفعل</span>
                                @endif
                            </p>
                            <p class="text-gray-700 text-center dark:text-gray-400" style="font-size: 18px;">
                                اضافة مبالغ المبيعات للصندوق :
                                @if ($settings->adding_sellers_fund_to_box == 1)
                                <span class="text-green-600">مفعل</span>
                                @else
                                <br><span class="text-red-600">غير مفعل</span>
                                @endif
                            </p>
                            <p class="text-gray-700 text-center dark:text-gray-400" style="font-size: 18px;">
                                خصم مبالغ الموردين للصندوق
                                @if ($settings->subtract_Procurement_fund_from_box == 1)
                                <span class="text-green-600">مفعل</span>
                                @else
                                
                                <br><span class="text-red-600">غير مفعل</span>
                                @endif
                            </p> 
                            <p class="text-gray-700 text-center dark:text-gray-400" style="font-size: 18px;">
                                خصم مبالغ المشتريات للصندوق :
                                @if ($settings->subtract_Suppliers_fund_from_box == 1)
                                <span class="text-green-600">مفعل</span>
                                @else
                                <br><span class="text-red-600">غير مفعل</span>
                                @endif
                            </p>
                            <p class="text-gray-700 text-center dark:text-gray-400" style="font-size: 18px;">
                                خصم مبالغ المشتريات للصندوق :
                                @if ($settings->subtract_Expenses_from_box == 1)
                                <span class="text-green-600">مفعل</span>
                                @else
                                <br><span class="text-red-600">غير مفعل</span>
                                @endif
                            </p>
                        </div>
                        <div id="card-type-tab-3" class="hidden" role="tabpanel" aria-labelledby="card-type-tab-item-3">
                            <p class="text-gray-500 dark:text-gray-400">
                                Tailwind CSS offers a seamless way...
                            </p>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('[role="tab"]'); // Select all tab buttons
        const tabContents = document.querySelectorAll('[role="tabpanel"]'); // Select all tab content divs

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active classes from all tabs and hide all content
                tabs.forEach(item => item.classList.remove('fc-tab-active', 'active'));
                tabContents.forEach(content => content.classList.add('hidden'));

                // Add active class to the clicked tab
                tab.classList.add('fc-tab-active', 'active');

                // Get the id of the target content from aria-controls
                const targetId = tab.getAttribute('aria-controls');
                const targetContent = document.getElementById(targetId);

                if (targetContent) {
                    targetContent.classList.remove('hidden'); // Show the corresponding content
                }
            });
        });
    });
</script>