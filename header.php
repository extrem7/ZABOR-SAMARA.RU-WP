<!DOCTYPE html>
<html lang="<? bloginfo( 'language' ) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= wp_get_document_title() ?></title>
	<? wp_head() ?>
</head>
<body <? body_class() ?>>
<?
global $phone, $mail, $modalBtn;
$phone    = get_field( 'телефон', 'option' );
$email    = get_field( 'почта', 'option' );
$modalBtn = get_field( 'кнопка-попап', 'option' );
$viber    = get_field( 'viber', 'option' );
$whatsapp = get_field( 'whatsapp', 'option' );
$telegram = get_field( 'telegram', 'option' );
?>
<header class="fixed-top">
    <div class="d-flex justify-content-center align-items-center">
        <a href="<?= phoneLink( $phone ) ?>"
           class="phone"><?= $phone ?></a>
        <a data-toggle="modal" data-target="#callback" class="btn-gray"><?= $modalBtn ?></a>
    </div>
</header>
<section class="main">
    <div class="container">
        <header class="header row justify-content-between">
            <button type="button" class="toggle-btn">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="social">
				<? if ( $viber ): ?>
                    <a href="<?= $viber ?>" class="viber"></a>
				<? endif; ?>
				<? if ( $whatsapp ): ?>
                    <a href="<?= $whatsapp ?>" class="whatsapp"></a>
				<? endif; ?>
				<? if ( $telegram ): ?>
                    <a href="<?= $telegram ?>" class="telegram"></a>
				<? endif; ?>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-8">
				<?php wp_nav_menu( [
					'menu'       => 'Хедер',
					'container'  => null,
					'items_wrap' => '<ul  class="menu">%3$s</ul>',
					'walker'     => new Bootstrap_Walker_Nav_Menu()
				] ); ?>
            </div>
            <div class="right col-xl-5 col-lg-5 col-md-4 d-block  d-lg-flex align-items-center justify-content-end">
                <div class="links">
                    <a href="<?= phoneLink( $phone ) ?>"
                       class="phone"><?= $phone ?></a>
                    <a href="mailto:<?= $email ?>" class="email"><?= $email ?></a>
                </div>

                <a data-toggle="modal" data-target="#callback" class="btn-gray"><?= $modalBtn ?></a>
            </div>
        </header>
        <div class="content row justify-content-between">
            <div class="col-xl-6 col-lg-5 col-md-6">
                <h1 class="title"><?
					if ( is_category() ) {
						the_field( 'Хедер-заголовок', 262 );
					} elseif ( is_archive() ) {
						the_field( 'акции-заголовок', 'option' );
					} else {
						$title = get_field( 'Хедер-заголовок' );
						echo $title ? $title : get_field( 'Хедер-заголовок', 34 );
					} ?></h1>
                <p class="text"><?
					if ( is_category() ) {
						echo $text ? $text : get_field( 'Хедер-текст', 262 );
					} elseif ( is_archive() ) {
						the_field( 'акции-текст', 'option' );
					} else {
						$text = get_field( 'Хедер-текст' );
						echo $text ? $text : get_field( 'Хедер-текст', 34 );
					} ?></p>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
				<?= do_shortcode( '[contact-form-7 id="181" title="Заявка из хедера" html_class="form"]' ) ?>
            </div>
        </div>
    </div>
</section>