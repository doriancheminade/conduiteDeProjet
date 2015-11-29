<?php
class RepositoryTest extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*firefox");
    $this->setBrowserUrl("http://localhost:8000");
  }

  public function testLinkRepoAndCheckOk()
  {
    $this->open("/ScrumTool/Project/bob/pacman2015");
    $this->click("link=add repository");
    $this->waitForPageToLoad("30000");
    $this->type("id=form_repoOwner", "doriancheminade");
    $this->type("id=form_repoName", "ScrumToolPacman");
    $this->click("id=form_add");
    $this->waitForPageToLoad("30000");
    
    $this->click("link=project");
    $this->waitForPageToLoad("30000");
    $this->click("css=a[type=\"datetime\"]");
    $this->waitForPageToLoad("30000");
    $this->click("//a[2]/button");
    $this->waitForPageToLoad("30000");
  
    $this->open("/ScrumTool/Kanban/bob/pacman2015/sprint%201/visualisation/");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("[T1]events: forgot to add lifes", $this->getText("//div[@id='Kanban']/table/tbody/tr[3]/td[2]"));
    $this->assertEquals("[T1]events: pacman moves, pacman dies", $this->getText("//div[@id='Kanban']/table/tbody/tr[4]/td[2]"));
    $this->assertEquals("[T2]ai: fantoms move now", $this->getText("//div[@id='Kanban']/table[2]/tbody/tr[3]/td[2]"));
    $this->assertEquals("[T3]textures: level 1 done", $this->getText("//div[@id='Kanban']/table[3]/tbody/tr[3]/td[2]"));

  }
}
?>
