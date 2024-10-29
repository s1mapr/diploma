<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer '.env('CHAT_GPT_KEY'),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function getExplanation($question, $userAnswer, $correctAnswer)
    {
        $prompt = "Питання: $question .Правильні відповіді: $correctAnswer .Відповіді користувача: $userAnswer .Поясни, будь ласка, чому відповідь не є вірною або частково вірною, якщо це так. Відповідай українською мовою, звертайся до учня ніби ти говориш з ним.";
        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Ти є помічником, який пояснює, чому відповіді на тестові питання є правильними або неправильними українською мовою.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'max_tokens' => 150,
            ],
        ]);

        $result = json_decode($response->getBody(), true);

        return $result['choices'][0]['message']['content'];
    }
}
