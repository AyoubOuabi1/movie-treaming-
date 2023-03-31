<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'realased_date',
        'server_link',
        'type',
        'description',
        'duration',
        'cover_image',
        'trailer_video',
        'languages',
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }


}
