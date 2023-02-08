<?php

namespace Letsgoi\LaravelSettings\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
    ];

    public function value(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $this->castValue($value, $this->type),
            set: fn(string|int|float|bool|array $value) => $this->castToString($value),
        );
    }

    private function castValue(string $value, string $type): string|float|array|bool|int
    {
        return match ($type) {
            'int' => (int) $value,
            'float' => (float) $value,
            'bool' => (bool) $value,
            'array' => json_decode($value, true),
            default => $value,
        };
    }

    private function castToString(string|int|float|bool|array $value): string
    {
        if (is_array($value)) {
            return json_encode($value);
        }

        if (is_bool($value)) {
            return $value ? '1' : '0';
        }

        return (string) $value;
    }
}
