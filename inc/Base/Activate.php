<?php

// inc/Base/Activate.php
namespace Inc\Base;

class Activate {
    public static function activate() {
        flush_rewrite_rules();
    }
}






