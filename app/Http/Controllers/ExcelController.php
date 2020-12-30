<?php

namespace App\Http\Controllers;

use App\Imports\DataImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function import(Request $request): RedirectResponse
    {
        Excel::import(new DataImport, $request->import_file);
        $request->session()->put('success', 'File has been imported successfully');

        return back();
    }
}
