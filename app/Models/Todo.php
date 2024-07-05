<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $table = 'todos';
    protected $primaryKey = 'id';
    protected $fillable = ['todo_category_id', 'user_id', 'title', 'description', 'status'];

    // Define the relationship with TodoCategory
    public function category()
    {
        return $this->belongsTo(TodoCategory::class, 'todo_category_id');
    }
}
