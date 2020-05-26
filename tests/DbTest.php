<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use DB;


class DbTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testConnection()
    {

        if(DB::connection()->getDatabaseName())
        {
            echo "connected successfully to database ".DB::connection()->getDatabaseName();
        }
        $this->assertTrue(true);
    }


}
