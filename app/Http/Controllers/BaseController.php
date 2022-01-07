<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController
{
    // Name class controller used
    protected $class;

    /**
     * Method return class
     *
     * @return mixed
     */
    public function index(Request $request) {

        // Get result from page for created pagination
        return $this->class::paginate($request->per_page);
    }

    /**
     * Return status and data in json
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {

        return response()->json($this->class::create($request->all()), '201');
    }

    /**
     * Return specific class or status 204
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) {

        $renderer = $this->class::find($id);

        if(is_null($renderer)) {
            return response()->json('', '204');
        }

        return response()->json($renderer);
    }

    /**
     * Method for save
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request) {

        $renderer = $this->class::find($id);

        if(is_null($renderer)) {
            return response()->json(['erro' => 'Error of update'], '404');
        }

        $renderer->fill($request->all());
        $renderer->save();

        return $renderer;
    }

    /**
     * Method for delete serie
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {

        $renderer = $this->class::destroy($id);

        if($renderer === 0) {
            return response()->json(['erro' => 'Not Found'], '404');
        }

        return response()->json('', '204');
    }
}
