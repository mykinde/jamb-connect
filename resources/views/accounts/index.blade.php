<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Account Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Your Account Profile</h3>
                        @if (!$account)
                            <a href="{{ route('accounts.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Create My Account
                            </a>
                        @endif
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('info'))
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Info!</strong>
                            <span class="block sm:inline">{{ session('info') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if ($account)
                        <div class="mb-4">
                            <p><strong>Profile Code:</strong> {{ $account->profile_code }}</p>
                            <p><strong>Application Type:</strong> {{ $account->application_type }}</p>
                            <p><strong>Phone:</strong> {{ $account->phone ?? 'N/A' }}</p>
                            <p><strong>Email Address:</strong> {{ $account->email_address }}</p>
                            <p><strong>Last JAMB Year:</strong> {{ $account->last_jamb_year ?? 'N/A' }}</p>
                            <p><strong>Last Institution Attended:</strong> {{ $account->last_institution_attended ?? 'N/A' }}</p>
                            <p><strong>Proposed New Institution:</strong> {{ $account->proposed_new_institution ?? 'N/A' }}</p>
                            <p><strong>Proposed Course:</strong> {{ $account->proposed_course ?? 'N/A' }}</p>
                            <p><strong>Application Year:</strong> {{ $account->application_year ?? 'N/A' }}</p>
                            <p><strong>Nationality:</strong> {{ $account->nationality ?? 'N/A' }}</p>
                            <p><strong>State:</strong> {{ $account->state ?? 'N/A' }}</p>
                            <p><strong>LGA:</strong> {{ $account->lga ?? 'N/A' }}</p>
                            <p><strong>Disabilities:</strong>
                                @if($account->blind) <span class="badge bg-red-100 text-red-800 px-2 py-1 rounded-full">Blind</span> @endif
                                @if($account->deaf) <span class="badge bg-red-100 text-red-800 px-2 py-1 rounded-full">Deaf</span> @endif
                                @if($account->dumb) <span class="badge bg-red-100 text-red-800 px-2 py-1 rounded-full">Dumb</span> @endif
                                @if($account->lame) <span class="badge bg-red-100 text-red-800 px-2 py-1 rounded-full">Lame</span> @endif
                                @if(!$account->blind && !$account->deaf && !$account->dumb && !$account->lame) None @endif
                            </p>
                            <p><strong>Marital Status:</strong> {{ $account->marital_status ?? 'N/A' }}</p>
                            <p><strong>Resident Address:</strong> {{ $account->resident_address ?? 'N/A' }}</p>
                            <p><strong>Resident Town:</strong> {{ $account->resident_town ?? 'N/A' }}</p>
                            <p><strong>Resident State:</strong> {{ $account->resident_state ?? 'N/A' }}</p>
                            <p><strong>Created At:</strong> {{ $account->created_at->format('M d, Y H:i A') }}</p>
                            <p><strong>Last Updated:</strong> {{ $account->updated_at->format('M d, Y H:i A') }}</p>
                        </div>

                        <div class="flex items-center mt-6">
                            <a href="{{ route('accounts.edit', $account->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                {{ __('Edit My Account') }}
                            </a>
                            <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Delete Account') }}
                                </button>
                            </form>
                        </div>
                    @else
                        <p class="text-gray-600">You do not have an account profile yet. Please create one to manage your details.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>