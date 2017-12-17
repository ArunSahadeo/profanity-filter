<?php namespace ArunSahadeo;

use PHPUnit\Framework\TestCase;

class ProfanityFilterTest extends TestCase
{

    public function setup()
    {
        $this->ProfanityFilter = new ProfanityFilter();
    }

    public function testWordNotBlacklisted()
    {
        //$this->assertFalse($this->ProfanityFilter->censorProfanities());
        return $this->ProfanityFilter->censorProfanities("shit");
    }

}
