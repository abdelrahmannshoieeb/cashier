<main class="flex-grow p-6">
    <div class="grid lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3 space-y-6">
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <p class="card-title">اضافة عميل جديد</p>
                    <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                        <i class="mgc_transfer_line"></i>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
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
                    <div class="">
                        <label for="project-name" class="mb-2 block " style="font-weight:600;">عنوان العميل</label>
                        <input style="font-weight:600;" type="email" id="project-name" class="form-input" placeholder="ادخل عنوان العميل" aria-describedby="input-helper-text" wire:model="addrees">
                        @error('addrees') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="">
                        <label for="project-description" class="mb-2 block" style="font-weight:600;">ملاحظات <span class="text-red-500">*</span></label>
                        <textarea id="project-description" class="form-input" rows="8" wire:model="notes"></textarea>
                        @error('notes') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>


                    <div class="grid md:grid-cols-4 gap-3">
                        <div>
                            <label for="select-label" class="mb-2 block" style="font-weight:600;">سعر البيع له</label>
                            <select id="select-label" class="form-select" wire:model="sell_price">
                                <option value="1">سعر رقم 1</option>
                                <option value="2">سعر رقم 2</option>
                                <option value="3">سعر رقم 3</option>
                                <option value="0">غير محدد</option>
                            </select>
                        </div>

                        <div class="">
                            <label for="due-date" class="mb-2 block" style="font-weight:600;"> رقم هاتف اول</label>
                            <input type="text" id="due-date" class="form-input" wire:model="phone1"></input>
                            @error('phone1') <span class="text-red-500">{{ $message }}</span> @enderror

                        </div>
                        <div class="">
                            <label for="due-date" class="mb-2 block" style="font-weight:600;"> رقم هاتف ثاني</label>
                            <input type="text" id="due-date" class="form-input" style="font-weight:600;" wire:model="phone2"></input>
                            @error('phone2') <span class="text-red-500">{{ $message }}</span> @enderror

                        </div>
                        <div class="">
                            <label for="due-date" class="mb-2 block" style="font-weight:600;">رقم محفظة</label>
                            <input type="text" id="due-date" class="form-input" style="font-weight:600;" wire:model="pocket_number"></input>
                            @error('pocket_number') <span class="text-red-500">{{ $message }}</span> @enderror

                        </div>
                    </div>

                    <div class="grid md:grid-cols-4 gap-3">
                        <div class="">
                            <label for="start-date" class="mb-2 block" style="font-weight:600;">سقف البيع الاجل</label>
                            <input type="text" id="start-date" class="form-input" style="font-weight:600;" wire:model="credit_limit"></input>
                            @error('credit_limit') <span class="text-red-500">{{ $message }}</span> @enderror

                        </div>

                        <div class="">
                            <label for="due-date" class="mb-2 block" style="font-weight:600;">نبهني بالاجل بعد</label>
                            <input type="text" id="due-date" class="form-input" style="font-weight:600;" wire:model="credit_limit_days"></input>
                            @error('credit_limit_days') <span class="text-red-500">{{ $message }}</span> @enderror

                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="lg:col-span-3 mt-5">
            <div class="flex justify-end gap-3">
                <button type="button" class="inline-flex items-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none">
                    Cancle
                </button>
                <button
                    wire:click="save"
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