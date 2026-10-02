<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'judul' => 'OVERHOUL EXCAVATOR KUBOTA U-50',
                'gambar' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=600&auto=format&fit=crop',
                'kategori' => 'Overhaul & Heavy Equipment',
            ],
            [
                'judul' => 'REPLACE MAIN PUMP, CONTROL VALVE & FINAL DRIVE D31',
                'gambar' => 'https://images.unsplash.com/photo-1504307651254-35680f356f12?q=80&w=600&auto=format&fit=crop',
                'kategori' => 'Replacement & Repair',
            ],
            [
                'judul' => 'OVERHOUL EXCAVATOR PC130-F',
                'gambar' => 'https://images.unsplash.com/photo-1578328819058-b69f3a3b0f6b?q=80&w=600&auto=format&fit=crop',
                'kategori' => 'Overhaul & Heavy Equipment',
            ],
            [
                'judul' => 'GENERAL UNDERCARRIAGE MAINTENANCE',
                'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=600&auto=format&fit=crop',
                'kategori' => 'Maintenance',
            ],
            [
                'judul' => 'GENERAL REPAIR DUMP TRUCK',
                'gambar' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?q=80&w=600&auto=format&fit=crop',
                'kategori' => 'Vehicle Repair',
            ],
            [
                'judul' => 'REPLACE & INSTALL TYRE FORKLIFT',
                'gambar' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=600&auto=format&fit=crop',
                'kategori' => 'Tyre & Installation',
            ],
            [
                'judul' => 'PREVENTIVE MAINTENANCE WATER TRUCK',
                'gambar' => 'https://images.unsplash.com/photo-1581092335397-9583fe92d232?q=80&w=600&auto=format&fit=crop',
                'kategori' => 'Maintenance',
            ],
            [
                'judul' => 'INSTALL PTO & HYDRAULIC SYSTEM',
                'gambar' => 'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?q=80&w=600&auto=format&fit=crop',
                'kategori' => 'Installation',
            ],
            [
                'judul' => 'REPLACE WIRE ROPE CRANE TRUCK',
                'gambar' => 'https://images.unsplash.com/photo-1541888946425-d0fbb186a5b7?q=80&w=600&auto=format&fit=crop',
                'kategori' => 'Replacement & Repair',
            ],
            [
                'judul' => 'JASA INSTALL AIR CONDITIONER INDUSTRIAL',
                'gambar' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?q=80&w=600&auto=format&fit=crop',
                'kategori' => 'AC & Air System',
            ],
            [
                'judul' => 'JASA MAINTENANCE AIR CONDITIONER HEAVY EQUIPMENT',
                'gambar' => 'https://images.unsplash.com/photo-1504307651254-35680f356f12?q=80&w=600&auto=format&fit=crop',
                'kategori' => 'AC & Air System',
            ],
        ];

        foreach ($projects as $project) {
            \App\Models\ProjectDocument::create($project);
        }
    }
}
