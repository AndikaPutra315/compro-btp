<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            'PT. Astra Agro Lestari',
            'PT. Bara Pramulya Abadi',
            'PT. Belengkong Mineral Resources',
            'PT. Bhadra Cemerlang',
            'PT. Borneo Persada Sukses Indonesia',
            'PT. DKND Gulden Investama',
            'PT. Diesel Utama Indonesia',
            'PT. Diesel Utama Mineral',
            'PT. Global Energi Lestari',
            'PT. Kalimantan Mitra Persada',
            'PT. Makmur Sejahtera Wisesa',
            'PT. Tanjung Power Indonesia',
            'PT. Tri Buana Mas',
        ];

        foreach ($clients as $index => $nama) {
            Client::firstOrCreate(
                ['nama_perusahaan' => $nama],
                [
                    'logo' => null,
                    'urutan' => $index + 1,
                ]
            );
        }
    }
}
