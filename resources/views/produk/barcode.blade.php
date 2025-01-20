<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  
    <title>Cetak Barcode</title>  
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .text-center {  
            text-align: center;  
        }  
  
        .a4-container {
            width: 210mm;  
            height: 297mm;  
            margin: 0 auto;  
            padding: 10px;  
        }  
  
        table {  
            width: 100%;  
            border-collapse: collapse;  
        }  
  
        td {  
            border: 1px solid #000;  
            padding: 10px;  
            width: 33.33%; /* Memastikan setiap kolom memiliki lebar yang sama */  
            box-sizing: border-box; /* Memastikan padding dan border termasuk dalam lebar total */  
        }  
    </style>  
</head>  
<body style="background-color: #000000;">
    <div class="a4-container" style="background-color: #ffffff;">
        <table>  
            @php  
                $index = 0;  
            @endphp  
            @foreach ($dataproduk as $produk)  
                @if ($index % 3 == 0)  
                    <tr>  
                @endif  
                <td class="text-center">  
                    <p>{{$produk->nama_produk}} - Rp. {{format_uang($produk->harga_jual)}}</p>  
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk->kode_produk, 'C39') }}" alt="{{ $produk->kode_produk }}" width="144" height="57"/>  
                    <br>
                    {{ $produk->kode_produk }}  
                </td>  
                @if (($index + 1) % 3 == 0 || $loop->last)  
                    </tr>  
                @endif  
                @php  
                    $index++;  
                @endphp  
            @endforeach  
        </table>
    </div>
</body>  
</html>  