 <?php
/*
Title: Answers
Post Type: unbook_question
Order: 1
Collapse: false

*/


piklist('field', array(
    'type' => 'select',
    'field' => 'question_type',
    'label' => 'Type of Question',
    'choices' => array(
      'multiple_choice' => 'Multiple Choice',
      'subjective' => 'Subjective',

    )
    ,'value' => 'hide'
  ));
piklist('field', array(
    'type' => 'text',
    'field' => 'question_mark',
    'label' => 'Marks assigned to this Question',
    
  ));

piklist('field', array(
    'type' => 'select',
    'field' => 'question_assigned_to',
    'label' => 'Asigned to Lesson / Quiz',
    'choices' => piklist(
              get_posts(
                 array(
                  'post_type' => 'unbook_lesson'
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
    'field' => 'question_explaination',
    'columns' =>12,
    'label' => 'Explaination for correct answer',
    
  ));







piklist('field', array(
    'type' => 'group'
    ,'label' => 'Answers'
    //,'field' => 'answer_group'
    //,'add_more' => true
    ,'conditions' => array(
      array(
        'field' => 'question_type'
        ,'value' => 'multiple_choice'
      )
    )
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'option1'
        ,'label' => __('Option 1', 'piklist-demo')
        ,'columns' =>12
        ,'attributes' => array(
          'class' => 'large-text'
        )
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'answer_correct'
          ,'columns' => 1
        
        ,'choices' => array(
       'option1' => 'Correct'
     )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'option2'
        ,'label' => __('Option 2', 'piklist-demo')
        ,'columns' =>12
        ,'attributes' => array(
          'class' => 'large-text'
        )
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'answer_correct'
          ,'columns' => 1
        
        ,'choices' => array(
       'option2' => 'Correct'
     )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'option3'
        ,'label' => __('Option 3', 'piklist-demo')
        ,'columns' =>12
        ,'attributes' => array(
          'class' => 'large-text'
        )
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'answer_correct'
          ,'columns' => 1
        
        ,'choices' => array(
       'option3' => 'Correct'
     )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'option4'
        ,'label' => __('Option 4', 'piklist-demo')
        ,'columns' =>12
        ,'attributes' => array(
          'class' => 'large-text'
        )
      )
      ,array(
        'type' => 'checkbox'
        ,'field' => 'answer_correct'
          ,'columns' => 1
        
        ,'choices' => array(
       'option4' => 'Correct'
     )
      )
      
    )
  ));