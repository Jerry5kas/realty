<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->unique();
            
            // Property/Project Link
            $table->foreignId('property_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
            
            // Transaction Type
            $table->string('transaction_type'); // sale, rent, lease, resale
            
            // Parties Involved
            $table->string('client_name');
            $table->string('client_email')->nullable();
            $table->string('client_phone');
            $table->text('client_address')->nullable();
            
            $table->string('seller_name')->nullable();
            $table->string('seller_phone')->nullable();
            $table->string('seller_email')->nullable();
            
            // Agent/User
            $table->foreignId('agent_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            
            // Financial Details
            $table->decimal('total_amount', 15, 2);
            $table->decimal('token_amount', 15, 2)->default(0);
            $table->decimal('booking_amount', 15, 2)->default(0);
            $table->decimal('down_payment', 15, 2)->default(0);
            $table->decimal('loan_amount', 15, 2)->default(0);
            $table->decimal('paid_amount', 15, 2)->default(0);
            $table->decimal('balance_amount', 15, 2)->default(0);
            
            // Commission
            $table->decimal('commission_percentage', 5, 2)->default(0);
            $table->decimal('commission_amount', 15, 2)->default(0);
            $table->string('commission_status')->default('pending'); // pending, paid, partial
            $table->decimal('commission_paid', 15, 2)->default(0);
            
            // Payment Details
            $table->string('payment_method')->nullable(); // cash, cheque, bank-transfer, emi, loan
            $table->string('payment_status')->default('pending'); // pending, partial, paid, overdue
            $table->integer('emi_months')->nullable();
            $table->decimal('emi_amount', 15, 2)->nullable();
            
            // Transaction Status & Stage
            $table->string('status')->default('initiated'); // initiated, negotiation, agreement, token-received, booking-confirmed, documentation, registration, completed, cancelled
            $table->string('priority')->default('medium'); // low, medium, high
            
            // Important Dates
            $table->date('agreement_date')->nullable();
            $table->date('token_date')->nullable();
            $table->date('booking_date')->nullable();
            $table->date('registration_date')->nullable();
            $table->date('possession_date')->nullable();
            $table->date('expected_closing_date')->nullable();
            $table->date('actual_closing_date')->nullable();
            
            // Additional Info
            $table->text('notes')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->json('documents')->nullable(); // Store document URLs
            
            $table->timestamps();
            
            // Indexes
            $table->index('transaction_number');
            $table->index('status');
            $table->index('transaction_type');
            $table->index('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
