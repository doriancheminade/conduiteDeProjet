<?php

class USCreationTest extends PHPUnit_Extensions_SeleniumTestCase
{
    public function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost:8000');
    }    
    public function testCreationOk()
    {    
        $string = "ceci est une nouvelle US"; 
        $this->open("/ScrumTool/Backlog/bob/pacman2015/");     
        $this->click("css=button.btn.btn-primary");
        $this->waitForPageToLoad("30000");           
        $this->type("id=form_Id", "42");
        $this->type("id=form_description", $string);
        $this->type("id=form_priority", "42");
        $this->type("id=form_cost", "24");
        $this->click("css=input.btn.btn-success");
        $this->waitForPageToLoad("30000");
        $this->click("link=Back to backlog");
        $this->waitForPageToLoad("30000");

        $page = $this->getText("id=Project");
        $this->assertTextPresent($page, $string);
    }  
}
?>
