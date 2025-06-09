<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Upload') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Add a New Exam Result</h3>
                    <p class="text-sm text-gray-600 mb-6">Enter the details for your exam upload below.</p>

                    <form method="POST" action="{{ route('uploads.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="exam_number" :value="__('Exam Number')" />
                            <x-text-input id="exam_number" class="block mt-1 w-full" type="text" name="exam_number" :value="old('exam_number')" required autofocus />
                            <x-input-error :messages="$errors->get('exam_number')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="exam_year" :value="__('Exam Year')" />
                            <select id="exam_year" name="exam_year" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select Year</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ old('exam_year') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('exam_year')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="subject_id" :value="__('Subject')" />
                            <select id="subject_id" name="subject_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('subject_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="exam_series" :value="__('Exam Series')" />
                            <select id="exam_series" name="exam_series" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select Exam Series</option>
                                @foreach($examSeries as $series)
                                    <option value="{{ $series }}" {{ old('exam_series') == $series ? 'selected' : '' }}>
                                        {{ $series }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('exam_series')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="exam_type" :value="__('Exam Type')" />
                            <select id="exam_type" name="exam_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select Exam Type</option>
                                @foreach($examTypes as $type)
                                    <option value="{{ $type }}" {{ old('exam_type') == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('exam_type')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="grade" :value="__('Grade')" />
                            <select id="grade" name="grade" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select Grade</option>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade }}" {{ old('grade') == $grade ? 'selected' : '' }}>
                                        {{ $grade }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('grade')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Upload Image (Optional)')" />
                            <input id="image" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="file" name="image" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            <p class="text-sm text-gray-500 mt-1">Accepted formats: JPG, PNG, GIF, SVG. Max size: 2MB.</p>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('uploads.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Create Upload') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>