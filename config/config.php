<?php
define('DEV', true);                       
define('DOMAIN', 'http://localhost'); 
define('ROOT_FOLDER', 'public');           

$this_folder   = substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']));
$parent_folder = dirname($this_folder);
define("DOC_ROOT", $parent_folder . DIRECTORY_SEPARATOR . ROOT_FOLDER . DIRECTORY_SEPARATOR);


$type     = 'mysql';                
$server   = 'localhost';             
$db       = 'btth03_cse485';             
$port     = '';                      
$charset  = 'utf8mb4';               
$username = 'root';         
$password = '';        

$dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";

$email_config = [
    'server'      => '',
    'port'        => '',
    'username'    => '',
    'password'    => '',
    'security'    => '',
    'admin_email' => '',
    'debug'       => (DEV) ? 2 : 0,
];

define('MEDIA_TYPES', ['image/jpeg', 'image/png', 'image/gif',]); 
define('FILE_EXTENSIONS', ['jpeg', 'jpg', 'png', 'gif',]);    
define('MAX_SIZE', '5242880');                                

define('UPLOADS', dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . ROOT_FOLDER . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR);
