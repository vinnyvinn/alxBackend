<?php

namespace App\Http\Controllers;

use App\Sources\AnimeSource;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    public $default_url="/anime?include=categories&fields[categories]=title,description,createdAt";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response()->json(AnimeSource::init()->getAnimes($this->default_url));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      return response()->json(AnimeSource::init()->getAnimesFiltered($request->get("url")));
    }

}
