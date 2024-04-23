<?php

namespace App\Services\Verification;

use App\Models\User;
use App\Models\VerificationSetting;
use App\Services\Verification\Contracts\VerificationServiceContract;
use Illuminate\Support\Facades\Cache;

class VerificationDatabaseService implements VerificationServiceContract
{
    /**
     * @inheritDoc
     */
    public function generate(User $user, string $key): string
    {
        do {
            $code = rand(111111, 999999);

            $exists = $this->getQuery($user, $key)->where('token', $code)->exists();
        } while ($exists);

        VerificationSetting::query()->create([
            'user_id' => $user->id,
            'token' => $code,
            'expires_at' => now()->addMinute(),
            'key' => $key
        ]);

        return $code;
    }

    /**
     * @inheritDoc
     */
    public function has(User $user, string $key): bool
    {
        return $this->getQuery($user, $key)->exists();
    }

    /**
     * @inheritDoc
     */
    public function isCorrect(User $user, string $key, string $token): bool
    {
        return $this->getQuery($user, $key)->first()->token === $token;
    }

    /**
     * Получить запрос
     */
    private function getQuery(User $user, string $key): \Illuminate\Database\Eloquent\Builder
    {
        return VerificationSetting::query()
            ->where('user_id', $user->id)
            ->where('key', $key)
            ->where('expires_at', '>', now());
    }
}
