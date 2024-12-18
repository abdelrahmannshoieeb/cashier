<div class="flex justify-between items-center mb-6">
    <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $title }}</h4>

    <div class="md:flex hidden items-center gap-2.5 text-sm font-semibold">
        @foreach ($links as $name => $route)
            <div class="flex items-center gap-2">
                @if (!$loop->first)
                    <i class="mgc_right_line text-lg flex-shrink-0 text-slate-400 rtl:rotate-180"></i>
                @endif
                <a href="{{ route($route) }}" class="text-sm font-medium text-slate-700 dark:text-slate-400">{{ $name }}</a>
            </div>
        @endforeach
    </div>
</div>
