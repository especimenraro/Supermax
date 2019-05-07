<?php
/**
 * The header for our theme
 *
 * @package WordPress
 * @subpackage supermarket-ecommerce
 * @since 1.0
 * @version 0.1
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'supermarket-ecommerce' ) ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="contact-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="social-icons">
					<?php if( get_theme_mod( 'supermarket_ecommerce_facebook_url') != '') { ?>
				      <a href="<?php echo esc_url( get_theme_mod( 'supermarket_ecommerce_facebook_url','' ) ); ?>"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
				    <?php } ?>
				    <?php if( get_theme_mod( 'supermarket_ecommerce_twitter_url') != '') { ?>
				      <a href="<?php echo esc_url( get_theme_mod( 'supermarket_ecommerce_twitter_url','' ) ); ?>"><i class="fab fa-twitter"></i></a>
				    <?php } ?>
				    <?php if( get_theme_mod( 'supermarket_ecommerce_insta_url') != '') { ?>
				      <a href="<?php echo esc_url( get_theme_mod( 'supermarket_ecommerce_insta_url','' ) ); ?>"><i class="fab fa-instagram"></i></a>
				    <?php } ?>
				    <?php if( get_theme_mod( 'supermarket_ecommerce_linkedin_url') != '') { ?>
				      <a href="<?php echo esc_url( get_theme_mod( 'supermarket_ecommerce_linkedin_url','' ) ); ?>"><i class="fab fa-linkedin-in"></i></a>
				    <?php } ?>	  
				    
				    <?php if( get_theme_mod( 'supermarket_ecommerce_you_tube_url') != '') { ?>
				      <a href="<?php echo esc_url( get_theme_mod( 'supermarket_ecommerce_you_tube_url','' ) ); ?>"><i class="fab fa-youtube"></i></a>
				    <?php } ?>
				    <?php if( get_theme_mod( 'supermarket_ecommerce_pinterest_url') != '') { ?>
				      <a href="<?php echo esc_url( get_theme_mod( 'supermarket_ecommerce_pinterest_url','' ) ); ?>"><i class="fab fa-pinterest-p"></i></a>
				    <?php } ?>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="email">
					<?php if( get_theme_mod( 'supermarket_ecommerce_call') != '') { ?>
						<span><i class="fas fa-phone"></i><?php echo esc_html( get_theme_mod('supermarket_ecommerce_call','') ); ?></span>
					<?php }?>
					<?php if( get_theme_mod( 'supermarket_ecommerce_mail') != '') { ?>
						<span><i class="fas fa-envelope"></i><?php echo esc_html( get_theme_mod('supermarket_ecommerce_mail','') ); ?></span>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="header">
	<div class="search-bar">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-12">
					<div class="logo">
				        <?php if( has_custom_logo() ){ supermarket_ecommerce_the_custom_logo();
				           }else{ ?>
				          <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				          <?php $description = get_bloginfo( 'description', 'display' );
				          if ( $description || is_customize_preview() ) : ?> 
				            <p class="site-description"><?php echo esc_html($description); ?></p>
				        <?php endif; }?>
				    </div>
				</div>
				<?php if(class_exists('woocommerce')){ ?>
					<div class="col-lg-6 col-md-7">
			        	<?php get_product_search_form()?>
			      	</div>
			      	<div class="col-lg-2 col-md-3">
			      		<div class="acc-btn">
				            <?php if(class_exists('woocommerce')){ ?>
					            <?php if ( is_user_logged_in() ) { ?>
					              <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" ><?php esc_html_e('MY ACCOUNT','supermarket-ecommerce'); ?></a>
					            <?php } 
					            else { ?>
					              <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" ><?php esc_html_e('LOGIN / REGISTER','supermarket-ecommerce'); ?></a>
					            <?php } ?>
					        <?php }?>
			        	</div>
			      	</div>
					<div class="col-lg-1 col-md-2">
					    <div class="cart_icon">
					        <a class="cart-contents" href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>"><i class="fas fa-shopping-basket"></i></a>
				            <li class="cart_box">
				              <span class="cart-value"> <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
				            </li>
					    </div>
				    </div>
				<?php } ?>
			</div>
		</div>
	</div>	
	<div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','supermarket-ecommerce'); ?></a></div>
	<div class="menu-section">
		<div class="container">
			<div class="main-top">
			   <div class="row">
			    	<?php if(class_exists('woocommerce')){ ?>
			      	<div class="col-lg-3 col-md-4">
				        <button class="product-btn"><?php echo esc_html_e('ALL CATEGORIES','supermarket-ecommerce'); ?><i class="fa fa-bars" aria-hidden="true"></i></button>
				        <div class="product-cat">
				          <?php
				            $args = array(
				              //'number'     => $number,
				              'orderby'    => 'title',
				              'order'      => 'ASC',
				              'hide_empty' => 0,
				              'parent'  => 0
				              //'include'    => $ids
				            );
				            $product_categories = get_terms( 'product_cat', $args );
				            $count = count($product_categories);
				            if ( $count > 0 ){
				                foreach ( $product_categories as $product_category ) {
				                  $cat_id   = $product_category->term_id;
				                  $cat_link = get_category_link( $cat_id );
				                  if ($product_category->category_parent == 0) { ?>
				                <li class="drp_dwn_menu"><a href="<?php echo esc_url(get_term_link( $product_category ) ); ?>">
				                <?php
				              }
				                echo esc_html( $product_category->name ); ?></a><i class="fas fa-chevron-right"></i></li>
				                <?php
				                }
				              }
				          ?>
			        	</div>
			      	</div>
			      	<?php } ?>
			      	<div class="col-lg-9 col-md-8">
						<div class="nav">
							<?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
						</div>
					</div>
			    </div>
			</div>
		</div>
	</div>	
</div>