@extends('layouts.admin')

@section('title', 'Transactions')
@section('page-title', 'Transactions Management')

@section('content')
<div class="max-w-7xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Transactions', 'url' => '']
    ]" />

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-300 rounded-xl text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <x-search-bar 
                placeholder="Search by transaction number, client name, phone, or email..." 
                :action="route('transactions.index')"
                :value="request('search')"
            />
        </div>
        <button 
            id="bulkDeleteBtn" 
            onclick="bulkDelete('transaction-checkbox', 'bulkDeleteForm', 'Are you sure you want to delete the selected transactions?')" 
            class="hidden p-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-all flex items-center gap-2"
            title="Delete Selected"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            <span class="hidden md:inline">Delete</span>
            <span class="px-2 py-0.5 bg-white/20 rounded-full text-xs font-semibold" id="selectedCount">0</span>
        </button>
    </div>

    <!-- Filters -->
    <div class="mb-6 bg-white rounded-xl shadow-sm border p-4">
        <form method="GET" action="{{ route('transactions.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <select name="transaction_type" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" onchange="this.form.submit()">
                <option value="">All Types</option>
                <option value="sale" {{ request('transaction_type') === 'sale' ? 'selected' : '' }}>Sale</option>
                <option value="rent" {{ request('transaction_type') === 'rent' ? 'selected' : '' }}>Rent</option>
                <option value="lease" {{ request('transaction_type') === 'lease' ? 'selected' : '' }}>Lease</option>
                <option value="resale" {{ request('transaction_type') === 'resale' ? 'selected' : '' }}>Resale</option>
            </select>
            <select name="status" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="initiated" {{ request('status') === 'initiated' ? 'selected' : '' }}>Initiated</option>
                <option value="negotiation" {{ request('status') === 'negotiation' ? 'selected' : '' }}>Negotiation</option>
                <option value="agreement" {{ request('status') === 'agreement' ? 'selected' : '' }}>Agreement</option>
                <option value="token-received" {{ request('status') === 'token-received' ? 'selected' : '' }}>Token Received</option>
                <option value="booking-confirmed" {{ request('status') === 'booking-confirmed' ? 'selected' : '' }}>Booking Confirmed</option>
                <option value="documentation" {{ request('status') === 'documentation' ? 'selected' : '' }}>Documentation</option>
                <option value="registration" {{ request('status') === 'registration' ? 'selected' : '' }}>Registration</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <select name="payment_status" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" onchange="this.form.submit()">
                <option value="">All Payment Status</option>
                <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="partial" {{ request('payment_status') === 'partial' ? 'selected' : '' }}>Partial</option>
                <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="overdue" {{ request('payment_status') === 'overdue' ? 'selected' : '' }}>Overdue</option>
            </select>
            <select name="priority" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" onchange="this.form.submit()">
                <option value="">All Priority</option>
                <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
            </select>
            <select name="agent_id" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" onchange="this.form.submit()">
                <option value="">All Agents</option>
                @foreach($agents as $agent)
                    <option value="{{ $agent->id }}" {{ request('agent_id') == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <form id="bulkDeleteForm" action="{{ route('transactions.bulk-delete') }}" method="POST">
        @csrf
        <x-data-table
            title="Transactions Management"
            description="Manage all property transactions and deals"
            :createRoute="route('transactions.create')"
            createLabel="Add Transaction"
            :columns="[
                ['label' => 'Select', 'field' => 'checkbox'],
                ['label' => 'Transaction #', 'field' => 'transaction_number'],
                ['label' => 'Client', 'field' => 'client_name'],
                ['label' => 'Property/Project', 'field' => 'property'],
                ['label' => 'Type', 'field' => 'transaction_type'],
                ['label' => 'Amount', 'field' => 'total_amount'],
                ['label' => 'Payment', 'field' => 'payment_status'],
                ['label' => 'Status', 'field' => 'status']
            ]"
        >
            <tr style="background-color: {{ $theme['primary_color'] }}05;">
                <td class="px-4 md:px-6 py-3">
                    <input 
                        type="checkbox" 
                        id="selectAll"
                        class="w-4 h-4 rounded focus:ring-offset-0" 
                        style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                        onchange="toggleSelectAll(this, 'transaction-checkbox')"
                    >
                </td>
                <td colspan="8" class="px-4 md:px-6 py-3 text-xs font-medium" style="color: {{ $theme['primary_color'] }};">
                    Select All
                </td>
            </tr>
            @forelse($transactions as $transaction)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <input 
                            type="checkbox" 
                            name="ids[]" 
                            value="{{ $transaction->id }}" 
                            class="transaction-checkbox w-4 h-4 rounded focus:ring-offset-0" 
                            style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                            onchange="updateBulkDeleteButton('transaction-checkbox')"
                        >
                    </td>
                    <td class="px-4 md:px-6 py-4">
                        <div class="font-medium" style="color: {{ $theme['primary_color'] }};">
                            <a href="{{ route('transactions.show', $transaction) }}" class="hover:underline">{{ $transaction->transaction_number }}</a>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">{{ $transaction->created_at->format('M d, Y') }}</div>
                    </td>
                    <td class="px-4 md:px-6 py-4">
                        <div class="font-medium" style="color: {{ $theme['accent_color'] }};">{{ $transaction->client_name }}</div>
                        <div class="text-xs text-gray-500">{{ $transaction->client_phone }}</div>
                    </td>
                    <td class="px-4 md:px-6 py-4 text-sm" style="color: {{ $theme['accent_color'] }};">
                        @if($transaction->property)
                            <div>{{ Str::limit($transaction->property->title, 30) }}</div>
                        @elseif($transaction->project)
                            <div>{{ Str::limit($transaction->project->name, 30) }}</div>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ ucfirst($transaction->transaction_type) }}
                        </span>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <div class="font-semibold" style="color: {{ $theme['primary_color'] }};">₹{{ number_format($transaction->total_amount, 0) }}</div>
                        <div class="text-xs text-gray-500">Paid: ₹{{ number_format($transaction->paid_amount, 0) }}</div>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        @if($transaction->payment_status === 'paid')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span>
                        @elseif($transaction->payment_status === 'partial')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Partial</span>
                        @elseif($transaction->payment_status === 'overdue')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Overdue</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Pending</span>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        @if($transaction->status === 'completed')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                        @elseif($transaction->status === 'cancelled')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ ucfirst(str_replace('-', ' ', $transaction->status)) }}</span>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <x-table-actions 
                            :editRoute="route('transactions.edit', $transaction)" 
                            :deleteRoute="route('transactions.destroy', $transaction)"
                            deleteMessage="Delete {{ $transaction->transaction_number }}?"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                        No transactions found. <a href="{{ route('transactions.create') }}" class="font-medium" style="color: {{ $theme['secondary_color'] }};">Add your first transaction</a>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </form>

    @if($transactions->hasPages())
        <div class="mt-6">
            {{ $transactions->links() }}
        </div>
    @endif
</div>


@endsection

