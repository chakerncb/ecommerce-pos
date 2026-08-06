<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable = [
        "id",
        "group", 	
        "name",  	
        "locked", 	
        "payload", 	
        "created_at", 	
        "updated_at"
    ];

    /**
     * Accessor for payload to unquote string payloads or parse JSON
     */
    public function getPayloadAttribute($value)
    {
        if (is_null($value)) {
            return '';
        }
        $decoded = json_decode($value, true);
        return $decoded !== null ? $decoded : $value;
    }
}