<?
global $product;
$card    = get_field( 'карточка-товара', $product );
?>
<a href="<?= get_permalink( $product ) ?>" class="product-card">
    <div class="photo" style="background-image: url('<?= $card['фото'] ?>')">
        <div class="cat"><?= $card['название'] ?></div>
    </div>
    <p class="title"><?= $card['название-второе'] ?></p>
    <p class="attr">
		<? foreach ( $card['краткие-характеристики'] as $item ): ?>
			<?= $item['поле'] ?>: <b> <?= $item['значение'] ?></b><br>
		<? endforeach; ?>
    </p>
    <div class="price">ЦЕНА: <?= $card['цена'] ?>
        <span class="price-icon"></span>
    </div>
</a>