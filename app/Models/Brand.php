<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];

    // Fallback to empty collection if brands table does not exist
    public static function all($columns = ['*'])
    {
        try {
            return parent::all($columns);
        } catch (\Throwable $e) {
            return collect();
        }
    }
}
