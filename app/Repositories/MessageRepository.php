<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    public function createMessage(array $data)
    {
        return Message::create($data);
    }

    public function deleteMessage(int $messageId)
    {
        $message = Message::find($messageId);

        if ($message) {
            $message->delete();
        }
    }

    public function getChatMessages(int $chatId)
    {
        return Message::where('chat_id', $chatId)->paginate(40);
    }
}
