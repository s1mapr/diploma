<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Services\MessageService;

class MessageController extends Controller
{
    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function deleteMessage(Message $message)
    {
        $this->messageService->deleteMessage($message);

        return $this->successWithoutData('Message deleted successfully');
    }
}
