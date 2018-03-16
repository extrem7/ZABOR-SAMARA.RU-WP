<?php
global $months;
$months = [
	'Января',
	'Февраля',
	'Марта',
	'Апреля',
	'Мая',
	'Июня',
	'Июля',
	'Августа',
	'Сентября',
	'Октября',
	'Ноября',
	'Декабря'
];

add_action( 'init', 'register_post_types' );
function register_post_types() {
	register_post_type( 'product', array(
		'labels'             => [
			'name'               => 'Продукт', // основное название для типа записи
			'singular_name'      => 'Продукты', // название для одной записи этого типа
			'add_new'            => 'Добавить продукт', // для добавления новой записи
			'add_new_item'       => 'Добавление продукта', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование продукта', // для редактирования типа записи
			'new_item'           => 'Новое', // текст новой записи
			'view_item'          => 'Смотреть продукт', // для просмотра записи этого типа.
			'search_items'       => 'Искать продукт', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'menu_name'          => 'Продукты', // название меню
		],
		'public'             => true,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-cart',
		'hierarchical'       => false,
		'supports'           => array( 'title', 'editor', 'custom-fields' ),
		// 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'         => array( 'category' ),
		'has_archive'        => false,
		'capability_type'    => 'post',
		'rewrite'            => array( 'slug' => 'product' ),
		'publicly_queryable' => true
	) );
	register_post_type( 'promotion', array(
		'labels'             => [
			'name'               => 'Акции', // основное название для типа записи
			'singular_name'      => 'Акции', // название для одной записи этого типа
			'add_new'            => 'Добавить акцию', // для добавления новой записи
			'add_new_item'       => 'Добавление акции', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование акции', // для редактирования типа записи
			'new_item'           => 'Новое', // текст новой записи
			'view_item'          => 'Смотреть акцию', // для просмотра записи этого типа.
			'search_items'       => 'Искать акцию', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'menu_name'          => 'Акции', // название меню
		],
		'public'             => true,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-backup',
		'hierarchical'       => false,
		'supports'           => array( 'title', 'editor', 'custom-fields', 'page-attributes', 'excerpt','thumbnail' ),
		// 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'has_archive'        => true,
		'capability_type'    => 'post',
		'rewrite'            => array( 'slug' => 'promotions' ),
		'publicly_queryable' => true
	) );
}

function custom_remove_cpt_slug($post_link, $post, $leavename)
{
	if ('product' != $post->post_type || 'publish' != $post->post_status)
	{
		return $post_link;
	}
	$post_link = str_replace('/' . $post->post_type . '/', '/', $post_link);

	return $post_link;
}

add_filter('post_type_link', 'custom_remove_cpt_slug', 10, 3);

function custom_parse_request_tricksy($query)
{
	// Only noop the main query
	if (!$query->is_main_query())
		return;

	// Only noop our very specific rewrite rule match
	if (2 != count($query->query) || !isset($query->query['page']))
	{
		return;
	}

	// 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
	if (!empty($query->query['name']))
	{
		$query->set('post_type', array('post', 'product', 'page'));
	}
}

add_action('pre_get_posts', 'custom_parse_request_tricksy');