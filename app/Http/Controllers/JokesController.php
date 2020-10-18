<?php

namespace App\Http\Controllers;

use App\Sources\FixedSource;
use Illuminate\Http\Request;

class JokesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response()->json(FixedSource::init()->getJokes());
    }
}
