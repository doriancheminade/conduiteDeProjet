<?php
class Example extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*chrome");
    $this->setBrowserUrl("http://localhost/");
  }

  public function testMyTestCase()
  {
    $this->open("/cdp/ScrumEnv/web/app_dev.php/ScrumTool/Sprint/list/bob/pacman2015/5/salut");
    $this->click("link=Kanban sprint");
    $this->waitForPageToLoad("30000");
    $this->click("link=Done");
    $this->waitForPageToLoad("30000");
    $this->click("css=button.btn.btn-success");
    $this->waitForPageToLoad("30000");
    $this->click("//div[@id='project']/div/div[2]/a[2]/button");
    $this->waitForPageToLoad("30000");
    $this->click("css=button.btn.btn-primary");
    $this->waitForPageToLoad("30000");
  }
}
?>