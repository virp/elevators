<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Elevator extends Model
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
        'move_to',
    ];

    public function scopeOnFloor(Builder $query, int $floor): Builder
    {
        return $query->where('floor', $floor);
    }

    public function scopeInMotion(Builder $query): Builder
    {
        return $query->whereNotNull('move_to');
    }

    public function move(): void
    {
        if (!$this->move_to) {
            return;
        }

        if ($this->floor < $this->move_to) {
            $this->update(
                [
                    'floor' => $this->floor + 1,
                    'move_to' => $this->move_to === $this->floor + 1 ? null : $this->move_to,
                ]
            );
        } elseif ($this->floor > $this->move_to) {
            $this->update(
                [
                    'floor' => $this->floor - 1,
                    'move_to' => $this->move_to === $this->floor - 1 ? null : $this->move_to,
                ]
            );
        } else {
            $this->update(['move_to' => null]);
        }
    }
}
