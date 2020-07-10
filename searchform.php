<?php
/**
 * The template for displaying search forms in iPanelThemes Knowledgebase
 *
 * @package iPanelThemes Knowledgebase
 */
$stext = esc_attr_x( 'Search Knowledgebase&hellip;', 'placeholder', 'ipt_kb' );
?>
<form role="search" method="get" id="searchformtop" action="<?php echo site_url(); ?>">
	<?php // Check to see if category, if yes, then modify the search parameters ?>
	<?php if ( is_category() ) : ?>
	<input type="hidden" name="cat" value="<?php echo esc_attr( get_query_var( 'cat' ) ); ?>" />
	<?php $stext = esc_attr( sprintf( __( 'Search Knowledgebase for %s&hellip;', 'ipt_kb' ), single_cat_title( '', false ) ) ); ?>
	<?php endif; ?>
	<div class="form-group">
		<div class="input-group input-group-lg">
		<input name="s" id="s" type="text" onKeyUp="suggest(this.value);" class="search-field form-control" onBlur="fill();" style="font-family:Helvetica, FontAwesome" autocomplete="off" placeholder="<?php echo get_theme_mod('genetik_arama_kutusu', 'Arama...') ?>" data-provide="typeahead" data-items="4" data-source=''>
			<span class="input-group-btn"><button type="submit" class="btn btn-default"><span class="ipt-icomoon-search"></span></button></span>
		</div>
		<div class="suggestionsbox" id="suggestions" style="display: none;">
			<img src="<?php echo get_template_directory_uri().'/images/arrow1.png'; ?>" height="18" width="27" class="upArrow" alt="upArrow" />
			<div class="suggestionlist" id="suggestionslist">
			</div>
		</div>
	</div>
</form>
