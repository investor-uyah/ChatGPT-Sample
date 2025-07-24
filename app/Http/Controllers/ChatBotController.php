<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

//use OpenAI;  // Ensure you have the correct namespace for OpenAI

class ChatBotController extends Controller
{
    public function sendchat(Request $request)
    {
        // Get the input from the user
        $input = $request->input('input'); // Make sure input is passed as 'input'

        // Call OpenAI API using the chat method for gpt-4 (or gpt-3.5-turbo)
        $result = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',  // Use gpt-4 or gpt-3.5-turbo
            'messages' => [
                ['role' => 'user', 'content' => $input],  // User's input as a message
            ],
            'max_tokens' => 100,  // Optional: set the token limit
        ]);

        // Extract the response from the API result
        $response = $result->choices[0]->message->content;


        // Dump the response for debugging
        return $response;
    }
}

