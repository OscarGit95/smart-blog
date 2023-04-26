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
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('set null')->onUpdate('cascade');
                     
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses')
                    ->onDelete('set null')->onUpdate('cascade');
            
            $table->longText('topic');
            $table->longText('blog');
            $table->dateTime('expires_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign('blogs_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('blogs_status_id_foreign');
            $table->dropColumn('status_id');
        });
        Schema::dropIfExists('blogs');

    }
};
