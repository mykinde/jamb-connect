<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Institution') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Add a New Institution</h3>

                    <form method="POST" action="{{ route('institutions.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Institution Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select id="category_id" name="category_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="classification_id" :value="__('Classification')" />
                            <select id="classification_id" name="classification_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select a Classification</option>
                                @foreach($classifications as $classification)
                                    <option value="{{ $classification->id }}" {{ old('classification_id') == $classification->id ? 'selected' : '' }}>
                                        {{ $classification->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('classification_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('institutions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Create Institution') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>