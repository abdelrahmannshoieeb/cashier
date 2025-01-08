<div class="overflow-x-auto" style="width: 99%;">
    <div class="min-w-full inline-block align-middle">
        <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
            <div class="py-3 px-4 d-flex">
                <div class="relative max-w-l flex items-center">
                    <input
                        type="text"
                        name="table-with-pagination-search"
                        id="table-with-pagination-search"
                        class="form-input ps-11 font-bold"
                        placeholder="ابحث عن الفواتير الخاصة بعميل باسم العميل"
                        wire:model="customerName">

                    <button type="button" wire:click="searchByCustomer" class="btn bg-info text-white" style="margin:10px">ابحث</button>
                    <button type="button" wire:click="viewAll" class="btn bg-dark text-white" style="margin:10px"> الكل</button>
                </div>
                <div class="relative max-w-l flex items-center">
                    <input
                        type="text"
                        name="table-with-pagination-search"
                        id="table-with-pagination-search"
                        class="form-input ps-11 font-bold"
                        placeholder="ابحث عن الفواتير بمعرف الفاتورة"
                        wire:model="invoiceId">

                    <button type="button" wire:click="searchByInvoice" class="btn bg-info text-white" style="margin:10px">ابحث</button>
                    <button type="button" wire:click="viewAll" class="btn bg-dark text-white" style="margin:10px"> الكل</button>
                </div>

            </div>


            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">معرف التصنيف</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">اسم العميل</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> المنتجات في الفاتورة</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> المجموع</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> طريقة الدفع </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> الخصم</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> نوع العميل</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> منفذ الفاتورة </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> التاريخ </th>
                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">عمليات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($paid_invoices as $invoice)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200  text-center">#{{ $invoice->id }}</td>
                            @if ($invoice->customerType === 'unattached')
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">{{ $invoice->customerName }}</td>
                            @else
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">{{ $invoice->customer->name }}</td>
                            @endif
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">
                                <ul>
                                    @foreach ($invoice->items as $item)
                                    <li style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                                        <div>
                                            <strong>المنتج:</strong> {{ $item->product->name }}
                                        </div>
                                        <div>
                                            <strong>الكمية:</strong> {{ $item->qty }}
                                        </div>
                                        <div>
                                            <strong>السعر:</strong> {{ $item->sellPrice }}
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>


                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center">
                                <ul>
                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-black text-white">
                                        <li style="font-size: larger;"> {{ $invoice->total }} </li>
                                    </span>
                                </ul>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center">
                                <ul>
                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-danger text-white">
                                        <li style="font-size: larger;"> {{ $invoice->payMethod }} </li>
                                    </span>
                                </ul>
                            </td>

                            @if ($invoice->discount)
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">
                                <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <span class="w-1.5 h-1.5 inline-block bg-green-400 rounded-full"></span>
                                    {{ $invoice->discount  }}
                                </span>
                            </td>
                            @else
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">
                                <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <span class="w-1.5 h-1.5 inline-block bg-red-400 rounded-full"></span>
                                    لا يوجد خصم
                                </span>
                            </td>
                            @endif
                            @if ($invoice->customerType == 'attached')
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">
                                <a href="{{ route('customers') }}" title="اذهب لجدول العملاء" style="text-decoration: underline;">عميل دائم
                                    <span class="mgc_arrow_right_up_fill text-base text-primary"></span>
                                </a>

                            </td>
                            @else
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">عميل غير دائم</td>
                            @endif
                            @if ($invoice->user->role === 'admin')
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">مستر ابو المجد</td>
                            @else
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder"> {{$invoice->user->name}}</td>
                            @endif
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 text-center" style="font-size: larger; font-weight: bolder">
                                {{ $invoice->created_at->format('d-m-Y') }} <br>
                                {{ $invoice->created_at->addHours(2)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                <button type="button" class="text-danger hover:text-sky-700 mt-5 " data-fc-target="default-modal" data-fc-type="modal" type="button" style="font-size: larger; font-weight: bolder;">مسح</button><br>
                                <div id="default-modal" class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
                                    <div class="fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                                        <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                                Modal Title
                                            </h3>
                                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                                                data-fc-dismiss type="button">
                                                <span class="material-symbols-rounded">close</span>
                                            </button>
                                        </div>
                                        <div class="px-4 py-8 overflow-y-auto">
                                            <p class="text-gray-800 dark:text-gray-200">
                                                هل انت متاكد من حذف الفاتورة
                                            </p>
                                        </div>
                                        <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                                            <button class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">الغاء </button>
                                            <button class="btn text-white font-bold border border-slate-200 dark:border-slate-700 hover:bg-red-600 hover:dark:bg-red-700 transition-all" data-fc-dismiss type="button" wire:click="delete({{$invoice->id }})" style="background-color: red;">حذف</button>
                                        </div>
                                    </div>
                                </div>
                                <a class="text-primary hover:text-sky-700" href="{{ route('printer', $invoice->id) }}" style="font-size: larger; font-weight: bolder">اعد طباعة الفاتورة</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>