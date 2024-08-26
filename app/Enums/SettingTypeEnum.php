<?php
namespace App\Enums;

class SettingTypeEnum
{
    const FACEBOOK_URL = 'facebook_url';
    const INSTAGRAM_URL = 'instagram_url';
    const TWITTER_URL = 'twitter_url';
    const BRAND_LOGO = 'brand_logo';

    /**
     * Get all available setting types as an associative array.
     *
     * @return array
     */
    public static function all()
    {
        return [
            self::FACEBOOK_URL => 'Facebook URL',
            self::INSTAGRAM_URL => 'Instagram URL',
            self::TWITTER_URL => 'Twitter URL',
            self::BRAND_LOGO => 'Brand Logo',
        ];
    }

    /**
     * Get the name of the setting type from the key.
     *
     * @param string $key
     * @return string
     */
    public static function getName($key)
    {
        $options = self::all();
        return $options[$key] ?? $key;
    }
}
