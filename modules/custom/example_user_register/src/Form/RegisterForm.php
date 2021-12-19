<?php
namespace Drupal\example_user_register\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
class RegisterForm extends FormBase
{
  public function getFormId() {
    return 'example_form';
  }


  public function buildForm(array $form, FormStateInterface $form_state) {
    $ageOption = array(
      '10-18' => '10-18',
      '18-30' => '18-30',
      '30-50' => '30-50',
    );
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Họ Tên'),
      '#default_value' => '',
//      '#required' => true
    );
    $form['phone_number'] = array(
      '#type' => 'tel',
      '#title' => t('Số đt'),
      '#default_value' => '',
//      '#required' => true
    );
    $form['email'] = array(
      '#type' => 'email',
      '#title' => t('email'),
      '#default_value' => '',
    );
    $form['age'] = array(
      '#type' => 'select',
      '#title' => $this->t('Độ Tuổi'),
      '#options' => $ageOption
    );
    $form['describe_yourself'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Mô tả bản thân'),
    );
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];
    return $form;
  }


  public function validateForm(array &$form, FormStateInterface $form_state) {
    $emailCut = strstr($form_state->getValue('email'),'@');
    if ($form_state->getValue('phone_number') === '') {
      $form_state->setErrorByName('phone_number', $this->t('Vui lòng nhập số điện thoại của bạn'));
    }
    if ($form_state->getValue('name') === '') {
      $form_state->setErrorByName('name', $this->t('Vui lòng nhập họ tên của bạn'));
    }
    if($emailCut !== '@kyanon.digital'){
      $form_state->setErrorByName('email', $this->t('Email không đúng định dạng'));
    }
    if($form_state->getValue('age')  === '10-18'){
      $form_state->setErrorByName('age', $this->t('Bạn khôn không đủ tuổi'));
    }
  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    $postData = $form_state->getValues();
    $connection = \Drupal::database();
    $result = $connection->insert('example_register')
      ->fields([
        'name' => $form_state->getValue('name'),
        'phone_number' => $form_state->getValue('phone_number'),
        'email' => $form_state->getValue('email'),
        'age' => $form_state->getValue('age'),
        'describe_yourself' => $form_state->getValue('describe_yourself'),
      ])
      ->execute();
    if($result){
      $this->messenger()->addStatus($this->t('Đăng ký thành công'));
    }

  }
}
