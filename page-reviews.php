<? /* Template Name: Отзывы */
get_header();
breadcrumbs();
?>
<div class="container">
    <div class="row">
		<? get_sidebar() ?>
        <main class="reviews-content col-lg-9 col-md-8">
            <h2 class="section-title"><? the_field( 'заголовок' ) ?></h2>
            <p class="write"><? the_field( 'текст' ) ?></p>
			<?= do_shortcode( '[contact-form-7 id="113" title="Отзыв" html_class="form"]' ) ?>
            <h2 class="section-title"><? the_field( 'заголовок-отзывов' ) ?></h2>
			<?
			global $months;
			$reviews      = get_field( 'отзывы-список' );
			$reviewsCount = count( $reviews );
			$paged        = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
			$limit        = 5;
			$start        = $limit * ( $paged - 1 );
			$offset       = $paged * $limit;
			for ( $i = $start; $i < $offset; $i ++ ):
				$date = explode( ',', $reviews[ $i ]['дата'] );
				$date     = "$date[0] {$months[ intval( $date[1] - 1 ) ]} $date[2]";
				if ( ! isset( $reviews[ $i ] ) ) {
					continue;
				}
				?>
                <div class="reviews-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="name"><?= $reviews[ $i ]['имя'] ?></p>
                        <p class="date"><?= $date ?></p>
                    </div>
                    <p class="text"><?= $reviews[ $i ]['текст'] ?></p>
                </div>
			<? endfor; ?>
			<?
			global $post;
			$slug = $post->post_name;
			if ( $reviewsCount > $limit ): ?>
                <div class="pagination d-flex justify-content-center">
                    <a href="/<?= $slug ?>" class="<? if ( $paged == 1 )
						echo ' current' ?>">1</a>
					<?
					for ( $i = 2; $i <= ( ceil( $reviewsCount / $limit ) ); $i ++ ):?>
                        <a href="<?= "/$slug/$i" ?>" class="<? if ( $paged == $i )
							echo ' current' ?>"><?= $i ?></a>
					<? endfor; ?>
                </div>
			<? endif; ?>
        </main>
    </div>
</div>
<? get_footer() ?>
