<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\adm_menu;


class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        adm_menu::create([
            'induk' => 'head',
            'uuid' => uniqid(),
            'kode_menu' => 'A',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Dashboard',
            'route' => 'dashboard',
            'remark' => 'Rekapan Data dan Grafis',
        ]);
         adm_menu::create([
            'induk' => 'head',
            'uuid' => uniqid(),
            'kode_menu' => 'B',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Master Data',
            'route' => '',
            'remark' => 'Master Data Sistem',
        ]);
           adm_menu::create([
            'induk' => 'head',
            'uuid' => uniqid(),
            'kode_menu' => 'C',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Proses',
            'route' => '',
            'remark' => 'Proses Data',
        ]);
        adm_menu::create([
            'induk' => 'head',
            'uuid' => uniqid(),
            'kode_menu' => 'D',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Reporting',
            'route' => '',
            'remark' => 'Laporan Data',
        ]);
        
          adm_menu::create([
            'induk' => 'Master Data',
            'uuid' => uniqid(),
            'kode_menu' => 'B1',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Unit',
            'route' => 'unit',
            'remark' => 'Master Data Unit',
        ]);
         adm_menu::create([
            'induk' => 'Master Data',
            'uuid' => uniqid(),
            'kode_menu' => 'B2',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Tingkat',
            'route' => 'tingkat',
            'remark' => 'Master Data Tingkat',
        ]);
         adm_menu::create([
            'induk' => 'Master Data',
            'uuid' => uniqid(),
            'kode_menu' => 'B3',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Kelas',
            'route' => 'kelas',
            'remark' => 'Master Data Kelas',
        ]);
         adm_menu::create([
            'induk' => 'Master Data',
            'uuid' => uniqid(),
            'kode_menu' => 'B4',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Siswa',
            'route' => 'siswa',
            'remark' => 'Master Data Siswa',
        ]);
        adm_menu::create([
            'induk' => 'Master Data',
            'uuid' => uniqid(),
            'kode_menu' => 'B5',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Tahun Pelajaran',
            'route' => 'tahun_pelajaran',
            'remark' => 'Master Tahun Pelajaran',
        ]);
         adm_menu::create([
            'induk' => 'Master Data',
            'uuid' => uniqid(),
            'kode_menu' => 'B6',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Semester',
            'route' => 'semester',
            'remark' => 'Master Data Semester',
        ]);
        adm_menu::create([
            'induk' => 'Master Data',
            'uuid' => uniqid(),
            'kode_menu' => 'B7',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Non Tagihan',
            'route' => 'non_tagihan',
            'remark' => 'Master Data Non Tagihan',
        ]);
        adm_menu::create([
            'induk' => 'Master Data',
            'uuid' => uniqid(),
            'kode_menu' => 'B8',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Tagihan',
            'route' => 'tagihan',
            'remark' => 'Master Data Tagihan',
        ]);
        adm_menu::create([
            'induk' => 'Master Data',
            'uuid' => uniqid(),
            'kode_menu' => 'B9',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Tagihan Tingkat',
            'route' => 'tagihan_tingkat',
            'remark' => 'Master Data Tagihan Tingkat',
        ]);
        adm_menu::create([
            'induk' => 'Master Data',
            'uuid' => uniqid(),
            'kode_menu' => 'B10',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Data Tagihan Siswa',
            'route' => 'tagihan_siswa',
            'remark' => 'Master Data Tagihan Siswa',
        ]);
        adm_menu::create([
            'induk' => 'Master Data',
            'uuid' => uniqid(),
            'kode_menu' => 'B11',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Akun Head',
            'route' => 'akun_head',
            'remark' => 'Master Data Akun Head',
        ]);adm_menu::create([
            'induk' => 'Master Data',
            'uuid' => uniqid(),
            'kode_menu' => 'B12',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Sub Akun Head',
            'route' => 'akun_head_sub',
            'remark' => 'Master Data Sub Akun head',
        ]);
        adm_menu::create([
            'induk' => 'Master Data',
            'uuid' => uniqid(),
            'kode_menu' => 'B13',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Sub Sub Akun Head',
            'route' => 'sub_sub_akun',
            'remark' => 'Master Data Sub Sub Akun Head',
        ]);
        adm_menu::create([
            'induk' => 'Master Data',
            'uuid' => uniqid(),
            'kode_menu' => 'B14',
            'icon' => "",
            'urut' => "",
            'nama_menu' =>'Akun',
            'route' => 'akun',
            'remark' => 'Master Data Akun',
        ]);


    }
}
