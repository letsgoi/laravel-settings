<?php

namespace Letsgoi\LaravelSettings\Tests\Unit;

use Exception;
use Letsgoi\LaravelSettings\Models\Setting;
use Letsgoi\LaravelSettings\Observers\SettingObserver;
use Letsgoi\LaravelSettings\Repository\SettingRepository;
use Letsgoi\LaravelSettings\Tests\TestCase;

class SettingRepositoryTest extends TestCase
{
    /** @test */
    public function it_should_return_string()
    {
        $settingRepository = new SettingRepository();

        Setting::create([
            'id' => 'id',
            'key' => 'android_app_version',
            'value' => '1',
            'type' => 'string',
        ]);

        $this->assertEquals('1', $settingRepository->find('android_app_version'));
    }

    /** @test */
    public function it_should_return_float()
    {
        $settingRepository = new SettingRepository();

        Setting::create([
            'id' => 'id',
            'key' => 'android_app_version',
            'value' => '1.5',
            'type' => 'float',
        ]);

        $this->assertEquals(1.5, $settingRepository->find('android_app_version'));
    }

    /** @test */
    public function it_should_return_array()
    {
        $settingRepository = new SettingRepository();

        Setting::create([
            'id' => 'id',
            'key' => 'android_app_version',
            'value' => json_encode(['1.5']),
            'type' => 'array',
        ]);

        $this->assertEquals([1.5], $settingRepository->find('android_app_version'));
    }

    /** @test */
    public function it_should_return_int()
    {
        $settingRepository = new SettingRepository();

        Setting::create([
            'id' => 'id',
            'key' => 'android_app_version',
            'value' => '1.2',
            'type' => 'int',
        ]);

        $this->assertEquals(1, $settingRepository->find('android_app_version'));
    }

    /** @test */
    public function it_should_return_bool()
    {
        $settingRepository = new SettingRepository();

        Setting::create([
            'id' => 'id',
            'key' => 'android_app_version',
            'value' => '1',
            'type' => 'bool',
        ]);

        Setting::create([
            'id' => 'id2',
            'key' => 'ios_app_version',
            'value' => '0',
            'type' => 'bool',
        ]);

        $this->assertTrue($settingRepository->find('android_app_version'));
        $this->assertFalse($settingRepository->find('ios_app_version'));
    }

    /** @test */
    public function it_should_return_error_if_variable_does_not_exist()
    {
        $settingRepository = new SettingRepository();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('The setting with key android_app_version does not exist');

        $settingRepository->find('android_app_version');
    }

    /** @test */
    public function it_should_return_updated_setting()
    {
        Setting::observe(SettingObserver::class);
        $settingRepository = new SettingRepository();

        $setting = Setting::create([
            'id' => 'id',
            'key' => 'pepe_app_version',
            'value' => '1.2',
            'type' => 'string',
        ]);

        $this->assertEquals('1.2', $settingRepository->find('pepe_app_version'));

        $setting->value = '2.1';
        $setting->save();

        $settingRepository->forgetCache($setting);

        $this->assertEquals('2.1', $settingRepository->find('pepe_app_version'));
    }
}
