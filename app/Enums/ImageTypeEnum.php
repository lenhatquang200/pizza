<?php

namespace App\Enums;

class ImageTypeEnum
{
    const BANNERHOME = 'Banner Home';
    const BANNERMENU = 'Banner Menu';

    /**
     * Get all available image types as an associative array.
     *
     * @return array
     */
    public static function all()
    {
        return [
            self::BANNERHOME => 'Banner Home',
            self::BANNERMENU => 'Banner Menu',
        ];
    }

    /**
     * Get the name of the image type from the key.
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
