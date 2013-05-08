<?php
/**
 * @file template.php
 *
 * @TODO: add touch icons via preprocessing, see mothership
 */

/**
 * Override or insert variables into the html template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered. This is usually "html", but can
 *   also be "maintenance_page" since zen_preprocess_maintenance_page() calls
 *   this function to have consistent variables.
 */
function training_two_preprocess_html(&$variables, $hook) {
  // Add variables and paths needed for HTML5 and responsive support.
  $variables['base_path'] = base_path();
  $variables['theme_path'] = drupal_get_path('theme', 'training_two');

  $variables['add_respond_js']      = FALSE;
  $variables['add_html5_shim']      = TRUE;
  $variables['add_responsive_meta'] = TRUE;


  // Attributes for html element.
  $variables['html_attributes_array'] = array(
    'lang' => $variables['language']->language,
    'dir' => $variables['language']->dir,
  );

  // Classes for body element. Allows advanced theming based on context
  // (home page, node of certain type, etc.)
  if (!$variables['is_front'] && $hook == 'html') {
    // Add unique class for each page.
    $path = drupal_get_path_alias($_GET['q']);
    // Add unique class for each website section.
    list($section, ) = explode('/', $path, 2);
    $arg = explode('/', $_GET['q']);
    if ($arg[0] == 'node') {
      if ($arg[1] == 'add') {
        $section = 'node-add';
      }
      elseif (isset($arg[2]) && is_numeric($arg[1]) && ($arg[2] == 'edit' || $arg[2] == 'delete')) {
        $section = 'node-' . $arg[2];
      }
    }
    $variables['classes_array'][] = drupal_html_class('section-' . $section);
  }

  // Store the menu item since it has some useful information.
  if ($hook == 'html') {
    $variables['menu_item'] = menu_get_item();
    if ($variables['menu_item']) {
      switch ($variables['menu_item']['page_callback']) {
        case 'views_page':
          // Is this a Views page?
          $variables['classes_array'][] = 'page-views';
          break;
        case 'page_manager_page_execute':
        case 'page_manager_node_view':
        case 'page_manager_contact_site':
          // Is this a Panels page?
          $variables['classes_array'][] = 'page-panels';
          break;
      }
    }
  }

}

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
function training_two_process_html(&$variables, $hook) {
  // Flatten out html_attributes.
  $variables['html_attributes'] = drupal_attributes($variables['html_attributes_array']);
}

/**
 * Override or insert variables in the html_tag theme function.
 *
 * @param type $variables
 */
function training_two_process_html_tag(&$variables) {
  $tag = &$variables['element'];

  if ($tag['#tag'] == 'style' || $tag['#tag'] == 'script') {
    // Remove redundant type attribute and CDATA comments.
    unset($tag['#attributes']['type'], $tag['#value_prefix'], $tag['#value_suffix']);

    // Remove media="all" but leave others unaffected.
    if (isset($tag['#attributes']['media']) && $tag['#attributes']['media'] === 'all') {
      unset($tag['#attributes']['media']);
    }
  }
}

/**
 * Implement hook_html_head_alter().
 *
 * @param array $head
 */
function training_two_html_head_alter(&$head) {
  // Simplify the meta tag for character encoding.
  $head['system_meta_content_type']['#attributes'] = array('charset' => str_replace('text/html; charset=', '', $head['system_meta_content_type']['#attributes']['content']));
}

/**
 * Override or insert variables into the page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function training_two_preprocess_page(&$variables, $hook) {
  // remove default message from main content if there is no content created yet.
  unset($variables['page']['content']['system_main']['default_message']);
}

/**
 * Override or insert variables into the page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 */
function training_two_process_page(&$variables) {

  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
  // Since the title and the shortcut link are both block level elements,
  // positioning them next to each other is much simpler with a wrapper div.
  if (!empty($variables['title_suffix']['add_or_remove_shortcut']) && $variables['title']) {
    // Add a wrapper div using the title_prefix and title_suffix render elements.
    $variables['title_prefix']['shortcut_wrapper'] = array(
      '#markup' => '<div class="shortcut-wrapper clearfix">',
      '#weight' => 100,
    );
    $variables['title_suffix']['shortcut_wrapper'] = array(
      '#markup' => '</div>',
      '#weight' => -99,
    );
    // Make sure the shortcut link is the first item in title_suffix.
    $variables['title_suffix']['add_or_remove_shortcut']['#weight'] = -100;
  }

}

