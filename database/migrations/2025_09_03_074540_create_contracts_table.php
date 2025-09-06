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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('pks_number_partner');
            $table->string('pks_number_hospital');
            $table->string('contract_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_new_contract')->default(true);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('admin_approved_at')->nullable();
            $table->timestamp('legal_approved_at')->nullable();
            $table->timestamp('marketing_approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
