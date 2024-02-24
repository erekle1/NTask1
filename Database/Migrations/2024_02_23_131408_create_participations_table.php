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
        Schema::create('participations', function (Blueprint $table) {
            $table->id();
            $table->string('email'); // The only non-nullable field as per your requirements
            $table->string('salutation')->nullable();;
            $table->string('firstname',40)->nullable();;
            $table->string('lastname',40)->nullable();;
            $table->date('date_of_birth')->nullable();;
            $table->string('phone',30)->nullable();;
            $table->text('street')->nullable();;
            $table->string('postal_code',20)->nullable();;
            $table->string('city',30)->nullable();;
            $table->string('country',30)->nullable();;
            $table->unsignedBigInteger('campaign_id'); // Foreign key to campaigns table
            $table->timestamps();

            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participations');
    }
};
