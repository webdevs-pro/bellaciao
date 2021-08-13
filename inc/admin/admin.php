<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class BC_Admin {

   public function __construct() {
      add_action('admin_menu', array( $this, 'admin_menu' ) );
   }


   public function admin_menu() {
      add_menu_page( 
         'BellaCiao', 
         'BellaCiao', 
         'manage_options', 
         'bellaciao', 
         array( $this, 'settings_page' ) 
      );
   }


   public function settings_page() {
      ?>
         <div class="wrap">
            <h1>BellaCiao</h1>
         

      <?php 
   }

}
new BC_Admin();






