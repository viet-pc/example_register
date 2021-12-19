<?php
namespace Drupal\example\Controller;

class ExampleController {
  public function myPage(): array
  {
    return array(
      '#markup' => 'Hello world!',
    );
  }
}
?>
