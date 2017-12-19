<?php
/**
 * @file
 * Contains \Drupal\myForm\Form\ContributeForm.
 */
namespace Drupal\myForm\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;

/**
 * Contribute form.
 */
class ContributeForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'myForm_contribute_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Your Name'),
      '#required' => TRUE,
    );
    $form['email'] = array(
      '#type' => 'email',
      '#title' => t('Your Email'),
      '#required' => TRUE,
    );
    $form['message'] = array(
      '#type' => 'textarea',
      '#title' => t('Your Message'),
      '#required' => TRUE,
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
    return $form;

  }

  /**
  * {@inheritdoc}
  */

  public function validateEmail(&$element, FormStateInterface $form_state, &$complete_form) {
    //Validtes entered email address
   $value = trim($element['#value']);
   $form_state->setValueForElement($element, $value);

   if ($value !== '' && !\Drupal::service('email.validator')->isValid($value)) {
     $form_state->setError($element, t('The email address %mail is not valid.', array('%mail' => $value)));
   }
 }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display submission result.
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

  }
}
?>
