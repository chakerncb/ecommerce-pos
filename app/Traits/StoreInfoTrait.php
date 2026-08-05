<?php 

namespace App\Traits;

use App\Models\Store;

Trait StoreInfoTrait {

      public function getStoreInfo()
      {
         $store = Store::all()->first();
         return $store;
      }
}