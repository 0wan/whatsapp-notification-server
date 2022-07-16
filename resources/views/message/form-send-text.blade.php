<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        {{ __('Send Text Message') }}
    </div>
    <div class="p-6 bg-white border-b border-gray-200 space-y-4">
        <div>
            <x-label for="phone" :value="__('Phone Number')" />
            <x-input id="phone" class="block mt-1 w-full" type="text" wire:model.defer="phone" required autofocus />
        </div>

        <div>
            <x-label for="message" :value="__('Message')" />
            <x-textarea id="message" class="block mt-1 w-full" type="text" wire:model.defer="message" required />
        </div>

        <div class="inline-flex items-center">
            <x-button class="mt-1" wire:click="submit" wire:loading.attr="disabled">
                {{ __('Send') }}
            </x-button>

            <x-form-session-status class="mt-1 ml-4" :status="session('status')" />
        </div>
    </div>
</div>
