<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\HackerNewsHttp;

class StoryController extends Controller
{
    public function index(HackerNewsHttp $http)
    {
        $stories = $http->getNewStories();

        return response()->json($stories->paginate(10));
    }
}
