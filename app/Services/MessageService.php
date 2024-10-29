<?php

namespace App\Services;

use App\Enums\MessageType;
use App\Events\MessageDeleted;
use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\Message;
use App\Repositories\MessageRepository;

class MessageService
{
    private MessageRepository $messageRepository;
    private S3Service $s3Service;

    public function __construct(MessageRepository $messageRepository, S3Service $s3Service)
    {
        $this->messageRepository = $messageRepository;
        $this->s3Service = $s3Service;
    }

    public function sendMessage($data, Chat $chat){
        $data['chat_id'] = $chat->id;

        if($data['content_type'] == MessageType::MEDIA->value){
            $data['content'] = $this->s3Service->uploadFile(
                'chats/' . $chat->id,
                $data['content'],
                uniqid('file_', true)
            );
        }

        $message = $this->messageRepository->createMessage($data);
        $this->checkIfChatNotStartedAndUpdateChatStatus($chat);

        broadcast(new MessageSent($message))->toOthers();

        return $message;
    }

    public function deleteMessage(Message $message)
    {
        $this->messageRepository->deleteMessage($message->id);

        broadcast(new MessageDeleted($message->chat_id, $message->id))->toOthers();
    }

    private function checkIfChatNotStartedAndUpdateChatStatus(Chat $chat): void
    {
        if (! $chat->is_started) {
            $chat->is_started = true;
            $chat->save();
        }
    }

    public function getChatMessages(Chat $chat)
    {
        return $this->messageRepository->getChatMessages($chat->id);
    }
}
