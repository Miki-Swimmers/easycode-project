<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * Изменить значение для настройки
     */
    public static function toggleSettings(User $user, string $key): int
    {
        return $user->settings()->where('key', $key)->update([
            'value' => DB::raw('NOT value')
        ]);
    }
}
