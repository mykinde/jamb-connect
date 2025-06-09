<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account; // Import the Account model
use Illuminate\Http\Request;

class AccountDashboardController extends Controller
{
    /**
     * Display the admin dashboard for accounts.
     */
    public function index(Request $request)
    {
        $query = Account::with('user'); // Eager load the user relationship

        // Search functionality by account name or associated user's name/email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%') // Search by account name
                  ->orWhereHas('user', function ($userQ) use ($search) {
                      $userQ->where('name', 'like', '%' . $search . '%') // Search by user name
                            ->orWhere('email', 'like', '%' . $search . '%'); // Search by user email
                  });
            });
        }

        $accounts = $query->latest()->paginate(20); // Paginate results

        $totalAccounts = Account::count(); // Get total count of all accounts

        return view('admin.accounts.dashboard', [
            'accounts' => $accounts,
            'totalAccounts' => $totalAccounts,
            'searchQuery' => $request->input('search'), // Pass search query back to view
        ]);
    }
}