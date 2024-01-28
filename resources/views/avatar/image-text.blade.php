<div class="flex items-center gap-3">
    <img class="w-10 h-10 rounded-full" src="{{ Storage::url($getRecord()->photo) }}">
    <div class="font-medium dark:text-white">
        <div>{{ $getRecord()->name }}</div>
        <div class="text-sm text-gray-500 dark:text-gray-500">
            <span class="px-2 text-sm">{{ $getRecord()->status ? $getRecord()->status : 'admin' }}</span>
        </div>
    </div>
</div>
