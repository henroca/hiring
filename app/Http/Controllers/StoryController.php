<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\HackerNewsHttp;
use Illuminate\Support\Collection;

class StoryController extends Controller
{
    public function index(HackerNewsHttp $http)
    {
        $paginate = $http->getNewStories()->paginate(10);
        $stories = $http->load($paginate->getCollection());
        $paginate->setCollection($stories);

        return response()->json($paginate);
    }

    public function show(HackerNewsHttp $http, $id)
    {
        $story = $http->getStory($id);

        return response()->json($story->jsonSerialize());
    }
}
