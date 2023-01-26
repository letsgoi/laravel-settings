## Laravel Settings
Move your env variables to database to change them easily using laravel nova
## Requirements
- PHP >= 8.0
- Laravel >= 8.0
- Laravel nova license
## Installation
- Require package with composer:
```bash
composer require letsgoi/laravel-domain-events-messaging
```

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
To register a new variable on Settings:
1. Create a migration with the name and key of the variable: 
   1. The available types are: bool, string, float, array, bool

```php
    DB::table('settings')->insert([
            'key' => 'APP_URL',
            'type' => 'string'
    ]);
```

2. Run migrations: ``php artisan migrate``
3. Access your nova url and fill the variable with the value
## Testing
Run tests:
``composer test``
