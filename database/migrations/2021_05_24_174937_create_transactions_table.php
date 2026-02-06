<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number')->nullable();
            $table->date('date')->nullable();
            $table->enum('transaction_type', ['income', 'expense']);
            $table->string('amount');
            $table->string('received_from')->nullable();
            $table->string('member_id')->nullable();
            $table->string('donor_id')->nullable();
            $table->string('student_id')->nullable();
            $table->string('received_from_other')->nullable();
            $table->string('paid_to')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('shop_id')->nullable();
            $table->string('paid_to_other')->nullable();
            $table->string('towards_id');
            $table->string('committee_id');
            $table->string('payment_mode');
            $table->string('receiver_id')->nullable();
            $table->string('payer_id')->nullable();
            $table->string('bank_id')->nullable();
            $table->string('transaction_number')->nullable();
            $table->text('check_details')->nullable();
            $table->string('check_bank_name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
