<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Overwrite or add your own custom functions to X in this file.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Parent Stylesheet
//   02. Additional Functions
// =============================================================================

// Enqueue Parent Stylesheet
// =============================================================================

add_filter( 'x_enqueue_parent_stylesheet', '__return_true' );



// Halsey Design Functions
// =============================================================================

/*  Remove Admin Bar
/* ------------------------------------ */ 
add_filter('show_admin_bar', '__return_false');



// Registering Custom Menu
// =============================================================================

add_action( 'after_setup_theme', 'custom_main_menu' );

function custom_main_menu() {
  register_nav_menu( 'main-2', __( 'Stone Farm Level 2', '__x__' ) );
}


