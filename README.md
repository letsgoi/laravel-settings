## Laravel Settings
Move your env variables to database to change them easily using laravel nova
## Requirements
- PHP >= 8.3
- Laravel >= 10.0
- Laravel nova license registered on project
## Installation
- Require package with composer:
```bash
composer require letsgoi/laravel-settings
```

- Add `Letsgoi\LaravelSettings\SettingsServiceProvider::class`to `app.php`
````php
    /*
     * Package Service Providers...
     */
    ...
    Letsgoi\LaravelSettings\SettingsServiceProvider::class,
````

- Publish configuration:
```bash
php artisan vendor:publish --provider="Letsgoi\LaravelSettings\SettingsServiceProvider" --tag="migrations"
```

- Add `SettingNovaResource::class` on `NovaServiceProvider.php`
````php
    protected function resources(): void
    {
        Nova::resources([
            ...
            SettingNovaResource::class,
        ]);
    }
````

## Usage
This package use cache memory to save variables, instead of retrieving them from database each time you need to use it:
1. When you save a variable, cache of this variable is cleared.
2. First time you retrieve a variable it is saved to cache.

To register a new variable on Settings:
1. Create a migration with the name and key of the variable: 
   1. The available types are: bool, string, float, array
```php
    DB::table('settings')->insert([
            'id' => 'APP_URL',
            'type' => 'string'
    ]);
```
2. Run migrations: ``php artisan migrate``
3. Access your nova url and fill the variable with the value: For booleans use 0 (false) and 1 (true).
4. Use variable in your code using:
```php
    $settingRepository = new SettingRepository();
    
    $value = $settingRepository->find('key');
```

## Testing
Run tests:
``composer test``
