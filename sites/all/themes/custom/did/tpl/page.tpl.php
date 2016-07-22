<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 */
?>
<div id="wrapper">
  <div id="header">
    <div class="padder">
      <div class="center">
        <div class="clearfix"> 
          <?php if ($logo && $site_name): ?>
            <div id="logo">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
                <img src="<?php print $logo; ?>" alt="<?php print t('Logo') . ' ' . $site_name; ?>" />
              </a>
            </div><!-- #logo -->
          <?php endif; ?>
          <div id="slogan"><?php print t('<strong>The Global Challenge of Human Rights Integration: <br />Towards a Users’ Perspective</strong> (HRI)'); ?></div>
          <ul id="more-logos">
            <li><a href="http://www.belspo.be/" title="Belspo"><img src="/sites/all/themes/custom/did/img/logo-belspo.jpg"></a></li>
            <li><a href="http://www.belspo.be/belspo/iap/index_en.stm"><img src="/sites/all/themes/custom/did/img/logo-iap.jpg"></a></li>
          </ul>
        </div>
      </div>
    </div>
          
    <?php if ($main_menu): ?>
      <div id="nav"><div class="padder"><div class="center"><?php print theme('links__system_main_menu', array('links' => $main_menu)); ?></div></div></div>
    <?php endif; ?>
      
    <?php print render($page['header']); ?>
  </div><?php // #header ?>
          
  <?php if ($back_link): ?>
    <div id="back-link"><div class="padder"><div class="center"><?php print $back_link; ?></div></div></div>
  <?php endif; ?>
  
  <div id="main">
    <div class="padder clearfix">
      <div class="center"> 
        <?php if ($page['sidebar_first']): ?>
          <div id="left">
              <?php print render($page['sidebar_first']); ?>
          </div><?php // #left ?>
        <?php endif; ?>
        
        <div id="content">
          <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
          <?php if($show_h1): ?>
            <?php print render($title_prefix); ?>            
            <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
            <?php print render($title_suffix); ?>
          <?php endif; ?>
          <?php if(!empty($messages)): ?><div id="messages"><?php print $messages; ?></div><?php endif; ?>        
          <?php print render($page['help']); ?>
          <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
          <?php print render($page['content']); ?>
          <?php print $feed_icons; ?>
        </div><?php // #content ?>
      
        <?php if ($page['sidebar_second']): ?>
          <div id="right">
              <?php print render($page['sidebar_second']); ?>
          </div><?php // #right ?>
        <?php endif; ?>
      </div>
    </div>
  </div><?php // #main ?>
  
  <?php if(!empty($page['after'])): ?>
    <div id="after-content">
      <?php print render($page['after']); ?>      
    </div>
  <?php endif; ?>
  
  <div id="footer">
    <div class="padder">
      <div class="center clearfix">
          <?php print render($page['footer']); ?>
          <ul id="footer-links">
            <li class="first">&copy; <?php print date('Y'); ?> Human Rights Integration</li>
            <li><?php print l(t('Contact'), 'node/40'); ?></li>
          </ul>
          <p id="back-to-top"><a href="#main">Back to top</a></p>      
      </div>
    </div>
  </div> <!-- #footer -->

</div><?php // #wrapper ?>
<?php if(!empty($tabs)): ?><div id="tabs"><?php print render($tabs); ?></div><?php endif; ?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-37573309-1']);
  _gaq.push(['_setDomainName', 'hrintegration.be']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>
