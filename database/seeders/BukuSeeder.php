<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buku::create([
            'judul' => 'Malin Kundang',
            'penulis' => 'Yuliadi Soekardi',
            'penerbit' => 'Gramedia',
            'tahun_terbit' => 2000,
            'jenis' => 'Novel',
            'sinopsis' => 'Demi memperbaiki nasibnya, Malin Kundang pergi sebuah ke negeri asing untuk mencari peruntungan. Tapi setelah menikahi putri kerajaan, ia kembali ke rumah dan tak mengakui ibu kandungnya yang miskin.',
            'foto' => 'png'

        ]);
    }
}
