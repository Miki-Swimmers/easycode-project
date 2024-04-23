<?php

namespace App\Services\Verification;

use App\Models\User;
use App\Services\Verification\Contracts\VerificationServiceContract;
use Illuminate\Support\Facades\Cache;

class VerificationCacheService implements VerificationServiceContract
{
    /**
     * @inheritDoc
     */
    public function generate(User $user, string $key): string
    {
        $code = rand(111111, 999999);

        Cache::set($this->getKey($user, $key), $code, 60);

        return $code;
    }

    /**
     * @inheritDoc
     */
    public function has(User $user, string $key): bool
    {
        return Cache::has($this->getKey($user, $key));
    }

    /**
     * @inheritDoc
     */
    public function isCorrect(User $user, string $key, string $token): bool
    {
        return Cache::get($this->getKey($user, $key)) == $token;
    }

    /**
     * Получить ключ к кэшу
     *
     * 1. %s - Класс обработчика
     * 2. %s - Какой ключ редактируем
     * 3. %s - ID Пользователя
     */
    private function getKey(User $user, string $key): string
    {
        return sprintf('verify_%s_%s:%s', static::class, $key, $user->id);
    }
}
