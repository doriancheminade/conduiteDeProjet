<?php

class USDeleteTest extends PHPUnit_Extensions_SeleniumTestCase
{
    public function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost:8000');
    }    
    public function testDeleteOk()
    {
        $this->open("/ScrumTool/Project/bob/pacman2015");
        $this->click("link=backlog");
        $this->waitForPageToLoad("30000");
        $page1 = $this->getText("id=Project");
        $this->click("css=button.btn.btn-danger");
        $this->waitForPageToLoad("30000");
        $page2 = $this->getText("id=Project");
        
        $this->assertEquals($this->getLocation(),'http://localhost:8000/ScrumTool/Backlog/bob/pacman2015/');
        $this->assertNotEquals($page1,$page2);
    }  
}
?>
