<?php
/**
 * The template for displaying image attachments
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package DevPack
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php
							$published_text = __( '<span class="attachment-meta">Published on <time class="entry-date" datetime="%1$s">%2$s</time> in <a href="%3$s" title="Return to %4$s" rel="gallery">%5$s</a></span>', 'devpack' );
							$post_title = get_the_title( $post->post_parent );
							if ( empty( $post_title ) || 0 == $post->post_parent )
								$published_text = '<span class="attachment-meta"><time class="entry-date" datetime="%1$s">%2$s</time></span>';

							printf( $published_text,
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								esc_url( get_permalink( $post->post_parent ) ),
								esc_attr( strip_tags( $post_title ) ),
								$post_title
							);

							$metadata = wp_get_attachment_metadata();
							printf( '<span class="attachment-meta full-size-link"><a href="%1$s" title="%2$s">%3$s (%4$s &times; %5$s)</a></span>',
								esc_url( wp_get_attachment_url() ),
								esc_attr__( 'Link to full-size image', 'devpack' ),
								__( 'Full resolution', 'devpack' ),
								$metadata['width'],
								$metadata['height']
							);

							edit_post_link( __( 'Edit', 'devpack' ), '<span class="edit-link">', '</span>' );
						?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->

				<div class="entry-content">
					<nav id="image-navigation" class="navigation image-navigation" role="navigation">
						<span class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'devpack' ) ); ?></span>
						<span class="nav-next"><?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'devpack' ) ); ?></span>
					</nav><!-- #image-navigation -->

					<div class="entry-attachment">
						<div class="attachment">
							<?php devpack_the_attached_image(); ?>

							<?php if ( has_excerpt() ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div>
							<?php endif; ?>
						</div><!-- .attachment -->
					</div><!-- .entry-attachment -->

					<?php if ( ! empty( $post->post_content ) ) : ?>
					<div class="entry-description">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'devpack' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-description -->
					<?php endif; ?>

				</div><!-- .entry-content -->
			</article><!-- #post -->

			<?php comments_template(); ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>