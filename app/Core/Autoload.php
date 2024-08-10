<?php 

function load_core($class_name){
  $path_to_file='../app/core/'.$class_name.'.php';
  if(file_exists($path_to_file)){
    require_once ($path_to_file);
  }
}

spl_autoload_register('load_core');