<?php
/**
 * Displays a course
 *
 * Available Variables:
 * $course_id       : (int) ID of the course
 * $course      : (object) Post object of the course
 * $course_settings : (array) Settings specific to current course
 *
 * $courses_options : Options/Settings as configured on Course Options page
 * $lessons_options : Options/Settings as configured on Lessons Options page
 * $quizzes_options : Options/Settings as configured on Quiz Options page
 *
 * $user_id         : Current User ID
 * $logged_in       : User is logged in
 * $current_user    : (object) Currently logged in user object
 *
 * $course_status   : Course Status
 * $has_access  : User has access to course or is enrolled.
 * $materials       : Course Materials
 * $has_course_content      : Course has course content
 * $lessons         : Lessons Array
 * $quizzes         : Quizzes Array
 * $lesson_progression_enabled  : (true/false)
 * $has_topics      : (true/false)
 * $lesson_topics   : (array) lessons topics
 *
 * @since 2.1.0
 *
 * @package LearnDash\Course
 */

?>

<?php
/**
 * Display course status
 */
?>
<?php
	$introduction = get_post_meta($post->ID, "introduction", true);
	if ($introduction != "") : ?>
		<span class="lead d-block">
			<?php echo get_post_meta( $post->ID, 'introduction', true ); ?>
		</span>
	<?php
	endif;
?>

<?php if ( $logged_in ) : ?>
	<div class="d-block mt-4">
		<?php 
		$status_class = $course_status;
		$status_class = preg_replace('/\s*/', '', $status_class);
		$status_class = strtolower($status_class);
		?>
		<span id="learndash_course_status" class="status-<?php echo $status_class; ?>">
			<?php echo esc_attr( $course_status ); ?>
		</span>
	</div>

	<?php
		/**
		 * Filter to add custom content after the Course Status section of the Course template output.
		 *
		 * @since 2.3
		 * See https://bitbucket.org/snippets/learndash/7oe9K for example use of this filter.
		 */
		echo apply_filters( 'ld_after_course_status_template_container', '', learndash_course_status_idx( $course_status ), $course_id, $user_id );
	?>

	<?php if ( ! empty( $course_certficate_link ) ) : ?>
		<div id="learndash_course_certificate" class="learndash_course_certificate">
			<a href='<?php echo esc_attr( $course_certficate_link ); ?>' class="btn-blue" target="_blank"><?php echo apply_filters( 'ld_certificate_link_label', esc_html__( 'PRINT YOUR CERTIFICATE', 'learndash' ), $user_id, $post->ID ); ?></a>
		</div>
		<br />
	<?php endif; ?>
<?php endif; ?>

<div class="learndash_content hide-h4 mt-5">
	<?php if ($content != "") : ?>
		<h2><?php _e("About", "integromat"); ?></h2>
		<?php echo $content; ?>
	<?php endif; ?>
</div>

<?php if ( ! $has_access ) : ?>
	<?php 
	/**
	 * Filter to add custom content before the Course Payment Button.
	 *
	 * @since 2.5.8
	 */
	do_action( 'learndash-course-payment-buttons-before', $course_id, $user_id ); 
	?>
	<?php echo learndash_payment_buttons( $post ); ?>
	<?php 
	/**
	 * Filter to add custom content after the Course Payment Button.
	 *
	 * @since 2.5.8
	 */
	do_action( 'learndash-course-payment-buttons-after', $course_id, $user_id ); 
	?>
<?php endif; ?>

