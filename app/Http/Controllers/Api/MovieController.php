<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\MovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;

/***
 * Author: chen ray
 * Email: chenraygogo@gmail.com
 *
 **/

class MovieController extends BaseController
{
    public function index(): AnonymousResourceCollection
    {
        $movies = Movie::limit(100)->orderBy('id', 'desc')->get();
        return MovieResource::collection($movies);
    }

    public function store(MovieRequest $request, Movie $movie): MovieResource
    {
        $movie->fill($request->all());
        $movie->save();
        return new MovieResource($movie);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response(null, 204);
    }
}
