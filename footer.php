<? global $phone, $mail, $modalBtn;
$vk       = get_field( 'vk', 'option' );
$fb       = get_field( 'fb', 'option' );
$politics = get_field( 'футер-политика', 'option' );
?>
<footer class="footer">
    <div class="top">
        <div class="container d-flex flex-wrap align-items-center">
			<?php wp_nav_menu( [
				'menu'       => 'Хедер',
				'container'  => null,
				'items_wrap' => '<ul  class="menu">%3$s</ul>'
			] ); ?>
            <div class="right d-flex align-items-center justify-content-between">
                <a href="<?= phoneLink( $phone ) ?>"
                   class="phone"><?= $phone ?></a>
                <a data-toggle="modal" data-target="#callback" class="btn-gray"><?= $modalBtn ?></a>
            </div>
        </div>
    </div>
    <div class="bottom">
        <div class="container d-flex align-items-center">
            <p class="site"><?= $_SERVER['SERVER_NAME'] ?> </p>
            <p class="d-flex flex-wrap align-items-center">
				<? the_field( 'футер-копирайт', 'option' ); ?>
				<? if ( $vk || $fb ): ?>
                    <span class="links">
                        <? if ( $vk ): ?>
                            <a href="<?= $vk ?>" class="vk"></a>
                        <? endif; ?>
						<? if ( $fb ): ?>
                            <a href="<?= $fb ?>" class="fb"></a>
						<? endif; ?>
                    </span>
				<? endif; ?>
                <i>|</i>
                <a href="<?= phoneLink( $phone ) ?>" class="mail"><?= $phone ?></a>
                <i>|</i>
				<? the_field( 'футер-адрес', 'option' ); ?>
                <i>|</i>
                <a href="<?= $politics['url'] ?>" target="<?= $politics['target'] ?>"
                   class="personal"><?= $politics['title'] ?></a>
            </p>
        </div>
    </div>
</footer>
<a data-toggle="modal" data-target="#callback" class="calc-btn"><span
            class="calc-icon"></span><? the_field( 'кнопка-стоимость', 'option' ) ?></a>
<div class="modal fade modal-vertical-center" id="callback">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"></button>
            <p class="title"> <? the_field( 'попап-заголовок', 'option' ) ?> <span
                        class="time"><? the_field( 'попап-таймер', 'option' ) ?> секунд</span></p>
			<?= do_shortcode( '[contact-form-7 id="199" title="Заявка попап" html_class="form"]' ) ?>
            <p class="politics"><? the_field( 'попап-политика', 'option' ) ?></p>
            <img src="<?= path() ?>img/modal-hand.png" alt="" class="hand">
        </div>
    </div>
</div>
<script src="<?= path() ?>js/script.php"></script>
<? wp_footer() ?>
</body>
</html>