<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Website;

class WebsiteController extends Controller {
    
    /**
     * Display a listing of the resource.
     *
     * @return json response
     */
    public function index() {
        return Website::all();
    }

    public function show(Website $website) {
        return $website;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json response
     */
    public function store(Request $request) {
        $article = Website::create($request->all());
        return response()->json($article, 201);
    }

    /** 
     * Update resource
     */
    public function update(Request $request, Website $website) {
        $website->update($request->all());
        return response()->json($website, 200);
    }

    /** Delete resource */
    public function destroy(Website $website) {
        $website->delete();
        return response()->json(null, 204);
    }
}
