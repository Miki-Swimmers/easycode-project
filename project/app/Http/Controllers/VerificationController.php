<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyCodeRequest;
use App\Models\User;
use App\Services\UserService;
use App\Services\Verification\Contracts\VerificationServiceContract;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Подтверждение действия
     */
    public function verify(VerifyCodeRequest $request, VerificationServiceContract $verificationService): \Illuminate\Http\JsonResponse
    {
        /** @var array{key: string, code: string} $validated */
        $validated = $request->validated();

        /** @var User $user */
        $user = $request->user();

        if (! $verificationService->isCorrect($user, $verificationService['key'], $validated['code'])) {
            return response()->json(['message' => 'Неверный код!']);
        }

        UserService::toggleSettings($user, $validated['key']);

        return response()->json(['message' => 'Успех!']);
    }
}
