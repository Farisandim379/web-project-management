<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id' ,
    ];

    /**
     * Mendapatkan user yang memiliki/membuat project ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendapatkan semua task yang ada di dalam project ini.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
