<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        {{ __('Device') }}
        <x-button wire:click="getStatus" type="button" class="ml-8">Check Status</x-button>
    </div>
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex items-center gap-4 md:gap-6">
            <div class="">
                <x-label value="Last Device Status :" />
                <span clas="font-medium text-base">{{ $latest }}</span>
            </div>
            <div class="">
                <x-label value="Current Device Status :" />
                <span clas="font-medium text-base">{{ $status }}</span>
            </div>
        </div>
        @if($qr)
        <div class="">
            <x-label value="Scan QRCode below :" />
            <div class="">
                {!! QrCode::size(300)->generate($qr) !!}
            </div>
        </div>
        @endif
    </div>
</div>
