<?php
/*
 * @package asif
 */

class MyPluginActivate
{
    public static function activate()
    {
        echo 'Asif';

        flush_rewrite_rules();
    }
}
