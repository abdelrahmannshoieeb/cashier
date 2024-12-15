<main class="flex-grow p-6">
    <div class="grid lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3 space-y-6">
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <p class="card-title">Genrel Product Data</p>
                    <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                        <i class="mgc_transfer_line"></i>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <div class="">
                        <label for="project-name" class="mb-2 block " style="font-weight:600;">اسم المنتج</label>
                        <input style="font-weight:600;" type="email" id="project-name" class="form-input" placeholder="ادخل اسم المنتج" aria-describedby="input-helper-text" wire:model="name">
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="">
                        <label for="project-description" class="mb-2 block" style="font-weight:600;">وصف المنتج <span class="text-red-500">*</span></label>
                        <textarea id="project-description" class="form-input" rows="8" wire:model="description"></textarea>
                        @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="product-status" class="mb-2 block" style="font-weight:600;">حاله المنتج <span class="text-red-500">*</span></label>
                        <div class="flex gap-x-6">
                            <div class="flex">
                                <input type="radio" name="isActive" class="form-radio" id="private" value="1" wire:model="isActive">
                                <label for="private" class="text-sm text-gray-500 ms-2 dark:text-gray-400" style="font-weight:600;">مفعل</label>
                            </div>

                            <div class="flex">
                                <input type="radio" name="isActive" class="form-radio" id="public" value="0" wire:model="isActive">
                                <label for="public" class="text-sm text-gray-500 ms-2 dark:text-gray-400" style="font-weight:600;">مغلق</label>
                            </div>
                        </div>
                        @error('isActive') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid md:grid-cols-4 gap-3">
                        <div class="">
                            <label for="start-date" class="mb-2 block" style="font-weight:600;">سعر بيع 1</label>
                            <input type="text" id="start-date" class="form-input" wire:model="price1"></input>
                            @error('price1') <span class="text-red-500">{{ $message }}</span> @enderror

                        </div>

                        <div class="">
                            <label for="due-date" class="mb-2 block" style="font-weight:600;">سعر بيع 2</label>
                            <input type="text" id="due-date" class="form-input" wire:model="price2"></input>
                            @error('price2') <span class="text-red-500">{{ $message }}</span> @enderror

                        </div>
                        <div class="">
                            <label for="due-date" class="mb-2 block" style="font-weight:600;">سعر بيع 3</label>
                            <input type="text" id="due-date" class="form-input" style="font-weight:600;" wire:model="price3"></input>
                            @error('price3') <span class="text-red-500">{{ $message }}</span> @enderror

                        </div>
                        <div class="">
                            <label for="due-date" class="mb-2 block" style="font-weight:600;">سعر شراء</label>
                            <input type="text" id="due-date" class="form-input" style="font-weight:600;" wire:model="buying_price"></input>
                            @error('buying_price') <span class="text-red-500">{{ $message }}</span> @enderror

                        </div>
                    </div>
                    <div class="grid md:grid-cols-4 gap-3">
                        <div class="">
                            <label for="start-date" class="mb-2 block" style="font-weight:600;">كمية المنتج في المخزون</label>
                            <input type="text" id="start-date" class="form-input" style="font-weight:600;" wire:model="itemStock"></input>
                            @error('itemStock') <span class="text-red-500">{{ $message }}</span> @enderror

                        </div>

                        <div class="">
                            <label for="due-date" class="mb-2 block" style="font-weight:600;">كمية الباكتات في المخزون</label>
                            <input type="text" id="due-date" class="form-input" style="font-weight:600;" wire:model="PacketStock"></input>
                            @error('packetStock') <span class="text-red-500">{{ $message }}</span> @enderror

                        </div>
                        <div class="">
                            <label for="due-date" class="mb-2 block" style="font-weight:600;">عدد القطع في الباكته</label>
                            <input type="text" id="due-date" class="form-input" style="font-weight:600;" wire:model="items_in_packet"></input>
                            @error('items_in_packet') <span class="text-red-500">{{ $message }}</span> @enderror

                        </div>
                        <div class="">
                            <label for="due-date" class="mb-2 block" style="font-weight:600;">نبهني عندما ينقص المنتج عن رقم</label>
                            <input type="text" id="due-date" class="form-input" style="font-weight:600;" wire:model="stockAlert"></input>
                            @error('stockAlert') <span class="text-red-500">{{ $message }}</span> @enderror

                        </div>
                    </div>

                    <div>
                        <label for="select-label" class="mb-2 block" style="font-weight:600;">التصنيف التابع له</label>
                        <select id="select-label" class="form-select" wire:model="category_id">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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
        <span class="font-bold text-lg"></span> تم الحفظ بنجاح
    </div>
    @endif
</main>