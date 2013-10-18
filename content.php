<?php
/**
 * @package iPanelThemes Knowledgebase
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'kb-article-excerpt' ); ?>>
	<header class="entry-header page-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta text-muted">
			<?php ipt_kb_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="clearfix"></div>

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="pull-left kb-thumb-medium hidden-xs">
		<a rel="bookmark" href="<?php the_permalink(); ?>" class="thumbnail"><?php the_post_thumbnail( 'ipt_kb_medium', array(
			'class' => 'img-rounded',
		) ); ?></a>
	</div>
	<div class="kb-thumb-large visible-xs">
		<a rel="bookmark" href="<?php the_permalink(); ?>" class="thumbnail"><?php the_post_thumbnail( 'ipt_kb_large', array(
			'class' => 'img',
		) ); ?></a>
	</div>
	<?php endif; ?>

	<div class="entry entry-excerpt">
		<?php the_excerpt(); ?>
	</div>

	<div class="clearfix"></div>
	<footer class="entry-meta">
		<p class="visible-xs">
			<a rel="bookmark" href="<?php the_permalink(); ?>" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-link"></i> <?php _e( 'Read more', 'ipt_kb' ); ?></a>
		</p>
		<p class="pull-right hidden-xs">
			<a rel="bookmark" href="<?php the_permalink(); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-link"></i> <?php _e( 'Read more', 'ipt_kb' ); ?></a>
		</p>
		<p class="text-muted hidden-xs meta-data">
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'ipt_kb' ) );
					if ( $categories_list && ipt_kb_categorized_blog() ) :
				?>
				<span class="cat-links">
					<i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<?php printf( __( 'Posted in %1$s', 'ipt_kb' ), $categories_list ); ?>
				</span>
				<?php endif; // End if categories ?>

				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( ', ', 'ipt_kb' ) );
					if ( $tags_list ) :
				?>
				<span class="tags-links">
					<i class="glyphicon glyphicon-tags"></i> <?php printf( __( 'Tagged %1$s', 'ipt_kb' ), $tags_list ); ?>
				</span>
				<?php endif; // End if $tags_list ?>
			<?php endif; // End if 'post' == get_post_type() ?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link">&nbsp;&nbsp;<i class="glyphicon ipt-icon-bubbles2"></i>&nbsp;<?php comments_popup_link( __( 'Leave a comment', 'ipt_kb' ), __( '1 Comment', 'ipt_kb' ), __( '% Comments', 'ipt_kb' ) ); ?></span>
			<?php endif; ?>
			<?php edit_post_link( __( 'Edit', 'ipt_kb' ), '&nbsp;&nbsp;<i class="glyphicon glyphicon-edit"></i>&nbsp;<span class="edit-link">', '</span>' ); ?>
		</p>
		<div class="clearfix"></div>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
<div class="clearfix"></div>
