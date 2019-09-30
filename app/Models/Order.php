<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'floor',
        'ordered_at',
        'elevator_id',
        'arrived_at',
        'iteration',
    ];

    protected $casts = [
        'ordered_at' => 'datetime',
        'arrived_at' => 'datetime',
    ];

    public static function makeTo(int $floor): self
    {
        return self::create(['floor' => $floor]);
    }

    public function elevator(): BelongsTo
    {
        return $this->belongsTo(Elevator::class);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->whereNull('arrived_at');
    }

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->whereNotNull('arrived_at');
    }
}
