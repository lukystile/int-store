<?php
/**
 * single.php
 *
 * The template for displaying single posts.
 */

get_header();?>
	<style>
        .page-container {
            padding: 0;
        }
	</style>
<div class="product-categories-menu">
	<div class="container">
		<?php

		global $wp_query;

		$args = array();
		$product_categories = get_terms( 'product_cat', $args );
		?>

		<ul>
			<?php foreach ($product_categories as $product_category) :?>
				<?php if ($wp_query->get_queried_object()->term_id == $product_category->term_id) :?>
					<li class="active">
				<?php else :?>
					<li>
				<?php endif;?>
					<a href="<?php echo get_term_link($product_category->term_id)?>"><?php echo $product_category->name?></a>
				</li>
			<?php endforeach;?>
		</ul>
	</div>
</div>

<div class="container aesti-products">
	<?php
	while( have_posts() ) : the_post();
		$image = get_field('product_wide_image', get_the_ID())
		?>
		<div class="aesti-product" style="background-image: url('<?php echo $image?>')">
			<div class="col-sm-4 no-padding-xs">
                <img src="<?php echo $image?>" alt="" class="img-responsive mobile-image">
            </div>
			<div class="col-sm-8 hidden-xs">
				<h2><?php the_title()?></h2>
				<a href="<?php echo get_permalink(get_the_ID())?>" class="btn btn-primary"><?php echo __('Watch more', 'aesti')?></a>
			</div>
			<div class="col-sm-8 visible-xs mobile-bottom">
                <a href="<?php echo get_permalink(get_the_ID())?>">
	                <?php the_title()?>
                </a>
			</div>
		</div>
		<?php
	endwhile;
	?>
</div>


<div class="container" style="padding: 30px 0; text-align: center">
	<?php dynamic_sidebar('resellers_area_widget');?>
</div>

<?php

get_footer();
