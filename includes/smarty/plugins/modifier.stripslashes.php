<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.stripslashes.php
 * Type:     modifier
 * Name:     stripslashes
 * Purpose:  strip slashes from string
 * -------------------------------------------------------------
 */
function smarty_modifier_stripslashes($string)
{
    return stripslashes($string);
}
?>


