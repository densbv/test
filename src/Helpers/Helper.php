<?php

namespace helpers;

class Helper 
{
    /**
     * @param string $var
     * @return string
     */
    public static function html(string $var): string
    {
        $var = htmlentities($var, ENT_QUOTES, "UTF-8"); 
        return $var;
    }
    
    /**
     * @param string $var
     * @return string
     */
    public static function sanitizeString(string $var): string 
    {
        $var = stripslashes($var); 
        $var = strip_tags($var);   
        $var = htmlentities($var, ENT_QUOTES, "UTF-8");
        return $var;
    }

}
