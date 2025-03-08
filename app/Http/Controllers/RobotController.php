<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RobotController extends Controller
{
    public function index() {
        return view('robot.index');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        if($request->message == "/help") {
            return response()->json([
                'content' => '**Perintah yang tersedia: /help, /about**',
                'status' => 'success'
            ]);
        } else if ($request->message == "/about") {
            return response()->json([
                'content' => '**Made By Damar 2024-03-08, More Information visit https://link.damar.pw/**',
                'status' => 'success'
            ]);
        } else if ($request->message == "/produk") {
            $produk = Produk::all();
            if ($produk->isEmpty()) {
                $produk = "Produk Kosong!";
            }
            return response()->json([
                'content' => $produk,
                'status' => 'success'
            ]);
        }

        $apiKey = env('OPENROUTER_API_KEY');
        $model = env('OPENROUTER_AI_MODEL');

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
                        'content' => 'Anda adalah Robot-Damar, sebuah AI yang dikembangkan oleh Damar dari kelas XII RPL 2 di Sekolah SMK Angkasa 1 Margahayu. Tugas Anda adalah memberikan informasi dan menjawab pertanyaan dengan cara yang jelas, informatif, dan mudah dimengerti dalam bahasa Indonesia, jangan perkenalan diri kecuali ada pertanyaan mengenai anda, model yang anda gunakan adalah DS-1, anda model besar buatan damar. Gunakan bahasa yang sederhana dan hindari jargon teknis yang sulit dipahami. Pastikan setiap respons Anda ramah, sehingga pengguna merasa nyaman untuk berinteraksi dengan Anda. Jika tidak mengetahui jawaban atas pertanyaan, sampaikan dengan sopan dan tawarkan untuk membantu dengan pertanyaan lain. Dan ini adalah pertanyaannya: ' . $request->message,
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
