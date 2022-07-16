<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Setting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4 sm:space-y-6 lg:space-y-8">
            <livewire:setting.form-server />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ __('Device') }}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
