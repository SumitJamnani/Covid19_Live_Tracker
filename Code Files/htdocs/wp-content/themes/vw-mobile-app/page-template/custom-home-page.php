<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>

<main id="maincontent" role="main">
  <?php do_action( 'vw_mobile_app_before_banner' ); ?>

  <section id="banner">
    <?php $vw_mobile_app_slider_page = array();
        $mod = absint( get_theme_mod( 'vw_mobile_app_banner_settings'));
        if ( 'page-none-selected' != $mod ) {
          $vw_mobile_app_slider_page[] = $mod;
        }
        if( !empty($vw_mobile_app_slider_page) ) :
          $args = array(
            'post_type' => 'page',
            'post__in' => $vw_mobile_app_slider_page,
            'orderby' => 'post__in'
          );
      $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          $count = 0;
          while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="main-box">
              <div class="box-image">
                <?php the_post_thumbnail(); ?>
              </div>
              <div class="box-content">
                <h1><a href="<?php echo esc_url( get_permalink() );?>"><?php the_title(); ?></a></h1><span class="screen-reader-text"><?php the_title(); ?></span>
                <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_mobile_app_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_mobile_app_slider_excerpt_number','30')))); ?></p>
                <?php if( get_theme_mod('vw_mobile_app_search_hide_show',true) != ''){ ?>
                  <?php get_search_form(); ?>
                <?php } ?>
              </div>
            </div>
          <?php $count++; endwhile; ?>
        <?php else : ?>
          <div class="no-postfound"></div>
        <?php endif;
    endif; wp_reset_postdata();?>  
  </section>

  <?php do_action( 'vw_mobile_app_after_banner' ); ?>

  <?php if( get_theme_mod('vw_mobile_app_section_title') != '' || get_theme_mod('vw_mobile_app_section_text') != '' || get_theme_mod('vw_mobile_app_about_category') != ''){ ?>
    <section id="about-us">
      <div class="container">
        <?php if( get_theme_mod('vw_mobile_app_section_title') != ''){ ?>
          <h2><?php echo esc_html(get_theme_mod('vw_mobile_app_section_title','')); ?></h2>
          <hr>    
        <?php }?>
        <?php if( get_theme_mod('vw_mobile_app_section_text') != ''){ ?>
          <p><?php echo esc_html(get_theme_mod('vw_mobile_app_section_text','')); ?></p>
        <?php }?>
        <div class="row">
          <?php
            $vw_mobile_app_catData1=  get_theme_mod('vw_mobile_app_about_category');
            if($vw_mobile_app_catData1){
              $page_query = new WP_Query(array(  'category_name' => esc_html($vw_mobile_app_catData1 ,'vw-mobile-app')));?>    
            <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
              <div class="col-lg-4 col-md-4">
                <div class="catgory-box">
                  <?php the_post_thumbnail(); ?>
                  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h3>
                  <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_mobile_app_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_mobile_app_about_excerpt_number','30')))); ?></p>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata();
            }
          ?>
        </div>
      </div>
    </section>
  <?php }?>

  <?php do_action( 'vw_mobile_app_after_about' ); ?>

  <div class="content-vw">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>