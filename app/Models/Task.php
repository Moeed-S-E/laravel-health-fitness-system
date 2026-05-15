<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    protected $fillable = [
        'user_id','category_id','title','description',
        'priority','status','start_date','due_date','completed_at'
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date'   => 'date',
        'completed_at' => 'datetime',
    ];

    public function user()     { return $this->belongsTo(User::class); }
    public function category() { return $this->belongsTo(Category::class); }

    public function isOverdue(): bool {
        return $this->status !== 'completed' && $this->due_date->isPast();
    }
}