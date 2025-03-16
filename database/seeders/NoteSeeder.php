<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Mohammed Najjar',
            'email' => 'a@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        Category::create([
            'name' => 'مهم',
            'user_id' => 1,
        ]);
        Category::create([
            'name' => 'غير مهم',
            'user_id' => 1,
        ]);
        $notes = [
            ['title' => 'تحليل النظام', 'content' => 'إجراء تحليل شامل لاحتياجات المشروع وتحديد المتطلبات.'],
            ['title' => 'استراتيجية التسويق', 'content' => 'وضع خطة تسويقية لتحسين الوعي بالعلامة التجارية.'],
            ['title' => 'تحسين الأداء', 'content' => 'تحسين أداء قاعدة البيانات باستخدام الفهارس (Indexes).'],
            ['title' => 'أهداف الشهر', 'content' => 'تحقيق نمو بنسبة 15% في المبيعات الشهرية.'],
        ];

        // إنشاء 50 ملاحظة مختلفة
        foreach ($notes as $note) {
            Note::create([
                'user_id' => 1, // تأكد من وجود مستخدم بهذا المعرف
                'title' => $note['title'],
                'content' => $note['content'],
                'is_favorite' => fake()->boolean(20), // 20% مفضلة
                'category_id' => fake()->boolean(10) ? 1 : (fake()->boolean(20) ? 2 : null),
            ]);
        }
    }
}
