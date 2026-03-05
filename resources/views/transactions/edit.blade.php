@extends('layouts.admin')

@section('title', 'Edit Transaction')
@section('page-title', 'Edit Transaction')

@section('content')
<div class="max-w-6xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Transactions', 'url' => route('transactions.index')],
        ['label' => 'Edit Transaction', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-4 md:px-6 py-4 border-b" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <h2 class="text-lg md:text-xl font-semibold" style="color: white;">Edit Transaction</h2>
        </div>

        <form action="{{ route('transactions.update', $transaction) }}" method="POST" class="p-4 md:p-6">
            @csrf
            @method('PUT')
            
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-2 border-red-500 rounded-xl">
                    <h3 class="text-red-800 font-semibold mb-2">Please fix the following errors:</h3>
                    <ul class="list-disc list-inside text-red-700 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <x-form-tabs :tabs="[
                ['id' => 'basic', 'label' => 'Basic Info', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\'></path></svg>'],
                ['id' => 'parties', 'label' => 'Parties', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z\'></path></svg>'],
                ['id' => 'financial', 'label' => 'Financial', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z\'></path></svg>'],
                ['id' => 'dates', 'label' => 'Dates', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg>'],
                ['id' => 'notes', 'label' => 'Notes', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z\'></path></svg>']
            ]">
                <!-- Basic Info Tab -->
                <x-tab-content id="basic">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-form-select label="Property" name="property_id" :value="$transaction->property_id" :options="$properties->pluck('title', 'id')->toArray()" placeholder="Select Property (Optional)" />
                            <x-form-select label="Project" name="project_id" :value="$transaction->project_id" :options="$projects->pluck('name', 'id')->toArray()" placeholder="Select Project (Optional)" />
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <x-form-select label="Transaction Type" name="transaction_type" :required="true" :value="$transaction->transaction_type" :options="[
                                'sale' => 'Sale',
                                'rent' => 'Rent',
                                'lease' => 'Lease',
                                'resale' => 'Resale'
                            ]" />
                            <x-form-select label="Status" name="status" :required="true" :value="$transaction->status" :options="[
                                'initiated' => 'Initiated',
                                'negotiation' => 'Negotiation',
                                'agreement' => 'Agreement',
                                'token-received' => 'Token Received',
                                'booking-confirmed' => 'Booking Confirmed',
                                'documentation' => 'Documentation',
                                'registration' => 'Registration',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled'
                            ]" />
                            <x-form-select label="Priority" name="priority" :required="true" :value="$transaction->priority" :options="[
                                'low' => 'Low',
                                'medium' => 'Medium',
                                'high' => 'High'
                            ]" />
                        </div>

                        <x-form-select label="Assigned Agent" name="agent_id" :value="$transaction->agent_id" :options="$agents->pluck('name', 'id')->toArray()" placeholder="Select Agent (Optional)" />
                    </div>
                </x-tab-content>

                <!-- Parties Tab -->
                <x-tab-content id="parties">
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Client/Buyer Information</h4>
                            <div class="space-y-4">
                                <x-form-input label="Client Name" name="client_name" :required="true" :value="$transaction->client_name" placeholder="Enter client name" />
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <x-form-input label="Client Phone" name="client_phone" :required="true" :value="$transaction->client_phone" placeholder="Enter phone number" />
                                    <x-form-input label="Client Email" name="client_email" type="email" :value="$transaction->client_email" placeholder="Enter email address" />
                                </div>
                                <x-form-textarea label="Client Address" name="client_address" rows="2" :value="$transaction->client_address" placeholder="Enter complete address" />
                            </div>
                        </div>

                        <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                            <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Seller/Owner Information (Optional)</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <x-form-input label="Seller Name" name="seller_name" :value="$transaction->seller_name" placeholder="Enter seller name" />
                                <x-form-input label="Seller Phone" name="seller_phone" :value="$transaction->seller_phone" placeholder="Enter phone number" />
                                <x-form-input label="Seller Email" name="seller_email" type="email" :value="$transaction->seller_email" placeholder="Enter email address" />
                            </div>
                        </div>
                    </div>
                </x-tab-content>

                <!-- Financial Tab -->
                <x-tab-content id="financial">
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Transaction Amount</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <x-form-input label="Total Amount (₹)" name="total_amount" type="number" :required="true" :value="$transaction->total_amount" placeholder="0.00" step="0.01" />
                                <x-form-input label="Paid Amount (₹)" name="paid_amount" type="number" :value="$transaction->paid_amount" placeholder="0.00" step="0.01" />
                            </div>
                        </div>

                        <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                            <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Payment Breakdown</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <x-form-input label="Token Amount (₹)" name="token_amount" type="number" :value="$transaction->token_amount" placeholder="0.00" step="0.01" />
                                <x-form-input label="Booking Amount (₹)" name="booking_amount" type="number" :value="$transaction->booking_amount" placeholder="0.00" step="0.01" />
                                <x-form-input label="Down Payment (₹)" name="down_payment" type="number" :value="$transaction->down_payment" placeholder="0.00" step="0.01" />
                                <x-form-input label="Loan Amount (₹)" name="loan_amount" type="number" :value="$transaction->loan_amount" placeholder="0.00" step="0.01" />
                            </div>
                        </div>

                        <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                            <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Payment Details</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <x-form-select label="Payment Method" name="payment_method" :value="$transaction->payment_method" :options="[
                                    'cash' => 'Cash',
                                    'cheque' => 'Cheque',
                                    'bank-transfer' => 'Bank Transfer',
                                    'emi' => 'EMI',
                                    'loan' => 'Loan'
                                ]" placeholder="Select Payment Method" />
                                <x-form-select label="Payment Status" name="payment_status" :required="true" :value="$transaction->payment_status" :options="[
                                    'pending' => 'Pending',
                                    'partial' => 'Partial',
                                    'paid' => 'Paid',
                                    'overdue' => 'Overdue'
                                ]" />
                                <x-form-input label="EMI Months" name="emi_months" type="number" :value="$transaction->emi_months" placeholder="0" min="0" />
                                <x-form-input label="EMI Amount (₹)" name="emi_amount" type="number" :value="$transaction->emi_amount" placeholder="0.00" step="0.01" />
                            </div>
                        </div>

                        <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                            <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Commission</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <x-form-input label="Commission (%)" name="commission_percentage" type="number" :value="$transaction->commission_percentage" placeholder="0.00" step="0.01" min="0" max="100" />
                                <x-form-input label="Commission Paid (₹)" name="commission_paid" type="number" :value="$transaction->commission_paid" placeholder="0.00" step="0.01" />
                                <x-form-select label="Commission Status" name="commission_status" :required="true" :value="$transaction->commission_status" :options="[
                                    'pending' => 'Pending',
                                    'paid' => 'Paid',
                                    'partial' => 'Partial'
                                ]" />
                            </div>
                        </div>
                    </div>
                </x-tab-content>

                <!-- Dates Tab -->
                <x-tab-content id="dates">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form-input label="Agreement Date" name="agreement_date" type="date" :value="$transaction->agreement_date?->format('Y-m-d')" />
                        <x-form-input label="Token Date" name="token_date" type="date" :value="$transaction->token_date?->format('Y-m-d')" />
                        <x-form-input label="Booking Date" name="booking_date" type="date" :value="$transaction->booking_date?->format('Y-m-d')" />
                        <x-form-input label="Registration Date" name="registration_date" type="date" :value="$transaction->registration_date?->format('Y-m-d')" />
                        <x-form-input label="Possession Date" name="possession_date" type="date" :value="$transaction->possession_date?->format('Y-m-d')" />
                        <x-form-input label="Expected Closing Date" name="expected_closing_date" type="date" :value="$transaction->expected_closing_date?->format('Y-m-d')" />
                        <x-form-input label="Actual Closing Date" name="actual_closing_date" type="date" :value="$transaction->actual_closing_date?->format('Y-m-d')" />
                    </div>
                </x-tab-content>

                <!-- Notes Tab -->
                <x-tab-content id="notes">
                    <div class="space-y-6">
                        <x-form-textarea label="Notes" name="notes" rows="4" :value="$transaction->notes" placeholder="Enter any additional notes or comments" />
                        <x-form-textarea label="Terms & Conditions" name="terms_conditions" rows="6" :value="$transaction->terms_conditions" placeholder="Enter terms and conditions of the transaction" />
                    </div>
                </x-tab-content>
            </x-form-tabs>

            <!-- Form Actions -->
            <div class="flex flex-col-reverse md:flex-row md:justify-end gap-3 pt-6 mt-6 border-t border-gray-200">
                <a href="{{ route('transactions.index') }}" class="px-6 py-3 border-2 rounded-xl font-medium hover:bg-gray-50 transition-all text-center" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 text-white rounded-xl font-medium hover:opacity-90 transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                    Update Transaction
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
