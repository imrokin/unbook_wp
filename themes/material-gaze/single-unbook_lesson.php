<?php
/**
 * The template for displaying all single posts
 *

 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
		<?php
			

			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
	</header><!-- .entry-header -->

	

	<div class="entry-content">

   





		
<?php //login check
$course_id=get_post_meta($post->ID,'course_assigned_to',true);
$enrolled_status=get_post_meta($course_id,$current_user->ID,true);

if (!$user_ID) {  
			echo "<center><h3><a href='".esc_url( get_permalink( get_page_by_title( 'Profile' ) ))."'>Login</a> First!</h3><center>";
			}
			elseif(!$enrolled_status=='payed' || !$enrolled_status=='enrolled')
			{
			echo "<center><h3>Sorry! Not Enrolled For this course.</h3><center>";	

			}else{ 

		  the_content(); ?>


        
		  <?php

		if($_POST)
		   {
		 $student_answer = $_POST['student_answer'];
		 $post_id = $_POST['question_id'];
  		if(update_post_meta($post_id,$current_user->ID,$student_answer)){ $answer_saved=TRUE; }

			} 
		elseif($_FILES)
		    {
			if (!function_exists('wp_generate_attachment_metadata')){
		    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		    }

		    foreach ($_FILES as $file => $array)
		    {
		        if($_FILES[$file]['error'] !== UPLOAD_ERR_OK){return "upload error : " . $_FILES[$file]['error'];}//If upload error
		        $attach_id = media_handle_upload($file,0);
		        $post_id = $_POST['question_id'];
		        update_post_meta($post_id,$current_user->ID,$attach_id);
		        //echo wp_get_attachment_url($attach_id);//upload file URL
		    }
		    }
		    ?>


 <div id="slider">
<?php
// get questions assigned to  lesson
$args = array( 'posts_per_page' => -1,
    'meta_key'         => 'question_assigned_to',
	'meta_value'       => get_the_ID(),
	'post_type'        => 'unbook_question',
	'post_status'      => 'publish',


 );


$lastposts = get_posts( $args );
$duration_lesson=get_post_meta($post->ID,'lesson_time_limit',true);
//check if questions are theri in this lesson
if($lastposts){



if(!$duration_lesson == 0 && !$duration_lesson=''){  


 echo '<h3> <span id="time"></span> </h3>';

}

$i=1;

foreach ( $lastposts as $post ) :
  setup_postdata( $post ); 
?>
 
	

	<?php 

//check for if question type is MCQ
	if(get_post_meta($post->ID,'question_type',true)=='multiple_choice'){ 
        $student_answer =get_post_meta($post->ID,$current_user->ID,true);
	 ?>
  <div id="<?php echo $i; ?>" class="slide">
  
	
	<form method="post" action="">
	<p class="result"></p>
	 <h4><?php echo $i.'. ';  the_title(); ?></h4><br>

	<input readonly type="text"  style="display:none;" class="question_explaination"   value="<?php echo get_post_meta($post->ID,'question_explaination',true); ?>">
	
	<input type="radio" class="student_answer" name='student_answer' <?php if($student_answer=='option1'){echo 'checked';} ?>  value="option1">&nbsp;<?php echo get_post_meta($post->ID,'option1',true); ?><br>
	<input type="radio" class="student_answer"  name='student_answer' <?php if($student_answer=='option2'){echo 'checked';} ?>  value="option2">&nbsp;<?php echo get_post_meta($post->ID,'option2',true); ?><br>
	<input type="radio" class="student_answer"  name='student_answer' <?php if($student_answer=='option3'){echo 'checked';} ?>  value="option3">&nbsp;<?php echo get_post_meta($post->ID,'option3',true); ?><br>
	<input type="radio" class="student_answer"  name='student_answer' <?php if($student_answer=='option4'){echo 'checked';} ?>  value="option4">&nbsp;<?php echo get_post_meta($post->ID,'option4',true); ?><br>
	<input type='hidden'  value='' name='correct'>
	<input type='hidden' id="question_id"   value='<?php echo $post->ID; ?>' name='question_id'><br>
	<input type="submit" id="save_answer" value="save">&nbsp;

	</form>
</div>
	<?php }
//check if question type is subjective
	elseif(get_post_meta($post->ID,'question_type',true)=='subjective'){
		$student_answer =get_post_meta($post->ID,$current_user->ID,true);
		?>

 <div id="<?php echo $i; ?>" class="slide">
 <p class="result"></p>
 <h4><?php echo $i.'. ';  the_title(); ?></h4>
<form method="post" action="" enctype="multipart/form-data">
<textarea rows="3" name="student_answer" ><?php echo $student_answer; ?></textarea> 
 <input type = "hidden" id="files" name="my_file_upload[]" accept = "image/*" class = "files-data form-control" multiple />
<input type='hidden'  value='<?php echo $post->ID; ?>' name='question_id'><br>
<input type='hidden'  value='subjective' name='question_type'>
<hr><input type="submit" name="submit" value="save">&nbsp;
<input type="submit" class='upload' name="submit" value="upload">&nbsp;
<div id="image_gallery"></div>
</form>
</div>


<?php 
} 
$i++;
endforeach; 
wp_reset_postdata(); 


?>

	
</div> 
		<br><br><button  id="previous-btn">< Previous</button> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button id="next-btn">Next ></button>
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- for showing questons one by one-->
<script type="text/javascript">
	 var active = 0;
    var n = $('#slider div').length; // number of divs...
    $(document).ready(function(){
        $('#slider div').hide();
        showElement(1);
        $("#next-btn").click(function(){
            if (active < n) showElement(active + 1);
            $('p.result').html("");
            $('.question_explaination').hide();
        });
        $("#previous-btn").click(function(){
            if (active > 1) showElement(active - 1);
             $('p.result').html("");
             $('.question_explaination').hide();
        });
    });
    function showElement(id) {
        $('#slider div').hide();
        $('#' + id).show();
        active = id;
    }

    </script>


    <!-- for answer save through ajax -->
    <script>
    
$('input[type=submit]').click(function(e) {
e.preventDefault();

var question_type= $(this).siblings('input[name=question_type]').val();
if(question_type =='subjective')
{
	var student_answer = $(this).siblings('textarea[name=student_answer]').val();
}
else
{
var student_answer = $(this).siblings('input[name=student_answer]:checked').val();
}
var post_id = $(this).siblings('input[name="question_id"]').val();

var current_user = <?php echo $current_user->ID; ?>;
jQuery.ajax({
       type: "POST",
       url: ajaxurl,
       data:{
            action: "save_answer",
            post_id: post_id,
            student_answer: student_answer,
            current_user: current_user
        },  
       success: function(msg){
       //	console.log(post_id);
       	//console.log(student_answer);
       	  //  	console.log(question_type);
       	     console.log('saved');
            $('p.result').html("Answer Saved!");
            $('.question_explaination').show();
       }
   });
});

</script>
<!-- for timer on questions-->
<script>
  function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.text(minutes + ":" + seconds);

        if (--timer < 0) {
           display.text('Time Finished!');
        }
    }, 1000);
}

jQuery(function ($) {
    var fiveMinutes = 60 * <?php echo get_post_meta($post->ID,'lesson_time_limit',true); ?>,
        display = $('#time');
    startTimer(fiveMinutes, display);
});
</script>
<!-- for image uploading through ajax -->
<script>
$(document).ready(function() {

    $('body').on('change', '#file', function(e){
        e.preventDefault;
  
        var fd = new FormData();
        var files_data = $('#file'); 
     
        $.each($(files_data), function(i, obj) {
            $.each(obj.files,function(j,file){
                fd.append('my_file_upload[' + j + ']', file);
            })
        });
        
        fd.append('action', 'cvf_upload_files');   

  var image_gallery=document.getElementById('image_gallery').value;
        
        fd.append('post_id', ''); 
  fd.append('image_gallery',image_gallery); 
  
        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
            data: fd,
            contentType: false,
            processData: false,
              dataType: "json",
            success: function(response){ 
    			console.log('uploaded');
    $('#image_gallery').val(response['attachment_idss']);
     
            }
        });
    });
});
</script> 




<?php 

//end if condition for question pressent or not
}


?>

</div><!-- .entry-content -->



</article><!-- #post-## -->


		</main><!-- #main -->
	</div><!-- #primary -->
	
</div><!-- .wrap -->

<?php  
  





// end of login check
} 




endwhile; // End of the loop.


 get_footer();
