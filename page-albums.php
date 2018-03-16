<? /* Template Name: Фотоотчеты */
get_header();
breadcrumbs();
?>
<div class="container">
    <div class="row">
		<? get_sidebar() ?>
        <main class="col-lg-9 col-md-8">
			<?
			while ( have_rows( 'список' ) ) : the_row()
				?>
                <article class="album-item">
                    <h2 class="section-title"><? the_sub_field( 'заголовок' ) ?></h2>
					<? if ( get_sub_field( 'описание' ) ): ?>
                        <p><? the_sub_field( 'описание' ) ?></p>
					<? endif; ?>
                    <div class="d-flex justify-content-around flex-wrap">
						<? foreach ( get_sub_field( 'галерея' ) as $photo ): ?>
                            <a data-fancybox="gallery" href="<?= $photo['url'] ?>"><img src="<?= $photo['sizes']['thumbnail'] ?>"
                                                                                        alt="<?= $photo['alt'] ?>"></a>
						<? endforeach; ?>
                    </div>
                </article>
			<? endwhile; ?>
        </main>
    </div>
</div>
<? get_footer() ?>
