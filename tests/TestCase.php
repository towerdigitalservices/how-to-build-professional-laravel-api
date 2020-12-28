<?php

namespace Tests;

use Faker\Generator;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\TestHelper;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $faker;

    protected $helper;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = app()->make(Generator::class);
        $this->helper = app()->make(TestHelper::class);
    }
}
