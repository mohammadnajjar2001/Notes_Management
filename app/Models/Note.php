<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'category_id', 'content', 'is_favorite']; // السماح بتعبئة هذه الحقول

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // العلاقة مع التصنيف
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
