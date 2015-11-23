<?php
class Registere_and_login extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost:8000');
  }

  public function testMyTestCase()
  {
    $this->open("/conduiteDeProjet/ScrumEnv/web/app_dev.php/register/");
    $this->type("id=fos_user_registration_form_email", "guillaume.verdugo@gmail.com");
    $this->type("id=fos_user_registration_form_username", "root");
    $this->type("id=fos_user_registration_form_plainPassword_first", "root");
    $this->type("id=fos_user_registration_form_plainPassword_second", "root");
    $this->click("css=input[type=\"submit\"]");
    $this->waitForPageToLoad("30000");
    $this->type("id=username", "root");
    $this->type("id=password", "root");
    $this->click("css=input[type=\"submit\"]");
    $this->waitForPageToLoad("30000");
  }
}
?>