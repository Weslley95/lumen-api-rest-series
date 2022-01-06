<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public $timestamps = false;
    protected $fillable = ['season', 'number', 'view'];

    public function serie() {
        return $this->belongsTo(Serie::class);
    }
}
