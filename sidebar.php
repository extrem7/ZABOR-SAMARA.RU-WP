<aside class="sidebar col-lg-3 col-md-4">
    <div class="sidebar-catalog">
        <div class="head">
            <div class="catalog-icon"></div>
            <p class="title">каталог</p>
        </div>
		<?php
		add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
			//pre($item);
			if ( $args->has_children ) {
				$atts['data-toggle'] = 'dropdown-catalog';
				$atts['class']       = 'dropdown-catalog';
			}

			return $atts;
		}, 10, 3 );
        wp_nav_menu( array(
			'menu'       => 'Каталог',
			'container'  => null,
			'items_wrap' => '<ul  class="categories">%3$s</ul>',
			'walker'     => new Sidebar_Walker()
		) ); ?>
    </div>
    <div class="sidebar-reviews">
        <div class="head">
            <div class="testimonials-icon"></div>
            <p class="title">Отзывы</p>
        </div>
        <ul class="reviews">
			<?
			global $months;
			$reviews  = get_field( 'отзывы-список', 76 );
			$reviews  = array_reverse( array_slice( $reviews, - 3, 3 ) );
			for ( $i = 0; $i < 3; $i ++ ):
				$date = explode( ',', $reviews[ $i ]['дата'] );
				$date = "$date[0] {$months[ intval( $date[1] - 1 ) ]} $date[2]";
				if ( ! isset( $reviews[ $i ] ) ) {
					continue;
				}
				?>
                <li class="reviews-item">
                    <p class="name"><?= $reviews[ $i ]['имя'] ?></p>
                    <p class="text"><?= mb_substr( $reviews[ $i ]['текст'], 0, 111 ) ?> ...</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="date"><?= $date ?></p>
                        <a href="<?= get_permalink( 76 ) ?>">Подробнее</a>
                    </div>
                </li>
			<? endfor; ?>
        </ul>
    </div>
    <div class="sidebar-photo">
        <div class="head">
            <div class="photo-icon"></div>
            <p class="title">фото дня</p>
        </div>
        <div class="photos d-flex flex-wrap align-items-start justify-content-between">
			<?
			$photoDay = get_field( 'фото-дня', 'option' );
			foreach ( $photoDay as $photo ):
				?>
                <a data-fancybox="gallery" href="<?= $photo['url'] ?>"><img src="<?= $photo['url'] ?>"
                                                                            alt="<?= $photo['alt'] ?>"></a>
			<? endforeach; ?>
        </div>
    </div>
</aside>