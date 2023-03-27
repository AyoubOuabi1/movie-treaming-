<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'born_in',
        'nationality',
        'description',
        'role',

    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
