<?php

namespace App\Http\Controllers;

use App\Http\Services\HackerNewsHttp;

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

    public function reload(HackerNewsHttp $http)
    {
        $http->forgetCache();

        return $this->index($http);
    }
}
