<?php
/**
 * @package iPanelThemes Knowledgebase
 */
global $ipt_theme_op_settings;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header page-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
<hr>
	<span class="sen-time" style="margin-right:15px;">	<b>Tarih:</b> <?php the_time('d.m.Y') ?> </span> <span class="last-updated-time"> <b>Son güncelleme:</b> <time itemprop="dateModified" content="<?php the_modified_date('d.m.Y'); ?>"><?php the_modified_date('d.m.Y'); ?></time> </span>
		<div class="entry-meta text-muted">
			<hr>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	<?php if ( isset( $ipt_theme_op_settings['ads'] ) && '' != trim( $ipt_theme_op_settings['ads']['below_title'] ) ) : ?>
	<div class="title-advertisement">
		<?php echo trim( $ipt_theme_op_settings['ads']['below_title'] ); ?>
	</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php if ( of_get_option( 'reklam_2' ) ) { ?>
		<div class="reklamnet">
		<?php echo of_get_option( 'reklam_2', '' ); ?>
		</div>
		<?php } ?>
		<?php the_content(); ?>
		<?php if ( of_get_option( 'reklam_1' ) ) { ?>
		<div class="reklamnet">
		<?php echo of_get_option( 'reklam_1', '' ); ?>
		</div>
		<?php } ?>
		<?php
			wp_link_pages( array(
				'before' => __( '<p class="pagination-p">Pages:</p>', 'ipt_kb' ) . '<ul class="pagination">',
				'after'  => '</ul><div class="clearfix"></div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
