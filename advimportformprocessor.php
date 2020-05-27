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
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function advimportformprocessor_civicrm_xmlMenu(&$files) {
  _advimportformprocessor_civix_civicrm_xmlMenu($files);
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
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function advimportformprocessor_civicrm_postInstall() {
  _advimportformprocessor_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function advimportformprocessor_civicrm_uninstall() {
  _advimportformprocessor_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function advimportformprocessor_civicrm_enable() {
  _advimportformprocessor_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function advimportformprocessor_civicrm_disable() {
  _advimportformprocessor_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function advimportformprocessor_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _advimportformprocessor_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function advimportformprocessor_civicrm_managed(&$entities) {
  _advimportformprocessor_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function advimportformprocessor_civicrm_caseTypes(&$caseTypes) {
  _advimportformprocessor_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function advimportformprocessor_civicrm_angularModules(&$angularModules) {
  _advimportformprocessor_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function advimportformprocessor_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _advimportformprocessor_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function advimportformprocessor_civicrm_entityTypes(&$entityTypes) {
  _advimportformprocessor_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function advimportformprocessor_civicrm_themes(&$themes) {
  _advimportformprocessor_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 *
function advimportformprocessor_civicrm_preProcess($formName, &$form) {

} // */

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
