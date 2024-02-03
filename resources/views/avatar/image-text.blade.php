<div class="font-medium dark:text-white ps-2">
    <div>{{ $getRecord()->name }}</div>
    <div class="text-sm text-gray-500 dark:text-gray-500">
        <span class="ps-1 text-sm">{{ $getRecord()->type ? $getRecord()->type : 'admin' }}</span>
    </div>
</div>
