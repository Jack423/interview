<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Search';
        $inputs = $request->all(['inputCity', 'inputState', 'inputZipCode']);
        $data = new Data;

        $request->flash();

        if ($request->anyFilled(['inputCity', 'inputState', 'inputZipCode'])) {
            $data = $data->where(function ($query) use ($inputs, $request) {
                if ($request->filled('inputCity')) {
                    $query->where('MixedCity', 'LIKE', $inputs['inputCity']);
                }
                if ($request->filled('inputState')) {
                    $query->where('StateCode', '=', $inputs['inputState']);
                }
                if ($request->filled('inputZipCode')) {
                    $query->where('ZipCode', '=', $inputs['inputZipCode']);
                }
            })->paginate(10);
        } else {
            $data = $data->paginate(10);
        }

        return view('pages.search', compact('title', 'data'));
    }

    public function advancedSearchIndex(Request $request) {
        $title = 'Advanced Search';

        return view('pages.advanced-search', compact('title'));
    }

    public function advancedSearch(Request $request)
    {
        $title = 'Advanced Search';
        $zip1 = $request->get('inputZip1');
        $zip2 = $request->get('inputZip2');
        $distance = $request->get('inputDistance');

        $url = 'http://www.zipcodeapi.com/rest/' . env('ZIPCODE_API_KEY') . '/match-close.json/' .
            $zip1 . ',' . $zip2 . '/' .
            $distance .
            '/mile';

        $data = Http::get($url)->body();

        return view('pages.advanced-search', compact('title'))->with('data', json_decode($data));
    }
}
