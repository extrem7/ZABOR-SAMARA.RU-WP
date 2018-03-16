<? /* Template Name: Главная */
get_header(); ?>
<!--schema-->
<? the_field( 'главная+контакты','option' ) ?>
<!--schema-->
<section class="services-complex">
    <h2 class="section-title"><? the_field( 'услуги-заголовок' ) ?></h2>
    <div class="container">
        <div class="row">
			<?
			while ( have_rows( 'услуги-список' ) ) : the_row() ?>
                <div class="col-lg-3 col-md-4 col-sm-6 item">
                    <a href="<? the_sub_field( 'ссылка' ) ?>" class="circle">
                        <img <? repeater_image( 'картинка' ) ?>>
                        <div class="button">перейти</div>
                    </a>
                    <p><? the_sub_field( 'название' ) ?></p>
                </div>
			<? endwhile; ?>
        </div>
    </div>
</section>
<section class="install-samara">
    <h2 class="section-title"><? the_field( 'установка-заголовок' ) ?></h2>
    <p class="text"><? the_field( 'установка-текст' ) ?></p>
</section>
<section class="advantages">
    <h3 class="section-title"><? the_field( 'приемущества-заголовок' ) ?></h3>
    <div class="container">
        <div class="row justify-content-center">
			<? while ( have_rows( 'приемущества-блоки' ) ) : the_row() ?>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 item">
                    <div class="icon">
                        <img <? repeater_image( 'иконка' ) ?>>
                    </div>
                    <p class="title"><? the_sub_field( 'заголовок' ) ?></p>
                    <p class="text"><? the_sub_field( 'текст' ) ?></p>
                </div>
			<? endwhile; ?>
        </div>
    </div>
</section>
<section class="catalog">
    <h2 class="section-title title-main"><? the_field( 'каталог-заголовок' ) ?></h2>
    <div class="d-flex justify-content-center flex-wrap">
		<? get_template_part( 'template-parts/loop' ) ?>
    </div>
    <a href="<? the_field( 'каталог-ссылка' ) ?>" class="btn-green-border">перейти в каталог</a>
	<? get_template_part( 'template-parts/stars' ) ?>
</section>
<? get_footer() ?>
