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
                        placeholder="ابحث عن الموظفين"
                        wire:model="search">
                        <button type="button" wire:click="thesearch" class="btn bg-info text-white" style="margin:10px">ابحث</button>
                        <button type="button" wire:click="viewAll" class="btn bg-dark text-white" style="margin:10px"> الكل</button>
                </div>


            </div>


            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">معرف الموظف</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">الاسم </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> رقم الهانف</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">المحل التابع له</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> حالة الموظف</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> حالة الوصول للصندوق</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> حالة تعديل الفواتير</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> عدد الاوردرات التي قام بها </th>
                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">عمليات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200  text-center">{{ $user->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">{{ $user->phone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">{{ $user->shop->name }}</td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 text-center " style="font-size: larger; font-weight: bolder" >
                                <div class="flex">
                                    <!-- Toggle switch -->
                                    <input
                                        class="form-switch"
                                        type="checkbox"
                                        role="switch"
                                        id="flexSwitchCheck{{ $user->id }}"
                                        wire:click="toggleStatus({{ $user->id }})"
                                        {{ $user->is_active ? 'checked' : '' }}>
                                    <label class="ms-1.5" for="flexSwitchCheck{{ $user->id }}">
                                        {{ $user->is_active ? 'مفعل' : 'غير مفعل' }}
                                    </label>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 text-center " style="font-size: larger; font-weight: bolder" >
                                <div class="flex">
                                    <!-- Toggle switch -->
                                    <input
                                        class="form-switch"
                                        type="checkbox"
                                        role="switch"
                                        id="flexSwitchCheck{{ $user->id }}"
                                        wire:click="toggleBoxAccess({{ $user->id }})"
                                        {{ $user->box_access ? 'checked' : '' }}>
                                    <label class="ms-1.5" for="flexSwitchCheck{{ $user->id }}">
                                        {{ $user->box_access ? 'مفعل' : 'غير مفعل' }}
                                    </label>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 text-center " style="font-size: larger; font-weight: bolder" >
                                <div class="flex">
                                    <!-- Toggle switch -->
                                    <input
                                        class="form-switch"
                                        type="checkbox"
                                        role="switch"
                                        id="flexSwitchCheck{{ $user->id }}"
                                        wire:click="toggleEditIvoicesAccess({{ $user->id }})"
                                        {{ $user->edit_invoices_access ? 'checked' : '' }}>
                                    <label class="ms-1.5" for="flexSwitchCheck{{ $user->id }}">
                                        {{ $user->edit_invoices_access ? 'مفعل' : 'غير مفعل' }}
                                    </label>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">{{ count( $user->invoice  )}}</td>


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
                                                هل انت متاكد من حذف الموظف
                                            </p>
                                        </div>
                                        <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                                            <button class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">الغاء </button>
                                            <button class="btn text-white font-bold border border-slate-200 dark:border-slate-700 hover:bg-red-600 hover:dark:bg-red-700 transition-all" data-fc-dismiss type="button" wire:click="delete({{$user->id }})" style="background-color: red;">حذف</button>
                                            </div>
                                    </div>
                                </div>                                <a class="text-primary hover:text-sky-700" href="{{ route('editWorker', $user->id) }}" style="font-size: larger; font-weight: bolder" >تعديل</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    </div>
        </div>
    </div>
</div>