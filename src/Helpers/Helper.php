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
        $var = htmlentities($var); // для удаления из строки любого HTML-кода
        return $var;
    }
    
    /**
     * @param string $var
     * @return string
     */
    public static function sanitizeString(string $var): string 
    {
        $var = stripslashes($var); //избавиться от нежелательных слеш-символов, например
        //с помощью уже устаревшей директивы magic_quotes_gpc
        $var = strip_tags($var);  // заменяет все угловые скобки, 
        //используемые в качестве
        //составляющих HTML-тегов
        $var = htmlentities($var, ENT_QUOTES); // для удаления из строки любого HTML-кода
        return $var;
    }

}
