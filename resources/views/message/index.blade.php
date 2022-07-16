<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Message') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ __('Send Text Message') }}
                </div>
                <div class="p-6 bg-white border-b border-gray-200 space-y-4">
                    <div>
                        <x-label for="phone" :value="__('Phone Number')" />

                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus />
                    </div>

                    <div>
                        <x-label for="message" :value="__('Message')" />

                        <x-textarea id="message" class="block mt-1 w-full" type="text" name="message" :value="old('message')" required />
                    </div>

                    <div>
                        <x-button class="mt-1">
                            {{ __('Send') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
