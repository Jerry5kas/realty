@extends('layouts.admin')

@section('title', 'Transaction Details')
@section('page-title', 'Transaction Details')

@section('content')
<div class="max-w-6xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Transactions', 'url' => route('transactions.index')],
        ['label' => 'Transaction Details', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-4 md:px-6 py-4 border-b flex justify-between items-center" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <div>
                <h2 class="text-lg md:text-xl font-semibold" style="color: white;">{{ $transaction->transaction_number }}</h2>
                <p class="text-sm text-white/80 mt-1">{{ $transaction->created_at->format('M d, Y h:i A') }}</p>
            </div>
            <a href="{{ route('transactions.edit', $transaction) }}" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
        </div>

        <div class="p-4 md:p-6 space-y-6">
            <!-- Status Badges -->
            <div class="flex flex-wrap gap-2">
                @if($transaction->status === 'completed')
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                @elseif($transaction->status === 'cancelled')
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                @else
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">{{ ucfirst(str_replace('-', ' ', $transaction->status)) }}</span>
                @endif

                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800">
                    {{ ucfirst($transaction->transaction_type) }}
                </span>

                @if($transaction->priority === 'high')
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">High Priority</span>
                @elseif($transaction->priority === 'medium')
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">Medium Priority</span>
                @endif

                @if($transaction->payment_status === 'paid')
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">Payment: Paid</span>
                @elseif($transaction->payment_status === 'partial')
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">Payment: Partial</span>
                @elseif($transaction->payment_status === 'overdue')
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">Payment: Overdue</span>
                @endif
            </div>

            <!-- Property/Project -->
            @if($transaction->property || $transaction->project)
                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h3 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Property/Project</h3>
                    @if($transaction->property)
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Property</p>
                            <a href="{{ route('properties.show', $transaction->property) }}" class="font-medium text-lg hover:underline" style="color: {{ $theme['secondary_color'] }};">
                                {{ $transaction->property->title }}
                            </a>
                        </div>
                    @endif
                    @if($transaction->project)
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-500">Project</p>
                            <a href="{{ route('projects.show', $transaction->project) }}" class="font-medium text-lg hover:underline" style="color: {{ $theme['secondary_color'] }};">
                                {{ $transaction->project->name }}
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Financial Summary -->
            <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                <h3 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Financial Summary</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Total Amount</p>
                        <p class="text-2xl font-bold" style="color: {{ $theme['primary_color'] }};">₹{{ number_format($transaction->total_amount, 2) }}</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Paid Amount</p>
                        <p class="text-2xl font-bold text-green-700">₹{{ number_format($transaction->paid_amount, 2) }}</p>
                        <div class="mt-2 bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ $transaction->payment_progress }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">{{ $transaction->payment_progress }}% paid</p>
                    </div>
                    <div class="p-4 bg-orange-50 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Balance Amount</p>
                        <p class="text-2xl font-bold text-orange-700">₹{{ number_format($transaction->balance_amount, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Client Information -->
            <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                <h3 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Client Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Name</p>
                        <p class="font-medium">{{ $transaction->client_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Phone</p>
                        <p class="font-medium">{{ $transaction->client_phone }}</p>
                    </div>
                    @if($transaction->client_email)
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium">{{ $transaction->client_email }}</p>
                        </div>
                    @endif
                    @if($transaction->client_address)
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">Address</p>
                            <p class="font-medium">{{ $transaction->client_address }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Commission -->
            @if($transaction->commission_amount > 0)
                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h3 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Commission Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Commission %</p>
                            <p class="font-medium">{{ $transaction->commission_percentage }}%</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Commission Amount</p>
                            <p class="font-medium">₹{{ number_format($transaction->commission_amount, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Commission Status</p>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $transaction->commission_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($transaction->commission_status) }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Agent -->
            @if($transaction->agent)
                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h3 class="font-semibold mb-2" style="color: {{ $theme['primary_color'] }};">Assigned Agent</h3>
                    <p class="font-medium">{{ $transaction->agent->name }}</p>
                </div>
            @endif

            <!-- Notes -->
            @if($transaction->notes)
                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h3 class="font-semibold mb-2" style="color: {{ $theme['primary_color'] }};">Notes</h3>
                    <p class="text-gray-700 whitespace-pre-line">{{ $transaction->notes }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
