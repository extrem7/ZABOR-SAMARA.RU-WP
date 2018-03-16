<?
get_header();
breadcrumbs();
?>
<div class="container">
    <div class="row">
		<? get_sidebar() ?>
        <main class="product col-lg-9 col-md-8" itemscope itemtype="http://schema.org/Product">
            <h2 class="section-title" itemprop="name"><? the_title() ?></h2>
			<? if ( get_field( 'короткий-текст' ) ): ?>
                <p class="excerpt"><? the_field( 'короткий-текст' ) ?></p>
			<? endif; ?>
            <div class="carousel d-flex justify-content-between">
				<?
				$gallery = get_field( 'галерея' );
				$main    = $gallery[0];
				?>
                <img src="<?= $main['url'] ?>" class="d-none" alt="<?= $main['alt'] ?>" itemprop="image">
                <div class="big" style="background-image: url('<?= $main['url'] ?>')">
					<? if ( count( $gallery ) > 1 ): ?>
                        <a href="" class="carousel-left"></a>
                        <a href="" class="carousel-right"></a>
					<? endif; ?>
                </div>
				<? if ( count( $gallery ) > 1 ): ?>
                    <div class="miniatures">
						<?
						$active = 'active';
						foreach ( $gallery as $photo ): ?>
                            <img src="<?= $photo['url'] ?>" class="<?= $active ?>" alt="<?= $photo['alt'] ?>">
							<?
							$active = null;
						endforeach; ?>
                    </div>
				<? endif; ?>
            </div>
            <p class="section-title"><? the_field( 'описание-заголовок' ) ?></p>
            <p class="about" itemprop="description"><? the_field( 'описание' ) ?></p>
			<? if ( get_field( 'таблица-заголовок' ) ): ?>
                <h2 class="section-title"><? the_field( 'таблица-заголовок' ) ?></h2>
				<? $table = get_field( 'таблица' );
				if ( $table ):?>
                    <table>
						<? if ( $table['header'] ): ?>
                            <thead>
                            <tr>
								<?
								foreach ( $table['header'] as $th ) {
									echo '<th>';
									echo $th['c'];
									echo '</th>';
								}
								?>
                            </tr>
                            </thead>
						<? endif; ?>
                        <tbody>
						<? foreach ( $table['body'] as $tr ): ?>
                            <tr>
								<?
								foreach ( $tr as $td ) {
									echo '<td>';
									echo $td['c'];
									echo '</td>';
								}
								?>
                            </tr>
						<? endforeach; ?>
                        </tbody>
                    </table>
				<? endif; ?>
                <p class="price-small"><? the_field( 'цена' ) ?></p>
                <a data-toggle="modal" data-target="#callback" class="btn-green">Рассчитать стоимость</a>
			<? endif; ?>
			<? if ( get_field( 'подробно-заголовок' ) ): ?>
                <h2 class="section-title"><? the_field( 'подробно-заголовок' ) ?></h2>
                <p><? the_field( 'подробно-текст' ) ?></p>
				<?
				$tabs = get_field( 'подробно-вкладки' );
				if ( $tabs ):?>
                    <ul class="nav tabs-nav">
						<?
						$active = 'active';
						$i      = 1;
						foreach ( $tabs as $tab ): ?>
                            <li>
                                <a class="<?= $active ?>" data-toggle="pill"
                                   href="#tab-<?= $i ?>"><?= $tab['название'] ?></a>
                            </li>
							<?
							$i ++;
							$active = null;
						endforeach; ?>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
						<?
						$active = 'show active';
						$i      = 1;
						foreach ( $tabs as $tab ): ?>
                            <div class="tab-pane fade <?= $active ?>" id="tab-<?= $i ?>">
                                <div class="content">
									<?= $tab['контент'] ?>
                                </div>
                            </div>
							<?
							$i ++;
							$active = null;
						endforeach; ?>
                    </div>
				<? endif; ?>
			<? endif;
			$steps = get_field( 'этапы-установки', 'option' );
			if ( $steps ):
				?>
                <div class="steps">
                    <p class="section-title"><?= $steps['заголовок'] ?></p>
                    <div class="d-flex justify-content-around flex-wrap">
                        <div class="item">
                            <div class="circle">1</div>
                            <p><?= $steps['этап-1'] ?></p>
                        </div>
                        <div class="item">
                            <div class="circle">2</div>
                            <p><?= $steps['этап-2'] ?></p>
                        </div>
                        <div class="item">
                            <div class="circle">3</div>
                            <p><?= $steps['этап-3'] ?></p>
                        </div>
                        <div class="item">
                            <div class="circle">4</div>
                            <p><?= $steps['этап-4'] ?></p>
                        </div>
                    </div>
                </div>
			<? endif; ?>
            <!--Указывается схема Offer.-->
            <div class="d-none" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

                <!--В поле price указывается цена товара.-->
                <span itemprop="price"><?= (int) preg_replace( '/\D/', '', get_field( 'цена' ) ); ?></span>

                <!--В поле priceCurrency указывается валюта.-->
                <span itemprop="priceCurrency">RUB</span>
            </div>
            <section class="catalog">
                <p class="section-title title-main"><? the_field( 'варианты' ) ?></p>
                <div class="d-flex justify-content-center flex-wrap">
	                <? get_template_part( 'template-parts/loop' ) ?>
                </div>
				<? get_template_part( 'template-parts/stars' ) ?>
            </section>
        </main>
    </div>
</div>
<? get_footer() ?>
