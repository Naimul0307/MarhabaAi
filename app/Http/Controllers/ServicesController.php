<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    public function detail($slug)
    {
        $service = Service::where('slug', $slug)
            ->with([
                'category',
                'subCategory',
            ])
            ->where('status', 1)
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Gallery Images
        |--------------------------------------------------------------------------
        */

        $galleryImages = $service->gallery_images;

        if (is_string($galleryImages)) {

            $decoded = json_decode($galleryImages, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $galleryImages = $decoded;
            } else {
                $galleryImages = [$galleryImages];
            }

        } elseif (!is_array($galleryImages)) {

            $galleryImages = [];

        }


        /*
        |--------------------------------------------------------------------------
        | Main Video
        |--------------------------------------------------------------------------
        */

        $mainVideo = $this->convertYoutubeUrl(
            $service->videos_link
        );


        /*
        |--------------------------------------------------------------------------
        | Additional Videos
        |--------------------------------------------------------------------------
        */

        $additionalVideos = $service->additional_videos_links;

        if (is_string($additionalVideos)) {

            $decoded = json_decode($additionalVideos, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $additionalVideos = $decoded;
            } else {
                $additionalVideos = [$additionalVideos];
            }

        } elseif (!is_array($additionalVideos)) {

            $additionalVideos = [];

        }


        /*
        |--------------------------------------------------------------------------
        | Convert Additional Videos
        |--------------------------------------------------------------------------
        */

        $additionalVideos = collect($additionalVideos)
            ->map(function ($video) {

                return $this->convertYoutubeUrl($video);

            })
            ->filter()
            ->values()
            ->toArray();


        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view('service', [

            'service' => $service,

            'galleryImages' => $galleryImages,

            'mainVideo' => $mainVideo,

            'additionalVideos' => $additionalVideos,

            'showHero' => false,

            'meta_title' => $service->meta_title
                ?? $service->name,

            'meta_description' =>
                $service->meta_description
                ?? Str::limit(
                    strip_tags($service->description ?? ''),
                    150
                ),

            'meta_keywords' =>
                $service->meta_keywords
                ?? 'MIRROR BOOTH, PHOTO BOOTH, VIDEOS BOOTH, EVENT SERVICES, DUBAI, UAE',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Convert YouTube URL
    |--------------------------------------------------------------------------
    */

    private function convertYoutubeUrl($url)
    {
        if (empty($url)) {
            return null;
        }

        $url = trim($url);


        /*
        | Already Embed URL
        */

        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }


        /*
        | YouTube Watch URL
        |
        | https://www.youtube.com/watch?v=VIDEO_ID
        */

        if (str_contains($url, 'youtube.com/watch')) {

            parse_str(
                parse_url($url, PHP_URL_QUERY) ?? '',
                $query
            );

            if (!empty($query['v'])) {

                return 'https://www.youtube.com/embed/'
                    . $query['v'];
            }
        }


        /*
        | YouTube Short URL
        |
        | https://youtu.be/VIDEO_ID
        */

        if (str_contains($url, 'youtu.be/')) {

            $videoId = trim(
                parse_url($url, PHP_URL_PATH),
                '/'
            );

            if (!empty($videoId)) {

                return 'https://www.youtube.com/embed/'
                    . $videoId;
            }
        }
        return $url;
    }
}
