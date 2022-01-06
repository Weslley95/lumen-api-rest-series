<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function season() {

        // Serie possui muitos episodios
        return $this->hasMany(Season::class);
    }
}
