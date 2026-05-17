<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'event_date',
        'location',
        'quota',
        'description',
        'poster'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
