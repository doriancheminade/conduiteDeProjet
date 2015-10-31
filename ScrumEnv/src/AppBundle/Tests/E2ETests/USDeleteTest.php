<?php

class USDeleteTest extends PHPUnit_Extensions_SeleniumTestCase
{
    public function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost:8000');
    }    
    public function testdelete()
    {
        $this->open('/bob/pacman2015/backlog');
        $this->waitForPageToLoad("30000");
        $this->click("css=input[type=\"submit\"]");
        $this->waitForPageToLoad("30000");
        $this->assertEquals($this->getLocation(),'http://localhost:8000/bob/pacman2015/backlog');
    }  
}
?>
