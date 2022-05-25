<?php
declare(strict_types=1);

namespace MichalHepner\Git\Util;

class StringUtil
{
    public static function toCamelCase(string $string, string $separator): string
    {
        return str_replace($separator, '', ucwords($string, $separator));
    }

    public static function toLowerCamelCase(string $string, string $separator): string
    {
        return lcfirst(self::toCamelCase($string, $separator));
    }

    public static function dashesToCamelCase(string $string): string
    {
        return self::toCamelCase($string, '-');
    }

    public static function dashesToLowerCamelCase(string $string): string
    {
        return self::toLowerCamelCase($string, '-');
    }

    public static function underscoresToCamelCase(string $string): string
    {
        return self::toCamelCase($string, '_');
    }

    public static function underscoresToLowerCamelCase(string $string): string
    {
        return self::toLowerCamelCase($string, '_');
    }
}
