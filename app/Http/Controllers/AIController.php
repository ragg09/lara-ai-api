<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Sentiment\Analyzer;

class AIController extends Controller
{
    public function generateSuggestion(Request $request)
    {

        $inputText = $request->input('text');

        $client = new Client();

        $response = $client->post('https://api.openai.com/v1/engines/davinci-codex/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            ],
            'json' => [
                'prompt' => $inputText,
                'max_tokens' => 50,
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);
        $suggestion = $responseData['choices'][0]['text'];

        return response()->json(['suggestion' => $suggestion]);
    }

    public function sentimentAnalyzer(Request $request)
    {
        $inputText = $request->input('text');
        $analyzer = new Analyzer();

        $data = $analyzer->getSentiment($inputText);


        return response()->json(['sentiment' => $data, 'source' => 'https://github.com/davmixcool/php-sentiment-analyzer']);
    }
}
