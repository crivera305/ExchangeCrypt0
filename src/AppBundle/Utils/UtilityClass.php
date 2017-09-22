<?php

namespace AppBundle\Utils;

/**
 * Class UtilityClass
 * @package AppBundle\Utils
 */
class UtilityClass
{
    static function cleanString($text)
    {
        $string = str_replace("\xC2", "", $text);
        $string = str_replace("?", "{%}", $string);
        $string = mb_convert_encoding($string, "ISO-8859-1", "UTF-8");
        $string = mb_convert_encoding($string, "UTF-8", "ISO-8859-1");
        $string = str_replace(array("?", "? ", " ?"), array(""), $string);
        $string = str_replace("{%}", "?", $string);

        return Encoding::fixUTF8($string);
    }

    static function slugify($text, $location = 'n-a')
    {
        // replace .' by blank
        $text = str_replace(".", '', $text);
        $text = str_replace("'", '', $text);
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);

        if ($text == '') {
            $text = $location;
        }

        return $text;
    }

    static function slugToString($slug)
    {
        return str_replace("-", " ", $slug);
    }

    static function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT,
            'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $return = curl_exec($ch);
        curl_close($ch);

        return $return;
    }

}
