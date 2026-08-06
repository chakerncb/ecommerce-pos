<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $guarded = [];

    public static function all($columns = ['*'])
    {
        try {
            return parent::all($columns);
        } catch (\Throwable $e) {
            return collect([
                (object)[
                    'name' => config('app.name', 'Ecommerce POS'),
                    'address' => 'Store Address',
                    'phone' => '123456789',
                    'email' => 'store@example.com',
                    'logo_dark' => 'logo.png',
                    'logo_light' => 'logo.png',
                ]
            ]);
        }
    }
}
