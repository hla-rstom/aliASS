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
        Schema::create('interests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->foreignId('rack_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('requested');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('rental_rate', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interest_id')->constrained()->onDelete('cascade');
            $table->string('direction');
            $table->string('status')->default('pending');
            $table->string('tracking_number')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
        Schema::create('shipment_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->string('condition_sent')->nullable();
            $table->string('condition_received')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
        Schema::create('rental_agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interest_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('active');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('rental_rate', 10, 2);
            $table->string('payment_terms');
            $table->text('terms_conditions')->nullable();
            $table->timestamps();
        });
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_agreement_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('status')->default('pending');
            $table->timestamp('payment_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interests');
        Schema::dropIfExists('shipments');
        Schema::dropIfExists('shipment_items');
        Schema::dropIfExists('rental_agreements');
        Schema::dropIfExists('payments');
    }
};
