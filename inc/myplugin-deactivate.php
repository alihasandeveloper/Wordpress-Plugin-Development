<?php
/*
 * @package asif
 */


class MyPluginDeactivate
{
    static function deactivate() {
        flush_rewrite_rules();
    }
}