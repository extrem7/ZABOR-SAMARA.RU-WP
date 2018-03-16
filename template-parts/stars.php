<div class="section-title line"></div>
<div class="stars">
	<?
	while ( have_rows( 'звезды', 34 ) ) : the_row() ?>
        <div class="item">
            <div class="star-icon"></div>
            <p><? the_sub_field( 'звезда' ) ?></p>
        </div>
	<? endwhile; ?>
</div>