<?php if ( $has_course_content ) : ?>
	<?php
		$show_course_content = true;
	if ( ! $has_access ) :
		if ( 'on' === $course_meta['sfwd-courses_course_disable_content_table'] ) :
			$show_course_content = false;
			endif;
		endif;

	if ( $show_course_content ) :
		?>
	<div id="learndash_course_content" class="learndash_course_content">
		<h2 id="learndash_course_content_title">
			<?php
			// translators: Course Content Label.
			printf( esc_html_x( 'Curriculum', 'Course Content Label', 'learndash' ), LearnDash_Custom_Label::get_label( 'course' ) );
			?>
		</h2>

		<?php
		/**
		 * Display lesson list
		 */
		?>
		<?php if ( ! empty( $lessons ) ) : ?>
			<?php if ( $has_topics ) : ?>
				<!-- this needs an improve if it will be ever in use -->
				<div class="expand_collapse">
					<a href="#" onClick='jQuery("#learndash_post_<?php echo $course_id; ?> .learndash_topic_dots").slideDown(); return false;'><?php esc_html_e( 'Expand All', 'learndash' ); ?></a> | <a href="#" onClick='jQuery("#learndash_post_<?php echo esc_attr( $course_id ); ?> .learndash_topic_dots").slideUp(); return false;'><?php esc_html_e( 'Collapse All', 'learndash' ); ?></a>
				</div>
				<?php if ( apply_filters( 'learndash_course_steps_expand_all', false, $course_id, 'course_lessons_listing_main' ) ) { ?>
					<script>
						jQuery(document).ready(function(){
							jQuery("#learndash_post_<?php echo $course_id; ?> .learndash_topic_dots").slideDown();
						});
					</script>	
				<?php } ?>
				<!-- make it pretty -->
			<?php endif; ?>

			<div id="learndash_lessons" class="learndash_lessons">

				<div id="list_lessons" class="list_lessons">

					<?php foreach ( $lessons as $lesson ) : ?>
						<div class='post-<?php echo esc_attr( $lesson['post']->ID ); ?> <?php echo esc_attr( $lesson['sample'] ); ?>'>

							<div class="count_list">
								<?php echo $lesson['sno']; ?>
							</div>

							<div class="status-square square-<?php echo esc_attr($lesson['status']); ?>"></div>

							<h3>
								<a class='<?php echo esc_attr( $lesson['status'] ); ?>' href='<?php echo esc_attr( learndash_get_step_permalink( $lesson['post']->ID, $course_id ) ); ?>'>
									<span class="lesson-sub d-block text-grey">
										<?php _e("Lesson", "integromat"); ?>
									</span>
									<?php echo $lesson['post']->post_title; ?>
								</a>

								<?php
								/**
								 * Not available message for drip feeding lessons
								 */
								?>
								<?php if ( ! empty( $lesson['lesson_access_from'] ) ) : ?>
									<?php
										SFWD_LMS::get_template(
											'learndash_course_lesson_not_available',
											array(
												'user_id' => $user_id,
												'course_id' => learndash_get_course_id( $lesson['post']->ID ),
												'lesson_id' => $lesson['post']->ID,
												'lesson_access_from_int' => $lesson['lesson_access_from'],
												'lesson_access_from_date' => learndash_adjust_date_time_display( $lesson['lesson_access_from'] ),
												'context' => 'course',
											), true
										);
									?>
								<?php endif; ?>


								<?php
								/**
								 * Lesson Topics
								 */
								?>
								<?php $topics = @$lesson_topics[ $lesson['post']->ID ]; ?>

								<?php if ( ! empty( $topics ) ) : ?>
									<div id='learndash_topic_dots-<?php echo esc_attr( $lesson['post']->ID ); ?>' class="learndash_topic_dots type-list">
										<ul>
											<?php $odd_class = ''; ?>
											<?php foreach ( $topics as $key => $topic ) : ?>
												<?php $odd_class       = empty( $odd_class ) ? 'nth-of-type-odd' : ''; ?>
												<?php $completed_class = empty( $topic->completed ) ? 'topic-notcompleted' : 'topic-completed'; ?>												
												<li class='<?php echo esc_attr( $odd_class ); ?>'>
													<span class="topic_item">
														<a class='<?php echo esc_attr( $completed_class ); ?>' href='<?php echo esc_attr( learndash_get_step_permalink( $topic->ID, $course_id ) ); ?>' title='<?php echo esc_attr( $topic->post_title ); ?>'>
															<span><?php echo $topic->post_title; ?></span>
														</a>
													</span>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								<?php endif; ?>

							</h3>
						</div>
					<?php endforeach; ?>

				</div>
			</div>
			<?php
				global $course_lessons_results;
				if ( isset( $course_lessons_results['pager'] ) ) {
					echo SFWD_LMS::get_template( 
						'learndash_pager.php', 
						array(
						'pager_results' => $course_lessons_results['pager'], 
						'pager_context' => 'course_lessons'
						) 
					);
				}
			?>
		<?php endif; ?>
		
		<?php
			if ( ( isset( $course_lessons_results['pager'] ) ) && ( !empty( $course_lessons_results['pager'] ) ) ) {
				if ( $course_lessons_results['pager']['paged'] == $course_lessons_results['pager']['total_pages'] ) {
					$show_course_quizzes = true;
				} else {
					$show_course_quizzes = false;
				}
			} else {
				$show_course_quizzes = true;
			}
		?>
		<?php
		/**
		 * Display quiz list
		 */
		?>
		<?php 
			if ( $show_course_quizzes == true ) {
				if ( ! empty( $quizzes ) ) { ?>
					<div id="learndash_quizzes" class="learndash_quizzes">
						<div id="quiz_heading">
								<span><?php echo LearnDash_Custom_Label::get_label( 'quizzes' ); ?></span><span class="right"><?php esc_html_e( 'Status', 'learndash' ); ?></span>
						</div>
						<div id="quiz_list" class=“quiz_list”>

							<?php foreach ( $quizzes as $quiz ) : ?>
								<div id='post-<?php echo esc_attr( $quiz['post']->ID ); ?>' class='<?php echo esc_attr( $quiz['sample'] ); ?>'>
									<div class="list-count"><?php echo $quiz['sno']; ?></div>
									<h4>
										<a class='<?php echo esc_attr( $quiz['status'] ); ?>' href='<?php echo esc_attr( learndash_get_step_permalink( $quiz['post']->ID, $course_id ) ); ?>'><?php echo $quiz['post']->post_title; ?></a>
									</h4>
								</div>						
							<?php endforeach; ?>

						</div>
					</div>
				<?php }
			} 
		?>
	</div>
	<?php endif; ?>
<?php endif; ?>
<?php if ( ( isset( $materials ) ) && ( ! empty( $materials ) ) ) : ?>
	<div id="learndash_course_materials" class="learndash_course_materials">
		<h4>
		<?php
			// translators: Course Materials Label.
			printf( esc_html_x( '%s Materials', 'Course Materials Label', 'learndash' ), LearnDash_Custom_Label::get_label( 'course' ) );
		?>
		</h4>
		<p><?php echo $materials; ?></p>
	</div>
<?php endif; ?>