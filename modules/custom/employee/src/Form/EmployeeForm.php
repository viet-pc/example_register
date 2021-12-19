<?php
namespace Drupal\employee\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class EmployeeForm extends FormBase
{
  public function getFormId(): string
  {
    return 'create_employee';
  }
  public function buildForm(array $form, FormStateInterface $form_state): array
  {
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
    $form['save']= array(
      '#type' => 'submit',
      '#value' => 'Save',
      '#button' => 'primary',
    );
    return $form;
  }
  public function submitForm(array &$form ,FormStateInterface $form_state){
    $postData = $form_state->getValues();
    echo "<pre>";
    print_r($postData);
    echo "<pre>";
  }
}
