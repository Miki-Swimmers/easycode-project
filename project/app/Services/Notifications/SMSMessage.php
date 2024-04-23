<?php

namespace App\Services\Notifications;

use App\Services\SMSService;
use Illuminate\Support\Facades\App;

class SMSMessage
{
    /**
     * @var SMSService
     */
    protected SMSService $api;

    /**
     * Данные о сообщении
     */
    private array $params = [
        'message' => '',
        'phone' => ''
    ];

    /**
     * SMSMessage constructor
     */
    public function __construct()
    {
        $this->api = App::make(SMSService::class);
    }

    /**
     * @return SMSMessage
     */
    public static function create(): SMSMessage
    {
        return new self();
    }

    /**
     * Установить получателя
     */
    public function to(string $phone): self
    {
        $this->params['phone'] = $phone;

        return $this;
    }

    /**
     * Установить текст письма
     */
    public function line(string $message): self
    {
        $this->params['message'] = $message;

        return $this;
    }

    /**
     * Отправить сообщение
     */
    public function send(): array|\Psr\Http\Message\ResponseInterface|null
    {
        return $this->api->send($this->params);
    }
}
