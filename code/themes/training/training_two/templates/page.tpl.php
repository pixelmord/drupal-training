<?php

/**
 * @file
 * Snowcrash base theme implementation to display a single Drupal page.
 *
 * Available variables:
 * for info on available variables see modules/system/page.tpl.php
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
 * @see template_preprocess_page()
 * @see template_process()
 */
?>

  <div id="page-wrapper"><div id="page">

    <?php if ($page['tools']): ?>
      <section id="tools">
        <?php print render($page['tools']); ?>
      </section> <!-- /#toolbar-->
    <?php endif; ?>

    <header id="header" role="banner">

      <?php print render($page['header']); ?>

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


      <nav id="navigation">
        <div class="navbar">
            <div class="navbar-inner">
              <div class="container">
                <?php print theme('links__system_main_menu', array(
                                                                  'links' => $main_menu,
                                                                  'attributes' => array(
                                                                    'id' => 'main-menu-links',
                                                                  ),
                                                                  'heading' => array(
                                                                    'text' => t('Main menu'),
                                                                    'level' => 'h2',
                                                                    'class' => array('element-invisible'),
                                                                  ),
                                                             )); ?>
              </div>
            </div> <!-- /.navbar-innerr -->
          </div> <!-- /.navbar -->
        <?php print render($page['navigation']); ?>
      </nav> <!-- /#splash-->


    <?php if ($page['highlighted']): ?>
      <section id="highlighted">
        <?php print render($page['highlighted']); ?>
      </section> <!-- /#splash-->
    <?php endif; ?>

    <div id="main">

      <?php print $messages; ?>

      <div id="content">
        <?php if ($page['content_top']): ?>
          <section id="content_top"><?php print render($page['content_top']); ?></section>
        <?php endif; ?>

        <div role="main">
          <a id="main-content"></a>
          <?php print render($title_prefix); ?>
          <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
          <?php print render($title_suffix); ?>

          <?php if (!empty($tabs['#primary']) || !empty($action_links)): ?>
            <nav id="content-author-navigation">
              <?php if (!empty($tabs['#primary'])): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
              <?php print render($page['help']); ?>
              <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
            </nav>
          <?php endif; ?>

          <?php print render($page['content']); ?>

          <?php print $feed_icons; ?>
        </div>

        <?php if ($page['content_bottom']): ?>
          <section id="content_bottom"><?php print render($page['content_bottom']); ?></section>
        <?php endif; ?>

      </div> <!-- /#content -->

      <?php if ($page['sidebar_first']): ?>
        <aside id="sidebar-first">
          <?php print render($page['sidebar_first']); ?>
        </aside> <!-- /#sidebar-first -->
      <?php endif; ?>

      <?php if ($page['sidebar_second']): ?>
        <aside id="sidebar-second">
          <?php print render($page['sidebar_second']); ?>
        </aside> <!-- /.section, /#sidebar-second -->
      <?php endif; ?>

    </div> <!-- /#main -->

    <div id="footer-wrapper">

      <?php if ($page['footer_first'] || $page['footer_second'] || $page['footer_third'] || $page['footer_fourth']): ?>
          <div id="footer-navigation">
          <div class="section-first"><?php print render($page['footer_first']); ?></div>
          <div class="section-second"><?php print render($page['footer_second']); ?></div>
          <div class="section-third"><?php print render($page['footer_third']); ?></div>
          <div class="section-fourth"><?php print render($page['footer_fourth']); ?></div>
        </div> <!-- /#footer-navigation -->
      <?php endif; ?>

      <?php if ($page['footer']): ?>
        <footer id="footer" role="contentinfo">
          <?php print render($page['footer']); ?>
        </footer> <!-- /#footer -->
      <?php endif; ?>

    </div> <!-- /#footer-wrapper -->

  </div></div> <!-- /#page, /#page-wrapper -->
