<?php

class USUpdateTest extends PHPUnit_Extensions_SeleniumTestCase
{
    public function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost:8000');
    }    
    public function testUpdateOk()
    {
        $this->open("/ScrumTool/Backlog/bob/pacman2015/");
        $value1 = $this->getText("css=td.DescriptionUser");
        $this->click("css=button.btn.btn-success");
        $this->waitForPageToLoad("30000");
        $this->type("id=form_description", "wololo wololo");
        $this->click("css=input.btn.btn-success");
        $this->waitForPageToLoad("30000");
        $this->click("link=Back to backlog");
        $this->waitForPageToLoad("30000");
        
        $this->assertEquals("wololo wololo", $this->getText("css=td.DescriptionUser"));
    }  
}
?>
