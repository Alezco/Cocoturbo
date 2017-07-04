<?php

namespace Tests;

use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
