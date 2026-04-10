<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class CmsHelper
{
    /**
     * Get a CMS setting value by key, with an optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("cms_{$key}", 600, function () use ($key, $default) {
            $setting = Setting::where('key', $key)->first();
            return $setting?->value ?? $default;
        });
    }

    /**
     * Get all CMS settings as a keyed array.
     */
    public static function all(): array
    {
        return Cache::remember('cms_all', 600, function () {
            return Setting::all()->pluck('value', 'key')->toArray();
        });
    }

    /**
     * Clear the CMS cache. Call after saving settings.
     */
    public static function clearCache(): void
    {
        $keys = Setting::pluck('key')->toArray();
        foreach ($keys as $key) {
            Cache::forget("cms_{$key}");
        }
        Cache::forget('cms_all');
    }
}
