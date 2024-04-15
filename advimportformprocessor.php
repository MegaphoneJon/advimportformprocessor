<?php

require_once 'advimportformprocessor.civix.php';
use CRM_Advimportformprocessor_ExtensionUtil as E;


/**
 * Implements hook_civicrm_advimport_helpers()
 */
function advimportformprocessor_civicrm_advimport_helpers(&$helpers) {
  $helpers[] = [
    'class' => 'CRM_Advimportformprocessor_Advimport_Formprocessor',
    'label' => E::ts('Form Processor'),
  ];
}

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/ 
 */
function advimportformprocessor_civicrm_config(&$config) {
  _advimportformprocessor_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function advimportformprocessor_civicrm_install() {
  _advimportformprocessor_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function advimportformprocessor_civicrm_enable() {
  _advimportformprocessor_civix_civicrm_enable();
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 *

 // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 *
function advimportformprocessor_civicrm_navigationMenu(&$menu) {
  _advimportformprocessor_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('New subliminal message'),
    'name' => 'mailing_subliminal_message',
    'url' => 'civicrm/mailing/subliminal',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _advimportformprocessor_civix_navigationMenu($menu);
} // */
