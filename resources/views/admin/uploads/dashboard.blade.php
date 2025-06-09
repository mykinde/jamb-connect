<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Uploads Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Overview of All Uploads</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-blue-100 p-4 rounded-lg shadow-md flex flex-col items-center">
                            <p class="text-blue-700 font-semibold text-lg">Total Uploads</p>
                            <p class="text-blue-900 text-3xl font-extrabold">{{ $totalUploads }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg shadow-md">
                            <p class="text-green-700 font-semibold text-lg mb-2">Uploads by Exam Type</p>
                            <ul>
                                @forelse($uploadsByExamType as $type => $count)
                                    <li class="flex justify-between text-sm text-green-800"><span>{{ $type }}:</span> <span>{{ $count }}</span></li>
                                @empty
                                    <li class="text-sm text-gray-600">No data</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="bg-purple-100 p-4 rounded-lg shadow-md">
                            <p class="text-purple-700 font-semibold text-lg mb-2">Uploads by Exam Series</p>
                            <ul>
                                @forelse($uploadsByExamSeries as $series => $count)
                                    <li class="flex justify-between text-sm text-purple-800"><span>{{ $series }}:</span> <span>{{ $count }}</span></li>
                                @empty
                                    <li class="text-sm text-gray-600">No data</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg shadow-md overflow-y-auto max-h-48">
                            <p class="text-yellow-700 font-semibold text-lg mb-2">Uploads by Grade</p>
                            <ul>
                                @forelse($uploadsByGrade as $grade => $count)
                                    <li class="flex justify-between text-sm text-yellow-800"><span>{{ $grade }}:</span> <span>{{ $count }}</span></li>
                                @empty
                                    <li class="text-sm text-gray-600">No data</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <form action="{{ route('admin.uploads.dashboard') }}" method="GET" class="mb-8 p-6 border rounded-lg bg-gray-50 shadow-sm">
                        <h4 class="font-semibold text-lg text-gray-700 mb-4">Filter & Search Uploads</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="search" :value="__('Search (Exam No./Subject/User)')" />
                                <x-text-input id="search" class="block mt-1 w-full" type="text" name="search" placeholder="Exam number, subject, or user" :value="request('search')" />
                            </div>
                            <div>
                                <x-input-label for="user_id" :value="__('Filter by User')" />
                                <select name="user_id" id="user_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">All Users</option>
                                    @foreach ($allUsers as $user)
                                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="subject_id" :value="__('Filter by Subject')" />
                                <select name="subject_id" id="subject_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">All Subjects</option>
                                    @foreach ($allSubjects as $subject)
                                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="exam_year" :value="__('Filter by Exam Year')" />
                                <select name="exam_year" id="exam_year" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">All Years</option>
                                    @foreach ($allExamYears as $year)
                                        <option value="{{ $year }}" {{ request('exam_year') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="exam_series" :value="__('Filter by Exam Series')" />
                                <select name="exam_series" id="exam_series" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">All Series</option>
                                    @foreach ($examSeriesOptions as $series)
                                        <option value="{{ $series }}" {{ request('exam_series') == $series ? 'selected' : '' }}>
                                            {{ $series }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="exam_type" :value="__('Filter by Exam Type')" />
                                <select name="exam_type" id="exam_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">All Exam Types</option>
                                    @foreach ($examTypesOptions as $type)
                                        <option value="{{ $type }}" {{ request('exam_type') == $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="grade" :value="__('Filter by Grade')" />
                                <select name="grade" id="grade" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">All Grades</option>
                                    @foreach ($gradeOptions as $grade)
                                        <option value="{{ $grade }}" {{ request('grade') == $grade ? 'selected' : '' }}>
                                            {{ $grade }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button type="submit" class="mr-2">
                                {{ __('Apply Filters') }}
                            </x-primary-button>
                            @if (request()->all() && !empty(array_filter(request()->except('page')))) {{-- Check if any filter/search is active --}}
                                <a href="{{ route('admin.uploads.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Clear Filters') }}
                                </a>
                            @endif
                        </div>
                    </form>

                    @if ($uploads->isEmpty())
                        <p class="text-gray-600 text-center">No uploads found matching the current criteria.</p>
                    @else
                        <div class="overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Uploaded By
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Exam No.
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Subject
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Year
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Series
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Exam Type
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Grade
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($uploads as $upload)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $upload->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $upload->user->name ?? 'N/A' }} ({{ $upload->user->email ?? 'N/A' }})
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $upload->exam_number }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $upload->subject->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $upload->exam_year }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $upload->exam_series }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $upload->exam_type }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $upload->grade }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('uploads.show', $upload->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">View Details</a>
                                                {{-- Add Admin-specific edit/delete links if needed, ensure they are routed correctly --}}
                                                {{-- For example, you might have: --}}
                                                {{-- <a href="{{ route('admin.uploads.edit', $upload->id) }}" class="text-green-600 hover:text-green-900 mr-3">Edit</a> --}}
                                                {{-- <form action="{{ route('admin.uploads.destroy', $upload->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this upload?');"> --}}
                                                {{--     @csrf --}}
                                                {{--     @method('DELETE') --}}
                                                {{--     <button type="submit" class="text-red-600 hover:text-red-900">Delete</button> --}}
                                                {{-- </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $uploads->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>