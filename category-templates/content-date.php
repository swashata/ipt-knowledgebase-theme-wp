<?php
/**
 * @package iPanelThemes Knowledgebase
 */
?>

<a rel="bookmark" class="list-group-item kb-list-date kb-post-list" href="<?php the_permalink(); ?>">
	<span class="badge"><?php echo get_the_date(); ?></span>
	<h3><span class="glyphicon ipt-file-3"></span> <?php the_title(); ?></h3>
	<span class="clearfix"></span>
</a>
