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
        Schema::create('final_cards', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');

            $table->boolean('active')->default('1')->comment('1: active 0:inactive');
            $table->string('control_num',14);
            $table->date('new_validity');
            $table->enum('issue_type',['new','replacement']);
            $table->string('idsec_image_path');
            $table->string('idsec_sign_path');
            $table->text('authority_remarks')->nullable();
            $table->foreignId('updated_user')->references('id')->on('users');
            $table->string('type');
            $table->string('emp_no');
            $table->string('full_name');
            $table->string('bangla_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('spouse_name')->nullable();
            $table->string('desig');
            $table->string('dept');
            $table->date('app_date');
            $table->string('station');
            $table->integer('shop_no');
            $table->integer('loc_no');
            $table->string('natl');
            $table->string('nid');
            $table->string('mobile',11);
            $table->string('pob');
            $table->date('dob');
            $table->string('bgrp');
            $table->string('height');
            $table->string('perm_add');
            $table->string('curr_add');
            $table->string('email');
            $table->string('ident_mark')->nullable();
            $table->date('card_val')->nullable();
            $table->text('change_reason');
            $table->string('ip_add')->nullable(); // Add this line
            $table->integer('receiver'); // Add this line
            $table->string('image_path'); // Add this line
            $table->string('signature_path'); // Add this line

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_cards');
    }
};
