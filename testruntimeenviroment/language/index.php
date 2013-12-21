<?php
/* Initialization of GetText in myphp */
$language = "de_DE";
putenv("LANG=$language"); 
bindtextdomain("myphp","./locale"); 
textdomain("myphp"); 
/* Print some messages in the native language */ 
echo gettext("Hello new user"); 
echo _("You have no new messages"); 
?>