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
        Schema::create('media', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('model_id')->nullable();
            $table->string('model_type')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('file_name', 255)->nullable();
            $table->string('mime_type', 255)->nullable();
            $table->string('disk', 255)->nullable();
            $table->string('size', 255)->nullable();
            $table->boolean('is_featured')->default(0);
            $table->foreignId('uploaded_by')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};