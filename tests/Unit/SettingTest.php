<?php

namespace Letsgoi\LaravelSettings\Tests\Unit;

use Letsgoi\LaravelSettings\Models\Setting;
use Letsgoi\LaravelSettings\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class SettingTest extends TestCase
{
    #[Test]
    public function it_should_return_string()
    {
        $setting = Setting::create([
            'id' => 'id',
            'key' => 'android_app_version',
            'value' => 'string',
            'type' => 'string',
        ]);

        $this->assertEquals('string', $setting->value);
    }

    #[Test]
    public function it_should_return_float()
    {
        $setting = Setting::create([
            'id' => 'id',
            'key' => 'android_app_version',
            'value' => 1.5,
            'type' => 'float',
        ]);

        $this->assertEquals(1.5, $setting->value);
    }

    #[Test]
    public function it_should_return_array()
    {
        $setting = Setting::create([
            'id' => 'id',
            'key' => 'android_app_version',
            'value' => ['1.5'],
            'type' => 'array',
        ]);

        $this->assertEquals([1.5], $setting->value);
    }

    #[Test]
    public function it_should_return_int()
    {
        $setting = Setting::create([
            'id' => 'id',
            'key' => 'android_app_version',
            'value' => 1,
            'type' => 'int',
        ]);

        $this->assertEquals(1, $setting->value);
    }

    #[Test]
    public function it_should_return_bool()
    {
        $settingTrue = Setting::create([
            'id' => 'id',
            'key' => 'android_app_version',
            'value' => true,
            'type' => 'bool',
        ]);

        $settingFalse = Setting::create([
            'id' => 'id2',
            'key' => 'ios_app_version',
            'value' => false,
            'type' => 'bool',
        ]);

        $this->assertTrue($settingTrue->value);
        $this->assertFalse($settingFalse->value);
    }
}
