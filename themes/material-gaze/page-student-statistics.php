<?php
/**
 * The template for displaying all pages.
 *
 * @package scrollme
 */
 global $wpdb ;

get_header(); ?>

	<div class="container clearfix">
		<div id="primary" class="content-area">
		<center><h3>Statistics</h3><center><hr>
		<style>
		td,th {
    font-size: 1.2rem;
			  }
		</style>
<table><th><p>Name</p></th><th><p>Correct</p></th><th><p>Earned</p></th><th><p>Incorrect</p></th><th><p>Lost</p></th><th><p>Total</p></th>
			<?php 
			
			//check if  logged in 
			if (!$user_ID) {  
			echo "<center><h3><a href='".esc_url( get_permalink( get_page_by_title( 'Profile' ) ))."'>Login</a> First!</h3><center>";
			}
			else
			{
			//if logged in fucntions here
			// get lessons assigned to course
				$args_course = array( 
					'posts_per_page' => -1,
				    'meta_key'         => $current_user->ID,
					'meta_value'	   => 'enrolled',	
					'post_type'        => 'unbook_course',
					'post_status'      => 'publish',


				 );
				$student_courses = get_posts( $args_course );
				foreach ( $student_courses as $course ){
				
				

				$args_lesson = array( 
					'posts_per_page' => -1,
				    'meta_key'         => 'course_assigned_to',
					'meta_value'	   =>  $course->ID,	
					'post_type'        => 'unbook_lesson',
					'post_status'      => 'publish',
					
				 );
				$student_lessons = get_posts( $args_lesson );
				foreach ($student_lessons as $lesson) {
					


				$args_questions = array( 
					'posts_per_page' => -1,
				    'meta_key'         => 'question_assigned_to',
					'meta_value'	   =>  $lesson->ID,	
					'post_type'        => 'unbook_question',
					'post_status'      => 'publish',
					
				 );

				$student_questions = get_posts( $args_questions );
				
				$correct=0;
				$earned=0;
				$incorrect=0;
				$lost=0;

				foreach ($student_questions as $question) {
				

				if($question->question_type =='multiple_choice'){ 

				$answer_key=$question->answer_correct; 
				$student_response=get_post_meta($question->ID,$current_user->ID,true);

				if(!$student_response==0){ 
				if($answer_key==$student_response){
					$correct++;
					$earned=$earned+$question->question_mark; 

				}else{
					$incorrect++;
					$lost=$lost+ number_format(($question->question_mark)/3,2,'.','');
				}

				}

			    }
			    elseif($question->question_type =='subjective'){

			    	$correct='NA';
			    	$incorrect='NA';
			     $earned=$earned + get_user_meta($current_user->ID,$question->ID,true) ;
			    }
		
				

					

					
					//question foreach

				}
				echo '<tr><td><p>'.$lesson->post_title."</p></td>";
				echo"<td><p>".$correct."</p></td>";
				echo"<td><p>".$earned."</p></td>";
				echo"<td><p>".$incorrect."</p></td>";
				echo"<td><p>".$lost."</p></td>";
				$total=$earned-$lost;
				echo"<td><p>".$total."</p></td></tr>";
					//lesson foreach

				}
					// course foreach
				}
				

				}
				





				
			


									
		    ?>

			</table>
		
	

	<div id="chartContainer" style="height: 400px; width: 100%;">
	</div>


	<script src="/app/jquery.canvasjs.min.js"></script>
        <script type="text/javascript">
		window.onload = function () {
			var chart = new CanvasJS.Chart("chartContainer",
			{
				title: {
					text: "Statistics"
				},
			/*	axisY: {
					stripLines: [{
						value: 143650,
						label: "Average",
						showOnTop: true
					}
					]
				}, */

				data: [
				{
					type: "bar",

					dataPoints: [
						{ x: 10, y:  50, label: "Polity" },
						{ x: 20, y: 60, label: "History" },
						{ x: 30, y: 150, label: "Geography" },
						{ x: 40, y: 90, label: "English" },
						{ x: 50, y: 180, label: "Marathi" },
						
					]
				}
				]
			});

			chart.render();
		}
	</script>

			
		</div><!-- #primary -->

		
	</div>

<?php get_footer();