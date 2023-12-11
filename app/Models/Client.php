<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }
    public function analytics(): HasMany
    {
        return $this->hasMany(Analytic::class);
    }
}