/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
function training_two_preprocess_maintenance_page(&$variables, $hook) {
  training_two_preprocess_html($variables, $hook);
}

/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
function training_two_process_maintenance_page(&$variables, $hook) {
  training_two_process_html($variables, $hook);
  // Ensure default regions get a variable. Theme authors often forget to remove
  // a deleted region's variable in maintenance-page.tpl.
  $regions = array(
      'help',
      'toolbar',
      'header',
      'navigation',
      'highlighted',
      'content_top',
      'content',
      'content_bottom',
      'sidebar_first',
      'sidebar_second',
      'footer_first',
      'footer_second',
      'footer_third',
      'footer_fourth',
      'footer'
      );
  foreach ($regions as $region) {
    if (!isset($variables[$region])) {
      $variables[$region] = '';
    }
  }
  training_two_process_page($variables);
}

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function training_two_preprocess_node(&$variables, $hook) {
  // Add $unpublished variable.
  $variables['unpublished'] = (!$variables['status']) ? TRUE : FALSE;

  // Add pubdate to submitted variable.
  $variables['pubdate'] = '<time pubdate datetime="' . format_date($variables['node']->created, 'custom', 'c') . '">' . $variables['date'] . '</time>';
  if ($variables['display_submitted']) {
    $variables['submitted'] = t('Submitted by !username on !datetime', array('!username' => $variables['name'], '!datetime' => $variables['pubdate']));
  }

  // Add a class for the view mode.
  if (!$variables['teaser']) {
    $variables['classes_array'][] = 'view-mode-' . $variables['view_mode'];
  }
  // Add a class to indicate preview state
  if (isset($variables['preview'])) {
    $variables['classes_array'][] = 'node-preview';
  }
  // Add a class to show node is authored by current user.
  if ($variables['uid'] && $variables['uid'] == $GLOBALS['user']->uid) {
    $variables['classes_array'][] = 'node-by-viewer';
  }

  $variables['title_attributes_array']['class'][] = 'node-title';

  $type = $variables['type'];
  $view_mode = $variables['view_mode'];
  /*
  //add a template suggestion for node teasers
  $variables['theme_hook_suggestions'][] = 'node__' . $view_mode;
  $variables['theme_hook_suggestions'][] = 'node__' . $type . '__' . $view_mode;
  */

  /*
  // add a CSS file for slideshow nodes only
  if ($type == 'slideshow_item' && $view_mode == 'teaser') {
    drupal_add_css(path_to_theme() . '/css/slideshow-item.css', array('group' => CSS_THEME));
  }
  */

  /*
  // add a class to article nodes reflecting subtype
  if ($type == 'article') {
    $article_type = field_get_items('node', $variables['node'], 'field_article_type');
    if (!empty($article_type)) {
      $variables['classes_array'][] = 'article-type-' . drupal_html_class($article_type[0]['value']);
    }
  }
  */
}

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
function training_two_preprocess_comment(&$variables, $hook) {
  // If comment subjects are disabled, don't display them.
  if (variable_get('comment_subject_field_' . $variables['node']->type, 1) == 0) {
    $variables['title'] = '';
  }

  // Add pubdate to submitted variable.
  $variables['pubdate'] = '<time pubdate datetime="' . format_date($variables['comment']->created, 'custom', 'c') . '">' . $variables['created'] . '</time>';
  $variables['submitted'] = t('!username replied on !datetime', array('!username' => $variables['author'], '!datetime' => $variables['pubdate']));

  // Zebra striping.
  if ($variables['id'] == 1) {
    $variables['classes_array'][] = 'first';
  }
  if ($variables['id'] == $variables['node']->comment_count) {
    $variables['classes_array'][] = 'last';
  }
  $variables['classes_array'][] = $variables['zebra'];

  $variables['title_attributes_array']['class'][] = 'comment-title';
}

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function training_two_preprocess_block(&$variables, $hook) {

  $variables['classes_array'][] = $variables['block_zebra'];

  $variables['title_attributes_array']['class'][] = 'block-title';

  // Add Aria Roles via attributes.
  // Suggest a navigation block template if appropriate.
  switch ($variables['block']->module) {
    case 'admin':
      switch ($variables['block']->delta) {
        case 'menu':
          // Suggest a navigation block template and set role
          $variables['theme_hook_suggestions'][] = 'block__navigation';
          $variables['attributes_array']['role'] = 'navigation';
          break;
      }
      break;
    case 'system':
      switch ($variables['block']->delta) {
        case 'main':
          // Note: the "main" role goes in the page.tpl, not here.
          // Use a template with no wrapper for the page's main content.
          $variables['theme_hook_suggestions'][] = 'block__no_wrapper';
          break;
        case 'help':
        case 'powered-by':
          $variables['attributes_array']['role'] = 'complementary';
          break;
        default:
          // Any other "system" block is a menu block.
          $variables['theme_hook_suggestions'][] = 'block__navigation';
          $variables['attributes_array']['role'] = 'navigation';
          break;
      }
      break;
    case 'menu':
    case 'menu_block':
    case 'blog':
    case 'book':
    case 'comment':
    case 'forum':
    case 'shortcut':
    case 'statistics':
      $variables['theme_hook_suggestions'][] = 'block__navigation';
      $variables['attributes_array']['role'] = 'navigation';
      break;
    case 'search':
      $variables['attributes_array']['role'] = 'search';
      break;
    case 'help':
    case 'aggregator':
    case 'locale':
    case 'poll':
    case 'profile':
      $variables['attributes_array']['role'] = 'complementary';
      break;
    case 'node':
      switch ($variables['block']->delta) {
        case 'syndicate':
          $variables['attributes_array']['role'] = 'complementary';
          break;
        case 'recent':
          $variables['theme_hook_suggestions'][] = 'block__navigation';
          $variables['attributes_array']['role'] = 'navigation';
          break;
      }
      break;
    case 'user':
      switch ($variables['block']->delta) {
        case 'login':
          $variables['attributes_array']['role'] = 'form';
          break;
        case 'new':
        case 'online':
          $variables['attributes_array']['role'] = 'complementary';
          break;
      }
      break;
  }
    // In some regions, visually hide the title of any block, but leave it accessible.
    $region = $variables['block']->region;
    if ($region == 'header' ||
        $region == 'navigation' ||
        $region == 'highlighted' ||
        $region == 'tools') {
        $variables['title_attributes_array']['class'][] = 'element-invisible';
    }
}

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function training_two_process_block(&$variables, $hook) {
  // Drupal 7 should use a $title variable instead of $block->subject.
  $variables['title'] = $variables['block']->subject;
}

