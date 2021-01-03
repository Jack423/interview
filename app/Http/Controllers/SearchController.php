<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public $searchTitle = 'Search';
    public $advancedSearchTitle = 'Advanced Search';

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $inputs = $request->all(['inputCity', 'inputState', 'inputZipCode']);
        $data = new Data;

        // Keep the text inside the inputs when search is clicked
        $request->flash();

        // Check which fields are filled
        if ($request->anyFilled(['inputCity', 'inputState', 'inputZipCode'])) {
            $data = $data->where(function ($query) use ($inputs, $request) {
                // Add the city to the SQL query
                if ($request->filled('inputCity')) {
                    $query->where('MixedCity', 'LIKE', $inputs['inputCity']);
                }
                // Add the state to the SQL query
                if ($request->filled('inputState')) {
                    $query->where('StateCode', '=', $inputs['inputState']);
                }
                // Add the zip code to the SQL query
                if ($request->filled('inputZipCode')) {
                    $query->where('ZipCode', '=', $inputs['inputZipCode']);
                }
            })->paginate(10);
        } else {
            // If no fields are filled, just return all the data in groups of 10 results
            $data = $data->paginate(10);
        }

        // Return search page with data from the SQL query
        return view('pages.search', [
            'title' => $this->searchTitle,
            'data' => $data,
        ]);
    }

    /**
     * Returns the basic view with no data for the advanced search page
     * @return Application|Factory|View
     */
    public function advancedSearchIndex() {
        // Return basic view
        return view('pages.advanced-search', ['title' => $this->advancedSearchTitle]);
    }

    /**
     * Validates and makes the call to the API to return information about the zip
     * codes entered into the inputs
     * @param Request $request
     * @return Application|Factory|View
     */
    public function advancedSearch(Request $request) {
        // Form validation
        $request->validate([
            'inputZip1' => 'required',
            'inputZip2' => 'required',
            'inputDistance' => 'required'
        ]);

        // Create URL for the API
        $url = 'http://www.zipcodeapi.com/rest/' . env('ZIPCODE_API_KEY') . '/match-close.json/' .
            $request->get('inputZip1') . ',' . $request->get('inputZip2') . '/' .
            $request->get('inputDistance') .
            '/mile';

        // Fetch the data with our generated URL
        $data = Http::get($url)->body();

        // Return the view with the data inside
        return view('pages.advanced-search', [
            'title' => $this->advancedSearchTitle,
            'data' => json_decode($data),
        ]);
    }
}
