<?php

namespace App\Services\Verification\Contracts;

use App\Models\User;

interface VerificationServiceContract
{
    /**
     * Сгенерировать код
     */
    public function generate(User $user, string $key): string;

    /**
     * Отправлен ли уже код
     */
    public function has(User $user, string $key): bool;

    /**
     * Проверить корректность кода
     */
    public function isCorrect(User $user, string $key, string $token): bool;
}
