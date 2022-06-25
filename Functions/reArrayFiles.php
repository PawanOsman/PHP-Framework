<?php
function reArrayFiles(&$file_post) {

    if(is_array($file_post['name']))
    {
      $file_ary = array();
      $file_count = count($file_post['name']);
      $file_keys = array_keys($file_post);

      for ($i=0; $i<$file_count; $i++) {
          foreach ($file_keys as $key) {
              $file_ary[$i][$key] = $file_post[$key][$i];
          }
      }

      $file_post = $file_ary[0];
    }
}
?>
