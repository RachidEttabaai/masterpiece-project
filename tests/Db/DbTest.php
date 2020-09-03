<?php

namespace Tests\Db;

use App\Db\MySQL;
use PHPUnit\Framework\TestCase;

class DbTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = new MySQL();
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
}