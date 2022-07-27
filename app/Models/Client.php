<?php

namespace App\Models;

use App\Models\Relationships\ClientRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use ClientRelationship,
        HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'post_number',
        'address',
        'site_url',
    ];
}