/**
 * --------------------- Preprocessing for contrib -----------------------------
 */

/**
 * template_preprocess_views_view_unformatted().
 * Add a suggestion for grouped views to wrap row groups and their headlines.
 *
 * @param type $variables
 *  An array of variables to pass to the view.
 */
function training_two_preprocess_views_view_unformatted(&$variables){
  if(!empty($variables['options']['grouping'])) {
    $variables['theme_hook_suggestions'][] = 'views_view_unformatted__grouping';
  }
}

/**
 * --------------------- Override theme functions ------------------------------
 */

/**
 * Implement theme_field()
 * Reduce markup generated for default field
 *
 * @param type $variables
 *  field variables
 * @return string
 */
function training_two_field($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<div class="field-label"' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;</div>';
  }

  // Render a wrapper for the field items, if label is inline
  $count = count($variables['items']);
  if ($variables['element']['#label_display'] == 'inline') {
    $output .= '<div class="field-items"' . $variables['content_attributes'] . '>';
  }
  // Render the items.
  foreach ($variables['items'] as $delta => $item) {
    $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even') . ($delta == 0 ? ' first' : '') . ($delta == ($count - 1) ? ' last' : '');
    $output .= '<div class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
  }
  // Render a wrapper for the field items, if label is inline.
  if ($variables['element']['#label_display'] == 'inline') {
    $output .= '</div>';
  }

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';

  return $output;
}




