<?php

namespace App\Imports;

use App\Models\Data;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Data
     */
    public function model(array $row): Data
    {
        // Log::debug($row['city']);

        return new Data([
            'ZipCode' => intval($row['zipcode']),
            'City' => $row['city'],
            'MixedCity' => $row['mixedcity'],
            'StateCode' => $row['statecode'],
            'StateFIPS' => $row['statefips'],
            'County' => $row['county'],
            'MixedCounty' => $row['mixedcounty'],
            'CountyFIPS' => $row['countyfips'],
            'Latitude' => $row['latitude'],
            'Longitude' => $row['longitude'],
            'GMT' => $row['gmt'],
            'DST' => $row['dst'],
        ]);
    }

    public function headingRow(): int {
        return 1;
    }
}
