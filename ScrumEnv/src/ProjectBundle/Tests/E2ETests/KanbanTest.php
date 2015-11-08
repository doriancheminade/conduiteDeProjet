<?php
class KanbanTest extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*chrome");
    $this->setBrowserUrl("http://localhost/conduiteDeProjet/ScrumEnv/web/app_dev.php/ScrumTool/Kanban/bob/pacman2015/visualisation/");
  }

  public function testMyTestCase()
  {
    $this->open("/conduiteDeProjet/ScrumEnv/web/app_dev.php/ScrumTool/Kanban/bob/pacman2015/visualisation/");
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