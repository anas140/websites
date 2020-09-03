<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Website;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:32',
            'text' => 'required',
            'url' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $article = Website::create($request->all());
        return response()->json([
            'status' => true,
            'data' => $article
        ], 201);
    }

    /** 
     * Update resource
     */
    public function update(Request $request, Website $website) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:32',
            'text' => 'required',
            'url' => 'required'
        ]);
        
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $website->update($request->all());
        return response()->json([
            'status' => true,
            'data' => $website
        ], 201);
    }

    /** Delete resource */
    public function destroy(Website $website) {
        $website->delete();
        return response()->json(['status' => true], 204);
    }
}
