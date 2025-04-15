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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid #000;
            padding: 10px;
            width: 33.33%;
            box-sizing: border-box;
        }

        tr {
            display: table-row;
        }
    </style>
</head>

<body>
    <div>
        <table>
            @php
                $counter = 0;
                $totalItems = count($dataproduk);
            @endphp

            @foreach ($dataproduk as $produk)
                @if ($counter % 3 == 0)
                    <tr>
                @endif

                <td class="text-center">
                    <p>{{ $produk->nama_produk }} - Rp. {{ format_uang($produk->harga_jual) }}</p>
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk->kode_produk, 'C39') }}"
                        alt="{{ $produk->kode_produk }}" width="188" height="57" />
                    <br>
                    {{ $produk->kode_produk }}
                </td>

                @if (($counter + 1) % 3 == 0)
                    </tr>
                @elseif ($loop->last)
                    @for ($i = 0; $i < (3 - ($totalItems % 3)) % 3; $i++)
                        <td class="text-center"></td>
                    @endfor
                    </tr>
                @endif

                @php
                    $counter++;
                @endphp
            @endforeach
        </table>
    </div>
</body>

</html>
