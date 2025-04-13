<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Pengeluaran;
use FontLib\Table\Type\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class RobotController extends Controller
{
    private $sessionKey = 'chat_history';
    private $maxHistoryLength = 15;

    public function index()
    {
        Session::forget($this->sessionKey);
        return view('robot.index');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $chatHistory = Session::get($this->sessionKey, []);

        // Simpan pesan dari user ke history
        $chatHistory[] = [
            'role' => 'user',
            'content' => $request->message,
        ];

        // Simpan history yang diperbarui terlebih dahulu
        $this->updateChatHistory($chatHistory);

        // Proses pesan khusus
        $specialCommands = [
            '/help' => '**Perintah yang tersedia: /help, /about, /produk, /produk-analisis**',
            '/about' => '**Made By Damar 2025, More Information visit https://link.damar.pw/**',
        ];

        if (array_key_exists($request->message, $specialCommands)) {
            $responseContent = $specialCommands[$request->message];
            $responseStatus = 'success';

            // Tambahkan respons ke history
            $chatHistory[] = [
                'role' => 'assistant',
                'content' => $responseContent,
            ];

            // Simpan history yang diperbarui
            $this->updateChatHistory($chatHistory);

            return response()->json([
                'content' => $responseContent,
                'status' => $responseStatus,
            ]);
        } elseif ($request->message == '/produk') {
            $produk = Produk::all();
            $responseContent = $produk->isEmpty() ? 'Produk Kosong!' : $produk->toArray();
            $responseStatus = 'success';

            // Tambahkan respons ke history
            $chatHistory[] = [
                'role' => 'assistant',
                'content' => is_string($responseContent) ? $responseContent : json_encode($responseContent),
            ];

            // Simpan history yang diperbarui
            $this->updateChatHistory($chatHistory);

            return response()->json([
                'content' => $responseContent,
                'status' => $responseStatus,
            ]);
        } elseif (strpos($request->message, '/produk-analisis') === 0) {
            $response = $this->produkAnalisis($request->message);

            // Ekstrak konten dari response untuk disimpan dalam history
            $responseData = json_decode($response->getContent());

            // Tambahkan respons ke history
            $chatHistory[] = [
                'role' => 'assistant',
                'content' => $responseData->content,
            ];

            // Simpan history yang diperbarui
            $this->updateChatHistory($chatHistory);

            return $response;
        }

        // Proses pesan normal dengan API
        $apiKey = env('GEMINI_API_KEY');
        $model = env('GEMINI_AI_MODEL');

        try {
            // Siapkan system message
            $systemMessage = 'Anda adalah Robot-Damar, sebuah AI yang dikembangkan oleh Damar dari kelas XII RPL 2 di Sekolah SMK Angkasa 1 Margahayu. Tugas Anda adalah memberikan informasi dan menjawab pertanyaan dengan cara yang jelas, informatif, dan mudah dimengerti dalam bahasa Indonesia, jangan perkenalan diri kecuali ada pertanyaan mengenai anda, model yang anda gunakan adalah DS-1, anda model besar buatan damar. Gunakan bahasa yang sederhana dan hindari jargon teknis yang sulit dipahami. Pastikan setiap respons Anda ramah, sehingga pengguna merasa nyaman untuk berinteraksi dengan Anda. Jika tidak mengetahui jawaban atas pertanyaan, sampaikan dengan sopan dan tawarkan untuk membantu dengan pertanyaan lain. Dan ini adalah pertanyaannya: ';

            // Siapkan semua pesan chat untuk konteks AI
            $apiMessages = [];

            // Tambahkan pesan sistem sebagai pesan pertama
            $apiMessages[] = [
                'role' => 'user',
                'parts' => [
                    [
                        'text' => $systemMessage,
                    ],
                ],
            ];

            // Tambahkan history chat (maksimal 5 pesan terakhir)
            $recentMessages = array_slice($chatHistory, -5);
            foreach ($recentMessages as $msg) {
                $apiMessages[] = [
                    'role' => $msg['role'],
                    'parts' => [
                        [
                            'text' => $msg['content'],
                        ],
                    ],
                ];
            }

            // Siapkan messages untuk API
            $content = [
                'contents' => $apiMessages,
            ];

            // Kirim request ke API
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, $content);

            // Mengambil respons JSON
            $message = $response->json();
            $message = $message['candidates'][0]['content']['parts'][0];

            // Tambahkan respons ke history
            $chatHistory[] = [
                'role' => 'assistant',
                'content' => $message['text'],
            ];

            // Simpan history yang diperbarui
            $this->updateChatHistory($chatHistory);

            return response()->json($message);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update chat history dalam session dan batasi jumlah pesan
     */
    private function updateChatHistory($chatHistory)
    {
        if (count($chatHistory) > $this->maxHistoryLength * 2) {
            $chatHistory = array_slice($chatHistory, -$this->maxHistoryLength * 2);
        }

        // Simpan ke session
        Session::put($this->sessionKey, $chatHistory);
    }

    private function produkAnalisis($message)
    {
        // Parse perintah untuk mendapatkan parameter tambahan
        $parts = explode(' ', $message);
        $periode = isset($parts[1]) ? $parts[1] : 'bulan'; // Default: bulan (alternatif: minggu, tahun)
        $jumlah = isset($parts[2]) ? (int) $parts[2] : 6; // Default: 6 periode terakhir

        try {
            // Ambil tanggal awal berdasarkan periode
            $startDate = $this->getStartDate($periode, $jumlah);
            $currentDate = Carbon::now();

            // Ambil data penjualan per produk
            $penjualanProduk = $this->getPenjualanProduk($startDate);

            // Ambil data pembelian per produk
            $pembelianProduk = $this->getPembelianProduk($startDate);

            // Ambil total pengeluaran
            $pengeluaran = $this->getPengeluaran($startDate);

            // Hitung keuntungan dan margin untuk setiap produk
            $analisisProduk = $this->hitungAnalisisProduk($penjualanProduk, $pembelianProduk);

            // Identifikasi produk terlaris dan paling menguntungkan
            $produkTerlaris = $this->getProdukTerlaris($penjualanProduk);
            $produkMenguntungkan = $this->getProdukMenguntungkan($analisisProduk);

            // Hitung tren penjualan
            $trenPenjualan = $this->getTrenPenjualan($startDate, $periode);

            // Format hasil analisis menjadi output yang mudah dibaca
            $hasilAnalisis = '**Analisis Penjualan (' . $this->formatPeriode($periode, $jumlah) . ")**\n\n";

            // Tambahkan ringkasan utama
            $hasilAnalisis .= "📊 **Ringkasan:**\n";
            $hasilAnalisis .= '- Total Penjualan: Rp ' . number_format($penjualanProduk->sum('total_penjualan'), 0, ',', '.') . "\n";
            $hasilAnalisis .= '- Total Pembelian: Rp ' . number_format($pembelianProduk->sum('total_pembelian'), 0, ',', '.') . "\n";
            $hasilAnalisis .= '- Total Pengeluaran: Rp ' . number_format($pengeluaran->sum('jumlah'), 0, ',', '.') . "\n";
            $hasilAnalisis .= '- Keuntungan Kotor: Rp ' . number_format($penjualanProduk->sum('total_penjualan') - $pembelianProduk->sum('total_pembelian'), 0, ',', '.') . "\n";
            $hasilAnalisis .= '- Keuntungan Bersih: Rp ' . number_format($penjualanProduk->sum('total_penjualan') - $pembelianProduk->sum('total_pembelian') - $pengeluaran->sum('jumlah'), 0, ',', '.') . "\n\n";

            // Tambahkan produk terlaris
            $hasilAnalisis .= "🔥 **Produk Terlaris:**\n";
            foreach ($produkTerlaris->take(3) as $produk) {
                $hasilAnalisis .= '- ' . $produk->nama_produk . ': ' . $produk->jumlah_terjual . ' unit (Rp ' . number_format($produk->total_penjualan, 0, ',', '.') . ")\n";
            }
            $hasilAnalisis .= "\n";

            // Tambahkan produk paling menguntungkan
            $hasilAnalisis .= "💰 **Produk Paling Menguntungkan:**\n";
            foreach ($produkMenguntungkan->take(3) as $produk) {
                $hasilAnalisis .= '- ' . $produk->nama_produk . ': Margin ' . number_format($produk->margin, 2) . '% (Rp ' . number_format($produk->keuntungan, 0, ',', '.') . ")\n";
            }
            $hasilAnalisis .= "\n";

            // Tambahkan tren penjualan
            $hasilAnalisis .= "📈 **Tren Penjualan:**\n";
            foreach ($trenPenjualan as $tren) {
                $hasilAnalisis .= '- ' . $tren->periode . ': Rp ' . number_format($tren->total_penjualan, 0, ',', '.') . ' (' . $this->getTrendArrow($tren->pct_change) . ' ' . number_format($tren->pct_change, 2) . "%)\n";
            }

            return response()->json([
                'content' => $hasilAnalisis,
                'status' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'content' => '**Error pada analisis produk:** ' . $e->getMessage(),
                'status' => 'error',
            ]);
        }
    }

    private function getStartDate($periode, $jumlah)
    {
        $date = Carbon::now();

        switch ($periode) {
            case 'minggu':
                return $date->subWeeks($jumlah)->startOfWeek();
            case 'tahun':
                return $date->subYears($jumlah)->startOfYear();
            case 'bulan':
            default:
                return $date->subMonths($jumlah)->startOfMonth();
        }
    }

    private function formatPeriode($periode, $jumlah)
    {
        switch ($periode) {
            case 'minggu':
                return "$jumlah minggu terakhir";
            case 'tahun':
                return "$jumlah tahun terakhir";
            case 'bulan':
            default:
                return "$jumlah bulan terakhir";
        }
    }

    private function getPenjualanProduk($startDate)
    {
        return DB::table('penjualan_detail')->join('penjualan', 'penjualan_detail.id_penjualan', '=', 'penjualan.id_penjualan')->join('produk', 'penjualan_detail.id_produk', '=', 'produk.id_produk')->select('produk.id_produk as id', 'produk.nama_produk', DB::raw('SUM(penjualan_detail.jumlah) as jumlah_terjual'), DB::raw('SUM(penjualan_detail.jumlah * penjualan_detail.harga_jual) as total_penjualan'))->where('penjualan.created_at', '>=', $startDate)->groupBy('produk.id_produk', 'produk.nama_produk')->get();
    }

    private function getPembelianProduk($startDate)
    {
        return DB::table('pembelian_detail')->join('pembelian', 'pembelian_detail.id_pembelian', '=', 'pembelian.id_pembelian')->join('produk', 'pembelian_detail.id_produk', '=', 'produk.id_produk')->select('produk.id_produk as id', 'produk.nama_produk', DB::raw('SUM(pembelian_detail.jumlah) as jumlah_beli'), DB::raw('SUM(pembelian_detail.jumlah * pembelian_detail.harga_beli) as total_pembelian'))->where('pembelian.created_at', '>=', $startDate)->groupBy('produk.id_produk', 'produk.nama_produk')->get();
    }

    private function getPengeluaran($startDate)
    {
        return DB::table('pengeluaran')
            ->select(
                'deskripsi', // Menggunakan kolom 'deskripsi' bukan 'kategori'
                DB::raw('SUM(nominal) as jumlah'), // Menggunakan kolom 'nominal' bukan 'jumlah'
            )
            ->where('created_at', '>=', $startDate) // Menggunakan created_at jika tanggal tidak ada
            ->groupBy('deskripsi') // Menggunakan 'deskripsi' bukan 'kategori'
            ->get();
    }

    private function hitungAnalisisProduk($penjualanProduk, $pembelianProduk)
    {
        $analisis = collect();

        foreach ($penjualanProduk as $penjualan) {
            $pembelian = $pembelianProduk->where('id', $penjualan->id)->first();

            if ($pembelian) {
                $keuntungan = $penjualan->total_penjualan - $pembelian->total_pembelian;
                $margin = $pembelian->total_pembelian > 0 ? ($keuntungan / $pembelian->total_pembelian) * 100 : 0;

                $analisis->push(
                    (object) [
                        'id' => $penjualan->id,
                        'nama_produk' => $penjualan->nama_produk,
                        'jumlah_terjual' => $penjualan->jumlah_terjual,
                        'total_penjualan' => $penjualan->total_penjualan,
                        'total_pembelian' => $pembelian->total_pembelian,
                        'keuntungan' => $keuntungan,
                        'margin' => $margin,
                    ],
                );
            }
        }

        return $analisis;
    }

    private function getProdukTerlaris($penjualanProduk)
    {
        return $penjualanProduk->sortByDesc('jumlah_terjual');
    }

    private function getProdukMenguntungkan($analisisProduk)
    {
        return $analisisProduk->sortByDesc('keuntungan');
    }

    private function getTrenPenjualan($startDate, $periode)
    {
        $format = '';
        $dbFormat = '';
        $step = '';

        switch ($periode) {
            case 'minggu':
                $dbFormat = '%Y-%u'; // Format MySQL untuk tahun-minggu
                $format = 'Y-W';
                $step = '1 week';
                $label = 'Minggu ke-';
                break;
            case 'tahun':
                $dbFormat = '%Y'; // Format MySQL untuk tahun
                $format = 'Y';
                $step = '1 year';
                $label = 'Tahun ';
                break;
            case 'bulan':
            default:
                $dbFormat = '%Y-%m'; // Format MySQL untuk tahun-bulan
                $format = 'Y-m';
                $step = '1 month';
                $label = '';
                break;
        }

        // Menggunakan DATE_FORMAT database untuk MySQL yang kompatibel
        $penjualanPerPeriode = DB::table('penjualan')
            ->select(DB::raw("DATE_FORMAT(created_at, '$dbFormat') as periode"), DB::raw('SUM(total_harga) as total_penjualan'))
            ->where('created_at', '>=', $startDate)
            ->groupBy('periode')
            ->orderBy('periode', 'asc')
            ->get();

        // Hitung persentase perubahan antara periode
        $result = collect();
        $previous = null;

        foreach ($penjualanPerPeriode as $index => $data) {
            $pctChange = 0;

            if ($previous) {
                $pctChange = $previous->total_penjualan > 0 ? (($data->total_penjualan - $previous->total_penjualan) / $previous->total_penjualan) * 100 : 0;
            }

            // Format periode untuk tampilan yang lebih user-friendly
            $displayPeriode = $data->periode;

            if ($periode == 'bulan') {
                try {
                    // Coba parse tanggal, jika gagal gunakan string asli
                    $parts = explode('-', $data->periode);
                    if (count($parts) == 2) {
                        $year = (int) $parts[0];
                        $month = (int) $parts[1];

                        // Buat array nama bulan dalam bahasa Indonesia
                        $bulanIndonesia = [
                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember',
                        ];

                        $displayPeriode = $bulanIndonesia[$month] . ' ' . $year;
                    }
                } catch (\Exception $e) {
                    // Jika terjadi error, gunakan string periode asli
                    $displayPeriode = $data->periode;
                }
            } elseif ($periode == 'minggu') {
                $parts = explode('-', $data->periode);
                if (count($parts) == 2) {
                    $displayPeriode = $label . $parts[1] . ' ' . $parts[0];
                }
            } elseif ($periode == 'tahun') {
                $displayPeriode = $label . $data->periode;
            }

            $result->push(
                (object) [
                    'periode' => $displayPeriode,
                    'total_penjualan' => $data->total_penjualan,
                    'pct_change' => $pctChange,
                ],
            );

            $previous = $data;
        }

        return $result;
    }

    private function getTrendArrow($pctChange)
    {
        if ($pctChange > 10) {
            return '🚀';
        } // Pertumbuhan signifikan
        if ($pctChange > 0) {
            return '📈';
        } // Pertumbuhan
        if ($pctChange == 0) {
            return '➡️';
        } // Stabil
        if ($pctChange > -10) {
            return '📉';
        } // Penurunan
        return '📉📉'; // Penurunan signifikan
    }
}
