<?
global $product;
$products = null;
if ( is_home() || get_page_template_slug() == 'page-products.php' ) {
	$products = get_field( 'каталог-товары' );
} elseif ( is_category() ) {
	$term     = get_queried_object()->term_id;
	$products = get_posts( [ 'post_type' => 'product', 'category' => $term, 'numberposts' => - 1 ] );
} else {
	$products = get_field( 'товары-предложение' );
	if ( ! $products ) {
		$products = get_field( 'каталог-товары', 34 );
	}
}
$columns = [ [], [], [] ];
$col     = 0;
for ( $i = 0; $i < count( $products ); $i ++ ) {
	array_push( $columns[ $col ], $products[ $i ] );
	$col != 2 ? $col ++ : $col = 0;
}
?>
<? foreach ( $columns as $column ): ?>
    <div class="column">
		<? foreach ( $column as $product ) {
			get_template_part( 'template-parts/product-card' );
		} ?>
    </div>

<? endforeach;