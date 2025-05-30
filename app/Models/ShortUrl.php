<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    /**
     * URL Shortener Project
     *
     * @copyright 2025 Jahid Hasan
     * @license   MIT License
     */
    protected $fillable = [
        'original_url',
        'short_url',
    ];
}
