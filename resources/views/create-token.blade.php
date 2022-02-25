<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Create New Token') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <form method="POST" action="{{ route('tokens.create') }}">
                @csrf
                <div>
                    <x-label for="email" :value="__('Token name')"/>
                    <x-input id="tokenName" class="block mt-1 w-full"
                             type="text" name="name"
                             :value="old('name')" required autofocus/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3">
                        {{ __('Generate') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
