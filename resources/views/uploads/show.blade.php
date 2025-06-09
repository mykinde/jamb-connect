<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Exam Result Details</h3>

                    <div class="mb-4">
                        <p><strong>Exam Number:</strong> {{ $upload->exam_number }}</p>
                        <p><strong>Exam Year:</strong> {{ $upload->exam_year }}</p>
                        <p><strong>Subject:</strong> {{ $upload->subject->name ?? 'N/A' }}</p>
                        <p><strong>Exam Series:</strong> {{ $upload->exam_series }}</p>
                        <p><strong>Exam Type:</strong> {{ $upload->exam_type }}</p>
                        <p><strong>Grade:</strong> {{ $upload->grade }}</p>
                        <p><strong>Total Subjects Uploaded:</strong> <span class="font-bold text-indigo-600">{{ $totalSubjectsCount }}</span></p>

                        @if ($upload->image_path)
                            <div class="mt-4">
                                <p class="font-semibold">Uploaded Image:</p>
                                <img src="{{ asset('storage/' . $upload->image_path) }}" alt="Uploaded Image" class="max-w-xs h-auto border rounded-md shadow-sm">
                            </div>
                        @else
                            <p class="mt-4 text-gray-600">No image uploaded for this record.</p>
                        @endif

                        <p class="mt-4 text-sm text-gray-500">Created: {{ $upload->created_at->format('M d, Y H:i A') }}</p>
                        <p class="text-sm text-gray-500">Last Updated: {{ $upload->updated_at->format('M d, Y H:i A') }}</p>
                    </div>

                    <div class="flex items-center mt-6">
                        <a href="{{ route('uploads.edit', $upload->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                            {{ __('Edit Upload') }}
                        </a>
                        <form action="{{ route('uploads.destroy', $upload->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this upload?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Delete Upload') }}
                            </button>
                        </form>
                        <a href="{{ route('uploads.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-auto">
                            {{ __('Back to Uploads List') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>