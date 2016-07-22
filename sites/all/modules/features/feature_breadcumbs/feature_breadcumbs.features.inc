<?php
/**
 * @file
 * feature_breadcumbs.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function feature_breadcumbs_ctools_plugin_api() {
  list($module, $api) = func_get_args();
  if ($module == "context" && $api == "context") {
    return array("version" => "3");
  }
}
