<?php

namespace Drupal\replace_word\Plugin\Action;
use Drupal\Core\Form\FormStateInterface;
use Drupal\views_bulk_operations\Action\ViewsBulkOperationsActionBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Plugin\PluginFormInterface;
/**
 * Action description.
 *
 * @Action(
 *   id = "replace_word_action",
 *   label = @Translation("Replace Word Action"),
 *   type="",
 *    confirm_form_route_name = "replace_word.my_special_action_confirm_form",
 * )
 */
class ReplaceAction extends ViewsBulkOperationsActionBase implements PluginFormInterface{
  use StringTranslationTrait;





  /**
   * {@inheritdoc}
   */
  public function execute($entity = NULL) {
    // Do some processing..
    $config_factory = \Drupal::service('config.factory');

    // Obtenha uma configuração editável.
    $config = $config_factory->getEditable("bb_lti.sign_in_editable_text");



    $novoValor =  $config->get('new_word123');


    // Don't return anything for a default completion message, otherwise return translatable markup.
    return $this->t('Some result');
  }

  /**
   * {@inheritdoc}
   */
  public function access($object, AccountInterface $account = NULL, $return_as_object = FALSE) {
    // If certain fields are updated, access should be checked against them as well.
    // @see Drupal\Core\Field\FieldUpdateActionBase::access().
    return $object->access('update', $account, $return_as_object);
  }


  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['old_word'] = [
      '#title' => t('Palavra que deseja substituir'),
      '#type' => 'textfield',
    ];


    return $form;
  }

  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {

    $this->configuration['old_word']  = $form_state->getValue('old_word');
    $this->configuration['new_word']  = $form_state->getValue('new_word');
  }

}
