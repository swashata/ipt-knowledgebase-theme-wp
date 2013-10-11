<?php
/**
 * @package iPanelThemes Knowledgebase
 */
?>

<a rel="bookmark" class="list-group-item kb-list-date kb-post-list" href="<?php the_permalink(); ?>">
	<?php
	// We would not want to show the date if the post order plugin is active
	// As the order would not be just according to the date
	// The plugin is most likely override it.
	?>
	<?php if ( ! function_exists( 'CPTOrderPosts' ) ) : ?>
	<span class="badge"><?php echo get_the_date(); ?></span>
	<?php endif; ?>
	<h3><span class="glyphicon ipt-file-3"></span> <?php the_title(); ?></h3>
	<span class="clearfix"></span>
</a>
