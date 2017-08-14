<?php

class Encrypt
{
    const salt1 = "c6729ca33464d34c43ed2263130036a1dc67aa757b9660f16763c56752efa878";
    const salt2 = "4cb3ecd17a0b9802ff898bf3b9b66a5332c9074d67739de5deae73601d70da7c";

    public static function hash($text)
    {
        $textEncrypted = hash("sha512", $text, false);
        $textEncrypted = self::salt1 . $textEncrypted . self::salt2;
        $textEncrypted = hash("whirlpool", $textEncrypted, false);
        return hash("sha256", $textEncrypted, true);
    }
}