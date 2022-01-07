<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public $timestamps = false;
    protected $fillable = ['season', 'number', 'view', 'serie_id'];

    // Accessors - Adding properties
    protected $appends = ['links'];

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

    /**
     * Access links for series
     *
     * @param $links
     * @return array link serie
     */
    public function getLinksAttribute($links): array {

        // HATEOAS
        return [
            'self' => '/api/episode/' . $this->id,
            'serie' => '/api/series/' . $this->id
        ];
    }
}
