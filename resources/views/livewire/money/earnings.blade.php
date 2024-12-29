<div class="overflow-x-auto" style="width: 99%;">
    <div class="min-w-full inline-block align-middle">
        <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
            <div class="py-3 px-4 d-flex">

            <div style="width: 300px;" x-data="{ open: false }" class="relative">
                                    <button @click="open = !open" type="button" class="py-2 px-3 inline-flex bg-success text-white justify-center items-center text-sm gap-2 rounded-md font-medium shadow-sm align-middle transition-all">
                                        فلتر حسب الفترة <i class="mgc_down_line text-base"></i>
                                    </button>

                                    <div x-show="open" @click.outside="open = false" class="absolute mt-2 z-50 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700 transition-all duration-300">
                                        <a wire:click="filterBy('day')" class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
                                            خلال اليوم
                                        </a>
                                        <a wire:click="filterBy('week')" class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
                                            خلال أسبوع
                                        </a>
                                        <a wire:click="filterBy('month')" class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
                                            خلال شهر
                                        </a>
                                        <a wire:click="filterBy('year')" class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
                                            خلال سنة
                                        </a>
                                    </div>
                                </div>
            </div>


            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" style="min-height: 200px;">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">المبالغ المحصلة من المدفوع بالكامل</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder">المبالغ المستحقة من الاجل</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> المبالغ المستحقة من المدفوع دفع جزئي</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase   text-center" style="font-size: larger; font-weight: bolder"> المبالغ المحصلة من المدفوع دفع جزئي</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                         <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200  text-center" style="font-size: larger; font-weight: bolder">{{ $earnings_from_totally_paid }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">{{ $receivable_from_credit }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">{{ $receivable_from_partiallypaid }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200   text-center" style="font-size: larger; font-weight: bolder">{{ $earnings_from_partiallypaid }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>