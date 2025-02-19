<?php

get_header();

$show_default_title = get_post_meta(get_the_ID(), '_et_pb_show_title', true);

// $is_page_builder_used = et_pb_is_pagebuilder_used(get_the_ID());
$is_page_builder_used = false;

?>

<div id="main-content">
	<?php
	if (false) :
		// load fullwidth page in Product Tour mode
		while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('et_pb_post'); ?>>
				<div class="entry-content">
					<?php
					the_content();
					?>

					<h3>Lessons </h3>
					<?php
					// Start the loop.
					$args = array(
						'posts_per_page'   => -1,
						'post_type'        => 'tl_lesson',
						'meta_query' => array(
							array(
								'key'   => 'tl_course_id',
								'value' =>  $post->ID
							)
						)
					);
					$result = get_posts($args);
					echo "<ul>";
					foreach ($result as $result) {
						echo '<li>';
						echo '<a href="' . get_permalink($result->ID) . '" target="blank">' . $result->post_title . '</a>';
						echo '</li>';
					}
					echo "</ul>";
					?>

				</div>

			</article>

		<?php endwhile;
	else :
		?>
		<div class="container">
			<div id="content-area" class="clearfix">
				<div id="left-area">
					<?php while (have_posts()) : the_post(); ?>
						<?php
						/**
						 * Fires before the title and post meta on single posts.
						 *
						 * @since 3.18.8
						 */
						do_action('et_before_post');
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('et_pb_post'); ?>>
							<?php if (('off' !== $show_default_title && $is_page_builder_used) || !$is_page_builder_used) { ?>
								<div class="et_post_meta_wrapper">
									<h1 class="entry-title"><?php the_title(); ?></h1>

									<?php
									if (!post_password_required()) :

										// et_divi_post_meta();

										/* $thumb = '';

										$width = (int) apply_filters('et_pb_index_blog_image_width', 1080);

										$height = (int) apply_filters('et_pb_index_blog_image_height', 675);
										$classtext = 'et_featured_image';
										$titletext = get_the_title();
										$alttext = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
										$thumbnail = ''; //get_thumbnail($width, $height, $classtext, $alttext, $titletext, false, 'Blogimage');
										$thumb = $thumbnail["thumb"];

										$post_format = false; // et_pb_post_format();

										if ('video' === $post_format && false !== ($first_video = false)) {
											printf(
												'<div class="et_main_video_container">
											%1$s
										</div>',
												et_core_esc_previously($first_video)
											);
										} else if (!in_array($post_format, array('gallery', 'link', 'quote')) && 'on' === et_get_option('divi_thumbnails', 'on') && '' !== $thumb) {
											print_thumbnail($thumb, $thumbnail["use_timthumb"], $alttext, $width, $height);
										} else if ('gallery' === $post_format) {
											et_pb_gallery_images();
										} */
									?>

									<?php
										/* $text_color_class = et_divi_get_post_text_color();

										$inline_style = et_divi_get_post_bg_inline_style();

										switch ($post_format) {
											case 'audio':
												$audio_player = et_pb_get_audio_player();

												if ($audio_player) {
													printf(
														'<div class="et_audio_content%1$s"%2$s>
													%3$s
												</div>',
														esc_attr($text_color_class),
														et_core_esc_previously($inline_style),
														et_core_esc_previously($audio_player)
													);
												}

												break;
											case 'quote':
												printf(
													'<div class="et_quote_content%2$s"%3$s>
												%1$s
											</div>',
													et_core_esc_previously(et_get_blockquote_in_content()),
													esc_attr($text_color_class),
													et_core_esc_previously($inline_style)
												);

												break;
											case 'link':
												printf(
													'<div class="et_link_content%3$s"%4$s>
												<a href="%1$s" class="et_link_main_url">%2$s</a>
											</div>',
													esc_url(et_get_link_url()),
													esc_html(et_get_link_url()),
													esc_attr($text_color_class),
													et_core_esc_previously($inline_style)
												);

												break;
										} */

									endif;
									?>
								</div>
							<?php  } ?>

							<div class="entry-content">
								<?php
								do_action('et_before_content');

								the_content();

								wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'Divi'), 'after' => '</div>'));
								?>
								<br>
								<br>
								
								<?php
								
								$lxp_sections = get_post_meta(get_the_ID(), "lxp_sections", true);
								$lxp_sections = $lxp_sections ? json_decode($lxp_sections) : [];
								
								foreach ($lxp_sections as $lxp_section) {
									$lesson_query = new WP_Query( array(
										'posts_per_page'   => -1,
										'orderby' => 'ID',
										'order'   => 'ASC',
										'post_type' => TL_LESSON_CPT,
										'meta_query' => [
												['key' => 'lti_content_title', 'value' => $lxp_section]
											]
									) );
								?>
									<h4><?php echo $lxp_section; ?></h4>
									<hr></hr>
									<?php
										if (($lesson_query->have_posts())) {
											echo "<ul>";
											while ($lesson_query->have_posts()) {
												$lesson_query->the_post();
									?>
										<li><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo get_the_title(); ?></a></li>
										
									<?php
									
										}
										echo "</ul>";
									}
								}
								
								?>
							</div>
							<div class="et_post_meta_wrapper">
								<?php
								/* if (et_get_option('divi_468_enable') === 'on') {
									echo '<div class="et-single-post-ad">';
									if (et_get_option('divi_468_adsense') !== '') echo et_core_intentionally_unescaped(et_core_fix_unclosed_html_tags(et_get_option('divi_468_adsense')), 'html');
									else {  */?>
										<!-- <a href="<?php // echo esc_url(strval(et_get_option('divi_468_url'))); ?>"><img src="<?php //echo esc_attr(et_get_option('divi_468_image')); ?>" alt="468" class="foursixeight" /></a> -->
								<?php /*	}
								 	echo '</div>';
								} */

								/**
								 * Fires after the post content on single posts.
								 *
								 * @since 3.18.8
								 */
								do_action('et_after_post');

								if ((comments_open() || get_comments_number()) && 'on' === et_get_option('divi_show_postcomments', 'on')) {
									comments_template('', true);
								}
								?>
							</div>
						</article>
						<div>
							<?php
							$tags = get_the_terms($post->ID, 'tl_course_tag');
							if ( $tags ) {
								foreach ( $tags as $tag ) {
									$tag_link = get_tag_link( $tag->term_id );
									$html = "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>{$tag->name}</a>";
									$tag_names[] =$html;
								}
								echo  "<span class='dashicons dashicons-tag'></span>&nbsp&nbsp". implode( ', ', $tag_names );
							}
							?>
						</div>
					<?php endwhile; ?>
				</div>

				<?php get_sidebar(); ?>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php

get_footer();
