<?php

namespace Drupal\example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ExampleForm extends FormBase {

  public function getFormId() {
    return 'example_form';
  }


  public function buildForm(array $form, FormStateInterface $form_state) {
    $genderOption = array(
      '0' => 'Select gender',
      'Male' => 'Male',
      'Female' => 'Female',
      'Other' => 'Other',
    );
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name'),
      '#default_value' => ''
    );
    $form['gender'] = array(
      '#type' => 'select',
      '#title' => 'Gender',
      '#options' => $genderOption
    );
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];
    return $form;
  }


//  public function validateForm(array &$form, FormStateInterface $form_state) {
//    if (strlen($form_state->getValue('phone_number')) < 3) {
//      $form_state->setErrorByName('phone_number', $this->t('The phone number is too short. Please enter a full phone number.'));
//    }
//  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    $postData = $form_state->getValues();
    echo "<pre>";
    print_r($postData);
    echo "<pre>";
    exit();
//    $this->messenger()->addStatus($this->t('Your phone number is @number', ['@number' => $form_state->getValue('phone_number')]));
  }

}
