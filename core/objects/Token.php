<?php

class Token
{
    const salt1 = "696e9a76ad85afdb4d5d8b67bb1c84df399f8759c2f73a901d0c3b1298c38e18";
    const salt2 = "dfjsdkjsdfjoiU&OIU(*&(*();lfd/fd/.fdsmfds/fjasfdshfdsf8a87&)(&()&(8d9s08fsda09fudklj9f8908*()*()f7ud09-fs";

    private static function encrypt($username, $day)
    {
        $text = self::salt1 . $username;
        $text = hash("sha512", $text, false);
        $text = $day . $text . self::salt2;
        $text = hash("whirlpool", $text, false);
        $text = hash("sha256", $text, false);
        return $text;
    }

    public static function getToken($username)
    {
        return self::encrypt($username, date('Ymd'));
    }
}