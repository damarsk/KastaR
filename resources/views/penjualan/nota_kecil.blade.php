<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Kecil</title>

    <?php
    $tinggi = !empty($_COOKIE['innerHeight']) ? $_COOKIE['innerHeight'] : '150'; // fallback 150mm
    $style = '
    <style>
        * {
            font-family: "consolas", sans-serif;
        }
        p {
            display: block;
            margin: 3px;
            font-size: 10pt;
        }
        table td {
            font-size: 9pt;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }

        @media print {
            @page {
                margin: 0;
                size: 58mm ' . $tinggi . 'mm;
            }

            html, body {
                width: 58mm;
                margin: 0;
                padding: 0;
            }

            .btn-print {
                display: none;
            }
        }
    </style>';
    ?>

    {!! $style !!}
</head>
<body onload="setTimeout(() => window.print(), 500)">
    <button class="btn-print" style="position: absolute; right: 1rem; top: 1rem;" onclick="window.print()">Print</button>

    <div class="text-center">
        <h3 style="margin-bottom: 5px;">{{ strtoupper($setting->nama_perusahaan) }}</h3>
        <p>{{ strtoupper($setting->alamat) }}</p>
    </div>
    <br>
    <div>
        <p style="float: left;">{{ date('d-m-Y') }}</p>
        <p style="float: right">{{ strtoupper(auth()->user()->name) }}</p>
    </div>
    <div class="clear-both" style="clear: both;"></div>
    <p>No: {{ tambah_nol_didepan($penjualan->id_penjualan, 10) }}</p>
    <p class="text-center">===================================</p>
    
    <br>
    <table width="100%" style="border: 0;">
        @foreach ($detail as $item)
            <tr>
                <td colspan="3">{{ $item->produk->nama_produk }}</td>
            </tr>
            <tr>
                <td>{{ $item->jumlah }} x {{ format_uang($item->harga_jual) }}</td>
                <td></td>
                <td class="text-right">{{ format_uang($item->jumlah * $item->harga_jual) }}</td>
            </tr>
        @endforeach
    </table>
    <p class="text-center">-----------------------------------</p>

    <table width="100%" style="border: 0;">
        <tr>
            <td>Total Harga:</td>
            <td class="text-right">{{ format_uang($penjualan->total_harga) }}</td>
        </tr>
        <tr>
            <td>Total Item:</td>
            <td class="text-right">{{ format_uang($penjualan->total_item) }}</td>
        </tr>
        <tr>
            <td>Diskon:</td>
            <td class="text-right">{{ format_uang($penjualan->diskon) }}</td>
        </tr>
        <tr>
            <td>Total Bayar:</td>
            <td class="text-right">{{ format_uang($penjualan->bayar) }}</td>
        </tr>
        <tr>
            <td>Diterima:</td>
            <td class="text-right">{{ format_uang($penjualan->diterima) }}</td>
        </tr>
        <tr>
            <td>Kembali:</td>
            <td class="text-right">{{ format_uang($penjualan->diterima - $penjualan->bayar) }}</td>
        </tr>
    </table>

    <p class="text-center">===================================</p>
    <p class="text-center">-- TERIMA KASIH --</p>

    <script>
        // Hitung tinggi konten dan simpan dalam cookie
        let body = document.body;
        let html = document.documentElement;

        let height = Math.max(
            body.scrollHeight, body.offsetHeight,
            html.clientHeight, html.scrollHeight, html.offsetHeight
        );

        let mmHeight = ((height + 50) * 0.264583).toFixed(2); // px to mm
        document.cookie = "innerHeight=" + mmHeight;
        console.log("Tinggi nota:", mmHeight + "mm");
    </script>
</body>
</html>
