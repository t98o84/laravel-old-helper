<?php

use Illuminate\Support\Facades\Session;

if (! function_exists('old_str')) {
    function old_str($key, ?string $default = null): ?string
    {
        $val = Session::getOldInput($key, $default);

        return is_string($val) ? $val : $default;
    }
}

if (! function_exists('old_num')) {
    function old_num($key, int|float|null $default = null): int|float|null
    {
        $val = Session::getOldInput($key, $default);

        if (! is_numeric($val)) {
            return $default;
        }

        return str_contains((string) $val, '.') ? (float) $val : (int) $val;
    }
}
//
if (! function_exists('old_int')) {
    function old_int($key, ?int $default = null): ?int
    {
        $val = Session::getOldInput($key, $default);

        if (! is_numeric($val) || str_contains((string) $val, '.')) {
            return $default;
        }

        return (int) $val;
    }
}

if (! function_exists('old_float')) {
    function old_float($key, ?float $default = null): ?float
    {
        $val = Session::getOldInput($key, $default);

        if (! is_numeric($val) || ! str_contains((string) $val, '.')) {
            return $default;
        }

        return (float) $val;
    }
}

if (! function_exists('old_bool')) {
    function old_bool($key, ?bool $default = null): ?bool
    {
        $val = Session::getOldInput($key, $default);

        if (in_array($val, [true, 'true', 1, '1'], true)) {
            return true;
        }

        if (in_array($val, [false, 'false', 0, '0'], true)) {
            return false;
        }

        return $default;
    }
}

if (! function_exists('old_array')) {
    function old_array($key, ?array $default = null): ?array
    {
        $val = Session::getOldInput($key, $default);

        return is_array($val) ? $val : $default;
    }
}
