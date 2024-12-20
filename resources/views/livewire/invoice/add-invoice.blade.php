<main class="flex-grow p-6">
    <div class="grid lg:grid-cols-6 gap-6">
        <div class="lg:col-span-3 space-y-6">
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="card-title font-bold" style="font-size: 26px;">فاتورة رقم</h3>
                </div>

                <div class="relative max-w-l flex items-center gap-3 align-middle">
                    <div>
                        <label for="select-label" class="mb-2 block" style="font-weight:600;">نوع العميل</label>
                        <select id="select-label" class="form-select" wire:model="customerType"
                        wire:change="changeCustomerType">
                            <option value="attached">عميل موجود</option>
                            <option value="unattached">عميل غير موجود</option>
                        </select>
                    </div>

                    @if ($customerType == 'attached')
                    <input
                        type="text"
                        name="search-customer"
                        id="search-customer"
                        class="form-input ps-11 font-bold"
                        placeholder="ابحث عن عميل"
                        wire:model="searchCustomer">

                    <button type="button" wire:click="thesearchCustomer" class="btn bg-info text-white" style="margin:10px">ابحث</button>

                    <ul id="customer-list" class="flex flex-col" style="max-height: 200px; overflow-y: auto; padding: 10px; width: 25%;">
                        @if ($customers)
                        @foreach ($customers as $customer)
                        <li class="product-item inline-flex cursor-pointer items-center gap-x-2 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                            wire:click="selectedCustomer({{ $customer->id }})">
                            {{ $customer->name }} ({{ $customer->balance }})
                        </li>
                        @endforeach
                        @endif
                    </ul>
                    @endif
                </div>


                <div class="grid md:grid-cols-4 gap-3">

                    <div>
                        <label for="select-label" class="mb-2 block" style="font-weight:600;">طريقة الدفع</label>
                        <select id="select-label" class="form-select" wire:model="payMethod">
                            <option value="creditCard">بطاقة</option>
                            <option value="cash">كاش</option>
                            <option value="cheque">شيك </option>
                            <option value="credit">اجل </option>
                        </select>
                    </div>

                    <div>
                        <label for="example-number" class="text-gray-800 text-sm font-medium inline-block mb-2">المدفوع</label>
                        <input class="form-input" placeholder="الكمية" id="example-number" type="number" name="qty"
                            wire:model="payedAmount">
                    </div>
                </div>



                <div class="flex justify-between items-center mb-4">
                    <h3 class="card-title font-bold" style="font-size: 22px;">المنتجات</h3>
                    <div wire:click="addItem"
                        class="inline-flex items-center gap-2 justify-center rounded-lg cursor-pointer dark:bg-slate-700 w-100 h-9">
                        <i class="mgc_add_fill" style="font-size: 20px;"></i>
                        <p style="font-size: 18px;">اضف منتج للفاتورة</p>
                    </div>
                </div>
                @foreach ($items as $index => $item)
                <div class="flex justify-start gap-3 items-start mb-4">
                    <h1 class="card-title font-bold" style="font-size: 18px;">منتج رقم {{ $index + 1 }} </h1>
                    <button type="button" class="btn bg-danger text-white" wire:click="removeItem({{ $index }})">احذف المنتج</button>
                </div>
                <div class="flex flex-col gap-3 bg--100 p-3" style="border-radius: 10px;">
                    <div class="relative max-w-l flex items-center gap-3 align-middle">
                        <input
                            type="text"
                            name="table-with-pagination-search"
                            id="table-with-pagination-search"
                            class="form-input ps-11 font-bold"
                            placeholder="ابحث عن منتج"
                            wire:model="search">

                        <button type="button" wire:click="thesearch" class="btn bg-info text-white" style="margin:10px">ابحث</button>

                        <ul id="product-list" class="flex flex-col" style="max-height: 200px; overflow-y: auto; padding: 10px; width: 25%;">
                            @if ($products)
                            @foreach ($products as $product)
                            <li class="product-item inline-flex cursor-pointer items-center gap-x-2 py-2.5 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                                wire:click="selectProduct({{ $index }}, {{ $product->id }})">
                                {{ $product->name }} ({{ $product->itemStock }})
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="grid md:grid-cols-4 gap-3">
                        <div>
                            <label for="example-number" class="text-gray-800 text-sm font-medium inline-block mb-2">الكمية</label>
                            <input class="form-input" placeholder="الكمية" id="example-number" type="number" name="qty"
                                wire:model="items.{{ $index }}.quantity">
                        </div>

                        <div>
                            <label for="select-label" class="mb-2 block" style="font-weight:600;">سعر البيع له</label>
                            <select id="select-label" class="form-select" wire:model="items.{{ $index }}.sell_price"
                                wire:change="updatePrice({{ $index }})">
                                <option value="1">سعر رقم 1</option>
                                <option value="2">سعر رقم 2</option>
                                <option value="3">سعر رقم 3</option>
                            </select>
                        </div>

                        <div>
                            <label for="item-price" class="text-gray-800 text-sm font-medium inline-block mb-2">السعر</label>
                            <input class="form-input" placeholder="السعر" id="item-price" type="text" name="price"
                                value="{{ $item['calculated_price'] }}" disabled>
                        </div>

                        <div>
                            <label for="project-description" class="mb-2 block" style="font-weight:600;">ملاحظات</label>
                            <textarea id="project-description" class="form-input" rows="4" wire:model="items.{{ $index }}.notes"></textarea>
                        </div>
                    </div>
                </div>
                <hr style="margin: 20px;">
                @endforeach

            </div>
        </div>

        <div class="lg:col-span-3 mt-5">
            <div class="flex justify-end gap-3">
                <button type="button" class="inline-flex items-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none">
                    Cancle
                </button>
                <button
                    wire:click="saveInvoice"
                    type="button" class="inline-flex items-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none">
                    Save
                </button>
            </div>
        </div>


    </div>
    @if (session()->has('message'))
    <div class="bg-success/25 text-success text-center text-xl rounded-md p-4 mt-5" role="alert" style="width: 75%;">
        <span class="font-bold text-lg"></span> تم اضافة العميل بنجاح
    </div>
    @endif
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const productList = document.getElementById('product-list');
        const productItems = productList.querySelectorAll('.product-item');

        productItems.forEach(item => {
            item.addEventListener('click', function() {
                // Remove the unique class from all items
                productItems.forEach(product => product.classList.remove('active-product'));

                // Add the unique class to the clicked item
                this.classList.add('active-product');
            });
        });
    });
</script>