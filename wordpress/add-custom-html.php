<?php

//head
function custom_head_html_func() {
  ?>
  <!-- Custom HTML here -->
  <?php
}

add_action('wp_head', 'custom_head_html_func');

//footer
function custom_footer_html_func() {
  ?>
  <!-- Custom HTML here -->
  <?php
}
add_action('wp_footer', 'custom_footer_html_func');
