<?php
/**
 * @package iPanelThemes Knowledgebase
 */
?>

<a rel="bookmark" class="list-group-item kb-list-date kb-post-list" href="<?php the_permalink(); ?>">
	<span class="badge"><?php echo get_post_meta( $post->ID, 'ipt_kb_like_article', true ); ?></span>
	<h3><span class="glyphicon ipt-icon-file"></span>  <?php the_title(); ?></h3>
	<span class="clearfix"></span>
</a>
