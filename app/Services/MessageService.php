<?php

namespace App\Services;

use App\Models\Message;
use App\Repositories\MessageRepository;

class MessageService
{
    private MessageRepository $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function createMessage(array $data)
    {
        // todo logic of media messages
        return $this->messageRepository->createMessage($data);
    }

    public function deleteMessage(Message $message)
    {
        $this->messageRepository->deleteMessage($message->id);
    }

}
