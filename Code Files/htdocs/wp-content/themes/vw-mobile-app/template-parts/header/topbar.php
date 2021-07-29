<?php
/**
 * The template part for header
 *
 * @package VW Mobile App 
 * @subpackage vw_mobile_app
 * @since VW Mobile App 1.0
 */
?>

<div id="header">
  <div class="header-menu <?php if( get_theme_mod( 'vw_mobile_app_sticky_header', false) != '' || get_theme_mod( 'vw_mobile_app_stickyheader_hide_show', false) != '') { ?> header-sticky"<?php } else { ?>close-sticky <?php } ?>">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-8 align-self-lg-center">
          <div class="logo">
            <?php if ( has_custom_logo() ) : ?>
              <div class="site-logo"><?php the_custom_logo(); ?></div>
            <?php endif; ?>
            <?php $blog_info = get_bloginfo( 'name' ); ?>
            <?php if( get_theme_mod('vw_mobile_app_logo_title_hide_show',true) != ''){ ?>
              <?php if ( ! empty( $blog_info ) ) : ?>
                <?php if ( is_front_page() && is_home() ) : ?>
                  <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php else : ?>
                  <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php endif; ?>
              <?php endif; ?>
            <?php }?>
            <?php if( get_theme_mod('vw_mobile_app_tagline_hide_show',true) != ''){ ?>
              <?php
                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) :
              ?>
                <p class="site-description">
                  <?php echo esc_html($description); ?>
                </p>
              <?php endif; ?>
            <?php }?>
          </div>
        </div>
        <div class="col-lg-8 col-md-8 col-4 align-self-lg-center">
          <?php if(has_nav_menu('primary')){ ?>
            <div class="toggle-nav mobile-menu">
              <button onclick="vw_mobile_app_menu_open_nav()" class="responsivetoggle"><i class="<?php echo esc_attr(get_theme_mod('vw_mobile_app_res_open_menu_icon','fas fa-bars')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Open Button','vw-mobile-app'); ?></span></button>
            </div> 
          <?php } ?>
          <div id="mySidenav" class="nav sidenav">
            <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'vw-mobile-app' ); ?>">
              <?php 
                if(has_nav_menu('primary')){
                  wp_nav_menu( array( 
                    'theme_location' => 'primary',
                    'container_class' => 'main-menu clearfix' ,
                    'menu_class' => 'clearfix',
                    'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                    'fallback_cb' => 'wp_page_menu',
                  ) ); 
                } 
              ?>
              <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="vw_mobile_app_menu_close_nav()"><i class="<?php echo esc_attr(get_theme_mod('vw_mobile_app_res_close_menus_icon','fas fa-times')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Close Button','vw-mobile-app'); ?></span></a>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>