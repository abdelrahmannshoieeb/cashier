<main class="flex-grow p-6">
    <div class="grid lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3 space-y-6">
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <p class="card-title">تعديل بيانات الموظف</p>
                    <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                        <i class="mgc_transfer_line"></i>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <div class="">
                        <label for="project-name" class="mb-2 block " style="font-weight:600;">اسم الموظف</label>
                        <input style="font-weight:600;" type="email" id="project-name" class="form-input" placeholder=" {{ $worker->name }} " aria-describedby="input-helper-text" wire:model="name">
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="example-select" class="text-gray-800 text-sm font-medium inline-block mb-2" class="form-label font-bold">الفرع التابع له </label>
                        <select class="form-select" id="example-select" wire:model="shop_id">
                            @foreach ($shops as $shop )
                            <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="">
                        <label for="project-description" class="mb-2 block" style="font-weight:600;">هاتف الموظف <span class="text-red-500">*</span></label>
                        <input id="project-description" class="form-input"  wire:model="phone" placeholder="  {{ $worker->phone }}"></input>
                        @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="">
                        <label for="project-description" class="mb-2 block" style="font-weight:600;">كلمة مرور الموظف <span class="text-red-500">*</span></label>
                        <input id="password" type="password" class="form-input" wire:model="pass"></input>
                        @error('pass') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>



                    <div class="grid md:grid-cols-4 gap-3">
                        <div class="flex items-center">
                            <input
                                class="form-switch"
                                type="checkbox"
                                role="switch"
                                wire:click="toggleStatus">
                            <label class="ms-1.5">
                                حالة المتستخدم-{{ $is_active ? 'فعال' : 'غير فعال' }}
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input
                                class="form-switch"
                                type="checkbox"
                                role="switch"
                                wire:click="toggleBoxAccess">
                            <label class="ms-1.5">
                                حالة الوصول للصندوق-{{ $box_access ? 'فعال' : 'غير فعال' }}
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input
                                class="form-switch"
                                type="checkbox"
                                role="switch"
                                wire:click="toggleEditInoviceAccess">
                            <label class="ms-1.5">
                                حالة تعديل الفواتير-{{ $edit_invoices_access ? 'فعال' : 'غير فعال' }}

                            </label>
                        </div>
                        <div class="flex items-center">
                            <input
                                class="form-switch"
                                type="checkbox"
                                role="switch"
                                wire:click="toggleEditProductAccess">
                            <label class="ms-1.5">
                                حالة تعديل المنتج-{{ $edit_product ? 'فعال' : 'غير فعال' }}

                            </label>
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
                    wire:click="edit"
                    type="button" class="inline-flex items-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none">
                    Save
                </button>
            </div>
        </div>


    </div>
    @if (session()->has('message'))
    <div class="bg-success/25 text-success text-center text-xl rounded-md p-4 mt-5" role="alert" style="width: 75%;">
        <span class="font-bold text-lg"></span> تم تعديل بيانات الموظف بنجاح
    </div>
    @endif
</main>