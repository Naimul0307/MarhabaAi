<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_title',
        'email',
        'phone',
        'facebook_url',
        'twitter_url',
        'whatsapp_url',
        'instagram_url',
        'tiktok_url',
        'linkedin_url',
        'youtube_url',
        'contact_card_one',
        'contact_card_two',
        'google_map',
        'copy',
    ];
}
