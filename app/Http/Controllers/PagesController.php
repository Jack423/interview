<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = "Upload an XML or CSV file";
        return view('pages.index')->with('title', $title);
    }
}
