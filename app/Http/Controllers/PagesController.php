<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function index() {
        $title = "Import data to MySQL";
        return view('pages.index')->with('title', $title);
    }
}
