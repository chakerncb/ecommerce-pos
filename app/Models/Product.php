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
     * Accessor for Feature Image URL
     */
    public function getFeatureImageUrlAttribute()
    {
        $media = $this->getMedia('feature_image')->first();
        if ($media) {
            return $media->getUrl();
        }

        $imagesMedia = $this->getMedia('images')->first();
        if ($imagesMedia) {
            return $imagesMedia->getUrl();
        }

        return asset('assets/src/images/product/no-image.png');
    }

    /**
     * Accessor for feature_image
     */
    public function getFeatureImageAttribute()
    {
        return $this->feature_image_url;
    }

    /**
     * Accessor for legacy images relation compatibility
     */
    public function getImagesAttribute()
    {
        $featureMedia = $this->getMedia('feature_image');
        $galleryMedia = $this->getMedia('images');

        $allMedia = $featureMedia->concat($galleryMedia);

        if ($allMedia->isEmpty()) {
            return collect();
        }

        return $allMedia->map(function ($item) {
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

    /**
     * Relation to App Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
