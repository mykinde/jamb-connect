<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Accounts Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Overview of All Accounts</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <div class="bg-blue-100 p-4 rounded-lg shadow-md flex flex-col items-center">
                            <p class="text-blue-700 font-semibold text-lg">Total Accounts</p>
                            <p class="text-blue-900 text-3xl font-extrabold">{{ $totalAccounts }}</p>
                        </div>
                        {{-- Add more statistics cards here if needed, e.g., total balance --}}
                    </div>

                    <form action="{{ route('admin.accounts.dashboard') }}" method="GET" class="mb-8 p-6 border rounded-lg bg-gray-50 shadow-sm flex items-end space-x-4">
                        <div>
                            <x-input-label for="search" :value="__('Search by Account Name / User Name / User Email')" />
                            <x-text-input id="search" class="block mt-1 w-80" type="text" name="search" placeholder="Account name, user name, or email" :value="$searchQuery" />
                        </div>
                        <x-primary-button type="submit">
                            {{ __('Search') }}
                        </x-primary-button>
                        @if ($searchQuery)
                            <a href="{{ route('admin.accounts.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Clear Search') }}
                            </a>
                        @endif
                    </form>

                    @if ($accounts->isEmpty())
                        <p class="text-gray-600 text-center">No accounts found matching your search criteria.</p>
                    @else
                        <div class="overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Account Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Balance
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            User
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Created At
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($accounts as $account)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $account->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $account->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ number_format($account->balance, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $account->user->name ?? 'N/A' }} ({{ $account->user->email ?? 'N/A' }})
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $account->created_at->format('Y-m-d') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                {{-- Add Admin-specific edit/delete links if needed for accounts --}}
                                                {{-- For example: --}}
                                                {{-- <a href="{{ route('admin.accounts.edit', $account->id) }}" class="text-green-600 hover:text-green-900 mr-3">Edit</a> --}}
                                                {{-- <form action="{{ route('admin.accounts.destroy', $account->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');"> --}}
                                                {{--     @csrf --}}
                                                {{--     @method('DELETE') --}}
                                                {{--     <button type="submit" class="text-red-600 hover:text-red-900">Delete</button> --}}
                                                {{-- </form> --}}
                                                <span class="text-gray-500">No actions defined</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $accounts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>