<?php

namespace Letsgoi\LaravelSettings\Tests\Unit;

use Exception;
use Letsgoi\LaravelSettings\Models\Setting;
use Letsgoi\LaravelSettings\Observers\SettingObserver;
use Letsgoi\LaravelSettings\Repository\SettingRepository;
use Letsgoi\LaravelSettings\Tests\TestCase;

class SettingTest extends TestCase
{
    /** @test */
    public function it_should_return_string()
    {
        $setting = Setting::create([
            'key' => 'android_app_version',
            'value' => 'string',
            'type' => 'string',
        ]);

        $this->assertEquals('string', $setting->value);
    }

    /** @test */
    public function it_should_return_float()
    {
        $setting = Setting::create([
            'key' => 'android_app_version',
            'value' => 1.5,
            'type' => 'float',
        ]);

        $this->assertEquals(1.5, $setting->value);
    }

    /** @test */
    public function it_should_return_array()
    {
        $setting = Setting::create([
            'key' => 'android_app_version',
            'value' => ['1.5'],
            'type' => 'array',
        ]);

        $this->assertEquals([1.5], $setting->value);
    }

    /** @test */
    public function it_should_return_int()
    {
        $setting = Setting::create([
            'key' => 'android_app_version',
            'value' => 1,
            'type' => 'int',
        ]);

        $this->assertEquals(1, $setting->value);
    }

    /** @test */
    public function it_should_return_bool()
    {
        $settingTrue = Setting::create([
            'key' => 'android_app_version',
            'value' => true,
            'type' => 'bool',
        ]);

        $settingFalse = Setting::create([
            'key' => 'ios_app_version',
            'value' => false,
            'type' => 'bool',
        ]);

        $this->assertTrue($settingTrue->value);
        $this->assertFalse($settingFalse->value);
    }
}
