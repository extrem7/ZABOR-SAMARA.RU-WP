<?
get_header();
breadcrumbs();
?>
<div class="container">
    <div class="row">
		<? get_sidebar() ?>
        <main class="promotion-item col-lg-9 col-md-8">
            <h2 class="section-title"><? the_title() ?></h2>
            <div class="photo" style="background-image: url('<? the_post_thumbnail_url() ?>')">
                <p class="name"><? the_field( 'название' ) ?></p>
            </div>
            <p class="text"><?= apply_filters( 'the_content', get_post_field( 'post_content', $id ) ); ?></p>
			<? global $months;
			$date = explode( '/', get_field('дата') );
			$date = "$date[0] {$months[ intval( $date[1] - 1 ) ]} $date[2]";
			?>
            <span class="date">Действие акции до <?= $date ?></span>
            <button data-toggle="modal" data-target="#callback" class="btn-green">Получить скидку</button>
        </main>
    </div>
</div>
<? get_footer() ?>
