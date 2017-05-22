<?php 
	/**
 * The template for displaying all single posts.
 *
 * @package themefisher
 */
get_header();

?>

<?php while ( have_posts() ) : the_post(); ?>


<div class="single-product-page ">
	 <section class="product-page-header page-title">
	 	<div class="container">
	 		<div class="row">
	 			<div class="col-md-12">
 					<h2 class="product-header">
						<?php the_title(); ?>
					</h2>
	 			</div>
	 		</div>
	 	</div>
	 </section>
		
	<section class="product-description">
		<div class="container">
			
			<div class="row">
				<div class="col-md-8">
					<div class="product-details">
					<div class="product-img ">
						<?php the_post_thumbnail();  ?>
                    </div>
                    <div class="product-description-content" >
	                    <?php the_content(); ?>
                    </div>
                </div>
	 		</div>

	 			

					<!-- Single Product Page Sidebar -->
				<div class="col-md-4">
					<div class="product-sidebar" >
						<div class="price-widget widget" >
							<div class="product-price text-center">
<!--								price amount-->
                                <div class="buy-button">
<!--                                    purchase button-->
                                    <?php
                                    $pack['ID'] = get_the_ID();
                                    $pack['post_title'] = get_the_title();
                                    $pack['post_content'] = get_the_content();
                                    $pack['post_excerpt'] = get_the_excerpt();
                                    $pack = wpdm_setup_package_data($pack);
                                    ?>
	                                <?php if(isset($pack['base_price'])&&$pack['base_price']>0){ ?>
				                                <?php echo str_replace("btn-primary","btn-main",$pack['download_link']); ?>
                                    <?php } ?>
	                                <?php if(!isset($pack['base_price'])||$pack['base_price']==0){ ?>
                                        <div class="text-center">
			                                <?php echo str_replace(array("[btnclass]", "btn-main","<i class=''></i>"),array("btn btn-main btn-lg btn-block","btn btn-main btn-lg btn-block"),$pack['download_link']); ?>
                                        </div>
	                                <?php } ?>

                                </div>
							</div>
                        </div>
                        <div class="product-category-widget widget-category widget">
                            <h4 class="widget-title"> Product Category</h4>
                            <ul>
	                            <?php
	                            $aa = get_the_terms(get_the_ID(), 'wpdmcategory');
	                            if ($aa):
		                            foreach($aa as $bb): ?>
                                        <li>
                                            <a href="<?php echo get_term_link($bb->term_id) ?>">
                                                <?php echo $bb->name; ?>
                                            </a>
                                        </li>
		                            <?php endforeach;
	                            endif; ?>
                            </ul>
                        </div>
                        <div class="product-tag-widget widget-tag widget">
                            <h4 class="widget-title"> Product Tags</h4>
                            <ul>
								<?php
									$aa = get_the_terms(get_the_ID(), 'post_tag');
									if ($aa):
                                    foreach($aa as $bb): ?>
                                    <li>
                                        <a href="<?php echo get_term_link($bb->term_id) ?>">
                                            <?php echo $bb->name; ?>
                                        </a>
                                    </li>
                                <?php endforeach; endif; ?>
                            </ul>
                        </div>
					</div>
				</div>
            </div>
		</div>
	</section>



	<section class="related-product section">
		<div class="container">
		    <div class="row">
		        <div class="col-md-12">
		            <h2 class="sub-title">Related Items</h2>
		        </div>
		    </div>
		    <div class="row">
		       <?php
		        $args = array(
		            'post_type' => 'wpdmpro',
		            'posts_per_page' => 3,
		            'category__in'  => wp_get_post_categories($post->ID),
		            'orderby'   =>'rand',
		            'post__not_in'  => array($post->ID),
		            'post_status' => 'publish'
		        );
		        $loop = new wp_query( $args );
		        if( $loop->have_posts() ) :
		        while ($loop->have_posts()) : $loop->the_post()
		          ?>
                    <div class="col-md-4">
                        <div class="product-item">
                            <div class="product-thumb">
                                <a href="">
	                                <?php the_post_thumbnail();  ?>
                                </a>
                                <!--                                <span class="badge">Pro</span>-->
                            </div>
                            <div class="content">
                                <div class="product-meta">
                                    <span class="price"> <i class="tf-pricetags"></i></span>
                                    <a class="author" href=""><i class="tf-profile-male"></i><?php the_author();  ?></a>
                                </div>
                                <h4><a href="<?php the_permalink();  ?>"><?php the_title();  ?></a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, animi.</p>
                                <div class="product-buttons">
                                    <a href="<?php the_permalink();  ?>" class="btn btn-main-sm">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
		        <?php
		        endwhile;
		        wp_reset_query(); 
		        endif;// if post  ?>

		     </div>
		</div>
	</section>
</div>




<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>
