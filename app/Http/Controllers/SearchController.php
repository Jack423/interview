<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function index(Request $request) {
        $title = 'Search';

        return view('pages.search', compact('title'));
    }

    public function search(Request $request) {
        $title = 'Search';
        $city = $request->get('inputCity');
        $state = $request->get('inputState');
        $zip = $request->get('inputZipCode');

        $data = (new Data)->where(function ($query) use ($city, $state, $zip) {
            if ($city != null || $city != "") {
                $query->where('MixedCity', 'LIKE', $city);
            }
            if ($state != null || $state != "") {
                $query->where('StateCode', '=', $state);
            }
            if ($zip != null || $zip != "") {
                $query->where('ZipCode', '=', $zip);
            }
        });

        Log::debug('Query: '.$data->toSql());
        Log::debug("COUNT: ".$data->get()->count());

        return view('pages.search', compact('title'))->with('data', $data->paginate(10));
    }
}
