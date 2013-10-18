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
	<span class="badge"><?php echo get_the_date(); ?></span>
	<h3><span class="glyphicon ipt-icon-file"></span> <?php the_title(); ?></h3>
	<span class="clearfix"></span>
</a>
