<?php

namespace App\Enums;

class PageNameEnum
{
    const HOME = 'Home';
    const ABOUT = 'About';
    const CONTACT = 'Contact';
    const MENU = 'Menu';

    /**
     * Get all available page names as an associative array.
     *
     * @return array
     */
    public static function all()
    {
        return [
            self::HOME => 'Home',
            self::ABOUT => 'About',
            self::CONTACT => 'Contact',
            self::MENU => 'Menu',
        ];
    }

    /**
     * Get the name of the page from the key.
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
