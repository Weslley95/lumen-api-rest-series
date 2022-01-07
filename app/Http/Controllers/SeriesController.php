<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController
{
    /**
     * Method return series
     *
     * @return Serie[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index() {

        return Serie::all();
    }

    /**
     * Return status and data in json
     *
     * @param Request $request
     * @return $serie and status created
     */
    public function store(Request $request) {

        return response()->json(Serie::create(['name' => $request->name]), '201');
    }


    /**
     * Return specific series or status 204
     *
     * @param $id
     * @return $serie or status 204
     */
    public function show($id) {

        $serie = Serie::find($id);

        if(is_null($serie)) {
            return response()->json('', '204');
        }

        return response()->json($serie);
    }

    /**
     * Method for save serie
     *
     * @param $id
     * @param Request $request
     * @return $serie or status 404
     */
    public function update($id, Request $request) {

        $serie = Serie::find($id);

        if(is_null($serie)) {
            return response()->json(['erro' => 'Error of update'], '404');
        }

        $serie->fill($request->all());
        $serie->save();

        return $serie;
    }

    /**
     * Method for delete serie
     *
     * @param $id
     * @return status request
     */
    public function destroy($id) {

        $seriesRemoved = Serie::destroy($id);

        if($seriesRemoved === 0) {
            return response()->json(['erro' => 'Not Found'], '404');
        }

        return response()->json('', '204');
    }
}
