<?php
/**
 * comments.php
 *
 * The template for displaying comments.
 */

	// Prevent the direct loading of comments.php.
	if ( ! empty( $_SERVER['SCRIPT-FILENAME'] ) && basename( $_SERVER['SCRIPT-FILENAME'] ) == 'comments.php' ) {
		die( __( 'You cannot access this page directly.', 'juster' ) );
	}

	// If the post is password protected, display info text and return.
	if ( post_password_required() ) : ?>
		<p class="password-alert">
			<?php
				echo __( 'This post is password protected. Enter the password to view the comments.', 'juster' );
				return;
			?>
		</p>
	<?php endif; ?>

<!-- Comments Area -->
<div class="jt-comments comments-area" id="comments">
	<?php if ( have_comments() ) : ?>
		<div class="sep-hover-control">
		<h3 class="comments-title">
			<?php
				printf( _nx( 'One comment', 'comment (%1$s)', get_comments_number(), 'Comment title', 'juster' ), number_format_i18n( get_comments_number() ) );
			?>
			<div class="jt-sep-two"></div>
		</h3>
		</div>

		<ol class="comments">
			<?php wp_list_comments('	type=comments&callback=juster_comment_modification'); ?>
		</ol>

		<?php
			// If the comments are paginated, display the controls.
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="comment-nav">
			<p class="comment-nav-prev">
				<?php previous_comments_link( __( '&larr; Older Comments', 'juster' ) ); ?>
			</p>

			<p class="comment-nav-next">
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'juster' ) ); ?>
			</p>
		</nav> <!-- end comment-nav -->
		<?php endif;

			// If the comments are closed, display an info text.
			if ( ! comments_open() && get_comments_number() ) :
		?>
			<p class="no-comments">
				<?php echo __( 'Comments are closed.', 'juster' ); ?>
			</p>
		<?php endif;
	endif;
	//comment_form();

    /* ==============================================
         Comment Forms
    =============================================== */
    if ( comments_open() ) { ?>
		<div class="jt-comment-form sep-hover-control">
				<?php
				$fields = array(
				    'author' => '
				    	<div class="jt-form-inputs col-sm-6 padding-zero">
			                <input type="text" id="author" name="author" value="' . esc_attr( $commenter['comment_author'] ) . '" tabindex="1" placeholder="' . __( 'Name', 'juster' ) . '"/>',
			        'email' => '
			                <input type="text" id="email" name="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" tabindex="2" placeholder="' . __( 'Email', 'juster' ) . '"/>',
			        'URL' => '
			                <input type="text" id="url" name="url" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" tabindex="3" placeholder="' . __( 'Phone', 'juster' ) . '"/>
			            </div>',
				);
				if ( is_user_logged_in() ) {
				    $defaults = array(
				        'comment_notes_before' => '',
				        'comment_notes_after'  => '',
				        'fields' => apply_filters( 'comment_form_default_fields', $fields),
				        'id_form'              => 'commentform',
				        'id_submit'            => 'submit',
				        'title_reply'          => __( 'Leave a Reply', 'juster' ).'<span class="jt-sep-two"></span>',
				        'title_reply_to'       => __( 'Leave a Reply to %s', 'juster' ),
				        'cancel_reply_link'    => '<i class="fa fa-times-circle"></i>'. '',
				        'label_submit'         => __( 'Submit Comment', 'juster' ),
				        'comment_field' => '
				        	<div class="jt-form-textarea-logedin col-sm-12 padding-zero">
			                    <textarea id="comment" name="comment" tabindex="4" rows="3" cols="30" placeholder="' . __( 'Message', 'juster' ) . '" ></textarea>
							</div>'
				    );
				}
				else {
		            $defaults = array(
		                'comment_notes_before' => '',
		                'comment_notes_after'  => '',
		                'fields' => apply_filters( 'comment_form_default_fields', $fields),
				        'id_form'              => 'commentform',
				        'id_submit'            => 'submit',
				        'title_reply'          => __( 'Leave a Reply', 'juster' ).'<span class="jt-sep-two"></span>',
				        'title_reply_to'       => __( 'Leave a Reply to %s', 'juster' ),
				        'cancel_reply_link'    => '<i class="fa fa-times-circle"></i>'. '',
				        'label_submit'         => __( 'Submit Comment', 'juster' ),
		                'comment_field' => '
		                		<div class="jt-form-textarea col-sm-6 padding-zero">
		                            <textarea id="comment" name="comment" tabindex="1" rows="3" cols="30" placeholder="' . __( 'Message', 'juster' ) . '" ></textarea>
		                        </div>'
		            );
				}

				comment_form($defaults);
				?>
		</div>
	<?php } ?>

</div> <!-- end comments-area --><?php
