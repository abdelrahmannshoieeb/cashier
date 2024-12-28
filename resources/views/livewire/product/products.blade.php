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
                    <div style="width: 450px;" x-data="{ open: false }" class="relative">
                        <button wire:click="alerted" type="button" class="btn bg-info text-white">عرض منتجات اقتربت على الانتهاء</button>
                    </div>
                    <div style="width: 300px;" x-data="{ open: false }" class="relative">
                        <button @click="open = !open" type="button" class="py-2 px-3 inline-flex bg-success text-white justify-center items-center text-sm gap-2 rounded-md font-medium shadow-sm align-middle transition-all">
                            فلتر حسب الكمية <i class="mgc_down_line text-base"></i>
                        </button>

                        <div x-show="open" @click.outside="open = false" class="absolute mt-2 z-50 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700 transition-all duration-300">
                            <a wire:click="stockFilter (1, 100); open = false " ; open=false"
                                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
                                من 1 ل 100
                            </a>
                            <a wire:click="stockFilter (100, 200); open = false "
                                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
                                من 100 ل 200
                            </a>
                            <a wire:click="stockFilter (200, 300); open = false "
                                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
                                من 200 ل 300
                            </a>
                            <a wire:click="stockFilter (300, 400); open = false "
                                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
                                من 300 ل 400
                            </a>
                            <a wire:click="stockFilter (400, 5000); open = false "
                                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
                                اكثر من 400
                            </a>
                        </div>
                    </div>
                    <div style="width: 300px;" x-data="{ open: false }" class="relative">
                        <button @click="open = !open" type="button" class="py-2 px-3 inline-flex bg-success text-white justify-center items-center text-sm gap-2 rounded-md font-medium shadow-sm align-middle transition-all">
                            فلتر حسب التصنيف <i class="mgc_down_line text-base"></i>
                        </button>

                        <div x-show="open" @click.outside="open = false" class="absolute mt-2 z-50 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700 transition-all duration-300">
                            @foreach ($categories as $category )

                            <a wire:click="categoryFilter ({{$category->id}}); open = false " ; open=false"
                                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
                                {{ $category->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">  الجديد المخزون</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> سعر الشراء</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> تحذير عندما يصل الي</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> الفئة التابع لها</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> الحالة</th>
                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">عمليات</th>
                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">اضف للمخزون</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($products as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200  text-center">#{{ $product->id }}</td>
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">
                                <ul>
                                    @foreach ($product->stock as $stock )
                                    <div style="border: 1px solid; padding: 2px ; border-radius: 5px; margin: 2px">
                                        <li> عدد القطع -{{ $stock->quantity}}</li>
                                        <li> سعر القطعة  -{{ $stock->price}}</li>
                                        <li>  رقم المخزون -{{ $stock->type}}</li>
                                    </div>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center">
                                <ul>
                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-black text-white">
                                        <li style="font-size: larger;"> {{ $product->buying_price }} </li>
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
                                        {{ $product->isActive ? 'checked' : '' }}>
                                    <label class="ms-1.5" for="flexSwitchCheck{{ $product->id }}">
                                        {{ $product->isActive ? 'مفعل' : 'غير مفعل' }}
                                    </label>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                <!-- Delete Button that Opens Modal -->
                                <button type="button" class="text-danger hover:text-sky-700 mt-5" data-fc-target="default-modal-{{ $product->id }}" data-fc-type="modal" style="font-size: larger; font-weight: bolder;">مسح</button><br>

                                <!-- Modal for each Product -->
                                <div id="default-modal-{{ $product->id }}" class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
                                    <div class="fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                                        <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                                Modal Title
                                            </h3>
                                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200" data-fc-dismiss type="button">
                                                <span class="material-symbols-rounded">close</span>
                                            </button>
                                        </div>
                                        <div class="px-4 py-8 overflow-y-auto">
                                            <p class="text-gray-800 dark:text-gray-200">
                                                هل انت متاكد من حذف المنتج
                                            </p>
                                        </div>
                                        <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                                            <button class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">الغاء</button>
                                            <button class="btn text-white font-bold border border-slate-200 dark:border-slate-700 hover:bg-red-600 hover:dark:bg-red-700 transition-all" data-fc-dismiss type="button" wire:click="delete({{ $product->id }})" style="background-color: red;">حذف</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Button -->
                                <a class="text-primary hover:text-sky-700" href="{{ route('editProduct', $product->id) }}" style="font-size: larger; font-weight: bolder">تعديل</a>
                            </td>
                            <td>
                                <!-- Button to Open Modal for Adding to Stock -->
                                <button type="button" class="text-danger hover:text-sky-700 mt-5" data-fc-target="default-moda-{{ $product->id }}" data-fc-type="modal" style="font-size: larger; font-weight: bolder;">اضف للمخزون</button><br>

                                <!-- Modal for Adding to Stock (Dynamic for each product) -->
                                <div id="default-moda-{{ $product->id }}" class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
                                    <div class="fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                                        <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                                اضف للمخزون
                                            </h3>
                                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200" data-fc-dismiss type="button">
                                                <span class="material-symbols-rounded">close</span>
                                            </button>
                                        </div>
                                        <div class="px-4 py-8 overflow-y-auto">
                                            <div>
                                                <!-- Dropdown to Select Quantity -->
                                                <label for="example-select-{{ $product->id }}" class="text-gray-800 text-sm font-medium inline-block mb-2">اختر المخزون</label>
                                                <select class="form-select" id="example-select" wire:model="quantityDropdown">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>

                                                <!-- Input to Enter Quantity -->
                                                <label class="text-gray-800 text-sm font-medium mb-2 block">الكمية</label>
                                                <input type="number" class="form-input" wire:model="productQuantityAdded">
                                                <label class="text-gray-800 text-sm font-medium mb-2 block">السعر</label>
                                                <input type="number" class="form-input" wire:model="price">
                                            </div>
                                        </div>
                                        <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                                            <button class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">الغاء</button>

                                            <!-- Button to Add Product to Stock (Trigger Livewire method) -->
                                            <button class="btn text-white font-bold border border-slate-200 dark:border-slate-700 hover:bg-red-600 hover:dark:bg-red-700 transition-all" data-fc-dismiss type="button" style="background-color: red;" wire:click="addProductToStock({{ $product->id }})">اضافة</button>
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