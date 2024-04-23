<?php

namespace App\Services;

use Psr\Http\Message\ResponseInterface;

/**
 * Интеграция с SMS-сервисом
 */
class SMSService
{
    /**
     * Отправить сообщение
     */
    public function send(array $params): ResponseInterface|array|null
    {
        // TODO: Отправка сообщения

        return null;
    }
}
