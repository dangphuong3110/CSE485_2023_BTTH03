<?php
include '../src/bootstrap.php';                             

$path  = mb_strtolower($_SERVER['REQUEST_URI']);          
$path  = substr($path, strlen(DOC_ROOT));            
$parts = explode('/', $path);             

if ($parts[0] != 'admin') {                                 
    $page = $parts[0] ?: 'index';                            
    $id   = $parts[1] ?? null;                            
} else {                                                  
    $page = 'admin/' . ($parts[1] ?? '');                   
    $id   = $parts[2] ?? null;                          
}
$id = filter_var($id, FILTER_VALIDATE_INT);             

$php_page = APP_ROOT . '/src/pages/' . $page . '.php';   

if (!file_exists($php_page)) {                             
    $php_page = APP_ROOT . '/src/pages/page-not-found.php';  
}
include $php_page;                                         