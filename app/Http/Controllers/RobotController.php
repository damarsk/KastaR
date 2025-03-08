<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RobotController extends Controller
{
    public function index() {
        return view('robot.index');
    }

    public function sendMessage(Request $request)
    {
        // Validasi input
        $request->validate([
            'message' => 'required|string',
        ]);

        // Ambil kunci API dari .env
        $apiKey = env('OPENROUTER_API_KEY');
        $model = env('OPENROUTER_AI_MODEL');

        // Kirim permintaan ke API
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'HTTP-Referer' => 'https://damar.pw/',
                'X-Title' => 'Damar',
                'Content-Type' => 'application/json',
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => $model,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => 'Anda adalah Robot-Damar, sebuah AI yang dikembangkan oleh Damar dari kelas XII RPL 2 di Sekolah SMK Angkasa 1 Margahayu. Tugas Anda adalah memberikan informasi dan menjawab pertanyaan dengan cara yang jelas, informatif, dan mudah dimengerti dalam bahasa Indonesia. Dan ini adalah pertanyaannya: ' . $request->message,
                    ],
                ],
            ]);

            $message = $response->json()['choices'][0]['message'];
            return response()->json($message);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
