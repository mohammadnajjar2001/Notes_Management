<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id(); // مفتاح رئيسي
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // علاقة بالمستخدم
            $table->string('title')->default('No title'); // عنوان الملاحظة
            $table->text('content'); // محتوى الملاحظة
            $table->timestamps(); // وقت الإنشاء والتعديل
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
