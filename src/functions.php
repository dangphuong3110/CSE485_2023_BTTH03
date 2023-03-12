<?php

function is_admin($role)
{
    if ($role !== 'admin') {                                  
        header('Location: ' . DOC_ROOT);                     
        exit;                                                
    }
}

function redirect(string $location, array $parameters = [], $response_code = 302)
{
    $qs = $parameters ? '?' . http_build_query($parameters) : '';       
    $location = $location . $qs;                                       
    header('Location: ' . DOC_ROOT . $location, true, $response_code); 
    exit;                                                                
}

function create_filename(string $filename, string $uploads): string
{
    $basename  = pathinfo($filename, PATHINFO_FILENAME);       
    $extension = pathinfo($filename, PATHINFO_EXTENSION);      
    $cleanname = preg_replace("/[^A-z0-9]/", "-", $basename); 
    $filename  = $cleanname . '.' . $extension;                   
    $i         = 0;                                               
    while (file_exists($uploads . $filename)) {               
        $i        = $i + 1;                                       
        $filename = $basename . $i . '.' . $extension;           
    }
    return $filename;                                             
}

function create_seo_name(string $text): string
{
    $text = strtolower($text);                                 
    $text = trim($text);                                      
    if (function_exists('transliterator_transliterate')) {     
        $text = transliterator_transliterate('Latin-ASCII', $text);
    }
    $text = preg_replace('/ /', '-', $text);                    
    $text = preg_replace('/[^-A-z0-9 ]+/', '', $text);         
    return $text;                                               
}

function handle_error($error_type, $error_message, $error_file, $error_line)
{
    throw new ErrorException($error_message, 0, $error_type, $error_file, $error_line);
}

function handle_exception($e)
{
    error_log($e);                       
    http_response_code(500);              
    echo "<h1>Sorry, a problem occurred</h1>   
          The site's owners have been informed. Please try again later.";
}

// Handle fatal errors
function handle_shutdown()
{
    $error = error_get_last();           
    if ($error !== null) {               
        $e = new ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line']);
        handle_exception($e);            
    }
}