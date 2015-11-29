<?php
class GanttRealTest extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*firefox");
    $this->setBrowserUrl("http://localhost:8000");
  }

  public function testGanttOk()
  {
    $this->open("/ScrumTool/Gantt/Edit/bob/pacman2015/sprint%201");
    $this->waitForPageToLoad("30000");
    for ($second = 0; ; $second++) {
    if ($second >= 60) $this->fail("timeout");
    try {
    if ($this->isElementPresent("css=div.row.spacer")) break;
    } catch (Exception $e) {}
    sleep(1);
    }

    $this->assertTrue($this->isElementPresent("css=div.row.spacer"));
    $this->assertEquals("T1 : coder la gestion des evenements et les controles de pacman", $this->getText("css=h3"));
    $this->assertEquals("T2 : coder l IA des fantomes", $this->getText("//div[2]/h3"));
    $this->assertEquals("T3 : faire les textures du niveau 1", $this->getText("//div[3]/h3"));
    $this->assertEquals("T3", $this->getText("css=div.bar.ganttRed > div.fn-label"));
  }
}
?>
