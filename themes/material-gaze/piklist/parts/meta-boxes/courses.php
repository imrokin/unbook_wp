 <?php
/*
Title: Course Options
Post Type: unbook_course
Order: 1
Collapse: false


*/


piklist('field', array(
    'type' => 'text',
    'field' => 'course_price',
    'label' => 'Course Price',
    
    
  ));

piklist('field', array(
    'type' => 'html'
    ,'label' => __('Assigned Lessons', 'piklist-demo')
    
    ,'value' => piklist(
              get_posts(
                 array(
                  'post_type' => 'unbook_lesson'
                  ,'orderby' => 'post_date'
                  ,'posts_per_page'=> -1
                  ,'meta_query' => array(
            array(
           'key' => 'course_assigned_to',
           'value' => $post->ID,
           
                  )
                   )
                 )
                 ,'objects'
               )
               ,array(
                 'ID'
                 ,'post_title'
               )
)
  ));


