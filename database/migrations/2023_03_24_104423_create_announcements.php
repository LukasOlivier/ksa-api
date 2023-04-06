<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('date');
            $table->string('targetGroup');
            $table->foreignId('creatorId')->constrained('members');
            $table->timestamps();
        });

        Schema::create('announcement_translations', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('announcementId')->constrained('announcements')->onDelete('cascade');
            $table->string("language",2);
            $table->string('title');
            $table->string('message');
            $table->timestamps();

            $table->unique(['announcementId', 'language']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcement_translations');
        Schema::dropIfExists('announcements');
    }
};
