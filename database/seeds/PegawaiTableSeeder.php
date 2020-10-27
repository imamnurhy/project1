<?php

use Illuminate\Database\Seeder;
use App\Models\Opd;
use App\Models\Rumpun;
use App\Models\Unitkerja;
use App\Models\Golongan;
use App\Models\Eselon;

class PegawaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rumpuns = [
            [
                'n_rumpun' => 'ASDA 1',
                'ket' => 'ASISTEN TATA PEMERINTAHAN'
            ],
            [
                'n_rumpun' => 'ASDA 2',
                'ket' => 'ASISTEN EKONOMI DAN PENGEMBANGAN'
            ],
            [
                'n_rumpun' => 'ASDA 3',
                'ket' => 'ASISITEN ADMINISTRASI UMUM DAN KESEJAHTERAAN RAKYAT'
            ]
        ];
        foreach ($rumpuns as $rumpun) {
            Rumpun::create([
                'n_rumpun' => $rumpun['n_rumpun'],
                'ket' => $rumpun['ket'],
            ]);
        }

        $opds = [
            ['kode' => '110101', 'n_opd' => 'DINAS PENDIDIKAN DAN KEBUDAYAAN', 'initial' => 'DINDIK', 'rumpun_id' => '3'],
            ['kode' => '110201', 'n_opd' => 'DINAS KESEHATAN', 'initial' => 'DINKES', 'rumpun_id' => '3'],
            ['kode' => '110202', 'n_opd' => 'RUMAH SAKIT UMUM', 'initial' => 'RSUD', 'rumpun_id' => '1'],
            ['kode' => '110301', 'n_opd' => 'DINAS PEKERJAAN UMUM', 'initial' => 'DPU', 'rumpun_id' => '2'],
            ['kode' => '110302', 'n_opd' => 'DINAS BANGUNAN DAN PENATAAN RUANG', 'initial' => 'DBPR', 'rumpun_id' => '2'],
            ['kode' => '110401', 'n_opd' => 'DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN', 'initial' => 'DPKPP', 'rumpun_id' => '2'],
            ['kode' => '110501', 'n_opd' => 'DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN', 'initial' => 'DPKP', 'rumpun_id' => '1'],
            ['kode' => '110502', 'n_opd' => 'BADAN PENANGGULANGAN BENCANA DAERAH', 'initial' => 'BPBD', 'rumpun_id' => '1'],
            ['kode' => '110503', 'n_opd' => 'SATUAN POLISI PAMONG PRAJA', 'initial' => 'SATPOL', 'rumpun_id' => '1'],
            ['kode' => '110504', 'n_opd' => 'BADAN KESATUAN BANGSA DAN POLITIK', 'initial' => 'KESBANGPOL', 'rumpun_id' => '1'],
            ['kode' => '110601', 'n_opd' => 'DINAS SOSIAL', 'initial' => 'DINSOS', 'rumpun_id' => '0'],
            ['kode' => '120101', 'n_opd' => 'DINAS KETENAGAKERJAAN', 'initial' => 'DISNAKER', 'rumpun_id' => '2'],
            ['kode' => '120201', 'n_opd' => 'DINAS PEMBERDAYAAN MASYARAKAT PEMBERDAYAAN PEREMPUAN PERLINDUNGAN ANAK DAN KELUARGA BERENCANA', 'initial' => 'DPMP3AKB', 'rumpun_id' => '3'],
            ['kode' => '120501', 'n_opd' => 'DINAS LINGKUNGAN HIDUP', 'initial' => 'DLH', 'rumpun_id' => '2'],
            ['kode' => '120601', 'n_opd' => 'DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL', 'initial' => 'DISDUKCAPIL', 'rumpun_id' => '1'],
            ['kode' => '120901', 'n_opd' => 'DINAS PERHUBUNGAN', 'initial' => 'DISHUB', 'rumpun_id' => '2'],
            ['kode' => '121001', 'n_opd' => 'DINAS KOMUNIKASI DAN INFORMATIKA', 'initial' => 'DISKOMINFO', 'rumpun_id' => '2'],
            ['kode' => '121101', 'n_opd' => 'DINAS KOPERASI, USAHA KECIL DAN MENENGAH', 'initial' => 'DKUKM', 'rumpun_id' => '2'],
            ['kode' => '121201', 'n_opd' => 'DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU', 'initial' => 'DPMPTSP', 'rumpun_id' => '2'],
            ['kode' => '121301', 'n_opd' => 'DINAS PEMUDA DAN OLAHRAGA', 'initial' => 'DPO', 'rumpun_id' => '3'],
            ['kode' => '121701', 'n_opd' => 'DINAS PERPUSTAKAAN DAN ARSIP DAERAH', 'initial' => 'DPAD', 'rumpun_id' => '0'],
            ['kode' => '200201', 'n_opd' => 'DINAS PARIWISATA', 'initial' => 'DISPAR', 'rumpun_id' => '2'],
            ['kode' => '200301', 'n_opd' => 'DINAS KETAHANAN PANGAN, PERTANIAN DAN PERIKANAN', 'initial' => 'DPPK', 'rumpun_id' => '2'],
            ['kode' => '200401', 'n_opd' => 'DINAS PERINDUSTRIAN DAN PERDAGANGAN', 'initial' => 'DISPERINDAG', 'rumpun_id' => '2'],
            ['kode' => '300101', 'n_opd' => 'BADAN PERENCANAAN PEMBANGUNAN DAERAH', 'initial' => 'BAPEDA', 'rumpun_id' => '2'],
            ['kode' => '300201', 'n_opd' => 'BADAN PENDAPATAN  DAERAH', 'initial' => 'BPD', 'rumpun_id' => '1'],
            ['kode' => '300202', 'n_opd' => 'BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH', 'initial' => 'BPKAD', 'rumpun_id' => '3'],
            ['kode' => '300301', 'n_opd' => 'BADAN KEPEGAWAIAN, PENDIDIKAN DAN PELATIHAN', 'initial' => 'BKD', 'rumpun_id' => '1'],
            ['kode' => '300501', 'n_opd' => 'SEKRETARIAT DPRD', 'initial' => 'SEKWAN', 'rumpun_id' => '1'],
            ['kode' => '300601', 'n_opd' => 'SEKRETARIAT DAERAH', 'initial' => 'SEKDA', 'rumpun_id' => '0'],
            ['kode' => '300701', 'n_opd' => 'INSPEKTORAT', 'initial' => 'INSPEKTORAT', 'rumpun_id' => '1'],
            ['kode' => '300801', 'n_opd' => 'KECAMATAN CIPUTAT', 'initial' => 'CIPUTAT', 'rumpun_id' => '0'],
            ['kode' => '300802', 'n_opd' => 'KECAMATAN CIPUTAT TIMUR', 'initial' => 'CIPUTAT TIMUR', 'rumpun_id' => '0'],
            ['kode' => '300803', 'n_opd' => 'KECAMATAN PAMULANG', 'initial' => 'PAMULANG', 'rumpun_id' => '0'],
            ['kode' => '300804', 'n_opd' => 'KECAMATAN SERPONG', 'initial' => 'SERPONG', 'rumpun_id' => '0'],
            ['kode' => '300805', 'n_opd' => 'KECAMATAN SERPONG UTARA', 'initial' => 'SERPONG UTARA', 'rumpun_id' => '0'],
            ['kode' => '300806', 'n_opd' => 'KECAMATAN PONDOK AREN', 'initial' => 'PONDOK AREN', 'rumpun_id' => '0'],
            ['kode' => '300807', 'n_opd' => 'KECAMATAN SETU', 'initial' => 'SETU', 'rumpun_id' => '0'],
            ['kode' => '300901', 'n_opd' => 'DEWAN PERWAKILAN RAKYAT DAERAH', 'initial' => 'DPRD', 'rumpun_id' => '1'],
            ['kode' => '300902', 'n_opd' => 'WALIKOTA DAN WAKIL WALIKOTA', 'initial' => 'KDH-WKDH', 'rumpun_id' => '0'],
            ['kode' => '300202', 'n_opd' => 'SATUAN KERJA PEGELOLA KEUANGAN DAERAH', 'initial' => 'SKPKD', 'rumpun_id' => '0']
        ];
        foreach ($opds as $opd) {
            Opd::create([
                'kode' => $opd['kode'],
                'n_opd' => $opd['n_opd'],
                'initial' => $opd['initial'],
                'rumpun_id' => $opd['rumpun_id']
            ]);
        }

        $unitkerjas = [
            '-',
            'Kepala',
            'Sekretariat',
            'Kepala Bidang',
            'Kepala Seksi',
            'Staf'
        ];
        for($i=1;$i<41;$i++){
            foreach ($unitkerjas as $unitkerja) {
                Unitkerja::create([
                    'n_unitkerja' => $unitkerja,
                    'opd_id' => $i
                ]);
            }
        }

        $golongans = [
            ['n_golongan' => 'I/a Juru Muda', 'ket' => ' '],
            ['n_golongan' => 'I/b Juru Muda Tingkat I', 'ket' => ' '],
            ['n_golongan' => 'I/c Juru', 'ket' => ' '],
            ['n_golongan' => 'I/d Juru Tingkat I', 'ket' => ' '],
            ['n_golongan' => 'II/a Pengatur Muda', 'ket' => ' '],
            ['n_golongan' => 'II/b Pengatur Muda Tingkat I', 'ket' => ' '],
            ['n_golongan' => 'II/c Pengatur', 'ket' => ' '],
            ['n_golongan' => 'II/d Pengatur Tingkat I', 'ket' => ' '],
            ['n_golongan' => 'III/a Penata Muda', 'ket' => ' '],
            ['n_golongan' => 'III/b Penata Muda Tingkat I', 'ket' => ' '],
            ['n_golongan' => 'III/c Penata', 'ket' => ' '],
            ['n_golongan' => 'III/d Penata Tingkat I', 'ket' => ' '],
            ['n_golongan' => 'IV/a Pembina', 'ket' => ' '],
            ['n_golongan' => 'IV/b Pembina Tingkat I', 'ket' => ' '],
            ['n_golongan' => 'IV/c Pembina Utama Muda', 'ket' => ' '],
            ['n_golongan' => 'IV/d Pembina Utama Madya', 'ket' => ' '],
            ['n_golongan' => 'IV/e Pembina Utama', 'ket' => ' ']
        ];
        foreach($golongans as $golongan){
            Golongan::create([
                'n_golongan' => $golongan['n_golongan'],
                'ket' => $golongan['ket'],        
            ]);
        }

        $eselons = [
            ['n_eselon' => 'Ia', 'ket' => ' '],
            ['n_eselon' => 'Ib', 'ket' => ' '],
            ['n_eselon' => 'IIa', 'ket' => 'Sekretaris Daerah'],
            ['n_eselon' => 'IIb', 'ket' => 'Asisten·Staf Ahli Bupati/Wali kota·Sekretaris DPRD·Kepala Dinas·Kepala Badan·Direktur RS Umum Daerah Kelas A dan B'],
            ['n_eselon' => 'IIIa', 'ket' => "Kepala Kantor·Camat·Kepala Bagian·Sekretaris pada Dinas/ Badan/Inspektorat·Inspektur Pembantu·Direktur RS Umum Kelas C / B·Wakil Direktur RS Umum Kelas A dan B·Wakil Direktur RS Khusus Kelas A"],
            ['n_eselon' => 'IIIb', 'ket' => 'Kepala Bidang pada Dinas dan Badan·Kepala Bagian dan Kepala Bidang pada RS Umum Daerah·Direktur RS Umum Daerah Kelas D·Sekretaris Camat'],
            ['n_eselon' => 'IVa', 'ket' => 'Lurah·Kepala Subbagian·Kepala Subbidang·Kepala Seksi·Kepala UPT Dinas dan Badan'],
            ['n_eselon' => 'IVb', 'ket' => 'Sekretaris Kelurahan·Kepala Seksi pada Kelurahan·Kepala Subbagian pada UPT·Kepala Subbagian pada Sekretariat Kecamatan·Kepala TU Sekolah Menengah Kejuruan'],
            ['n_eselon' => 'Va', 'ket' => 'Kepala TU Sekolah Lanjutan Tingkat Pertama·Kepala TU Sekolah Menengah Umum']
        ];
        foreach($eselons as $eselon){
           Eselon::create([
               'n_eselon' => $eselon['n_eselon'],
               'ket' => $eselon['ket']
           ]); 
        }
    }
}
