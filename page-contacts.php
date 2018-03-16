<? /* Template Name: Контакты */
get_header();
breadcrumbs();
?>
<!--schema-->
<? the_field( 'главная+контакты','option' ) ?>
<!--schema-->
<div class="container">
    <div class="row">
		<? get_sidebar() ?>
        <main class="col-lg-9 col-md-8">
            <h2 class="section-title"><? the_title() ?></h2>
            <div class="map">
                <div class="info"><? the_field( 'инфо' ) ?></div>
				<? the_field( 'карта' ) ?>
            </div>
            <a data-toggle="modal" data-target="#callback" class="btn-green">Обратный звонок</a>
            <h2 class="section-title"><? the_field( 'реквизиты-заголовок' ) ?></h2>
            <div class="d-flex align-items-start flex-wrap justify-content-center justify-content-lg-start">
                <p class="text"><? the_field( 'реквизиты-текст' ) ?></p>
                <a href="<?= get_field( 'реквизиты-картинка' )['url'] ?>" data-fancybox="images">
                    <img src="<?= get_field( 'реквизиты-картинка' )['url'] ?>"
                         alt="<?= get_field( 'реквизиты-картинка' )['alt'] ?>"></a>
            </div>
            <h2 class="section-title"><? the_field( 'партнеры-заголовок' ) ?></h2>
            <div class="partners d-flex justify-content-around align-items-center flex-wrap">
				<?
				while ( have_rows( 'партнеры-список' ) ) : the_row()
					?>
                    <a href="<? the_sub_field( 'ссылка' ) ?>"
                       target="_blank"><img <? repeater_image( 'картинка' ) ?>></a>
				<? endwhile; ?>
            </div>
        </main>
    </div>
</div>
<? get_footer() ?>
