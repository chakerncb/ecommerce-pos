<?php 

namespace App\Traits;

use App\Models\Setting;

trait StoreInfoTrait {

    public static function getStoreInfo()
    {
        return Setting::where('group', 'sites')->get()->keyBy('name');
    }
}