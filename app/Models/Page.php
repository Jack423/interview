<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Page extends Model
{
    public static function insertData($data)
    {
        $value = DB::table('data')->where('ZipCode', $data['ZipCode'])->get();

        if ($value->count() == 0) {
            DB::table('data')->insert($data);
        }
    }
}
