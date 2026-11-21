<?php

use App\Models\OrganizationMember;

if (OrganizationMember::count() > 0) {
    echo 'Already seeded: ' . OrganizationMember::count() . ' records';
    return;
}

$direktur = OrganizationMember::create(['jabatan' => 'DIREKTUR', 'nama' => 'Yudhiani Mirdhatillah', 'urutan' => 1, 'parent_id' => null]);

$pjo = OrganizationMember::create(['jabatan' => 'PENANGGUNG JAWAB OPERASIONAL', 'nama' => 'Darul Imam Mustofa', 'urutan' => 2, 'parent_id' => $direktur->id]);

$fa1  = OrganizationMember::create(['jabatan' => 'FINANCE & ACCOUNTING', 'nama' => 'Aji Dwi Andika Putra',  'urutan' => 1, 'parent_id' => $pjo->id]);
$mek1 = OrganizationMember::create(['jabatan' => 'MEKANIK',              'nama' => 'Sunaryo Suwito',        'urutan' => 2, 'parent_id' => $pjo->id]);
$weld = OrganizationMember::create(['jabatan' => 'WELDER',               'nama' => 'Jainuri',               'urutan' => 3, 'parent_id' => $pjo->id]);
$tac1 = OrganizationMember::create(['jabatan' => 'TEKNISI AC',           'nama' => 'Saprudin',              'urutan' => 4, 'parent_id' => $pjo->id]);

OrganizationMember::create(['jabatan' => 'FINANCE & ACCOUNTING', 'nama' => 'Azrilia Istiqomah', 'urutan' => 1, 'parent_id' => $fa1->id]);
OrganizationMember::create(['jabatan' => 'MEKANIK',              'nama' => 'Misrani',           'urutan' => 1, 'parent_id' => $mek1->id]);
$tac2 = OrganizationMember::create(['jabatan' => 'TEKNISI AC',  'nama' => 'Murhan',             'urutan' => 1, 'parent_id' => $tac1->id]);
OrganizationMember::create(['jabatan' => 'TEKNISI AC',           'nama' => 'Muamar',            'urutan' => 1, 'parent_id' => $tac2->id]);

echo 'Seeded ' . OrganizationMember::count() . ' records OK';
