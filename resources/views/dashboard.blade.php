<x-app-layout>
    <x-slot name="header">
        {{ __('Personal Access Tokens') }}
    </x-slot>

    <div class="overflow-hidden shadow-sm sm:rounded-lg">
        <div class="border-b border-gray-200">
            <div class="mb-8">
                <x-button type="href" :href="route('tokens.form')">{{ __('Generate New Token') }}</x-button>
            </div>

            @if (count($tokens) > 0)
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Used</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Delete</span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($tokens as $token)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $token->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $token->last_used_at ? $token->last_used_at->diffForHumans() : '' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="{{ route('tokens.delete', ['token' => $token->id]) }}">
                                                @csrf
                                                <x-button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </x-button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @else
            <div class="py-6 px-6 bg-white">
                {{ __('You don\'t have personal access tokens yet') }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
