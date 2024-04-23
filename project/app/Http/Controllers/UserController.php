<?php

namespace App\Http\Controllers;

use App\Enums\ServiceType;
use App\Http\Requests\UpdateSettingsRequest;
use App\Models\User;
use App\Notifications\SendCodeNotification;
use App\Repositories\UserRepository;
use App\Services\Verification\Contracts\VerificationServiceContract;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Получить настройки пользователя
     */
    public function view(User $user): \Illuminate\Http\JsonResponse
    {
        return response()->json(['payload' => [
            'user' => $user,
            'settings' => $user->settings
        ]]);
    }

    /**
     * Обновить настройки
     */
    public function toggleSettings(User $user, UpdateSettingsRequest $request, VerificationServiceContract $verificationService): \Illuminate\Http\JsonResponse
    {
        /** @var array{key: string, type: string} $validated */
        $validated = $request->validated();

        if ($verificationService->has($user, $validated['key'])) {
            return response()->json(['message' => 'Код подтверждения уже отправлен!']);
        }

        $user->notify(new SendCodeNotification(ServiceType::{$validated['type']}, $code = $verificationService->generate($user, $validated['key'])));

        return response()->json([
            'message' => 'Отправлен код подтверждения.',
            'payload' => [
                'code_length' => mb_strlen($code)
            ]
        ]);
    }
}
