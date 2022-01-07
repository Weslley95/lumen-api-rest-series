<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    // Accessors - Adding properties
    protected $appends = ['links'];

    // Get items for page
    protected $perPage = 3;

    public function episodes() {

        // Series has many episodes
        return $this->hasMany(Episode::class);
    }

    /**
     * Access links for episodes
     *
     * @param $links
     * @return array link episode
     */
    public function getLinksAttribute($links): array {

        // HATEOAS
        return [
            'self' => '/api/series/' . $this->id,
            'episodes' => '/api/series/' . $this->id . '/episodes'
        ];
    }

}
