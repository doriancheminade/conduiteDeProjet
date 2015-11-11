<?php
class Example extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*chrome");
    $this->setBrowserUrl("http://localhost:8000");
  }

  public function testMyTestCase()
  {
    $this->open("/ScrumTool/Project/bob/pacman2015/sprint_1/kanban_view");
    $this->click("//div[@id='project']/div/div[2]/table/tbody/tr[2]/td[5]/a/button");
    $this->waitForPageToLoad("30000");
    $this->type("id=form_description", "test mvc modification");
    $this->click("css=input.btn.btn-success");
    $this->waitForPageToLoad("30000");
    $this->click("css=button.btn.btn-success");
    $this->waitForPageToLoad("30000");
  }
}
?>