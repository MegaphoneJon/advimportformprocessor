<?php

use CRM_Advimport_ExtensionUtil as E;

class CRM_Advimportformprocessor_Advimport_Formprocessor extends CRM_Advimport_Helper_PHPExcel {

  /**
   * Available fields.
   */
  function getMapping(&$form) {
    $map = [];

    // QuickForm weirdness: this gets called before setDefaults
    // and also gets called twice (the second time will have empty values).
    $formProcessorInstanceId = $form->controller->get('formProcessorInstanceId');

    if (!$formProcessorInstanceId) {
      $values = $form->exportValues();
      $formProcessorInstanceId = $values['formProcessorInstanceId'];
    }

    if ($formProcessorInstanceId) {
      $form->controller->set('formProcessorInstanceId', $formProcessorInstanceId);

      $fields = civicrm_api3('FormProcessorInput', 'get', [
        'sequential' => 1,
        'form_processor_instance_id' => $formProcessorInstanceId,
      ])['values'];

      foreach ($fields as $val) {
        $name = $val['name'];

        $map[$name] = [
          'label' => $val['title'] . ($val['is_required'] ? ' *' : ''),
          'field' => $name,
          'mandatory' => $val['is_required'],
          'aliases' => [
            // Helps to match on the machine name (first_name), not just 'First Name'
            $val['name'],
          ],
        ];
      }
    }

    return $map;
  }

  /**
   *
   */
  function mapfieldsSetDefaultValues(&$form) {
    $values = [];

    $values['formProcessorInstanceId'] = $form->controller->get('formProcessorInstanceId');

    if (empty($values['formProcessorInstanceId'])) {
      $advimport_id = $form->controller->get('advimport_id');

      if ($advimport_id) {
        $mapping = $form->controller->get('mapping');

        if (!empty($mapping['formProcessorInstanceId'])) {
          $formProcessorInstanceId = $mapping['formProcessorInstanceId'];
          $form->controller->set('formProcessorInstanceId', $formProcessorInstanceId);
          $values['formProcessorInstanceId'] = $formProcessorInstanceId;
        }
      }
    }

    return $values;
  }

  /**
   * Alter MapFields form.  This lets us pick the Form Processor Instance.
   */
  function mapfieldsBuildFormPre(&$form) {
    $options = [];
    $options[0] = ts('- select -');

    $entities = civicrm_api3('FormProcessorInstance', 'get', [
      'sequential' => 1,
    ])['values'];

    foreach ($entities as $key => $val) {
      $options[$val['id']] = $val['title'];
    }

    $form->add('select', 'formProcessorInstanceId', E::ts('Form Processor'), $options, TRUE);
  }

  /**
   * Check if we have all the data we need.
   */
  function mapfieldsPostProcessPre(&$form) {
    $formProcessorInstanceId = $form->controller->get('formProcessorInstanceId');

    if (!$formProcessorInstanceId) {
      return false;
    }

    $mapping = $form->controller->exportValues('MapFields');

    $has_data = false;
    $missing_mandatory = false;
    $ignore = ['qfKey', 'entryURL', 'formProcessorInstanceId'];

    foreach ($mapping as $entity_field => $column) {
      if (!in_array($entity_field, $ignore)) {
        $has_data = true;
        break;
      }
    }

    if (!$has_data) {
      return false;
    }

    // Check for mandatory fields
    $fields = civicrm_api3('FormProcessorInput', 'get', [
      'sequential' => 1,
      'form_processor_instance_id' => $formProcessorInstanceId,
    ])['values'];

    foreach ($fields as $key => $val) {
      $name = $val['name'];

      if ($val['is_required'] && $name != 'id' && !in_array($name, $mapping)) {
        $missing_mandatory = true;
        CRM_Core_Session::setStatus(E::ts("%1 (%2) is a mandatory field. The field must be in the uploaded file and you must select a field match for it.", array(1 => $val['title'], 2 => $name)), 'error');
      }
    }

    if ($missing_mandatory) {
      return false;
    }

    return true;
  }

  /**
   * Returns a human-readable name for this helper.
   */
  function getHelperLabel() {
    return E::ts("Form Processor");
  }

  /**
   * Import an item gotten from the queue.
   */
  function processItem($params) {
    static $formProcessorInstanceId = NULL;
    static $formProcessorInstanceName = NULL;

    $formProcessorInstanceId = CRM_Utils_Array::value('formProcessorInstanceId', $params);
    unset($params['formProcessorInstanceId']);

    // Hack to fetch this data, until MapFields is fixed
    // Currently the above fails because formProcessorInstanceId is not in params.
    if (!$formProcessorInstanceId) {
      $mapping = CRM_Core_DAO::singleValueQuery('SELECT mapping FROM civicrm_advimport WHERE table_name = %1', [
        1 => [$params['import_table_name'], 'String'],
      ]);

      $mapping = json_decode($mapping, TRUE);
      $formProcessorInstanceId = CRM_Utils_Array::value('formProcessorInstanceId', $mapping);
      $formProcessorInstanceName = civicrm_api3('FormProcessorInstance', 'getvalue', [
        'return' => "name",
        'id' => $formProcessorInstanceId,
      ]);
    }

    civicrm_api3('FormProcessor', $formProcessorInstanceName, $params);
  }

}
