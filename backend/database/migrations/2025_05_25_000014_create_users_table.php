<?php

use App\Domain\State\UserStatuses;
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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('password');
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Not_Selected'])->default('Not_Selected');
            $table->date('birth_date')->nullable();
            $table->string('phone_number')->unique();
            $table->string('address', 1000)->nullable();
            $table->unsignedInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->index('room_id');
            $table->unsignedInteger('city_id')->nullable();;
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->index('city_id');
            $table->unsignedInteger('user_status_id')->nullable()->default(UserStatuses::ACTIVE_USER);
            $table->foreign('user_status_id')->references('id')->on('user_statuses')->onDelete('cascade');
            $table->index('user_status_id');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};