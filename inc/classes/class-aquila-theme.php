<?php 
/**
 * Boostrap the theme
 * 
 * @package Aquila
 */ 

 namespace AQUILA_THEME\Inc;
 
 use AQUILA_THEME\Inc\Traits\Singleton;
 
 class AQUILA_THEME {
    use Singleton;
    
    protected function __construct() {
        // load classes
        Assets::get_instance();     
    }
    
  
 }