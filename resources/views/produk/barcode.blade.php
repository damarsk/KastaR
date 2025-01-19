<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>
    <style>
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            @foreach ($dataproduk as $produk)
            <td class="text-center" style="border: 1px solid #000; padding: 10px;">
                <p>{{$produk->nama_produk}} - Rp. {{format_uang($produk->harga_jual)}}</p>
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk->kode_produk, 'C39') }}" alt="{{ $produk->kode_produk }}" width="120" height="60"/>
                <br><br>
                {{ $produk->kode_produk }}
            </td>
            @endforeach
        </tr>
    </table>
</body>
</html>