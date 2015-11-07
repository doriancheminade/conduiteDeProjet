<?php

class USListTest extends PHPUnit_Extensions_SeleniumTestCase
{
    public function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost:8000');
    }    
    public function testlistOk()
    {
        $this->open("/ScrumTool/Backlog/bob/pacman2015/");
        for ($second = 0; ; $second++) {
            if ($second >= 60) $this->fail("timeout");
                try {
                    if ($this->isElementPresent("css=th.Backlog_column_int")) break;
                } catch (Exception $e) {}
            sleep(1);
        }

$this->assertTrue($this->isElementPresent("//div[@id='backlog']/table/tbody/tr[3]/td"));



        $this->assertEquals("ID", $this->getText("css=th.Backlog_column_int"));
        $this->assertEquals("Description", $this->getText("css=th.Backlog_column_string"));
        $this->assertEquals("Priority", $this->getText("//div[@id='backlog']/table/tbody/tr/th[3]"));
        $this->assertEquals("Cost", $this->getText("//div[@id='backlog']/table/tbody/tr/th[4]"));
        $this->assertEquals("Update", $this->getText("//div[@id='backlog']/table/tbody/tr/th[5]"));
        $this->assertEquals("Delete", $this->getText("//div[@id='backlog']/table/tbody/tr/th[6]"));

        
        $this->assertTrue($this->isElementPresent("//div[@id='backlog']/table/tbody/tr[2]/td"));
        $this->assertTrue($this->isElementPresent("//div[@id='backlog']/table/tbody/tr[3]/td"));
        $this->assertTrue($this->isElementPresent("//div[@id='backlog']/table/tbody/tr[4]/td"));

    }  
}
?>
