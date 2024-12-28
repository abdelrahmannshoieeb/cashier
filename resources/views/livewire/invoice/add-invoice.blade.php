<main class="flex-grow p-6">
    <div class="grid lg:grid-cols-6 gap-6">
        <div class="lg:col-span-4 space-y-6">
            <div class="card p-6">
                <h3 class="card-title font-bold mb-4" style="font-size: 26px;"> انشاء فاتورة</h3>


                <div class="grid md:grid-cols-2 gap-3">
                    <!-- Customer Selection -->
                    <div class="relative max-w-l flex items-center gap-3 mb-6">
                        <div class="flex">
                            <input class="form-switch" type="checkbox" id="flexSwitchCheck" wire:click="toggleCustomerType">
                            <label class="ms-1.5" for="flexSwitchCheck"></label>
                        </div>
                        <label class="text-gray-800 text-sm font-medium">
                            {{ $customerType === 'attached' ? 'عميل سابق' : 'عميل لمره واحده' }}
                        </label>
                        @if ($customerType === 'attached')
                        <input type="text" id="search-customer" class="form-input ps-11" placeholder="ابحث عن عميل"
                            wire:model="searchCustomer">
                        <button class="btn bg-info text-white" wire:click="thesearchCustomer">ابحث</button>
                        @else
                        <input type="text" id="customer-name" class="form-input" placeholder="اسم العميل"
                            wire:model="customerName">
                        @endif
                    </div>

                    @if ($searchCustomer)
                    <div class="overflow-x-auto mb-6">
                        <div class="min-w-full inline-block align-middle">
                            <ul style="max-height: 10rem; overflow-y: auto;" class="max-w-xs flex flex-col">
                                @foreach ($customers as $customer )
                                <li wire:click="selectedCustomer({{ $customer->id }})" style="cursor: pointer;"
                                    class="inline-flex items-center gap-x-2 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                    {{ $customer->name }} ({{ $customer->balance }})
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
                @if ($showButtons)
                <br>
                <div class="grid md:grid-cols-4 gap-3 mb-6 w-full">
                    <div>
                        <label class="text-gray-800 text-sm font-medium mb-2 block">المبلغ المدفوع</label>
                        <input type="number" class="form-input" wire:model="payedAmount">
                    </div>
                    <div>
                        <label class="text-gray-800 text-sm font-medium mb-2 block">ملاحظات</label>
                        <textarea type="text" class="form-input" wire:model="notes"> </textarea>
                    </div>
                    <div>
                        <label class="text-gray-800 text-sm font-medium mb-2 block">خصم</label>
                        <input type="number" class="form-input" wire:model="discount">
                    </div>
                    <div>
                        <label for="example-select" class="text-gray-800 text-sm font-medium inline-block mb-2">طريقة الدفع </label>
                        <select class="form-select" id="example-select" wire:model="payMethod">
                            <option value="creditCard">بطاقة الدفع</option>
                            <option value="cash">كاش</option>
                            <option value="cheque">شيك</option>
                            <option value="credit">اجل</option>
                        </select>
                    </div>

                </div>

                <!-- Product Table -->
                <table class="w-full border-collapse border border-gray-300 mb-6">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">اسم المنتج</th>
                            <th class="border border-gray-300 px-4 py-2">الكمية</th>
                            <th class="border border-gray-300 px-4 py-2">السعر</th>
                            <th class="border border-gray-300 px-4 py-2">الإجمالي</th>
                            <th class="border border-gray-300 px-4 py-2">إجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $index => $item)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $item['name'] }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="number"
                                    class="form-input"
                                    value="{{ $item['quantity'] }}"
                                    id="quantity-{{ $index }}"> <!-- Unique ID to target the value -->
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item['calculated_price'] }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ (int)$item['quantity'] * (float)$item['calculated_price'] }}
                            </td>

                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <button
                                    class="btn bg-danger text-white"
                                    wire:click="removeItem({{ $index }})">
                                    حذف
                                </button>
                                <button
                                    class="btn bg-info text-white"
                                    wire:click="updateQuantity({{ $index }}, document.getElementById('quantity-{{ $index }}').value)">
                                    تحديث الكمية
                                </button>
                            </td>
                        </tr>

                        @endforeach
                        <tr>
                            <td class="px-4 py-2 font-bold" colspan="3">الإجمالي</td> <!-- Merge cells and bold text -->
                            <td class="px-4 py-2 text-right">
                                {{ collect($items)->sum(function ($item) {
        return (float)$item['quantity'] * (float)$item['calculated_price'];
    }) }}
                            </td>

                        </tr>


                    </tbody>
                </table>

                <div class="flex justify-end mt-4">
                    <button class="btn bg-green-500 text-white" wire:click="addItem">أضف المنتج</button>
                </div>
                <div class="grid md:grid-cols-3 gap-3">
                    <!-- Search Product Section -->
                    <div>
                        <label class="text-gray-800 text-sm font-medium mb-2 block">اسم المنتج</label>
                        <input type="text" id="search-product" class="form-input" placeholder="ابحث عن منتج" wire:model="search">
                        <button class="btn bg-info text-white mt-2" wire:click="thesearch">ابحث</button>
                        @if ($search)
                        <div class="overflow-x-auto m-6">
                            <div class="min-w-full inline-block align-middle">
                                <ul style="max-height: 10rem; overflow-y: auto;" class="max-w-xs flex flex-col">
                                    @foreach ($products as $product)
                                    <li wire:click="selectProduct({{ $product->id }})" style="cursor: pointer;"
                                        class="inline-flex items-center gap-x-2 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                        {{ $product->name }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Quantity Section -->
                    <div>
                        <label class="text-gray-800 text-sm font-medium mb-2 block">الكمية</label>
                        <input type="number" class="form-input" wire:model="newItem.quantity">
                    </div>

                    <!-- Sell Price Section -->
                    @if ($selectedProduct)
                    <div>
                        <label class="text-gray-800 text-sm font-medium mb-2 block">اختر السعر</label>
                        <select class="form-input" wire:model="sell_price">
                            @if ($selectedProduct)
                            @if ($selectedProduct->itemStock > 0)
                            <option value="{{ $selectedProduct->price1 }}">Price 1 ({{ $selectedProduct->price1 }})</option>
                            <option value="{{ $selectedProduct->price2 }}">Price 2 ({{ $selectedProduct->price2 }})</option>
                            <option value="{{ $selectedProduct->price3 }}">Price 3 ({{ $selectedProduct->price3 }})</option>
                            @else
                            @foreach ($selectedProduct->stock as $stock)
                            <option value="{{ $stock->price }}">
                                {{ __(' نوع المخزن') }} {{ $stock->type }} ({{ __(' سعر') }}: {{ $stock->price }})
                            </option>
                            @endforeach
                            @endif
                            @endif
                        </select>

                    </div>
                    @endif


                    @if (session()->has('quantityError'))
                    <div class="bg-danger/25 text-dark text-center text-xl rounded-md p-4 mt-5" role="alert" style="width: 75%;">
                        <span class="font-bold text-lg"></span> {{ session('addItem') }}
                    </div>
                    @endif
                </div>



            </div>
        </div>
    </div>

    <div class="lg:col-span-3 mt-5">
        <div class="flex justify-end gap-3">
            <button type="button" class="inline-flex items-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none">
                الغاء
            </button>
            <button
                style="cursor: pointer;"
                wire:click="saveInvoice"
                type="button"
                id="redirectButton"
                class="inline-flex items-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none">
                طباعة وحفظ الفاتورة
            </button>
            @if ($invoice)

            <a
                href="{{ route('printer', $invoice->id) }}"
                type="button" class="inline-flex items-center rounded-md border border-transparent bg-indigo-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none">
                طباعة
            </a>

            @endif
        </div>
    </div>
    @else
    <div class="lg:col-span-3 mt-5">
        <div class="flex justify-end gap-3">
            <button
                wire:click="continueInvoice(true)"
                type="button" class="inline-flex items-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none">
                استمرار
            </button>
            <div class="flex justify-end gap-3">
                <button
                    wire:click="continueInvoice(false)"
                    type="button" class="inline-flex items-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none">
                    فاتورة جديدة
                </button>
                <p class="text-gray-500 " style="font-size: 20px;">العميل متبقى عليه اموال هل تريد الاستمرار في عمل الفاتورة؟</p>
            </div>
        </div>
        @endif



    </div>
    @if (session()->has('message'))
    <div class="bg-success/25 text-success text-center text-xl rounded-md p-4 mt-5" role="alert" style="width: 75%;">
        <span class="font-bold text-lg"></span> تم الحفظ بنجاح
    </div>
    @endif
    @if (session()->has('balance'))
    <div class="bg-warning/25 text-success text-center text-xl rounded-md p-4 mt-5" role="alert" style="width: 75%;">
        <span class="font-bold text-lg"></span> {{ session('balance') }}
    </div>
    @endif

</main>