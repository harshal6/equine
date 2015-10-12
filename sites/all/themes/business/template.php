<?php
include_once(drupal_get_path('theme', 'business') . '/common.inc');

function business_theme() {
  $items = array();
  $items['render_panel'] = array(
    "variables" => array(
      'page' => array(),
      'panels_list' => array(),
      'panel_regions_width' => array(),
      ),
    'preprocess functions' => array(
      'business_preprocess_render_panel'
      ),
    'template' => 'panel',
    'path' => drupal_get_path('theme', 'business') . '/tpl',
    );
  return $items;
}

function business_preprocess_html(&$vars) {
  $current_skin = theme_get_setting('skin');
  if (isset($_COOKIE['weebpal_skin'])) {
    $current_skin = $_COOKIE['weebpal_skin'];
  }
  if (!empty($current_skin) && $current_skin != 'default') {
    $vars['classes_array'][] = "skin-$current_skin";
  }

  $current_background = theme_get_setting('background');
  if (isset($_COOKIE['weebpal_background'])) {
    $current_background = $_COOKIE['weebpal_background'];
  }
  if (!empty($current_background)) {
    $vars['classes_array'][] = $current_background;
  }
}

function business_preprocess_page(&$vars) {
  global $theme_key;

  $vars['page_css'] = '';

  $vars['regions_width'] = business_regions_width($vars['page']);
  $panel_regions = business_panel_regions();
  if (count($panel_regions)) {
    foreach ($panel_regions as $panel_name => $panels_list) {
      $panel_markup = theme("render_panel", array(
        'page' => $vars['page'],
        'panels_list' => $panels_list,
        'regions_width' => $vars['regions_width'],
        ));
      $panel_markup = trim($panel_markup);
      $vars[$panel_name] = empty($panel_markup) ? FALSE : $panel_markup;
    }
  }

  $current_skin = theme_get_setting('skin');
  if (isset($_COOKIE['weebpal_skin'])) {
    $current_skin = $_COOKIE['weebpal_skin'];
  }

  $layout_width = (theme_get_setting('layout_width') == '')
  ? theme_get_setting('layout_width_default')
  : theme_get_setting('layout_width');
  $vars['page']['show_skins_menu'] = $show_skins_menu = theme_get_setting('show_skins_menu');

  if($show_skins_menu) {
    $current_layout = theme_get_setting('layout');
    if (isset($_COOKIE['weebpal_layout'])) {
      $current_layout = $_COOKIE['weebpal_layout'];
    }

    if ($current_layout == 'layout-boxed') {
      $vars['page_css'] = 'style="max-width:' . $layout_width . 'px;margin: 0 auto;" class="boxed"';
    }
    $data = array(
      'layout_width' => $layout_width,
      'current_layout' => $current_layout
      );
    $skins_menu = theme_render_template(drupal_get_path('theme', 'business') . '/tpl/skins-menu.tpl.php', $data);
    $vars['page']['show_skins_menu'] = $skins_menu;
  }

  $vars['page']['weebpal_skin_classes'] = !empty($current_skin) ? ($current_skin . "-skin") : "";
  if (!empty($current_skin) && $current_skin != 'default' && theme_get_setting("default_logo") && theme_get_setting("toggle_logo")) {
    $vars['logo'] = file_create_url(drupal_get_path('theme', $theme_key)) . "/css/colors/" . $current_skin . "/images/logo.png";
  }

  $skin = theme_get_setting('skin');
  if (isset($_COOKIE['weebpal_skin'])) {
    $skin = $_COOKIE['weebpal_skin'] == 'default' ? '' : $_COOKIE['weebpal_skin'];
  }
  if (!empty($skin) && file_exists(drupal_get_path('theme', $theme_key) . "/css/colors/" . $skin . "/style.css")) {
    drupal_add_css(drupal_get_path('theme', $theme_key) . "/css/colors/" . $skin . "/style.css", array(
      'group' => CSS_THEME,
      ));
  }
}

function business_preprocess_render_panel(&$variables) {
  $page = $variables['page'];
  $panels_list = $variables['panels_list'];
  $regions_width = $variables['regions_width'];
  $variables = array();
  $variables['page'] = array();
  $variables['panel_width'] = $regions_width;
  $variables['panel_classes'] = array();
  $variables['panels_list'] = $panels_list;
  $is_empty = TRUE;
  $panel_keys = array_keys($panels_list);

  foreach ($panels_list as $panel) {
    $variables['page'][$panel] = $page[$panel];
    $panel_width = $regions_width[$panel];
    if (render($page[$panel])) {
      $is_empty = FALSE;
    }
    $classes = array("panel-column");
    $classes[] = "col-lg-$panel_width";
    $classes[] = "col-md-$panel_width";
    $classes[] = "col-sm-12";
    $classes[] = "col-xs-12";
    $classes[] = str_replace("_", "-", $panel);
    $variables['panel_classes'][$panel] = implode(" ", $classes);
  }
  $variables['empty_panel'] = $is_empty;
}



function business_preprocess_maintenance_page(&$vars) {
}

function business_preprocess_views_view_fields(&$vars) {
  $view = $vars['view'];
  foreach ($vars['fields'] as $id => $field) {
    if(isset($field->handler->field_info) && $field->handler->field_info['type'] === 'image') {
      $prefix = $field->wrapper_prefix;
      if(strpos($prefix, "views-field ") !== false) {
        $parts = explode("views-field ", $prefix);
        $type = str_replace("_", "-", $field->handler->field_info['type']);
        $prefix = implode("views-field views-field-type-" . $type . " ", $parts);
      }
      $vars['fields'][$id]->wrapper_prefix = $prefix;
    }
  }
}
