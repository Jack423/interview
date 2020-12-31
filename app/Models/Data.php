<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Data
 * @mixin Builder
 */
class Data extends Model
{
    //use HasFactory;

    protected $table = 'data';
    protected $guarded = array();
}
