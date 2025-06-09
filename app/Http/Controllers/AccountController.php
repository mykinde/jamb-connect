<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    // Define the fixed options for dropdowns
    private $applicationTypes = ['UTME', 'DL', 'NOUN', 'PT', 'DE', 'SDW'];
    private $maritalStatuses = ['Single', 'Married'];

    /**
     * Display a listing of the resource.
     * Users can only see their own accounts.
     */
    public function index()
    {
        // A user typically has one main account profile.
        // We'll retrieve the authenticated user's account if it exists.
        $account = Auth::user()->account; // Assuming a hasOne relationship on User model

        return view('accounts.index', compact('account'));
    }

    /**
     * Show the form for creating a new resource.
     * A user should only create one account. Redirect if one already exists.
     */
    public function create()
    {
        if (Auth::user()->account) {
            return redirect()->route('accounts.index')->with('info', 'You already have an account. You can edit it instead.');
        }

        $currentYear = date('Y');
        $jambYears = range($currentYear, $currentYear - 10); // Last 10 years for JAMB year
        $applicationYears = range($currentYear, $currentYear + 5); // Current to next 5 years

        return view('accounts.create', [
            'applicationTypes' => $this->applicationTypes,
            'maritalStatuses' => $this->maritalStatuses,
            'jambYears' => $jambYears,
            'applicationYears' => $applicationYears,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Prevent creating multiple accounts
        if (Auth::user()->account) {
            return redirect()->route('accounts.index')->with('error', 'You already have an account and cannot create another.');
        }

        $validatedData = $request->validate([
            'profile_code' => 'required|string|max:255|unique:accounts,profile_code',
            'application_type' => ['required', Rule::in($this->applicationTypes)],
            'phone' => 'nullable|string|max:20',
            'email_address' => 'required|email|max:255|unique:accounts,email_address',
            'last_jamb_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'last_institution_attended' => 'nullable|string|max:255',
            'proposed_new_institution' => 'nullable|string|max:255',
            'proposed_course' => 'nullable|string|max:255',
            'application_year' => 'nullable|integer|min:' . (date('Y') - 5) . '|max:' . (date('Y') + 5),
            'nationality' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'lga' => 'nullable|string|max:100',
            'blind' => 'boolean',
            'deaf' => 'boolean',
            'dumb' => 'boolean',
            'lame' => 'boolean',
            'marital_status' => ['nullable', Rule::in($this->maritalStatuses)],
            'resident_address' => 'nullable|string|max:255',
            'resident_town' => 'nullable|string|max:100',
            'resident_state' => 'nullable|string|max:100',
        ]);

        $validatedData['user_id'] = Auth::id();

        // Ensure boolean fields are set correctly if not present in request (checkboxes)
        $validatedData['blind'] = $request->boolean('blind');
        $validatedData['deaf'] = $request->boolean('deaf');
        $validatedData['dumb'] = $request->boolean('dumb');
        $validatedData['lame'] = $request->boolean('lame');

        Account::create($validatedData);

        return redirect()->route('accounts.index')->with('success', 'Account created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        // Authorization: A user can only view their own account
        if ($account->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('accounts.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        // Authorization: A user can only edit their own account
        if ($account->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $currentYear = date('Y');
        $jambYears = range($currentYear, $currentYear - 10);
        $applicationYears = range($currentYear, $currentYear + 5);

        return view('accounts.edit', [
            'account' => $account,
            'applicationTypes' => $this->applicationTypes,
            'maritalStatuses' => $this->maritalStatuses,
            'jambYears' => $jambYears,
            'applicationYears' => $applicationYears,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        // Authorization: A user can only update their own account
        if ($account->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'profile_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('accounts')->ignore($account->id), // Ignore current account's ID
            ],
            'application_type' => ['required', Rule::in($this->applicationTypes)],
            'phone' => 'nullable|string|max:20',
            'email_address' => [
                'required',
                'email',
                'max:255',
                Rule::unique('accounts')->ignore($account->id), // Ignore current account's ID
            ],
            'last_jamb_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'last_institution_attended' => 'nullable|string|max:255',
            'proposed_new_institution' => 'nullable|string|max:255',
            'proposed_course' => 'nullable|string|max:255',
            'application_year' => 'nullable|integer|min:' . (date('Y') - 5) . '|max:' . (date('Y') + 5),
            'nationality' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'lga' => 'nullable|string|max:100',
            'blind' => 'boolean',
            'deaf' => 'boolean',
            'dumb' => 'boolean',
            'lame' => 'boolean',
            'marital_status' => ['nullable', Rule::in($this->maritalStatuses)],
            'resident_address' => 'nullable|string|max:255',
            'resident_town' => 'nullable|string|max:100',
            'resident_state' => 'nullable|string|max:100',
        ]);

        // Ensure boolean fields are set correctly if not present in request (checkboxes)
        $validatedData['blind'] = $request->boolean('blind');
        $validatedData['deaf'] = $request->boolean('deaf');
        $validatedData['dumb'] = $request->boolean('dumb');
        $validatedData['lame'] = $request->boolean('lame');

        $account->update($validatedData);

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        // Authorization: A user can only delete their own account
        if ($account->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $account->delete();
        return redirect()->route('accounts.index')->with('success', 'Account deleted successfully.');
    }
}