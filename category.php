<?
get_header();
breadcrumbs();
?>
<div class="container">
    <div class="row">
		<? get_sidebar() ?>
        <main class="product col-lg-9 col-md-8">
            <h2 class="section-title" itemprop="name"><?= get_queried_object()->name ?></h2>
            <section class="catalog">
                <div class="d-flex justify-content-center flex-wrap">
					<? get_template_part( 'template-parts/loop' ) ?>
                </div>
            </section>
        </main>
    </div>
</div>
<? get_footer() ?>
