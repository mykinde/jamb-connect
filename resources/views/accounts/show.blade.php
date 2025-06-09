<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Details for Profile Code: {{ $account->profile_code }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <p><strong>Application Type:</strong> {{ $account->application_type }}</p>
                            <p><strong>Phone:</strong> {{ $account->phone ?? 'N/A' }}</p>
                            <p><strong>Email Address:</strong> {{ $account->email_address }}</p>
                            <p><strong>Last JAMB Year:</strong> {{ $account->last_jamb_year ?? 'N/A' }}</p>
                            <p><strong>Last Institution Attended:</strong> {{ $account->last_institution_attended ?? 'N/A' }}</p>
                            <p><strong>Proposed New Institution:</strong> {{ $account->proposed_new_institution ?? 'N/A' }}</p>
                            <p><strong>Proposed Course:</strong> {{ $account->proposed_course ?? 'N/A' }}</p>
                            <p><strong>Application Year:</strong> {{ $account->application_year ?? 'N/A' }}</p>
                            <p><strong>Marital Status:</strong> {{ $account->marital_status ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p><strong>Nationality:</strong> {{ $account->nationality ?? 'N/A' }}</p>
                            <p><strong>State:</strong> {{ $account->state ?? 'N/A' }}</p>
                            <p><strong>LGA:</strong> {{ $account->lga ?? 'N/A' }}</p>
                            <p><strong>Resident Address:</strong> {{ $account->resident_address ?? 'N/A' }}</p>
                            <p><strong>Resident Town:</strong> {{ $account->resident_town ?? 'N/A' }}</p>
                            <p><strong>Resident State:</strong> {{ $account->resident_state ?? 'N/A' }}</p>
                            <p><strong>Disabilities:</strong>
                                @if($account->blind) <span class="badge bg-red-100 text-red-800 px-2 py-1 rounded-full">Blind</span> @endif
                                @if($account->deaf) <span class="badge bg-red-100 text-red-800 px-2 py-1 rounded-full">Deaf</span> @endif
                                @if($account->dumb) <span class="badge bg-red-100 text-red-800 px-2 py-1 rounded-full">Dumb</span> @endif
                                @if($account->lame) <span class="badge bg-red-100 text-red-800 px-2 py-1 rounded-full">Lame</span> @endif
                                @if(!$account->blind && !$account->deaf && !$account->dumb && !$account->lame) None @endif
                            </p>
                            <p><strong>Created At:</strong> {{ $account->created_at->format('M d, Y H:i A') }}</p>
                            <p><strong>Last Updated:</strong> {{ $account->updated_at->format('M d, Y H:i A') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('accounts.edit', $account->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                            {{ __('Edit Account') }}
                        </a>
                        <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Delete Account') }}
                            </button>
                        </form>
                        <a href="{{ route('accounts.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-auto">
                            {{ __('Back to My Account') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>