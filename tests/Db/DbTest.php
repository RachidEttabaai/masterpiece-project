<?php

namespace Tests\Db;

use App\Db\MySQL;
use PHPUnit\Framework\TestCase;

class DbTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = new MySQL(null);
    }

    protected function tearDown(): void
    {
        $this->pdo = null;
    }

    public function testIsCountQueryInt(): void
    {
        $count = $this->pdo->countquery("SELECT COUNT(*) FROM Country");
        $this->assertIsInt($count);
    }

    public function testGetCountQuery(): void
    {
        $count = $this->pdo->countquery("SELECT COUNT(*) FROM Country");
        $this->assertLessThanOrEqual(248, $count);
    }

    public function testGetResSelectQuery(): void
    {
        $resselect = $this->pdo->selectquery("SELECT * FROM Country");
        $this->assertEquals(248, count($resselect));
    }

    public function testGetContentResSelectQuery(): void
    {
        $rescontentselect = $this->pdo->selectquery("SELECT * FROM Country WHERE country_name = 'Germany'");
        $this->assertEquals(1, count($rescontentselect));
        $this->assertIsArray($rescontentselect);
        $this->assertArrayHasKey("0", $rescontentselect);
    }

    public function testGetEmptyContentResSelectQuery(): void
    {
        $rescontentselect = $this->pdo->selectquery("SELECT * FROM Country WHERE country_name = 'Allemagne'");
        $this->assertEquals(0, count($rescontentselect));
        $this->assertEmpty($rescontentselect);
    }
}