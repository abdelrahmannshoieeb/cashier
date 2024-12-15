<main class="flex-grow p-6">

    <div class="grid lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3 space-y-6">
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <p class="card-title">اضافة تصنيف</p>
                    <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                        <i class="mgc_transfer_line"></i>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <div class="">
                        <label for="project-name" class="mb-2 block font-bold">اسم التصنيف</label>
                        <input type="email" id="project-name" class="form-input" placeholder="ادخل اسم" aria-describedby="input-helper-text" wire:model="name">
                    </div>


                </div>
            </div>
        </div>

        <div class="lg:col-span-3 mt-5" style="float: right">
            <div class="flex justify-end gap-3">
                <button type="button" class="inline-flex items-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-bold text-white shadow-sm hover:bg-red-500 focus:outline-none" wire:click="cancel">
                    الغاء
                </button>
                <button wire:click="save"
                    type="button" class="inline-flex items-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-bold text-white shadow-sm hover:bg-green-500 focus:outline-none">
                    حفظ
                </button>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto grid lg:grid-cols-2 gap-6">
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
                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">عمليات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($categories as $category)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200  text-center">{{ $category->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">{{ $category->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <a class="text-primary hover:text-sky-700" href="#" style="font-size: larger; font-weight: bolder" wire:click="delete({{$category->id }})">مسح</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>