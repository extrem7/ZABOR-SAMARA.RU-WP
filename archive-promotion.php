<? /* Template Name: Фотоотчеты */
get_header();
breadcrumbs();
?>
<div class="container">
    <div class="row">
		<? get_sidebar() ?>
        <main class="promotion-content col-lg-9 col-md-8">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ): the_post(); ?>
                    <article class="promotion-item">
                        <a href="<? the_permalink() ?>" class="section-title"><? the_title() ?></a>
                        <div class="photo" style="background-image: url('<? the_post_thumbnail_url() ?>')">
                            <a href="<? the_permalink() ?>" class="name"><? the_field('название') ?></a>
                        </div>
                        <p class="excerpt"><? the_excerpt() ?></p>
                        <a href="<? the_permalink() ?>" class="btn-green-border">Условия акции</a>
                    </article>
				<?endwhile;
			}
			?>
        </main>
    </div>
</div>
<? get_footer() ?>
