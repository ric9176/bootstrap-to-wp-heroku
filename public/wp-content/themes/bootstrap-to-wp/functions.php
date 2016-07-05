<?php

add_theme_support( 'post-thumbnails' );

function b2w_theme_styles() {
 wp_enqueue_style('bootstrap_css' , get_template_directory_uri() . '/css/bootstrap.min.css');

 wp_enqueue_style('style' , get_template_directory_uri() . '/style.css');
}

add_action ('wp_enqueue_scripts', 'b2w_theme_styles');

function b2w_theme_js() {
 wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js' , array('jquery') , '', true);
 wp_enqueue_script( 'classie_js', get_template_directory_uri() . '/js/classie.js', array('jquery') , '', true);
 wp_enqueue_script( 'cbpAnimatedHeader_js', get_template_directory_uri() . '/js/cbpAnimatedHeader.js', array('jquery') , '', true);
 wp_enqueue_script( 'jqBootstrapValidation_js', get_template_directory_uri() . '/js/jqBootstrapValidation.js', array('jquery') , '', true);
 wp_enqueue_script( 'contact_me_js', get_template_directory_uri() . '/js/contact_me.js', array('jquery') , '', true);
 wp_enqueue_script( 'freelancer', get_template_directory_uri() . '/js/freelancer.js', array('jquery') , '', true);
 }

add_action ('wp_enqueue_scripts', 'b2w_theme_js');﻿

?>
