<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityEvent extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'button_text',
        'button_url',
        'image_path',
        'is_active',
        'display_order',
        'event_date'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'event_date' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('event_date', 'asc');
    }
}
