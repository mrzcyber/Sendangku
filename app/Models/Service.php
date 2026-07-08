<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Service extends Model
{
    use HasSlug;
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'description',
        'price',
        'duration',
        'thumbnail',
    ];


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function serviceGalleries():HasMany
    {
        return $this->hasMany(ServiceGallery::class);
    }

    public function servicePackages():HasMany
    {
        return $this->hasMany(ServicePackage::class);
    }

}
