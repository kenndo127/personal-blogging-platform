<?php
function create_slug($string) {
  // 1. Lowercase the string
  $slug = strtolower($string);
  // 2. Replace any non-alphanumeric characters with a hyphen
  $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
  // 3. Remove multiple hyphens in a row and trim from ends
  $slug = preg_replace('/-+/', '-', $slug);
  return trim($slug, '-');
}

function get_url(){
  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
  $host = $_SERVER['HTTP_HOST'];
  $path = $_SERVER['REQUEST_URI'];
  
  return $protocol . $host . $path;
}

function get_domain_url($string) {
  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
  $host = $_SERVER['HTTP_HOST'];
  $clean_path = ltrim($string, '/');
  return $protocol . $host . "/" . $clean_path;
}