/**
 * Override theme_tablesort_indicator()
 *
 * @param  Array $variables
 * @return String
 */
function training_two_tablesort_indicator($variables) {
  if ($variables['style'] == "asc") {
    return '<div class="table-order-asc"></div>';
  }
  else {
    return '<div class="table-order-desc"></div>';
  }
}

/**
 * Override theme_breadcrumb()
 * output markup with HTML5
 *
 * @param $variables
 *   An associative array containing:
 *   - breadcrumb: An array containing the breadcrumb links.
 */
function training_two_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  $output = '';
  if (!empty($breadcrumb)) {
    $output .= '<nav role="navigation" class="breadcrumb">';
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output .= '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    $output .= '<ol><li>' . implode(' » </li><li>', $breadcrumb) . '</li></ol>';
    $output .= '</nav>';
  }
  return $output;
}

/**
 * Override theme_file_link()
 * Remove img icons from generic file and display them with css instead
 *
 * @param type $variables
 * @return type
 */
function training_two_file_link($variables) {
  $file = $variables['file'];

  $url = file_create_url($file->uri);

  // Set options as per anchor format described at
  // http://microformats.org/wiki/file-format-examples
  $options = array(
    'attributes' => array(
      'type' => $file->filemime . '; length=' . $file->filesize,
    ),
  );

  // Use the description as the link text if available.
  $mimeclass = 'mime-' . drupal_html_class($file->filemime) ;
  if (empty($file->description)) {
    $link_text = '<div class="file-icon"></div>' . $file->filename;
  }
  else {
    $link_text = '<div class="file-icon"></div>' . $file->description;
    $options['attributes']['title'] = check_plain($file->filename);
  }

  $options['attributes']['class'] = array($mimeclass);
  $options['html'] = TRUE;

  return '<div class="file">' . l($link_text, $url, $options) . '</div>';
}



/**
 * --------------------- Override theme functions for forms --------------------
 */

/**
 * Override theme_form()
 *    remove wrapping div
 *
 * @param  Array $variables
 *    Contains form variables
 * @return String
 */
function training_two_form($variables) {
  $element = $variables['element'];
  if (isset($element['#action'])) {
    $element['#attributes']['action'] = drupal_strip_dangerous_protocols($element['#action']);
  }
  element_set_attributes($element, array('method', 'id'));
  if (empty($element['#attributes']['accept-charset'])) {
    $element['#attributes']['accept-charset'] = "UTF-8";
  }

  return '<form' . drupal_attributes($element['#attributes']) . '>' . $element['#children'] . '</form>';
}



/**
 * Override theme_textarea().
 * Returns HTML for a textarea form element with optional placeholder.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties of the element.
 *     Properties used: #title, #value, #description, #rows, #cols,
 *     #placeholder, #required, #attributes
 *
 */
function training_two_textarea($variables) {
  $element = $variables['element'];
  element_set_attributes($element, array('id', 'name', 'rows', 'cols', 'placeholder'));
  _form_set_class($element, array('form-textarea'));

  $wrapper_attributes = array(
    'class' => array('form-textarea-wrapper'),
  );

  // Add resizable behavior.
  if (!empty($element['#resizable'])) {
    drupal_add_library('system', 'drupal.textarea');
    $wrapper_attributes['class'][] = 'resizable';
  }

  $output = '<div' . drupal_attributes($wrapper_attributes) . '>';
  $output .= '<textarea' . drupal_attributes($element['#attributes']) . '>' . check_plain($element['#value']) . '</textarea>';
  $output .= '</div>';
  return $output;
}

/**
 * Returns HTML for a password form element.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties of the element.
 *     Properties used: #title, #value, #description, #size, #maxlength,
 *     #placeholder, #required, #attributes.
 *
 * @ingroup themeable
 */
function training_two_password($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'password';
  element_set_attributes($element, array('id', 'name', 'size', 'maxlength', 'placeholder'));
  _form_set_class($element, array('form-text'));

  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}
