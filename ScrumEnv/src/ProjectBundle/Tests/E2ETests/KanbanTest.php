<?php
class KanbanTest extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*chrome");
    $this->setBrowserUrl("http://localhost:8000");
  }

  public function testMyTestCase()
  {
    $this->open("/ScrumTool/Kanban/bob/pacman2015/visualisation/");
    $this->click("link=oG");
    $this->waitForPageToLoad("30000");
    $this->click("link=Done");
    $this->waitForPageToLoad("30000");
    $this->click("link=onGoing");
    $this->waitForPageToLoad("30000");
    $this->click("link=ToDo");
    $this->waitForPageToLoad("30000");
  }
}
?>