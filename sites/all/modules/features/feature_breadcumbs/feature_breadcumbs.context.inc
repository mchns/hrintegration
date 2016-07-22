<?php
/**
 * @file
 * feature_breadcumbs.context.inc
 */

/**
 * Implements hook_context_default_contexts().
 */
function feature_breadcumbs_context_default_contexts() {
  $export = array();

  $context = new stdClass();
  $context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
  $context->api_version = 3;
  $context->name = 'breadcrumbs_events';
  $context->description = '';
  $context->tag = 'breadcrumbs';
  $context->conditions = array(
    'path' => array(
      'values' => array(
        'event/*' => 'event/*',
      ),
    ),
  );
  $context->reactions = array(
    'menu' => 'events',
  );
  $context->condition_mode = 0;

  // Translatables
  // Included for use with string extractors like potx.
  t('breadcrumbs');
  $export['breadcrumbs_events'] = $context;

  $context = new stdClass();
  $context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
  $context->api_version = 3;
  $context->name = 'breadcrumbs_news';
  $context->description = '';
  $context->tag = 'breadcrumbs';
  $context->conditions = array(
    'path' => array(
      'values' => array(
        'news/*' => 'news/*',
      ),
    ),
  );
  $context->reactions = array(
    'menu' => 'news',
  );
  $context->condition_mode = 0;

  // Translatables
  // Included for use with string extractors like potx.
  t('breadcrumbs');
  $export['breadcrumbs_news'] = $context;

  $context = new stdClass();
  $context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
  $context->api_version = 3;
  $context->name = 'breadcrumbs_publications';
  $context->description = '';
  $context->tag = 'breadcrumbs';
  $context->conditions = array(
    'path' => array(
      'values' => array(
        'publication/*' => 'publication/*',
      ),
    ),
  );
  $context->reactions = array(
    'menu' => 'publications',
  );
  $context->condition_mode = 0;

  // Translatables
  // Included for use with string extractors like potx.
  t('breadcrumbs');
  $export['breadcrumbs_publications'] = $context;

  $context = new stdClass();
  $context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
  $context->api_version = 3;
  $context->name = 'breadcrumbs_reports';
  $context->description = '';
  $context->tag = 'breadcrumbs';
  $context->conditions = array(
    'path' => array(
      'values' => array(
        'report/*' => 'report/*',
      ),
    ),
  );
  $context->reactions = array(
    'menu' => 'reports',
  );
  $context->condition_mode = 0;

  // Translatables
  // Included for use with string extractors like potx.
  t('breadcrumbs');
  $export['breadcrumbs_reports'] = $context;

  return $export;
}
