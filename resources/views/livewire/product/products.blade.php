<div class="overflow-x-auto grid lg:grid-cols-1 gap-6">
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
                </div>

            </div>


            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">معرف التصنيف</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">اسم التصنيف</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> اسعار البيع</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> المخزون</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> سعر الشراء</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> تحذير عندما يصل الي</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> الفئة التابع لها</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> الحالة</th>
                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">عمليات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($products as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200  text-center">{{ $product->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">{{ $product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">
                                <ul>
                                    <li> السعر الاول-{{ $product->price1 }} </li>
                                    <li> السعر الثانى-{{ $product->price2 }}</li>
                                    <li> السعر الثالث-{{ $product->price3 }}</li>
                                </ul>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">
                                <ul>
                                    <li> عدد القطع -{{ $product->itemStock }} </li>
                                    <li> عددالبكتات -{{ $product->PacketStock }}</li>
                                    <li> عدد القطع في الباكت-{{ $product->items_in_packet }}</li>
                                </ul>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center"  >
                                <ul>
                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-black text-white">                                    <li style="font-size: larger;"> السعر الاول-{{ $product->buying_price }} </li>
                                    </span>
                                </ul>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">
                                <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <span class="w-1.5 h-1.5 inline-block bg-red-400 rounded-full"></span>
                                    {{ $product->stockAlert  }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">{{ $product->category->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 text-center" style="font-size: larger; font-weight: bolder">
            <div class="flex items-center">
                <!-- Toggle switch -->
                <input
                    class="form-switch"
                    type="checkbox"
                    role="switch"
                    id="flexSwitchCheck{{ $product->id }}"
                    wire:click="toggleStatus({{ $product->id }})"
                    {{ $product->isActive ? 'checked' : '' }}
                >
                <label class="ms-1.5" for="flexSwitchCheck{{ $product->id }}">
                    {{ $product->isActive ? 'مفعل' : 'غير مفعل' }}
                </label>
            </div>
        </td>

                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                <a class="text-danger hover:text-sky-700 mt-5 " href="#" style="font-size: larger; font-weight: bolder;" wire:click="delete({{$product->id }})">مسح</a><br>
                                <a class="text-primary hover:text-sky-700" href="#" style="font-size: larger; font-weight: bolder" wire:click="delete({{$product->id }})">تعديل</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>