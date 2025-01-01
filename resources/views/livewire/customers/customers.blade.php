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
                        placeholder="ابحث عن التصنيفات"
                        wire:model="search">

                    <button type="button" wire:click="thesearch" class="btn bg-info text-white" style="margin:10px">ابحث</button>
                    <button type="button" wire:click="viewAll" class="btn bg-dark text-white" style="margin:10px"> الكل</button>
                    <div style="width: 200px;" x-data="{ open: false }" class="relative">
                        <button @click="open = !open" type="button" class="py-2 px-3 inline-flex bg-success text-white justify-center items-center text-sm gap-2 rounded-md font-medium shadow-sm align-middle transition-all">
                            فلتر حسب الاجل <i class="mgc_down_line text-base"></i>
                        </button>

                        <div x-show="open" @click.outside="open = false" class="absolute mt-2 z-50 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700 transition-all duration-300">
                            <a wire:click="forhim; open = false"
                                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
                                له
                            </a>
                            <a wire:click="onhim; open = false"
                                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
                                عليه
                            </a>
                            <a wire:click="empty; open = false"
                                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
                                الرصيد فارغ
                            </a>
                        </div>
                    </div>

                </div>

            </div>

            <div class="overflow-x-auto">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 class=" overflow-x-auto"">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase text-center" style="font-size: larger; font-weight: bolder">معرف العميل</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase text-center" style="font-size: larger; font-weight: bolder">اسم العميل</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase text-center" style="font-size: larger; font-weight: bolder">عنوان العميل</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase text-center" style="font-size: larger; font-weight: bolder">ارقام الهاتف</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase text-center" style="font-size: larger; font-weight: bolder">ملاحظات</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase text-center" style="font-size: larger; font-weight: bolder">الرصيد</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase text-center" style="font-size: larger; font-weight: bolder">رقم المحفظة</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase text-center" style="font-size: larger; font-weight: bolder">سعر البيع</th>
                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase text-center" style="font-size: larger; font-weight: bolder">حد الاجل</th>
                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase text-center" style="font-size: larger; font-weight: bolder">العمليات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($customers as $customer)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 text-center">{{ $customer->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 text-center" style="font-size: larger; font-weight: bolder">{{ $customer->name }}</td>
                                @if ($customer->address)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 text-center" style="font-size: larger; font-weight: bolder;">{{ $customer->address }}</td>
                                @else
                                <td>
                                    <li> <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">لا يوجد عنوان</span> </li>
                                </td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 text-center" style="font-size: larger; font-weight: bolder">
                                    <ul>
                                        <li> <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">رقم الهاتف الاول-{{ $customer->phone1 }} </span> </li>
                                        @if ($customer->phone2)
                                        <li> <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">رقم الهاتف الثاني-{{ $customer->phone2 }} </span> </li>
                                        @else
                                        <li> <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">رقم الهاتف الثانى-لا يوجد</span> </li>
                                        @endif
                                    </ul>
                                </td>
                                @if ($customer->pocket_number)
                                <td>
                                    <li> <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">رقم الهاتف الثانى- {{ $customer->pocket_number }} </span> </li>
                                </td>
                                @else
                                <td>
                                    <li> <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">لا يوجد رقم المحفظة</span> </li>
                                </td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 text-center" style="font-size: larger; font-weight: bolder">
                                    <li> <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">{{ $customer->balance }}</span> </li>
                                </td>
                                @if ($customer->credit_limit)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 text-center" style="font-size: larger; font-weight: bolder">{{ $customer->credit_limit }}</td>
                                @else
                                <td>
                                    <li> <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">لا يوجد حد الاجل</span> </li>
                                </td>
                                @endif
                                @if ($customer->sell_price != 0)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 text-center" style="font-size: larger; font-weight: bolder">{{ $customer->sell_price }}</td>
                                @else
                                <td>
                                    <li> <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-red-800">غير محدد</span> </li>
                                </td>
                                @endif
                                @if ($customer->credit_limit_days)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 text-center" style="font-size: larger; font-weight: bolder">{{ $customer->credit_limit_days }}</td>
                                @else
                                <td>
                                    <li> <span class="inline-flex items-center gap-1.5 py-1.5 px-3 text-xs font-medium bg-green-100 text-green-800">لا يوجد حد ايام للاجل</span> </li>
                                </td>
                                @endif
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
                                                    هل انت متاكد من حذف العميل
                                                </p>
                                            </div>
                                            <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                                                <button class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">الغاء </button>
                                                <button class="btn text-white font-bold border border-slate-200 dark:border-slate-700 hover:bg-red-600 hover:dark:bg-red-700 transition-all" data-fc-dismiss type="button" wire:click="delete({{$customer->id }})" style="background-color: red;">حذف</button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>