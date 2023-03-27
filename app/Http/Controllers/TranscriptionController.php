<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Http;
use OpenAI\Client;
class TranscriptionController extends Controller
{
    public function transcribe(Request $request)
    {
        // Check if audio file was uploaded
        if (!$request->hasFile('audio-file')) {
            return response()->json('No audio file uploaded.', 400);
        }

        // Get input language from form data
        $inputLanguage = $request->input('language-input', 'en');

        // Get API key from environment variable
        $apiKey = env('OPENAI_API_KEY');
        if (!$apiKey) {
            return response()->json('No API key found.', 400);
        }

        // Upload audio file to OpenAI API with curl
        $audioFile = $request->file('audio-file');
        $audioFilePath = $audioFile->getPathname();
        $audioFileType = $audioFile->getMimeType();
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.openai.com/v1/audio/transcriptions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: multipart/form-data'
            ],
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'file' => curl_file_create($audioFilePath, $audioFileType, $audioFile->getClientOriginalName()),
                'model' => 'whisper-1'
            ]
        ]);
        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        // Check response status code
        if ($statusCode != 200) {
            return response()->json('Error transcribing audio.', 500);
        }

        // Get transcription from response body
        $responseArray = json_decode($response, true);
        $transcription = $responseArray['text'];
        return response()->json($transcription);
    }
}
