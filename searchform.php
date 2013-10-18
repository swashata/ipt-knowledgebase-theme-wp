<?php
/**
 * The template for displaying search forms in iPanelThemes Knowledgebase
 *
 * @package iPanelThemes Knowledgebase
 */
$stext = esc_attr_x( 'Search Knowledgebase&hellip;', 'placeholder', 'ipt_kb' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<?php // Check to see if category, if yes, then modify the search parameters ?>
	<?php if ( is_category() ) : ?>
	<input type="hidden" name="cat" value="<?php echo esc_attr( get_query_var( 'cat' ) ); ?>" />
	<?php $stext = esc_attr( sprintf( __( 'Search Knowledgebase for %s&hellip;', 'ipt_kb' ), single_cat_title( '', false ) ) ); ?>
	<?php endif; ?>
	<div class="form-group">
		<div class="input-group input-group-lg">
			<input type="search" class="search-field form-control" placeholder="<?php echo $stext; ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
			<span class="input-group-btn"><button type="submit" class="btn btn-default"><span class="ipt-icon-search"></span></button></span>
		</div>
	</div>
</form>
