 <?php
/*
Title: Lesson / Quiz Assigned to
Post Type: unbook_lesson
Order: 1
Collapse: false
Context: side

*/


piklist('field', array(
    'type' => 'select',
    'field' => 'course_assigned_to',
    'label' => 'Asigned to',
    'choices' => piklist(
              get_posts(
                 array(
                  'post_type' => 'unbook_course'
                  ,'orderby' => 'post_date'
                  ,'posts_per_page'=> -1
                 )
                 ,'objects'
               )
               ,array(
                 'ID'
                 ,'post_title'
               )
)
    
  ));

piklist('field', array(
    'type' => 'text',
    'field' => 'lesson_time_limit',
    'label' => 'Set Time in Minutes',
    
    
  ));


piklist('field', array(
    'type' => 'html'
    ,'label' => __('Assigned Questions', 'piklist-demo')
    
    ,'value' => piklist(
              get_posts(
                 array(
                  'post_type' => 'unbook_question'
                  ,'orderby' => 'post_date'
                  ,'meta_query' => array(
            array(
           'key' => 'question_assigned_to',
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

