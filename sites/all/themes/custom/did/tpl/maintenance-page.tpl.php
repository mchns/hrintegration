<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page while offline.
 *
 * All the available variables are mirrored in html.tpl.php and page.tpl.php.
 * Some may be blank but they are provided for consistency.
 *
 * @see template_preprocess()
 * @see template_preprocess_maintenance_page()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <style>
    * {
      margin: 0;
      padding: 0;
    }
    
    body {
      background: #fff;
    }
    
    #logo {
      display: block;
      float: none;
      margin-bottom: 30px;
    }
    
    #maintenance {
      width: 280px;
      margin: 80px auto 0 auto;
      text-align: center;
    }
  </style>
</head>
<body class="<?php print $classes; ?>">
  <div id="maintenance">
    <?php if (!empty($logo)): ?>
      <a href="<?php print $base_path; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
    <?php endif; ?>        
    <?php print $content; ?>
  </div>
</body>
</html>
