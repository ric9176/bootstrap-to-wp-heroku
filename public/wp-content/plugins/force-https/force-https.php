<?php
/*
Plugin Name: Force HTTPS
Plugin URI: https://riyadarefin.com
Description: Forces every single page/post to go over HTTPS
Author: Riyad Arefin
Author URI: https://pressply.com
Version: 0.1.1
*/

function riyad_force_https () {
  if ( !is_ssl() ) {
    wp_redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 301 );
    exit();
  }
}
add_action ( 'template_redirect', 'riyad_force_https', 1 );
