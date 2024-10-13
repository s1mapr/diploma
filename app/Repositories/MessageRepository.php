<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    public function createMessage(array $data)
    {
        return Message::save($data);
    }

    public function deleteMessage(int $messageId)
    {
        Message::delete($messageId);
    }
}
