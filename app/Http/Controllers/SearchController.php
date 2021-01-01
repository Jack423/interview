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
        $data = (new Data)->paginate(10);
        switch ($request->path()) {
            case 'search':
                $title = 'Search';
                return view('pages.search', compact('title', 'data'));
            case 'advanced-search':
                $title = 'Advanced Search';
                return view('pages.advanced-search', compact('title', 'data'));
            default:
                break;
        }
    }

    public function search(Request $request)
    {
        $title = 'Search';
        $inputs = $request->all(['inputCity', 'inputState', 'inputZipCode']);

        $request->flash();

        $data = (new Data)->where(function ($query) use ($inputs, $request) {
            if ($request->filled('inputCity')) {
                $query->where('MixedCity', 'LIKE', $inputs['inputCity']);
            }
            if ($request->filled('inputState')) {
                $query->where('StateCode', '=', $inputs['inputState']);
            }
            if ($request->filled('inputZipCode')) {
                $query->where('ZipCode', '=', $inputs['inputZipCode']);
            }
        });

        Log::debug('Query: ' . $data->toSql());
        Log::debug("COUNT: " . $data->get()->count());

        return view('pages.search', compact('title'))->with('data', $data->paginate(10));
    }

    public function advancedSearch(Request $request) {
        $title = 'Advanced Search';
        $zip1 = $request->get('inputZip1');
        $zip2 = $request->get('inputZip2');
        $distance = $request->get('inputDistance');

        $url = 'http://www.zipcodeapi.com/rest/'.env('ZIPCODE_API_KEY').'/match-close.json/'.
            $zip1.','.$zip2.'/'.
            $distance.
            '/mile';

        $data = Http::get($url)->body();

        return view('pages.advanced-search', compact('title'))->with('data', $data);
    }
}
