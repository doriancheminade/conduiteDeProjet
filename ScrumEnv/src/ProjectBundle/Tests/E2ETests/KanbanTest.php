<?php
class KanbanTest extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*firefox");
    $this->setBrowserUrl("http://localhost:8000");
  }

  public function testMyTestCase()
  {
    $this->open("/ScrumTool/Project/bob/pacman2015");
    $this->click("link=new sprint");
    $this->waitForPageToLoad("30000");
    $this->type("id=form_id", "sprint_1");
    $this->type("id=form_description", "description sprint_1");
    $this->select("id=form_dateEnd_year", "label=2012");
    $this->click("css=input.btn.btn-success");
    $this->waitForPageToLoad("30000");
    $this->click("css=a[type=\"datetime\"]");
    $this->waitForPageToLoad("30000");
    $this->click("css=div.panel-body > a > button");
    $this->waitForPageToLoad("30000");
    $this->type("id=form_id", "sprint1.2");
    $this->type("id=form_description", "test mvc");
    $this->type("id=form_cost", "2");
    $this->type("id=form_dependencies", "none");
    $this->click("css=input.btn.btn-success");
    $this->waitForPageToLoad("30000");
    $this->click("css=button.btn.btn-success");
    $this->waitForPageToLoad("30000");
    $this->click("link=Kanban sprint");
    $this->waitForPageToLoad("30000");
    $this->click("xpath=(//a[contains(text(),'oG')])[1]");
    $this->waitForPageToLoad("30000");
    $this->click("xpath=(//a[contains(text(),'Done')])[1]");
    $this->waitForPageToLoad("30000");
    $this->click("link=onGoing");
    $this->waitForPageToLoad("30000");
    $this->click("link=ToDo");
    $this->waitForPageToLoad("30000");
    $this->click("xpath=(//a[contains(text(),'Done')])[1]");
    $this->waitForPageToLoad("30000");
    $this->click("link=ToDo");
    $this->waitForPageToLoad("30000");
    $this->click("xpath=(//a[contains(text(),'oG')])[1]");
    $this->waitForPageToLoad("30000");
    $this->click("xpath=(//a[contains(text(),'Done')])[1]");
    $this->waitForPageToLoad("30000");
    $this->click("css=button.btn.btn-success");
    $this->waitForPageToLoad("30000");
  }
}
?>
