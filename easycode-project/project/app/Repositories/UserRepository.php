<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserSettings;

class UserRepository
{
    /**
     * Получить настройки пользователя
     */
    public static function getUserSettings(int $userId): \Illuminate\Database\Eloquent\Collection|array
    {
        return UserSettings::query()->where('user_id', $userId)->get();
    }
}
