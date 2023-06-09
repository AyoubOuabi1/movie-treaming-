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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('realased_date');
            $table->text('server_link');
             $table->text('description');
            $table->string('duration');
            $table->text('poster_image');
            $table->text('cover_image');
            $table->string('trailer_video');
            $table->string('languages');
            $table->string('directorId');
            $table->Integer('totalView');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
