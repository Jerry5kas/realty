<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Property;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['property', 'project', 'agent', 'creator']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('transaction_number', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%")
                  ->orWhere('client_phone', 'like', "%{$search}%")
                  ->orWhere('client_email', 'like', "%{$search}%");
            });
        }

        // Filters
        if ($request->filled('transaction_type')) {
            $query->where('transaction_type', $request->transaction_type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->filled('agent_id')) {
            $query->where('agent_id', $request->agent_id);
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate(15);
        $agents = User::all();

        return view('transactions.index', compact('transactions', 'agents'));
    }

    public function create()
    {
        $properties = Property::where('status', '!=', 'sold')->get();
        $projects = Project::where('publish_status', 'published')->get();
        $agents = User::all();

        return view('transactions.create', compact('properties', 'projects', 'agents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'project_id' => 'nullable|exists:projects,id',
            'transaction_type' => 'required|in:sale,rent,lease,resale',
            'client_name' => 'required|string|max:255',
            'client_email' => 'nullable|email|max:255',
            'client_phone' => 'required|string|max:20',
            'client_address' => 'nullable|string',
            'seller_name' => 'nullable|string|max:255',
            'seller_phone' => 'nullable|string|max:20',
            'seller_email' => 'nullable|email|max:255',
            'agent_id' => 'nullable|exists:users,id',
            'total_amount' => 'required|numeric|min:0',
            'token_amount' => 'nullable|numeric|min:0',
            'booking_amount' => 'nullable|numeric|min:0',
            'down_payment' => 'nullable|numeric|min:0',
            'loan_amount' => 'nullable|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0',
            'commission_percentage' => 'nullable|numeric|min:0|max:100',
            'payment_method' => 'nullable|in:cash,cheque,bank-transfer,emi,loan',
            'payment_status' => 'required|in:pending,partial,paid,overdue',
            'emi_months' => 'nullable|integer|min:1',
            'emi_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:initiated,negotiation,agreement,token-received,booking-confirmed,documentation,registration,completed,cancelled',
            'priority' => 'required|in:low,medium,high',
            'agreement_date' => 'nullable|date',
            'token_date' => 'nullable|date',
            'booking_date' => 'nullable|date',
            'registration_date' => 'nullable|date',
            'possession_date' => 'nullable|date',
            'expected_closing_date' => 'nullable|date',
            'actual_closing_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
        ]);

        // Calculate balance amount
        $validated['balance_amount'] = $validated['total_amount'] - ($validated['paid_amount'] ?? 0);

        // Calculate commission amount
        if (!empty($validated['commission_percentage'])) {
            $validated['commission_amount'] = ($validated['total_amount'] * $validated['commission_percentage']) / 100;
        } else {
            $validated['commission_amount'] = 0;
        }

        $validated['created_by'] = auth()->id();
        $validated['commission_status'] = 'pending';
        $validated['commission_paid'] = 0;

        Transaction::create($validated);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['property', 'project', 'agent', 'creator']);
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $properties = Property::where('status', '!=', 'sold')->get();
        $projects = Project::where('publish_status', 'published')->get();
        $agents = User::all();

        return view('transactions.edit', compact('transaction', 'properties', 'projects', 'agents'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'project_id' => 'nullable|exists:projects,id',
            'transaction_type' => 'required|in:sale,rent,lease,resale',
            'client_name' => 'required|string|max:255',
            'client_email' => 'nullable|email|max:255',
            'client_phone' => 'required|string|max:20',
            'client_address' => 'nullable|string',
            'seller_name' => 'nullable|string|max:255',
            'seller_phone' => 'nullable|string|max:20',
            'seller_email' => 'nullable|email|max:255',
            'agent_id' => 'nullable|exists:users,id',
            'total_amount' => 'required|numeric|min:0',
            'token_amount' => 'nullable|numeric|min:0',
            'booking_amount' => 'nullable|numeric|min:0',
            'down_payment' => 'nullable|numeric|min:0',
            'loan_amount' => 'nullable|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0',
            'commission_percentage' => 'nullable|numeric|min:0|max:100',
            'commission_paid' => 'nullable|numeric|min:0',
            'commission_status' => 'required|in:pending,paid,partial',
            'payment_method' => 'nullable|in:cash,cheque,bank-transfer,emi,loan',
            'payment_status' => 'required|in:pending,partial,paid,overdue',
            'emi_months' => 'nullable|integer|min:1',
            'emi_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:initiated,negotiation,agreement,token-received,booking-confirmed,documentation,registration,completed,cancelled',
            'priority' => 'required|in:low,medium,high',
            'agreement_date' => 'nullable|date',
            'token_date' => 'nullable|date',
            'booking_date' => 'nullable|date',
            'registration_date' => 'nullable|date',
            'possession_date' => 'nullable|date',
            'expected_closing_date' => 'nullable|date',
            'actual_closing_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
        ]);

        // Calculate balance amount
        $validated['balance_amount'] = $validated['total_amount'] - ($validated['paid_amount'] ?? 0);

        // Calculate commission amount
        if (!empty($validated['commission_percentage'])) {
            $validated['commission_amount'] = ($validated['total_amount'] * $validated['commission_percentage']) / 100;
        } else {
            $validated['commission_amount'] = 0;
        }

        $transaction->update($validated);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:transactions,id'
        ]);

        Transaction::whereIn('id', $request->ids)->delete();

        return redirect()->route('transactions.index')
            ->with('success', count($request->ids) . ' transaction(s) deleted successfully.');
    }
}

