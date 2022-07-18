<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Setting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4 sm:space-y-6 lg:space-y-8">
            <livewire:setting.form-server />
            <livewire:setting.form-device/>
        </div>
    </div>
</x-app-layout>
