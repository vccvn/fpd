<?php

if(!function_exists('fpd_asset')){
    function fpd_asset($path = null)
    {
        return asset('vendor/fpd' . ($path?'/'.$path:''));
    }
}