<x-app-layout>
    <x-slot name="header">
        <div class="flex sm:justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('REST API') }}
            </h2>
            <div class="mt-2 sm:mt-0">
                <livewire:token.form-create-token/>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4 sm:space-y-6 lg:space-y-8">
            <livewire:token.token-lists />
        </div>
    </div>
</x-app-layout>
