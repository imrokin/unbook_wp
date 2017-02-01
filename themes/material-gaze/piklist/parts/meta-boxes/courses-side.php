 <?php
/*
Title: Course Options
Post Type: unbook_course
Order: 1
Collapse: false
Context: side

*/

piklist('field', array(
    'type' => 'file'
    ,'field' => '_thumbnail_id' // Use this field to match WordPress featured image field name.
    ,'scope' => 'post_meta'
    ,'options' => array(
      'title' => __('Set featured image(s)', 'piklist-demo')
      ,'button' => __('Set featured image(s)', 'piklist-demo')
    )
  ));
