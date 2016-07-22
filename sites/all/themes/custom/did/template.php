<?php
/*
 * Implements hook_css_alter
 */ 
function did_css_alter(&$css) {
  // verberg css files die door drupal worden gegenereerd
  unset($css['modules/system/system.base.css']);
  unset($css['modules/system/system.menus.css']);
  unset($css['modules/system/system.theme.css']);
  unset($css['sites/all/modules/contrib/field_collection/field_collection.theme.css']);
}


/*
 * Theme pager
 */ 
function did_pager($variables) {
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }
  // End of generation loop preparation.

  $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('First')), 'element' => $element, 'parameters' => $parameters));
  $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('Previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('Next')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('Last')), 'element' => $element, 'parameters' => $parameters));

  if ($pager_total[$element] > 1) {
    if ($li_first) {
      $items[] = array(
        'class' => array('pager-first'), 
        'data' => $li_first,
      );
    }
    if ($li_previous) {
      $items[] = array(
        'class' => array('pager-previous'), 
        'data' => $li_previous,
      );
    }

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          'class' => array('pager-ellipsis'), 
          'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            'class' => array('pager-item'), 
            'data' => theme('pager_previous', array('text' => sprintf('%02d', $i), 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            'class' => array('pager-current'), 
            'data' => '<strong>'. sprintf('%02d', $i) .'</strong>',
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            'class' => array('pager-item'), 
            'data' => theme('pager_next', array('text' => sprintf('%02d', $i), 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => array('pager-ellipsis'), 
          'data' => '…',
        );
      }
    }
    // End generation.
    if ($li_last) {
      $items[] = array(
        'class' => array('pager-last'), 
        'data' => $li_last,
      );
    }
    if ($li_next) {
      $items[] = array(
        'class' => array('pager-next'), 
        'data' => $li_next,
      );
    }
    return '<h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
      'items' => $items, 
      'attributes' => array('class' => array('pager', 'clearfix')),
    ));
  }
}

/**
 * Preprocess variables for node.tpl.php
 */
function did_preprocess_node(&$vars) {  
  /* markup for both teasers and pages */
  if (variable_get('node_submitted_' . $vars['node']->type, TRUE)) {
    $vars['datetime'] = format_date($vars['created'], 'custom', 'F j, Y');
    
    $vars['submitted'] = t('!datetime',
      array(
        '!datetime' => $vars['datetime'],
      )
    );    
  }
  else {
    $vars['submitted'] = '';
  }
  
  /* teaser specific markup */
  if($vars['teaser']) {
    // strip html tags in teaser en toon enkel de eerste body
    for ($i=0; isset($vars['content']['body'][$i]['#markup']) ; $i++) {
      if($i > 0) {
        unset($vars['content']['body'][$i]);
      }
      else {
        $vars['content']['body'][$i]['#markup'] = '<p>'. strip_tags($vars['content']['body'][$i]['#markup']) .'</p>';        
      }
      
    }
  }
  /* page specifig markup */
  else {
    
  }
}

function did_preprocess_page(&$vars) {
  $vars['show_h1'] = (isset($vars['node']) ? FALSE: TRUE);
  if(isset($vars['node']) && $vars['node']->type == 'work_package' && $vars['node']->field_title_prefix['und'][0]['value']) {
    $vars['node']->title = $vars['node']->field_title_prefix['und'][0]['value'] .'. '. $vars['node']->title; 
  }
  
  $vars['back_link'] = '';
  if(isset($vars['node']->type)) {
    switch ($vars['node']->type) {
      case 'work_package':
        $vars['back_link'] = l('Back to project overview', 'work-package');
        break;
        
      case 'staff':
        $vars['back_link'] = l('Back to team overview', 'team');
        break;
        
      case 'article':
        $article_type = (!empty($vars['node']->field_type['und'][0]['value']) ? $vars['node']->field_type['und'][0]['value'] : $vars['node']->field_type[0]['value']);
        switch ($article_type) {
          case 'event':
            $vars['back_link'] = l('View all events', 'events');
            break;
            
          case 'publication':
            $vars['back_link'] = l('View all publications', 'publications');
            break;
            
          case 'conference':
            $vars['back_link'] = l('View all conferences', 'conferences');
            break;
          
          default:
            $vars['back_link'] = l('View all news', 'news');
            break;
        }        
        break; // article
      
      default:
        
        break;
    }
  }
}

function did_preprocess_html(&$vars) {
}

function _did_var($var_name, $new_val = NULL) {
  $vars = &drupal_static(__FUNCTION__, array());

  // If a new value has been passed
  if ($new_val) {
    $vars[$var_name] = $new_val;
  }

  return isset($vars[$var_name]) ? $vars[$var_name] : NULL;
}




?>