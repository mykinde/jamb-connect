<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Institution Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Institution: {{ $institution->name }}</h3>

                    <div class="mb-4">
                        <p><strong>ID:</strong> {{ $institution->id }}</p>
                        <p><strong>Name:</strong> {{ $institution->name }}</p>
                        <p><strong>Category:</strong> {{ $institution->category->name }}</p>
                        <p><strong>Classification:</strong> {{ $institution->classification->name }}</p>
                        <p><strong>Location:</strong> {{ $institution->location }}</p>
                        <p><strong>Created At:</strong> {{ $institution->created_at->format('M d, Y H:i A') }}</p>
                        <p><strong>Last Updated:</strong> {{ $institution->updated_at->format('M d, Y H:i A') }}</p>
                    </div>

                    <div class="flex items-center">
                        <a href="{{ route('institutions.edit', $institution->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('institutions.destroy', $institution->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this institution? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Delete') }}
                            </button>
                        </form>
                        <a href="{{ route('institutions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-auto">
                            {{ __('Back to Institutions') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>