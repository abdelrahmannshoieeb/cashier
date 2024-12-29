<main class="flex-grow p-6">
    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-3 space-y-6">
            <div class="card" style="padding-top: 15px; padding-bottom: 15px; padding-right: 60px; padding-left: 60px;">
                <div class="flex justify-between items-center mb-4">
                    <p class="card-title">اضافة سند مصاريف</p>
                    <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                        <i class="mgc_transfer_line"></i>
                    </div>
                </div>
                <div class="grid grid-rows-1 gap-6">
                    <div>
                        <div class="flex flex-col gap-2">
                            <div class="form-check">
                                <input wire:model="type" value="1"
                                    type="radio" class="form-radio text-primary" name="formRadio1" id="formRadio1_01" checked>
                                <label class="ms-1.5" for="formRadio1_01">اضافة</label>
                            </div>
                            <div class="form-check">
                                <input wire:model="type" value="0"
                                    type="radio" class="form-radio text-primary" name="formRadio1" id="formRadio1_02">
                                <label class="ms-1.5" for="formRadio1_02">سحب</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="simpleinput" class="text-gray-800 text-sm font-medium inline-block mb-2">المبلغ</label>
                        <input wire:model="amount" type="text" id="simpleinput" class="form-input">
                        @error($amount)
                            <div class="text-danger " style="font-size: 16px;">يرجي ادخال المبلغ بالارقام</div>
                        @enderror
                    </div>
                    <div>
                        <label for="simpleinput" class="text-gray-800 text-sm font-medium inline-block mb-2">لحساب</label>
                        <input wire:model="name" type="text" id="simpleinput" class="form-input">
                        @error($name)
                            <div class="text-danger " style="font-size: 16px;">يرجي ادخال سبب سحب المبلغ بالحروف</div>
                        @enderror
                    </div>

                    <div>
                        <label for="select-label" class="mb-2 block" style="font-weight:600;">طريقة تنفيذ العملية</label>
                        <select id="select-label" class="form-select" wire:model="method">
                            <option>اختر الطريقة</option>
                            <option value="cash">من الصندوق</option>
                            <option value="credit"> بطاقة</option>
                            <option value="cheque">شيك</option>
                        </select>
                    </div>



                    <div>
                        <button wire:click="create" style="  font-size: 18px;" type="button" class="btn bg-success text-white rounded-full">تنفيذ</button>
                    </div>
                </div>
                @if (session()->has('addsuccess'))
                <div class="bg-success/25 text-success text-center text-xl rounded-md p-4 mt-5" role="alert" style="width: 75%;">
                    <span class="font-bold text-lg"></span> {{ session('addsuccess') }}
                </div>
                @endif
                @if (session()->has('subtractmessage'))
                <div class="bg-success/25 text-success text-center text-xl rounded-md p-4 mt-5" role="alert" style="width: 75%;">
                    <span class="font-bold text-lg"></span> {{ session('subtractmessage') }}
                </div>
                @endif
                @if (session()->has('subtractmessagefailed'))
                <div class="bg-danger/25 text-danger text-center text-xl rounded-md p-4 mt-5" role="alert" style="width: 75%;">
                    <span class="font-bold text-lg"></span> {{ session('subtractmessagefailed') }}
                </div>
                @endif
            </div>
        </div>
    </div>



</main>