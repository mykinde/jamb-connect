<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Account Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Create Your Account Profile</h3>
                    <p class="text-sm text-gray-600 mb-6">Please fill in your account details below.</p>

                    <form method="POST" action="{{ route('accounts.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="profile_code" :value="__('Profile Code')" />
                            <x-text-input id="profile_code" class="block mt-1 w-full" type="text" name="profile_code" :value="old('profile_code')" required autofocus />
                            <x-input-error :messages="$errors->get('profile_code')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="application_type" :value="__('Application Type')" />
                            <select id="application_type" name="application_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select Application Type</option>
                                @foreach($applicationTypes as $type)
                                    <option value="{{ $type }}" {{ old('application_type') == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('application_type')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="phone" :value="__('Phone Number (Optional)')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="email_address" :value="__('Contact Email Address')" />
                            <x-text-input id="email_address" class="block mt-1 w-full" type="email" name="email_address" :value="old('email_address')" required />
                            <x-input-error :messages="$errors->get('email_address')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="last_jamb_year" :value="__('Last JAMB Year (Optional)')" />
                            <select id="last_jamb_year" name="last_jamb_year" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Select Year</option>
                                @foreach($jambYears as $year)
                                    <option value="{{ $year }}" {{ old('last_jamb_year') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('last_jamb_year')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="last_institution_attended" :value="__('Last Institution Attended (Optional)')" />
                            <x-text-input id="last_institution_attended" class="block mt-1 w-full" type="text" name="last_institution_attended" :value="old('last_institution_attended')" />
                            <x-input-error :messages="$errors->get('last_institution_attended')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="proposed_new_institution" :value="__('Proposed New Institution (Optional)')" />
                            <x-text-input id="proposed_new_institution" class="block mt-1 w-full" type="text" name="proposed_new_institution" :value="old('proposed_new_institution')" />
                            <x-input-error :messages="$errors->get('proposed_new_institution')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="proposed_course" :value="__('Proposed Course (Optional)')" />
                            <x-text-input id="proposed_course" class="block mt-1 w-full" type="text" name="proposed_course" :value="old('proposed_course')" />
                            <x-input-error :messages="$errors->get('proposed_course')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="application_year" :value="__('Application Year (Optional)')" />
                            <select id="application_year" name="application_year" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Select Year</option>
                                @foreach($applicationYears as $year)
                                    <option value="{{ $year }}" {{ old('application_year') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('application_year')" class="mt-2" />
                        </div>

                        <hr class="my-6">
                        <h4 class="font-semibold text-gray-800 mb-3">Address & Demographics</h4>

                        <div class="mb-4">
                            <x-input-label for="nationality" :value="__('Nationality (Optional)')" />
                            <x-text-input id="nationality" class="block mt-1 w-full" type="text" name="nationality" :value="old('nationality')" />
                            <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="state" :value="__('State (Optional)')" />
                            <x-text-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state')" />
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="lga" :value="__('LGA (Local Government Area) (Optional)')" />
                            <x-text-input id="lga" class="block mt-1 w-full" type="text" name="lga" :value="old('lga')" />
                            <x-input-error :messages="$errors->get('lga')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="resident_address" :value="__('Resident Address (Optional)')" />
                            <x-text-input id="resident_address" class="block mt-1 w-full" type="text" name="resident_address" :value="old('resident_address')" />
                            <x-input-error :messages="$errors->get('resident_address')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="resident_town" :value="__('Resident Town (Optional)')" />
                            <x-text-input id="resident_town" class="block mt-1 w-full" type="text" name="resident_town" :value="old('resident_town')" />
                            <x-input-error :messages="$errors->get('resident_town')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="resident_state" :value="__('Resident State (Optional)')" />
                            <x-text-input id="resident_state" class="block mt-1 w-full" type="text" name="resident_state" :value="old('resident_state')" />
                            <x-input-error :messages="$errors->get('resident_state')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="marital_status" :value="__('Marital Status (Optional)')" />
                            <select id="marital_status" name="marital_status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Select Marital Status</option>
                                @foreach($maritalStatuses as $status)
                                    <option value="{{ $status }}" {{ old('marital_status') == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />
                        </div>

                        <hr class="my-6">
                        <h4 class="font-semibold text-gray-800 mb-3">Disability Information</h4>

                        <div class="mb-4">
                            <label for="blind" class="inline-flex items-center mr-4">
                                <input id="blind" type="checkbox" name="blind" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('blind') ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Blind') }}</span>
                            </label>
                            <label for="deaf" class="inline-flex items-center mr-4">
                                <input id="deaf" type="checkbox" name="deaf" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('deaf') ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Deaf') }}</span>
                            </label>
                            <label for="dumb" class="inline-flex items-center mr-4">
                                <input id="dumb" type="checkbox" name="dumb" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('dumb') ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Dumb') }}</span>
                            </label>
                            <label for="lame" class="inline-flex items-center">
                                <input id="lame" type="checkbox" name="lame" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('lame') ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Lame') }}</span>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('blind') ?? $errors->get('deaf') ?? $errors->get('dumb') ?? $errors->get('lame')" class="mt-2" />


                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('accounts.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Create Account') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>