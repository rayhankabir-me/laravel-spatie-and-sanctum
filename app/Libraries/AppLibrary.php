<?php

namespace App\Libraries;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use InvalidArgumentException;
use App\Enums\CurrencyPosition;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\File;

class AppLibrary {


    public static function date($date, $pattern = null): string
    {
        if (!$pattern) {
            $pattern = env('DATE_FORMAT');
        }
        return Carbon::parse($date)->format($pattern);
    }

    public static function permissionWithAccess(&$permissions, $rolePermissions): object
    {
        if ($permissions) {
            foreach ($permissions as $permission) {
                if (isset($rolePermissions[$permission->id])) {
                    $permission->access = true;
                } else {
                    $permission->access = false;
                }
            }
        }
        return $permissions;
    }


    public static function flatAmountFormat($amount): string
    {
        return number_format($amount, env('CURRENCY_DECIMAL_POINT'), '.', '');
    }

    public static function currencyAmountFormat($amount): string
    {
        if (env('CURRENCY_POSITION') == 5) {
            return env('CURRENCY_SYMBOL') . number_format($amount, env('CURRENCY_DECIMAL_POINT'), '.', '');
        }
        return number_format($amount, env('CURRENCY_DECIMAL_POINT'), '.', '') . env('CURRENCY_SYMBOL');
    }


    public static function defaultPermission($permissions)
    {
        $defaultPermission = (object)[];
        if (count($permissions)) {
            foreach ($permissions as $permission) {
                if ($permission->access) {
                    $defaultPermission = $permission;
                    break;
                }
            }
        }
        return $defaultPermission;
    }


}
