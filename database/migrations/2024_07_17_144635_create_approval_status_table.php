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
        Schema::create('approval_status', function (Blueprint $table) {
            $table->id();

            $table->foreignId('form_no')->references('id')->on('card_requests');
            $table->enum('stage_name', ['admin-cell','id-section','gm-security','dept-approval','user','admin']);
            $table->foreignId('sub_to')->nullable()->references('id')->on('users');
            $table->string('sub_from');
            $table->enum('action', ['approved','rejected','submitted','pending']);
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_status');
    }
};
