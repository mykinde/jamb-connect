<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Correction Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Correction Request #{{ $correction->id }}</h3>
                    <p class="text-sm text-gray-600 mb-6">Submitted by: {{ $correction->user->name ?? 'N/A' }} on {{ $correction->created_at->format('M d, Y H:i A') }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="p-4 border border-gray-200 rounded-md bg-gray-50">
                                <h4 class="font-semibold text-gray-800 mb-2">Entry {{ $i }}</h4>
                                @php
                                    $institutionField = 'institution' . $i;
                                    $courseField = 'course' . $i;
                                @endphp

                                @if($correction->$institutionField)
                                    <p><strong>Institution:</strong> {{ $correction->$institutionField->name }} ({{ $correction->$institutionField->location }})</p>
                                    <p class="text-xs text-gray-500">Category: {{ $correction->$institutionField->category->name ?? 'N/A' }}, Classification: {{ $correction->$institutionField->classification->name ?? 'N/A' }}</p>
                                @else
                                    <p><strong>Institution:</strong> N/A</p>
                                @endif

                                @if($correction->$courseField)
                                    <p class="mt-2"><strong>Course:</strong> {{ $correction->$courseField->name }}</p>
                                    <p class="text-xs text-gray-500">Category: {{ $correction->$courseField->category->name ?? 'N/A' }}</p>
                                @else
                                    <p class="mt-2"><strong>Course:</strong> N/A</p>
                                @endif

                                @if(empty($correction->$institutionField) && empty($correction->$courseField))
                                    <p class="text-gray-500 italic">No data submitted for this entry.</p>
                                @endif
                            </div>
                        @endfor
                    </div>

                    {{-- If you have a notes/description field in your correction model --}}
                    {{--
                    <div class="mb-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Notes/Details:</h4>
                        <p class="p-3 bg-gray-50 border border-gray-200 rounded-md">
                            {{ $correction->notes ?? 'No additional notes provided.' }}
                        </p>
                    </div>
                    --}}

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('corrections.edit', $correction->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('corrections.destroy', $correction->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this correction? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Delete') }}
                            </button>
                        </form>
                        <a href="{{ route('corrections.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-auto">
                            {{ __('Back to My Corrections') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>