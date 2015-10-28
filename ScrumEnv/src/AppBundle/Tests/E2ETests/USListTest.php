<?php

//require('../vendor/autoload.php')
//require __DIR__ . '/vendor/autoload.php'
//require __DIR__ . '/phpunit/phpunit-selenium';

class USListTest extends PHPUnit_Extensions_SeleniumTestCase
{
    public function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost:8000');
    }    
    public function testlist()
    {
        //TODO: when database is set add case to verify USlist
        $this->open('/bob/pacman2015/backlog');
        $tr = $this->getText('xpath=(//*[@id="usListTable"]/thead/tr)');
        $this->assertContains("ID", $tr);
        $this->assertContains("DESCRIPTION", $tr);
        $this->assertContains("COST", $tr);
        $this->assertContains("PRIORITY", $tr);
    }  
}
?>