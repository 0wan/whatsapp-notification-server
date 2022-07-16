<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        {{ __('Whatsapp Server') }}
    </div>
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            <div>
                <x-label for="form.host" :value="__('Host/Domain/URL')" />
                <x-input id="form.host" wire:model.defer="form.host" type="text" class="block mt-1 w-full" />
            </div>
            <div>
                <x-label for="form.port" :value="__('Port')" />
                <x-input id="form.port" wire:model.defer="form.port" type="text" class="block mt-1 w-full" />
            </div>
            <div>
                <label class="hidden xl:block">&nbsp;</label>
                <div class="inline-flex items-center">
                    <x-button class="mt-1" wire:click="submit" wire:loading.attr="disabled">
                        {{ __('Save') }}
                    </x-button>

                    <x-form-session-status class="mt-1 ml-4" :status="session('status')" />
                </div>
            </div>
        </div>
    </div>
</div>
