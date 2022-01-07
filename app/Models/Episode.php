<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public $timestamps = false;
    protected $fillable = ['season', 'number', 'view', 'serie_id'];

    public function serie() {
        return $this->belongsTo(Serie::class);
    }

    /**
     * Casting value, int for bool
     *
     * @param $view
     * @return bool
     */
    public function getViewAttribute($view): bool {
        return $view;
    }
}
