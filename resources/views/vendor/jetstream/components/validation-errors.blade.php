<div {{ $attributes }}>
    @foreach ($errors->all() as $error)
        <div class="text-center py-4">
            <div class="block w-full p-2 bg-red-800 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">{{ __('privbin.error') }}</span>
                <span class="font-semibold mr-2 text-left flex-auto">{{ $error }}</span>
            </div>
        </div>
    @endforeach
</div>
