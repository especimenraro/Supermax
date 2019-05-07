<?php
/**
 * The main template file.
 */

get_header(); ?>

<?php if ( is_front_page() && $paged < 2) : ?>

    <?php get_template_part( 'wpzoom-slider' ); ?>

<?php endif; ?>

<main id="main" class="site-main" role="main">

    <section class="content-area">

            <h2 class="section-title"><?php esc_html_e('Latest Posts', 'foodica'); ?></h2>

            <?php if ( have_posts() ) : ?>

                <section id="recent-posts" class="recent-posts">

                    <?php  while ( have_posts() ) : the_post();  ?>

                        <?php if ( is_sticky() && $paged < 2 ) {

                            get_template_part( 'content', 'sticky' );

                        } else {

                            get_template_part( 'content', get_post_format() );
                        } ?>

                    <?php endwhile; ?>

                </section>

                <?php get_template_part( 'pagination' ); ?>

            <?php else: ?>

                <?php get_template_part( 'content', 'none' ); ?>

            <?php endif; ?>

        <div class="clear"></div>

    </section><!-- .content-area -->

    <?php get_sidebar(); ?>

</main><!-- .site-main -->

<?php
get_footer();