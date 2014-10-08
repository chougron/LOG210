<?php

namespace App\Component;

use App\Component\Kernel;

class Redirect {
    
    public static function to($url)
    {
        $link = Kernel::$base_site . $url;
        header("Location: $link");
        die();
    }
}