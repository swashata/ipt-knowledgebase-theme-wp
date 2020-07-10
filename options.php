<?php
function optionsframework_option_name() {
	return 'options-framework-theme';
}

function optionsframework_options() {

	// Test data
	$test_array = array(
		'acik' => __( 'acik', 'theme-textdomain' ),
		'kapali' => __( 'kapali', 'theme-textdomain' )
	);

	$test_array_defaults = array(
		'acik' => '1',
		'kapali' => '0'
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __( 'French Toast', 'theme-textdomain' ),
		'two' => __( 'Pancake', 'theme-textdomain' ),
		'three' => __( 'Omelette', 'theme-textdomain' ),
		'four' => __( 'Crepe', 'theme-textdomain' ),
		'five' => __( 'Waffle', 'theme-textdomain' )
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __( 'Canvas menü', 'theme-textdomain' ),
		'type' => 'heading'
	);


	$options[] = array(
		'name' => __( 'Link 1', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 1.link (url)', 'theme-textdomain' ),
		'id' => 'link_1',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Başlık 1', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 1.link için Başlık', 'theme-textdomain' ),
		'id' => 'desc_1',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Link 2', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 2.link (url)', 'theme-textdomain' ),
		'id' => 'link_2',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Başlık 2', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 2.link için Başlık', 'theme-textdomain' ),
		'id' => 'desc_2',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Link 3', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 3.link (url)', 'theme-textdomain' ),
		'id' => 'link_3',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Başlık 3', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 3.link için Başlık', 'theme-textdomain' ),
		'id' => 'desc_3',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Link 4', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 4.link (url)', 'theme-textdomain' ),
		'id' => 'link_4',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Başlık 4', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 4.link için Başlık', 'theme-textdomain' ),
		'id' => 'desc_4',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Link 5', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 5.link (url)', 'theme-textdomain' ),
		'id' => 'link_5',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Başlık 5', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 5.link için Başlık', 'theme-textdomain' ),
		'id' => 'desc_5',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Link 6', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 6.link (url)', 'theme-textdomain' ),
		'id' => 'link_6',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Başlık 6', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 6.link için Başlık', 'theme-textdomain' ),
		'id' => 'desc_6',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Link 7', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 7.link (url)', 'theme-textdomain' ),
		'id' => 'link_7',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Başlık 7', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 7.link için Başlık', 'theme-textdomain' ),
		'id' => 'desc_7',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Link 8', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 8.link (url)', 'theme-textdomain' ),
		'id' => 'link_8',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Başlık 8', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü 8.link için Başlık', 'theme-textdomain' ),
		'id' => 'desc_8',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Metin ya da kod alanı', 'theme-textdomain' ),
		'desc' => __( 'Canvas menü için metin ya da kod alanı en altta görünür(linklerin altında). Html veya dikey reklam kullanabilirsiniz.', 'theme-textdomain' ),
		'id' => 'detay_1',
		'std' => '',
		'type' => 'textarea'
	);


	$options[] = array(
		'name' => __( 'Reklam kodları', 'theme-textdomain' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Reklam kategori yanı', 'theme-textdomain' ),
		'desc' => __( 'Reklam kategori yanı kodu html, javascript desteklidir. <b>Önerilen boyutlar</b> 250 x 250 - 336 x 280  -  300 x 250', 'theme-textdomain' ),
		'id' => 'reklam_yeni',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Alt kısım copyright altı reklam alanı', 'theme-textdomain' ),
		'desc' => __( 'Alt kısım copyright altı reklam alanı html, javascript desteklidir. <b>Önerilen boyutlar</b> 728 x 90 - 970 x 90 - 970 x 250</div>', 'theme-textdomain' ),
		'id' => 'reklam_alt',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Reklam Yazı Altı', 'theme-textdomain' ),
		'desc' => __( 'Yazı altına reklam kodu html, javascript desteklidir.  <b>Önerilen boyutlar</b> 468 x 60 </div>', 'theme-textdomain' ),
		'id' => 'reklam_1',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Reklam Yazı Üstü', 'theme-textdomain' ),
		'desc' => __( 'Yazı üstüne reklam kodu html, javascript desteklidir.  <b>Önerilen boyutlar</b> 468 x 60 </div>', 'theme-textdomain' ),
		'id' => 'reklam_2',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Anasayfa arama kutusu altı reklam alanı', 'theme-textdomain' ),
		'desc' => __( 'Anasayfa arama kutusu altı reklam kodunuzu giriniz html, javascript desteklidir. <b>Önerilen boyutlar</b> 728 x 90 - 970 x 90 - 970 x 250</div>', 'theme-textdomain' ),
		'id' => 'reklam_3',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Anasayfa son yazılar üstü alanı', 'theme-textdomain' ),
		'desc' => __( 'Anasayfa son yazılar üstü kodunuzu giriniz html, javascript desteklidir. <b>Önerilen boyutlar</b> 728 x 90 - 970 x 90 - 970 x 250</div>', 'theme-textdomain' ),
		'id' => 'reklam_4',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Anasayfa son yazılar altı alanı', 'theme-textdomain' ),
		'desc' => __( 'Anasayfa son yazılar altı kodunuzu giriniz html, javascript desteklidir. <b>Önerilen boyutlar</b> 728 x 90 - 970 x 90 - 970 x 250</div>', 'theme-textdomain' ),
		'id' => 'reklam_5',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Kategori üst reklam alanı', 'theme-textdomain' ),
		'desc' => __( 'Kategori üst reklam alanı kodunuzu giriniz html, javascript desteklidir. <b>Önerilen boyutlar</b> 468 x 60 </div>', 'theme-textdomain' ),
		'id' => 'reklam_6',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Kategori alt reklam alanı', 'theme-textdomain' ),
		'desc' => __( 'Kategori alt reklam alanı kodunuzu giriniz html, javascript desteklidir. <b>Önerilen boyutlar</b> 468 x 60 </div>', 'theme-textdomain' ),
		'id' => 'reklam_7',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Yan menü üstü reklam alanı', 'theme-textdomain' ),
		'desc' => __( 'Yan menü üstü reklam alanı kodunuzu giriniz html, javascript desteklidir. <b>Önerilen boyutlar</b> 250 x 250 - 336 x 280  -  300 x 250 ', 'theme-textdomain' ),
		'id' => 'reklam_8',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Yan menü altı reklam alanı', 'theme-textdomain' ),
		'desc' => __( 'Yan menü altı reklam alanı kodunuzu giriniz html, javascript desteklidir. <b>Önerilen boyutlar</b> 250 x 250 - 336 x 280  -  300 x 250', 'theme-textdomain' ),
		'id' => 'reklam_9',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Son yazılar altı reklam alanı', 'theme-textdomain' ),
		'desc' => __( 'Son yazılar altı reklam alanı kodunuzu giriniz html, javascript desteklidir. <b>Önerilen boyutlar</b> 250 x 250 - 336 x 280  -  300 x 250 ', 'theme-textdomain' ),
		'id' => 'reklam_10',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Popüler yazılar altı reklam alanı', 'theme-textdomain' ),
		'desc' => __( 'Popüler yazılar altı reklam alanı kodunuzu giriniz html, javascript desteklidir. <b>Önerilen boyutlar</b> 250 x 250 - 336 x 280  -  300 x 250', 'theme-textdomain' ),
		'id' => 'reklam_11',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Gazeteler', 'theme-textdomain' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Gazeteler sponsor', 'theme-textdomain' ),
		'desc' => __( 'Gazeteler sponsor', 'theme-textdomain' ),
		'id' => 'gazetesponsor_1',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
	  'name' => __( 'Link 1', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 1.link (url)', 'theme-textdomain' ),
	  'id' => 'gazete_1',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 1', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 1.link için Başlık', 'theme-textdomain' ),
	  'id' => 'gazete_aciklama_1',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 2', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 2.link (url)', 'theme-textdomain' ),
	  'id' => 'gazete_2',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 2', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 2.link için Başlık', 'theme-textdomain' ),
	  'id' => 'gazete_aciklama_2',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 3', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 3.link (url)', 'theme-textdomain' ),
	  'id' => 'gazete_3',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 3', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 3.link için Başlık', 'theme-textdomain' ),
	  'id' => 'gazete_aciklama_3',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 4', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 4.link (url)', 'theme-textdomain' ),
	  'id' => 'gazete_4',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 4', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 4.link için Başlık', 'theme-textdomain' ),
	  'id' => 'gazete_aciklama_4',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 5', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 5.link (url)', 'theme-textdomain' ),
	  'id' => 'gazete_5',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 5', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 5.link için Başlık', 'theme-textdomain' ),
	  'id' => 'gazete_aciklama_5',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 6', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 6.link (url)', 'theme-textdomain' ),
	  'id' => 'gazete_6',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 6', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 6.link için Başlık', 'theme-textdomain' ),
	  'id' => 'gazete_aciklama_6',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 7', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 7.link (url)', 'theme-textdomain' ),
	  'id' => 'gazete_7',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 7', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 7.link için Başlık', 'theme-textdomain' ),
	  'id' => 'gazete_aciklama_7',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 8', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 8.link (url)', 'theme-textdomain' ),
	  'id' => 'gazete_8',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 8', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 8.link için Başlık', 'theme-textdomain' ),
	  'id' => 'gazete_aciklama_8',
	  'std' => '',
	  'type' => 'text'
	);



	$options[] = array(
	  'name' => __( 'Link 9', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 9.link (url)', 'theme-textdomain' ),
	  'id' => 'gazete_9',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 9', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 9.link için Başlık', 'theme-textdomain' ),
	  'id' => 'gazete_aciklama_9',
	  'std' => '',
	  'type' => 'text'
	);



	$options[] = array(
	  'name' => __( 'Link 10', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 10.link (url)', 'theme-textdomain' ),
	  'id' => 'gazete_10',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 10', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 10.link için Başlık', 'theme-textdomain' ),
	  'id' => 'gazete_aciklama_10',
	  'std' => '',
	  'type' => 'text'
	);


	$options[] = array(
	  'name' => __( 'Link 11', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 11.link (url)', 'theme-textdomain' ),
	  'id' => 'gazete_11',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 11', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 11.link için Başlık', 'theme-textdomain' ),
	  'id' => 'gazete_aciklama_11',
	  'std' => '',
	  'type' => 'text'
	);


	$options[] = array(
	  'name' => __( 'Link 12', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 12.link (url)', 'theme-textdomain' ),
	  'id' => 'gazete_12',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 12', 'theme-textdomain' ),
	  'desc' => __( 'Gazete 12.link için Başlık', 'theme-textdomain' ),
	  'id' => 'gazete_aciklama_12',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Yerel Gazeteler', 'theme-textdomain' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Yerel Gazeteler sponsor', 'theme-textdomain' ),
		'desc' => __( 'Yerel Gazeteler sponsor', 'theme-textdomain' ),
		'id' => 'ygazetesponsor_1',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
	  'name' => __( 'Link 1', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 1.link (url)', 'theme-textdomain' ),
	  'id' => 'ygazete_1',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 1', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 1.link için Başlık', 'theme-textdomain' ),
	  'id' => 'ygazete_aciklama_1',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 2', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 2.link (url)', 'theme-textdomain' ),
	  'id' => 'ygazete_2',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 2', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 2.link için Başlık', 'theme-textdomain' ),
	  'id' => 'ygazete_aciklama_2',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 3', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 3.link (url)', 'theme-textdomain' ),
	  'id' => 'ygazete_3',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 3', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 3.link için Başlık', 'theme-textdomain' ),
	  'id' => 'ygazete_aciklama_3',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 4', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 4.link (url)', 'theme-textdomain' ),
	  'id' => 'ygazete_4',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 4', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 4.link için Başlık', 'theme-textdomain' ),
	  'id' => 'ygazete_aciklama_4',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 5', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 5.link (url)', 'theme-textdomain' ),
	  'id' => 'ygazete_5',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 5', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 5.link için Başlık', 'theme-textdomain' ),
	  'id' => 'ygazete_aciklama_5',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 6', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 6.link (url)', 'theme-textdomain' ),
	  'id' => 'ygazete_6',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 6', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 6.link için Başlık', 'theme-textdomain' ),
	  'id' => 'ygazete_aciklama_6',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 7', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 7.link (url)', 'theme-textdomain' ),
	  'id' => 'ygazete_7',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 7', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 7.link için Başlık', 'theme-textdomain' ),
	  'id' => 'ygazete_aciklama_7',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 8', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 8.link (url)', 'theme-textdomain' ),
	  'id' => 'ygazete_8',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 8', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 8.link için Başlık', 'theme-textdomain' ),
	  'id' => 'ygazete_aciklama_8',
	  'std' => '',
	  'type' => 'text'
	);



	$options[] = array(
	  'name' => __( 'Link 9', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 9.link (url)', 'theme-textdomain' ),
	  'id' => 'ygazete_9',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 9', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 9.link için Başlık', 'theme-textdomain' ),
	  'id' => 'ygazete_aciklama_9',
	  'std' => '',
	  'type' => 'text'
	);



	$options[] = array(
	  'name' => __( 'Link 10', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 10.link (url)', 'theme-textdomain' ),
	  'id' => 'ygazete_10',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 10', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 10.link için Başlık', 'theme-textdomain' ),
	  'id' => 'ygazete_aciklama_10',
	  'std' => '',
	  'type' => 'text'
	);


	$options[] = array(
	  'name' => __( 'Link 11', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 11.link (url)', 'theme-textdomain' ),
	  'id' => 'ygazete_11',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 11', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 11.link için Başlık', 'theme-textdomain' ),
	  'id' => 'ygazete_aciklama_11',
	  'std' => '',
	  'type' => 'text'
	);


	$options[] = array(
	  'name' => __( 'Link 12', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 12.link (url)', 'theme-textdomain' ),
	  'id' => 'ygazete_12',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 12', 'theme-textdomain' ),
	  'desc' => __( 'Yerel Gazete 12.link için Başlık', 'theme-textdomain' ),
	  'id' => 'ygazete_aciklama_12',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Televizyon', 'theme-textdomain' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Televizyon sponsor', 'theme-textdomain' ),
		'desc' => __( 'Televizyon sponsor', 'theme-textdomain' ),
		'id' => 'televizyonsponsor_1',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
	  'name' => __( 'Link 1', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 1.link (url)', 'theme-textdomain' ),
	  'id' => 'televizyon_1',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 1', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 1.link için Başlık', 'theme-textdomain' ),
	  'id' => 'televizyon_aciklama_1',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 2', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 2.link (url)', 'theme-textdomain' ),
	  'id' => 'televizyon_2',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 2', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 2.link için Başlık', 'theme-textdomain' ),
	  'id' => 'televizyon_aciklama_2',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 3', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 3.link (url)', 'theme-textdomain' ),
	  'id' => 'televizyon_3',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 3', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 3.link için Başlık', 'theme-textdomain' ),
	  'id' => 'televizyon_aciklama_3',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 4', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 4.link (url)', 'theme-textdomain' ),
	  'id' => 'televizyon_4',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 4', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 4.link için Başlık', 'theme-textdomain' ),
	  'id' => 'televizyon_aciklama_4',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 5', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 5.link (url)', 'theme-textdomain' ),
	  'id' => 'televizyon_5',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 5', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 5.link için Başlık', 'theme-textdomain' ),
	  'id' => 'televizyon_aciklama_5',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 6', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 6.link (url)', 'theme-textdomain' ),
	  'id' => 'televizyon_6',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 6', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 6.link için Başlık', 'theme-textdomain' ),
	  'id' => 'televizyon_aciklama_6',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 7', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 7.link (url)', 'theme-textdomain' ),
	  'id' => 'televizyon_7',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 7', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 7.link için Başlık', 'theme-textdomain' ),
	  'id' => 'televizyon_aciklama_7',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Link 8', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 8.link (url)', 'theme-textdomain' ),
	  'id' => 'televizyon_8',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 8', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 8.link için Başlık', 'theme-textdomain' ),
	  'id' => 'televizyon_aciklama_8',
	  'std' => '',
	  'type' => 'text'
	);



	$options[] = array(
	  'name' => __( 'Link 9', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 9.link (url)', 'theme-textdomain' ),
	  'id' => 'televizyon_9',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 9', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 9.link için Başlık', 'theme-textdomain' ),
	  'id' => 'televizyon_aciklama_9',
	  'std' => '',
	  'type' => 'text'
	);



	$options[] = array(
	  'name' => __( 'Link 10', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 10.link (url)', 'theme-textdomain' ),
	  'id' => 'televizyon_10',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 10', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 10.link için Başlık', 'theme-textdomain' ),
	  'id' => 'televizyon_aciklama_10',
	  'std' => '',
	  'type' => 'text'
	);


	$options[] = array(
	  'name' => __( 'Link 11', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 11.link (url)', 'theme-textdomain' ),
	  'id' => 'televizyon_11',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 11', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 11.link için Başlık', 'theme-textdomain' ),
	  'id' => 'televizyon_aciklama_11',
	  'std' => '',
	  'type' => 'text'
	);


	$options[] = array(
	  'name' => __( 'Link 12', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 12.link (url)', 'theme-textdomain' ),
	  'id' => 'televizyon_12',
	  'std' => '',
	  'type' => 'text'
	);

	$options[] = array(
	  'name' => __( 'Başlık 12', 'theme-textdomain' ),
	  'desc' => __( 'Televizyon 12.link için Başlık', 'theme-textdomain' ),
	  'id' => 'televizyon_aciklama_12',
	  'std' => '',
	  'type' => 'text'
	);


		$options[] = array(
			'name' => __( 'Dergiler', 'theme-textdomain' ),
			'type' => 'heading'
		);

		$options[] = array(
			'name' => __( 'Dergiler sponsor', 'theme-textdomain' ),
			'desc' => __( 'Dergiler sponsor', 'theme-textdomain' ),
			'id' => 'dergisponsor_1',
			'std' => '',
			'type' => 'textarea'
		);

		$options[] = array(
		  'name' => __( 'Link 1', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 1.link (url)', 'theme-textdomain' ),
		  'id' => 'dergiler_1',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Başlık 1', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 1.link için Başlık', 'theme-textdomain' ),
		  'id' => 'dergiler_aciklama_1',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Link 2', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 2.link (url)', 'theme-textdomain' ),
		  'id' => 'dergiler_2',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Başlık 2', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 2.link için Başlık', 'theme-textdomain' ),
		  'id' => 'dergiler_aciklama_2',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Link 3', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 3.link (url)', 'theme-textdomain' ),
		  'id' => 'dergiler_3',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Başlık 3', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 3.link için Başlık', 'theme-textdomain' ),
		  'id' => 'dergiler_aciklama_3',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Link 4', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 4.link (url)', 'theme-textdomain' ),
		  'id' => 'dergiler_4',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Başlık 4', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 4.link için Başlık', 'theme-textdomain' ),
		  'id' => 'dergiler_aciklama_4',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Link 5', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 5.link (url)', 'theme-textdomain' ),
		  'id' => 'dergiler_5',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Başlık 5', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 5.link için Başlık', 'theme-textdomain' ),
		  'id' => 'dergiler_aciklama_5',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Link 6', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 6.link (url)', 'theme-textdomain' ),
		  'id' => 'dergiler_6',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Başlık 6', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 6.link için Başlık', 'theme-textdomain' ),
		  'id' => 'dergiler_aciklama_6',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Link 7', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 7.link (url)', 'theme-textdomain' ),
		  'id' => 'dergiler_7',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Başlık 7', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 7.link için Başlık', 'theme-textdomain' ),
		  'id' => 'dergiler_aciklama_7',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Link 8', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 8.link (url)', 'theme-textdomain' ),
		  'id' => 'dergiler_8',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Başlık 8', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 8.link için Başlık', 'theme-textdomain' ),
		  'id' => 'dergiler_aciklama_8',
		  'std' => '',
		  'type' => 'text'
		);



		$options[] = array(
		  'name' => __( 'Link 9', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 9.link (url)', 'theme-textdomain' ),
		  'id' => 'dergiler_9',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Başlık 9', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 9.link için Başlık', 'theme-textdomain' ),
		  'id' => 'dergiler_aciklama_9',
		  'std' => '',
		  'type' => 'text'
		);



		$options[] = array(
		  'name' => __( 'Link 10', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 10.link (url)', 'theme-textdomain' ),
		  'id' => 'dergiler_10',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Başlık 10', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 10.link için Başlık', 'theme-textdomain' ),
		  'id' => 'dergiler_aciklama_10',
		  'std' => '',
		  'type' => 'text'
		);


		$options[] = array(
		  'name' => __( 'Link 11', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 11.link (url)', 'theme-textdomain' ),
		  'id' => 'dergiler_11',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Başlık 11', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 11.link için Başlık', 'theme-textdomain' ),
		  'id' => 'dergiler_aciklama_11',
		  'std' => '',
		  'type' => 'text'
		);


		$options[] = array(
		  'name' => __( 'Link 12', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 12.link (url)', 'theme-textdomain' ),
		  'id' => 'dergiler_12',
		  'std' => '',
		  'type' => 'text'
		);

		$options[] = array(
		  'name' => __( 'Başlık 12', 'theme-textdomain' ),
		  'desc' => __( 'Dergi 12.link için Başlık', 'theme-textdomain' ),
		  'id' => 'dergiler_aciklama_12',
		  'std' => '',
		  'type' => 'text'
		);

	return $options;
}
