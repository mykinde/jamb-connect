<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Correction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Correction Request #{{ $correction->id }}</h3>
                    <p class="text-sm text-gray-600 mb-6">
                        Adjust the institution-course pairs for this correction. All fields are optional.
                    </p>

                    <form method="POST" action="{{ route('corrections.update', $correction->id) }}">
                        @csrf
                        @method('PUT')

                        @for ($i = 1; $i <= 4; $i++)
                            <div class="mb-6 p-4 border border-gray-200 rounded-md bg-gray-50">
                                <h4 class="font-semibold text-gray-800 mb-3">Correction Entry {{ $i }}</h4>

                                @php
                                    $institutionIdField = 'institution' . $i . '_id';
                                    $courseIdField = 'course' . $i . '_id';
                                @endphp

                                <div class="mb-4">
                                    <x-input-label for="institution{{ $i }}_id" :value="__('Institution ' . $i)" />
                                    <select id="institution{{ $i }}_id" name="institution{{ $i }}_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="">Select an Institution (Optional)</option>
                                        @foreach($institutions as $institution)
                                            <option value="{{ $institution->id }}" {{ old($institutionIdField, $correction->$institutionIdField) == $institution->id ? 'selected' : '' }}>
                                                {{ $institution->name }} ({{ $institution->location }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get($institutionIdField)" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="course{{ $i }}_id" :value="__('Course ' . $i)" />
                                    <select id="course{{ $i }}_id" name="course{{ $i }}_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="">Select a Course (Optional)</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ old($courseIdField, $correction->$courseIdField) == $course->id ? 'selected' : '' }}>
                                                {{ $course->name }} (Category: {{ $course->category->name ?? 'N/A' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get($courseIdField)" class="mt-2" />
                                </div>
                            </div>
                        @endfor

                        {{-- If you have a notes/description field in your correction model --}}
                        {{--
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Correction Details/Notes')" />
                            <textarea id="notes" name="notes" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes', $correction->notes) }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>
                        --}}

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('corrections.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Update Correction') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>