<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Blog
 * @property integer $id
 * @property boolean $is_active
 * @property Carbon $publish_date
 * @property string $title
 * @property string $content
 * @property array $category
 * @property array $author
 */
class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'publish_date',
        'title',
        'content',
        'category',
        'author',
    ];
  
    protected $hidden = [
  	    'is_active',
	];

    protected $casts = [
        'is_active' => 'boolean',
        'category' => 'array',
        'author' => 'array',
    ];

    protected $dates = [
        'publish_date',
    ];
}