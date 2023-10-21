<?php

namespace Drupal\replace_word\Form;
use Drupal\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormState;
use Drupal\views_bulk_operations\Form\ConfirmAction;
use Drupal\Core\Form\FormStateInterface;



class MySpecialActionConfirmForm extends ConfirmAction{
  public function getFormId() {
    return 'mymodule_myform';
  }



  public function buildForm(array $form, FormStateInterface $form_state, $view_id = NULL, $display_id = NULL) {


    $form = parent::buildForm($form,$form_state,$view_id,$display_id);
    $form['new_word'] = [
      '#title' => t('Nova Palavra'),
      '#type' => 'textfield',
    ];




    return $form;


  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    $config_factory = \Drupal::service('config.factory');

    // Obtenha uma configuração editável.
    $config = $config_factory->getEditable("bb_lti.sign_in_editable_text");

    // Modifique os valores.
    $config->set('new_word123', $form_state->getValue('new_word'));

    // Salve as alterações.
    $config->save();


    parent::submitForm($form, $form_state);
  }



}
