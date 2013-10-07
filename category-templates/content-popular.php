<?php
/**
 * @package iPanelThemes Knowledgebase
 */
?>

<a rel="bookmark" class="list-group-item kb-list-date kb-post-list" href="<?php the_permalink(); ?>">
	<?php if ( has_post_thumbnail() ) : ?>
	<span class="pull-left kb-thumb-small">
		<?php the_post_thumbnail( 'ipt_kb_small', array(
			'class' => 'img-circle',
		) ); ?>
	</span>
	<?php endif; ?>
	<span class="badge"><?php echo get_post_meta( $post->ID, 'ipt_kb_like_article', true ); ?></span>
	<h3><?php the_title(); ?></h3>
	<span class="clearfix"></span>
</a>
