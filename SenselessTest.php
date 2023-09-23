<?php

use PHPUnit\Framework\TestCase;

// Class yang mau di TEST.
require_once "./core/db-hook.php";

// Class untuk run Testing.
class SenselessTest extends TestCase
{
    public function testMemberRegistered()
    {
        $this->assertNotEquals("", load_login_db("Faisal"));
    }
    public function testItemAll()
    {
        $this->assertNotEmpty(load_item_all());
    }
    public function testCashFormat()
    {
        $this->assertEquals("8.000.000,00", convertCashFormat(8000000));
    }

    public function testAddItem()
    {
        $this->assertEquals(true, itemAdd(0, "Tester", 1, 10000));
    }

    public function testUpdateItem()
    {
        $this->assertEquals(true, itemUpdate(0, "Test Update", 2, 20000));
    }

    public function testDeleteItem()
    {
        $this->assertEquals(true, itemDelete(0));
    }

    public function testAddPelanggan()
    {
        $this->assertEquals(true, pelangganAdd(0, "Tester", "test", 70970077));
    }

    public function testUpdatePelanggan()
    {
        $this->assertEquals(true, pelangganUpdate(0, "test update", "update", 990090));
    }

    public function testDeletePelanggan()
    {
        $this->assertEquals(true, pelangganDelete(0));
    }

    public function testAddSuplier()
    {
        $this->assertEquals(true, suplierAdd(0, "Tester", "test", 70970077));
    }

    public function testUpdateSuplier()
    {
        $this->assertEquals(true, suplierUpdate(0, "test update", "update", 990090));
    }

    public function testDeleteSuplier()
    {
        $this->assertEquals(true, suplierDelete(0));
    }
}
