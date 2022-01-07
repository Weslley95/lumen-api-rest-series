<?php

namespace App\Http\Controllers;

use App\Models\Episode;

class EpisodesController extends BaseController
{
    /**
     * Used methods in BaseController
     */
    public function __construct() {
        $this->class = Episode::class;
    }

    /**
     * Get of episodes
     *
     * @param int $serieId
     * @return $episodes
     */
    public function getOfSerie(int $serieId) {

        $episodes = Episode::query()->where('serie_id', $serieId)->paginate();

        return $episodes;
    }
}
