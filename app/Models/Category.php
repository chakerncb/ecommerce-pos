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
            return $value[app()->getLocale()] ?? reset($value) ?? '';
        }
        if (method_exists($this, 'getTranslation')) {
            try {
                $translated = $this->getTranslation('name', app()->getLocale(), false);
                if (!empty($translated)) {
                    return $translated;
                }
            } catch (\Throwable $e) {
                // fallback
            }
        }
        return is_string($value) ? $value : '';
    }
}
