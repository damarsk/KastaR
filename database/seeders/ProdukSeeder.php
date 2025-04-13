<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat kategori
        $kategori = [
            ['nama_kategori' => 'Makanan'],
            ['nama_kategori' => 'Minuman'],
            ['nama_kategori' => 'Snack'],
            ['nama_kategori' => 'Perlengkapan Mandi'],
            ['nama_kategori' => 'Alat Tulis']
        ];

        DB::table('kategori')->insert($kategori);

        // Membuat produk
        $produk = [
            // Kategori Makanan
            [
                'id_kategori' => 1,
                'kode_produk' => 'P000001',
                'nama_produk' => 'Indomie Goreng',
                'merk' => 'Indomie',
                'harga_beli' => 2500,
                'harga_jual' => 3000,
                'stok' => 0
            ],
            [
                'id_kategori' => 1,
                'kode_produk' => 'P000002',
                'nama_produk' => 'Beras Putih Premium',
                'merk' => 'Tani Makmur',
                'harga_beli' => 12000,
                'harga_jual' => 13500,
                'stok' => 0
            ],
            [
                'id_kategori' => 1,
                'kode_produk' => 'P000003',
                'nama_produk' => 'Minyak Goreng',
                'merk' => 'Bimoli',
                'harga_beli' => 14000,
                'harga_jual' => 16000,
                'stok' => 0
            ],
            [
                'id_kategori' => 1,
                'kode_produk' => 'P000004',
                'nama_produk' => 'Telur Ayam',
                'merk' => 'Telur Segar',
                'harga_beli' => 23000,
                'harga_jual' => 25000,
                'stok' => 0
            ],
            [
                'id_kategori' => 1,
                'kode_produk' => 'P000005',
                'nama_produk' => 'Gula Pasir',
                'merk' => 'Gulaku',
                'harga_beli' => 12500,
                'harga_jual' => 14000,
                'stok' => 0
            ],

            [
                'id_kategori' => 2,
                'kode_produk' => 'P000006',
                'nama_produk' => 'Aqua 600ml',
                'merk' => 'Aqua',
                'harga_beli' => 2000,
                'harga_jual' => 3000,
                'stok' => 0
            ],
            [
                'id_kategori' => 2,
                'kode_produk' => 'P000007',
                'nama_produk' => 'Teh Botol Sosro',
                'merk' => 'Sosro',
                'harga_beli' => 3500,
                'harga_jual' => 5000,
                'stok' => 0
            ],
            [
                'id_kategori' => 2,
                'kode_produk' => 'P000008',
                'nama_produk' => 'Pocari Sweat',
                'merk' => 'Pocari',
                'harga_beli' => 5000,
                'harga_jual' => 7000,
                'stok' => 0
            ],
            [
                'id_kategori' => 2,
                'kode_produk' => 'P000009',
                'nama_produk' => 'Ultra Milk',
                'merk' => 'Ultra Jaya',
                'harga_beli' => 4500,
                'harga_jual' => 6000,
                'stok' => 0
            ],

            // Kategori Snack
            [
                'id_kategori' => 3,
                'kode_produk' => 'P000010',
                'nama_produk' => 'Chitato',
                'merk' => 'Chitato',
                'harga_beli' => 8000,
                'harga_jual' => 10000,
                'stok' => 0
            ],
            [
                'id_kategori' => 3,
                'kode_produk' => 'P000011',
                'nama_produk' => 'Taro',
                'merk' => 'Taro',
                'harga_beli' => 7000,
                'harga_jual' => 9000,
                'stok' => 0
            ],
            [
                'id_kategori' => 3,
                'kode_produk' => 'P000012',
                'nama_produk' => 'Oreo',
                'merk' => 'Kraft',
                'harga_beli' => 6000,
                'harga_jual' => 8000,
                'stok' => 0
            ],
            [
                'id_kategori' => 3,
                'kode_produk' => 'P000013',
                'nama_produk' => 'Pocky',
                'merk' => 'Glico',
                'harga_beli' => 8500,
                'harga_jual' => 10500,
                'stok' => 0
            ],

            // Kategori Perlengkapan Mandi
            [
                'id_kategori' => 4,
                'kode_produk' => 'P000014',
                'nama_produk' => 'Sabun Lifebuoy',
                'merk' => 'Lifebuoy',
                'harga_beli' => 3000,
                'harga_jual' => 4500,
                'stok' => 0
            ],
            [
                'id_kategori' => 4,
                'kode_produk' => 'P000015',
                'nama_produk' => 'Shampoo Clear',
                'merk' => 'Clear',
                'harga_beli' => 15000,
                'harga_jual' => 18000,
                'stok' => 0
            ],
            [
                'id_kategori' => 4,
                'kode_produk' => 'P000016',
                'nama_produk' => 'Sikat Gigi Formula',
                'merk' => 'Formula',
                'harga_beli' => 4000,
                'harga_jual' => 6000,
                'stok' => 0
            ],
            [
                'id_kategori' => 4,
                'kode_produk' => 'P000017',
                'nama_produk' => 'Pasta Gigi Pepsodent',
                'merk' => 'Pepsodent',
                'harga_beli' => 8000,
                'harga_jual' => 10000,
                'stok' => 0
            ],

            // Kategori Alat Tulis
            [
                'id_kategori' => 5,
                'kode_produk' => 'P000018',
                'nama_produk' => 'Pulpen Pilot',
                'merk' => 'Pilot',
                'harga_beli' => 2000,
                'harga_jual' => 3500,
                'stok' => 0
            ],
            [
                'id_kategori' => 5,
                'kode_produk' => 'P000019',
                'nama_produk' => 'Buku Tulis',
                'merk' => 'Sinar Dunia',
                'harga_beli' => 3000,
                'harga_jual' => 4500,
                'stok' => 0
            ],
            [
                'id_kategori' => 5,
                'kode_produk' => 'P000020',
                'nama_produk' => 'Pensil 2B',
                'merk' => 'Faber Castell',
                'harga_beli' => 2500,
                'harga_jual' => 4000,
                'stok' => 0
            ],
            [
                'id_kategori' => 5,
                'kode_produk' => 'P000021',
                'nama_produk' => 'Penghapus',
                'merk' => 'Steadtler',
                'harga_beli' => 1500,
                'harga_jual' => 3000,
                'stok' => 0
            ]
        ];

        DB::table('produk')->insert($produk);
    }
}
