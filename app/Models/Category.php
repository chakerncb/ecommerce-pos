<?php

namespace App\Models;

use TomatoPHP\FilamentCms\Models\Category as TomatoCategory;

class Category extends TomatoCategory
{
    protected $table = 'categories';

    /**
     * Accessor for legacy category_id property
     */
    public function getCategoryIdAttribute()
    {
        return $this->attributes['id'] ?? $this->id;
    }

    /**
     * Ensure name returns string cleanly
     */
    public function getNameAttribute($value)
    {
        if (is_array($value)) {
            $locale = app()->getLocale();
            return $value[$locale] ?? reset($value) ?? '';
        }

        if (is_string($value) && !empty($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                $locale = app()->getLocale();
                return $decoded[$locale] ?? reset($decoded) ?? $value;
            }
            return $value;
        }

        return '';
    }
}
