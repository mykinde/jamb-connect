<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard - Corrections') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">All Submitted Corrections</h3>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('admin.corrections.index') }}" method="GET" class="mb-6 p-4 border rounded-md bg-gray-50">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="search_user" :value="__('Search by User Name/Email')" />
                                <x-text-input id="search_user" class="block mt-1 w-full" type="text" name="search_user" placeholder="User name or email" :value="request('search_user')" />
                            </div>
                            <div>
                                <x-input-label for="search_institution" :value="__('Search by Institution Name')" />
                                <x-text-input id="search_institution" class="block mt-1 w-full" type="text" name="search_institution" placeholder="Institution name" :value="request('search_institution')" />
                            </div>
                            <div>
                                <x-input-label for="search_course" :value="__('Search by Course Name')" />
                                <x-text-input id="search_course" class="block mt-1 w-full" type="text" name="search_course" placeholder="Course name" :value="request('search_course')" />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button type="submit">
                                {{ __('Search / Filter') }}
                            </x-primary-button>
                            @if (request('search_user') || request('search_institution') || request('search_course'))
                                <a href="{{ route('admin.corrections.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Clear Filters') }}
                                </a>
                            @endif
                        </div>
                    </form>

                    @if ($corrections->isEmpty())
                        <p class="text-gray-600">No corrections found matching your criteria.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Submitted By
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Institution/Course 1
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Institution/Course 2
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Submitted On
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($corrections as $correction)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $correction->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $correction->user->name ?? 'N/A' }}<br>
                                                <span class="text-xs text-gray-500">{{ $correction->user->email ?? '' }}</span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                @if($correction->institution1)
                                                    <p><strong>Inst:</strong> {{ $correction->institution1->name }}</p>
                                                @endif
                                                @if($correction->course1)
                                                    <p><strong>Course:</strong> {{ $correction->course1->name }}</p>
                                                @endif
                                                @if(empty($correction->institution1) && empty($correction->course1))
                                                    <em>N/A</em>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                @if($correction->institution2)
                                                    <p><strong>Inst:</strong> {{ $correction->institution2->name }}</p>
                                                @endif
                                                @if($correction->course2)
                                                    <p><strong>Course:</strong> {{ $correction->course2->name }}</p>
                                                @endif
                                                @if(empty($correction->institution2) && empty($correction->course2))
                                                    <em>N/A</em>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $correction->created_at->format('M d, Y H:i A') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                {{-- For admin, we might only need a view link, as editing/deleting might be done through the user's specific correction page or a separate admin-specific page for processing --}}
                                                <a href="{{ route('corrections.show', $correction->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">View Details</a>
                                                {{-- If admins can delete/edit directly from here, uncomment and adjust routes if needed --}}
                                                {{-- <a href="{{ route('admin.corrections.edit', $correction->id) }}" class="text-green-600 hover:text-green-900 mr-3">Edit</a> --}}
                                                {{-- <form action="{{ route('admin.corrections.destroy', $correction->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this correction permanently?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $corrections->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>