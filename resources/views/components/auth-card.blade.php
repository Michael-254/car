<div class="flex flex-col sm:justify-center items-center mt-4 pt-3 sm:pt-0">
    <div>
        <div class="bg-white flex justify-center items-center p-5 border-4 border-green-500">
            <img class="w-16 h-16" src="{{asset('/storage/logo.png')}}" />
        </div>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>