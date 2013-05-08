<?php

/**
 * @file
 * Zen theme's implementation to display a single Drupal page while offline.
 *
 * All the available variables are mirrored in html.tpl.php and page.tpl.php.
 * Some may be blank but they are provided for consistency.
 *
 * Regions:
 * - $page['toolbar'] : Items for Toolbar
 * - $page['header']: Items for the header region.
 * - $page['navigation'] : Items for Navigation
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content_top'] : Items for Content top
 * - $page['content']: The main content of the current page.
 * - $page['content_bottom'] : Items for Content bottom
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['footer_first'] : Items for Footer first
 * - $page['footer_second'] : Items for Footer second
 * - $page['footer_third'] : Items for Footer third
 * - $page['footer_fourth'] : Items for Footer fourth
 * - $page['footer_closure']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_maintenance_page()
 */
?>
<!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7" <?php print $html_attributes; ?>><![endif]-->
<!--[if (lte IE 6)&(!IEMobile)]><html class="ie6 ie6-7 ie6-8" <?php print $html_attributes; ?>><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="ie7 ie6-7 ie6-8" <?php print $html_attributes; ?>><![endif]-->
<!--[if (IE 8)&(!IEMobile)]><html class="ie8 ie6-8" <?php print $html_attributes; ?>><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html <?php print $html_attributes . $rdf_namespaces; ?>><!--<![endif]-->
<head profile="<?php print $grddl_profile; ?>">
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  
  <?php if ($add_responsive_meta): ?>
    <meta name="viewport" content="width=device-width, target-densityDpi=160dpi, initial-scale=1">
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes">
  <?php endif; ?>
  <meta http-equiv="cleartype" content="on">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  
  <?php if ($add_respond_js): ?>
    <!--[if lt IE 9]>
    <script src="<?php print $base_path . $theme_path; ?>/js/html5-respond.js"></script>
    <![endif]-->
  <?php elseif ($add_html5_shim): ?>
    <!--[if lt IE 9]>
    <script src="<?php print $base_path . $theme_path; ?>/js/html5.js"></script>
    <![endif]-->
  <?php endif; ?>
  <?php print $styles; ?>
  
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  
  <div id="page-wrapper"><div id="page">
      
    <header id="header" role="banner">

      <?php print $header; ?>

      <div id="identity">
        <?php if ($logo): ?>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
            <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
          </a>
        <?php endif; ?>

        <?php if ($site_name || $site_slogan): ?>
          <hgroup id="name-and-slogan">
            <?php if ($site_name): ?>
              <?php if ($title): ?>
                <div id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>><strong>
                  <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
                </strong></div>
              <?php else: /* Use h1 when the content title is empty */ ?>
                <h1 id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>>
                  <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
                </h1>
              <?php endif; ?>
            <?php endif; ?>

            <?php if ($site_slogan): ?>
              <h2 id="site-slogan"<?php if ($hide_site_slogan) { print ' class="element-invisible"'; } ?>><?php print $site_slogan; ?></h2>
            <?php endif; ?>
          </hgroup> <!-- /#name-and-slogan -->
        <?php endif; ?>
      </div>
      
    </header> <!-- /#header -->

    <?php if ($page['navigation']): ?>
      <nav id="navigation">
        <?php print render($page['navigation']); ?>
      </nav> <!-- /#splash-->
    <?php endif; ?>

    <?php if ($highlighted): ?>
      <section id="highlighted">
        <?php print $highlighted; ?>
      </section> <!-- /#splash-->
    <?php endif; ?>
      
    <div id="main-wrapper"><div id="main">

      <?php print $messages; ?>

      <div id="content">
        <?php if ($content_top): ?>
          <section id="content_top"><?php print $content_top; ?></section>
        <?php endif; ?>

        <div role="main">
          <a id="main-content"></a>
          <?php print render($title_prefix); ?>
          <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
          <?php print render($title_suffix); ?>
          
          <?php print $content; ?>
          
          <?php print $feed_icons; ?>
        </div>

        <?php if ($content_bottom): ?>
          <section id="content_bottom"><?php print $content_bottom; ?></section>
        <?php endif; ?>

      </div> <!-- /#content -->

      <?php if ($sidebar_first): ?>
        <aside id="sidebar-first">
          <?php print $sidebar_first; ?>
        </aside> <!-- /#sidebar-first -->
      <?php endif; ?>

      <?php if ($sidebar_second): ?>
        <aside id="sidebar-second">
          <?php print $sidebar_second; ?>
        </aside> <!-- /#sidebar-second -->
      <?php endif; ?>

    </div></div> <!-- /#main, /#main-wrapper -->

    <div id="footer-wrapper">

      <?php if ($footer_first || $footer_second || $footer_third || $footer_fourth): ?>
          <div id="footer-navigation">
          <div class="section-first"><?php print $footer_first; ?></div>
          <div class="section-second"><?php print $footer_second; ?></div>
          <div class="section-third"><?php print $footer_third; ?></div>
          <div class="section-fourth"><?php print $footer_fourth; ?></div>
        </div> <!-- /#footer-navigation -->
      <?php endif; ?>

      <?php if ($footer): ?>
        <footer id="footer" role="contentinfo">
          <?php print $footer; ?>
        </footer> <!-- /#footer -->
      <?php endif; ?>

    </div> <!-- /#footer-wrapper -->

  </div></div> <!-- /#page, /#page-wrapper -->
  
  <?php print $scripts; ?>  
  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
  chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
</body>
</html>