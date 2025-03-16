<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'user_id'];

    // العلاقة مع الملاحظات
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function user()
    {
        return $this->belongsTo(Category::class);
    }
}
