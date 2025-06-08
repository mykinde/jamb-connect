<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard - Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">System Reports Overview</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 shadow-sm">
                            <h4 class="text-lg font-semibold text-blue-800 mb-2">Total Institutions</h4>
                            <p class="text-4xl font-bold text-blue-700">{{ $totalInstitutions }}</p>
                            <p class="text-sm text-gray-600 mt-2">Currently registered institutions.</p>
                            <div class="mt-4 text-right">
                                <a href="{{ route('institutions.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Institutions &rarr;</a>
                            </div>
                        </div>

                        <div class="bg-green-50 border border-green-200 rounded-lg p-6 shadow-sm">
                            <h4 class="text-lg font-semibold text-green-800 mb-2">Total Courses</h4>
                            <p class="text-4xl font-bold text-green-700">{{ $totalCourses }}</p>
                            <p class="text-sm text-gray-600 mt-2">Currently registered courses.</p>
                            <div class="mt-4 text-right">
                                <a href="{{ route('courses.index') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">View Courses &rarr;</a>
                            </div>
                        </div>

                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 shadow-sm">
                            <h4 class="text-lg font-semibold text-yellow-800 mb-2">Total Corrections</h4>
                            <p class="text-4xl font-bold text-yellow-700">{{ $totalCorrections }}</p>
                            <p class="text-sm text-gray-600 mt-2">Total correction requests submitted by users.</p>
                            <div class="mt-4 text-right">
                                <a href="{{ route('admin.corrections.index') }}" class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">View Corrections &rarr;</a>
                            </div>
                        </div>

                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-6 shadow-sm col-span-1 md:col-span-2">
                            <h4 class="text-lg font-semibold text-purple-800 mb-4">Institutions by Category</h4>
                            @if($institutionsByCategory->isEmpty())
                                <p class="text-gray-600">No categories found or no institutions assigned.</p>
                            @else
                                <ul class="list-disc list-inside text-gray-700">
                                    @foreach($institutionsByCategory as $category)
                                        <li>{{ $category->name }}: <span class="font-bold">{{ $category->institutions_count }}</span> institutions</li>
                                    @endforeach
                                </ul>
                            @endif
                            <p class="text-sm text-gray-600 mt-4">A breakdown of institutions per category.</p>
                        </div>

                        <div class="bg-orange-50 border border-orange-200 rounded-lg p-6 shadow-sm col-span-1 md:col-span-1">
                            <h4 class="text-lg font-semibold text-orange-800 mb-4">Courses by Category</h4>
                            @if($coursesByCategory->isEmpty())
                                <p class="text-gray-600">No categories found or no courses assigned.</p>
                            @else
                                <ul class="list-disc list-inside text-gray-700">
                                    @foreach($coursesByCategory as $category)
                                        <li>{{ $category->name }}: <span class="font-bold">{{ $category->courses_count }}</span> courses</li>
                                    @endforeach
                                </ul>
                            @endif
                            <p class="text-sm text-gray-600 mt-4">A breakdown of courses per category.</p>
                        </div>

                        <div class="bg-red-50 border border-red-200 rounded-lg p-6 shadow-sm col-span-1 md:col-span-3">
                            <h4 class="text-lg font-semibold text-red-800 mb-4">Institutions by Classification</h4>
                            @if($institutionsByClassification->isEmpty())
                                <p class="text-gray-600">No classifications found or no institutions assigned.</p>
                            @else
                                <ul class="list-disc list-inside text-gray-700 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                                    @foreach($institutionsByClassification as $classification)
                                        <li>{{ $classification->name }}: <span class="font-bold">{{ $classification->institutions_count }}</span> institutions</li>
                                    @endforeach
                                </ul>
                            @endif
                            <p class="text-sm text-gray-600 mt-4">A breakdown of institutions per classification.</p>
                        </div>

                        {{-- Add more report sections as needed --}}
                        {{--
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 shadow-sm col-span-full">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4">User Activity Summary</h4>
                            <p class="text-gray-600">Detailed user login and submission trends can be displayed here.</p>
                            <div class="mt-4 h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                                [Chart/Table: User Registrations Over Time]
                            </div>
                        </div>
                        --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>