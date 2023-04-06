<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name')->unique();
            $table->string('groupPicture');
            $table->timestamps();
        });

        Schema::create('group_members', function (Blueprint $table) {
            $table->foreignId('groupId')->default(10)->constrained('groups');
            $table->foreignId('memberId')->constrained('members');
            $table->timestamps();
            $table->unique(['groupId', 'memberId']);
        });

        Schema::create('group_documents', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('groupId')->constrained('groups')->onDelete('cascade');
            $table->string('name');
            $table->text('url');
            $table->timestamps();
        });

        Schema::create('activity_responsibles', function (Blueprint $table) {
            $table->foreignId('groupId')->constrained('groups')->onDelete('cascade');
            $table->foreignId('memberId')->constrained('members')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_members');
        Schema::dropIfExists('group_documents');
        Schema::dropIfExists('activity_responsibles');
        Schema::dropIfExists('groups');
    }
};
