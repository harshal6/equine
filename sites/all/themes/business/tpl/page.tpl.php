
<div id="page" <?php print $page_css ?>>
  <?php if(isset($page['show_skins_menu']) && $page['show_skins_menu']):?>
    <?php print $page['show_skins_menu'];?>
  <?php endif;?>

  <?php if($headline = render($page['headline'])): ?>
    <section id="headline-wrapper" class="wrapper">
      <div class="container">
        <?php print $headline; ?>
      </div>
    </section>
  <?php endif;?>

  <header id="header-wrapper" class="wrapper">
    <div class="container">

      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>

      <?php if ($site_name || $site_slogan): ?>
        <div id="name-and-slogan">
          <?php if ($site_name): ?>
            <?php if ($title): ?>
              <div id="site-name"><strong>
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </strong></div>
            <?php else: /* Use h1 when the content title is empty */ ?>
              <h1 id="site-name">
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </h1>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ($site_slogan): ?>
            <div id="site-slogan"><?php print $site_slogan; ?></div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      
      <?php print render($page['header']); ?>
    </div>
  </header>

  <?php if($main_menu = render($page['main_menu'])): ?>
    <nav id="main-menu-wrapper" class="navbar navbar-default" role="navigation">
      <div class="container">
        <?php if($search = render($page['search'])): ?>
          <?php print $search; ?>
        <?php endif; ?>
        <a id="menu-toggle" class="navbar-toggle" href="#menu-toggle">
          <span class="title">Menu</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <div class="collapse navbar-collapse" id="main-menu-inner">
          <?php print $main_menu; ?>
        </div>
      </div>
    </nav>
  <?php endif;?>

  <?php if(($slideshow = render($page['slideshow']))): ?>
    <section id="slideshow-wrapper" class="wrapper">
      <div class="container">
        <?php print $slideshow;?>
      </div>
    </section>
  <?php endif;?>

  <?php if ($messages): ?>
    <section id="messages-wrapper" class="wrapper">
      <div class="container">
        <?php print $messages; ?>
      </div>
    </section>
  <?php endif;?>

  <?php if($panel_first): ?>
    <section id="panel-first-wrapper" class="wrapper panel">
      <div class="container">
        <div class="row">
          <?php print $panel_first;?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if($panel_featured): ?>
    <section id="panel-featured-wrapper" class="wrapper panel">
      <div class="container">
        <div class="row">
          <?php print $panel_featured;?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if($panel_second): ?>
    <section id="panel-second-wrapper" class="wrapper panel">
      <div class="container">
        <div class="row">
          <?php print $panel_second;?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($title): ?>
    <section id="title-wrapper" class="wrapper">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php print render($title_prefix); ?>
            <h1 class="title" id="page-title"><?php print $title; ?></h1>
            <?php print render($title_suffix); ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <section id="main-wrapper" class="wrapper">
    <div id="main" class="container">
      <div class="row">
        <div class="col-lg-<?php print $regions_width['content']?> col-md-<?php print $regions_width['content']?> col-sm-12 col-xs-12">
          <div id="content" class="column">
            <div class="section">
              <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
              <a id="main-content"></a>
              <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
              <?php print render($page['help']); ?>
              <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
              <?php print render($page['content']); ?>
            </div>
          </div>
        </div>
        <?php if ($regions_width['sidebar_first']): ?>
          <aside id="sidebar-first" class="sidebar col-lg-<?php print $regions_width['sidebar_first']?> col-md-<?php print $regions_width['sidebar_first']?> col-sm-12 col-xs-12">
            <div class="section">
              <?php print render($page['sidebar_first']); ?>
            </div>
          </aside>
        <?php endif; ?>
        <?php if ($page['sidebar_second']): ?>
          <aside id="sidebar-second" class="sidebar col-lg-<?php print $regions_width['sidebar_second']?> col-md-<?php print $regions_width['sidebar_second']?> col-sm-12 col-xs-12">
            <div class="section">
              <?php print render($page['sidebar_second']); ?>
            </div>
          </aside>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <?php if($panel_third): ?>
    <section id="panel-third-wrapper" class="wrapper panel">
      <div class="container">
        <div class="row">
          <?php print $panel_third;?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if($panel_fourth): ?>
    <section id="panel-fourth-wrapper" class="wrapper panel">
      <div class="container">
        <div class="row">
          <?php print $panel_fourth;?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if($panel_fifth): ?>
    <section id="panel-fifth-wrapper" class="wrapper panel">
      <div class="container">
        <div class="row">
          <?php print $panel_fifth;?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($breadcrumb): ?>
    <section id="breadcrumb-wrapper" class="wrapper">
      <div class="container">
        <?php print $breadcrumb; ?>
      </div>
    </section>
  <?php endif; ?>

  <footer id="footer-wrapper" class="wrapper">
    <div class="container">
      <?php print render($page['footer']); ?>
    </div>
  </footer>
  <a class="btn-btt" href="#"></a>
</div>