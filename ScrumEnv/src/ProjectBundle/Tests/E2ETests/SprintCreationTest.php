<?php

class SprintCreationTest extends PHPUnit_Extensions_SeleniumTestCase
{
    public function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost:8000');
    }    
    public function testCreationOk()
    {
        $this->open("/ScrumTool/Project/bob/pacman2015");
        for ($second = 0; ; $second++) {
            if ($second >= 60) $this->fail("timeout");
                try {
                    if ($this->isElementPresent("link=new sprint")) break;
                } catch (Exception $e) {}
            sleep(1);
        }
        $this->click("link=new sprint");
        $this->waitForPageToLoad("30000");
        $this->type("id=form_id", "2");
        $this->type("id=form_description", "sprint de demarrage");
        $this->select("id=form_dateBegining_year", "label=2011");
        $this->select("id=form_dateBegining_month", "label=Feb");
        $this->select("id=form_dateBegining_day", "label=2");
        $this->select("id=form_dateEnd_year", "label=2011");
        $this->select("id=form_dateEnd_month", "label=Feb");
        $this->select("id=form_dateEnd_day", "label=7");
        $this->click("css=input.btn.btn-success");
        $this->waitForPageToLoad("30000");
        
        $this->assertTrue($this->isElementPresent("//a[contains(text(),'2\n                         : \n                        2011-02-02\n                         : \n                        2011-02-07')]"));
        $this->open("/ScrumTool/Project/bob/pacman2015");        
    }  
}
?>
