<?php
/**
 * @file
 * feature_general.features.user_role.inc
 */

/**
 * Implements hook_user_default_roles().
 */
function feature_general_user_default_roles() {
  $roles = array();

  // Exported role: contentmanager.
  $roles['contentmanager'] = array(
    'name' => 'contentmanager',
    'weight' => '3',
  );

  return $roles;
}
