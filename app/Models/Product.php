<?php

namespace App\Models;

use TomatoPHP\FilamentEcommerce\Models\Product as TomatoProduct;

class Product extends TomatoProduct
{
    protected $table = 'products';

    /**
     * Accessor for legacy product_id attribute
     */
    public function getProductIdAttribute()
    {
        return $this->attributes['id'] ?? $this->id;
    }

    /**
     * Accessor for legacy stock attribute
     */
    public function getStockAttribute()
    {
        return $this->is_in_stock ? 100 : 0;
    }

    /**
     * Accessor for legacy category_name attribute
     */
    public function getCategoryNameAttribute()
    {
        if ($this->relationLoaded('category') && $this->category) {
            return $this->category->name;
        }
        $category = Category::find($this->category_id);
        return $category ? $category->name : 'General';
    }

    /**
     * Accessor for legacy images relation compatibility
     */
    public function getImagesAttribute()
    {
        $media = $this->getMedia('feature_image');
        if ($media->isEmpty()) {
            $media = $this->getMedia('images');
        }

        if ($media->isEmpty()) {
            return collect();
        }

        return $media->map(function ($item) {
            return (object)[
                'path' => $item->getUrl(),
                'is_url' => true,
            ];
        });
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

    /**
     * Relation to App Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
