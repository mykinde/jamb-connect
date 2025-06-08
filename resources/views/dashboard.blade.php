<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <!-- User Information Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        {{ __('User Information') }}
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Name Field -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">{{ __('Name') }}</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">{{ __('Email') }}</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Phone Field -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">{{ __('JAMB NO') }}</p>
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ Auth::user()->number ?? __('Not provided') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        
                        <!-- Phone Field -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">{{ __('Role NO') }}</p>
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ Auth::user()->role ?? __('Not provided') }}
                                    </p>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>