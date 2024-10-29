<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendMessageRequest;
use App\Http\Resources\ChatResource;
use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Services\ChatService;
use App\Services\MessageService;
use App\Traits\HttpResponseTrait;

class ChatController extends Controller
{

    use HttpResponseTrait;
    private ChatService $chatService;
    private MessageService $messageService;

    public function __construct(ChatService $chatService, MessageService $messageService)
    {
        $this->chatService = $chatService;
        $this->messageService = $messageService;
    }

    public function sendMessage(SendMessageRequest $request, Chat $chat)
    {
        $data = $request->validated();
        $request->user()->isTeacher() ? $data['teacher_id'] = $request->user()->id : $data['student_id'] = $request->user()->id;
        $message = $this->messageService->sendMessage($data, $chat);

        return $this->success(
            [
                'message' => MessageResource::make($message)
            ]
        );
    }

    public function getChatMessages(Chat $chat){

        $messages = $this->messageService->getChatMessages($chat);

        return $this->success(
            [
                'chat' => ChatResource::make($chat),
                'messages' => MessageResource::collection($messages),
                'current_page'=> $messages->currentPage(),
                'last_page'=> $messages->lastPage(),
                'total'=> $messages->total(),
            ]
        );
    }
}
