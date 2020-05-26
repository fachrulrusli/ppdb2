<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'login' => array(
        'title'     =>"Login",
        'subtitle'  =>"Masuk dengan username dan password saat mengakses sistem, harap dicatat, jangan sampai orang lain tahu username dan password Anda ... !!",
        'title_box' =>"",
        'alert' =>"Enter any username and password. ",
        'form'      => array(
            'username' => "NIK",
            'password' => "Password",
            'remember' => "Remember me",
        ),
        'button'      => array(
            'login' => "Masuk"
        ),
    ),
    'dashboard' => array(
        'title'     =>"Dashboard",
        'subtitle'  =>"",
        'title_box' =>"",
        'alert'     =>"",
        'content'      => array(
            'remun_pj'      => "Remunerasi Pinjaman",
            'remun_sm'      => "Remunerasi Simpanan",
            'simpanan'      => "Simpanan",
            'pinjaman'      => "Pinjaman",
        ),
        'button'      => array(
            'login' => "Sign in"
        ),
    ),
    'province' => array(
        'title' => "Provinsi",
        'subtitle' => "Provinsi",
        'title_box' => "Provinsi",
        'add' =>'Tambah',
        'edit' =>'Ubah',
        'form' => array(
            'provname' => "Provinsi",
            'm_provname' => "Masukan Nama Provinsi",
        ),
        'table' => array(
            'id' => "ID",
            'provname' => "Provinsi",
        ),
        'button'  => array(
            'submit' => "Simpan",
            'cancel' => "Batal"
        ),
        'alert'  => array(
            'success' => "Data berhasil disimpan..",
            'error' => "Data gagal disimpan..",
            'error_unknown' => "Terdapat error, silahkan hubungin administrator"
        ),
        'confirm'  => array(
            'title' => "Apakah anda ingin melanjutkan proses ini ?",
            'y' => "Ya",
            'n' => "Tidak"
        ),

    ),
    'city' => array(
        'title' => "Kota",
        'subtitle' => "Kota",
        'title_box' => "Kota",
        'form' => array(
            'add'=>'Tambah Data Kota',
            'edit'=>'Edit Data Kota',
            'labelcity' => "Masukan Nama Kota",
            'city' => "Kota",
            'labelprov' => "Pilih Nama Provinsi",
            'prov' => "Provinsi",
            'backbtn' => "Kembali",
            'submit' => "Simpan",
            'reset' => "Ulang",
        ),
        'table' => array(
            'id' => "ID",
            'cityname' => "Kota",
            'provname' => "Provinsi",
        ),
        'button'  => array(
            'submit' => "Simpan",
            'cancel' => "Batal"
        ),
        'alert'  => array(
            'success' => "Data berhasil disimpan..",
            'error' => "Data gagal disimpan..",
            'error_unknown' => "Terdapat error, silahkan hubungin administrator"
        ),
        'confirm'  => array(
            'title' => "Apakah anda ingin melanjutkan proses ini ?",
            'y' => "Ya",
            'n' => "Tidak"
        ),
    ),
    'user' => array(
        'title'     =>"User",
        'subtitle'  =>"",
        'title_box' =>"",
        'alert'     =>"",
        'add'       =>"Tambah",
        'edit'      =>"Ubah",
        'form'      => array(
            'username'      => "Username",
            'pass'          => "Kata Sandi",
            'name'          => "Nama",
            'jenis'         => "Jenis Cabang",
            'm_name'        => "Masukan Nama",
            'm_username'    => "Masukan Username",
            'm_pass'        => "Masukan Kata Sandi",
            'k_pass'        => "Konfirmasi Kata Sandi",
            'm_k_pass'      => "Masukan Konfirmasi Kata Sandi",
            'status'        => "Status",
            'p_status'      => "Pilih Status",
            'cabang'        => "Cabang",
            'p_cabang'      => "Pilih Cabang",
            'grup'          => "Grup",
            'p_grup'        => "Pilih Grup",
            'o_pass'        => "Kata Sandi Otor",
            'm_o_pass'      => "Masukan Kata Sandi Otor",
            'k_o_pass'      => "Konfirmasi Kata Sandi Otor",
            'm_k_o_pass'    => "Masukan Konfirmasi Kata Sandi Otor",
        ),
        'table'      => array(
            'username'      => "Username",
            'name'          => "Nama",
            'branch'        => "Cabang",
            'status'        => "Status",
            'action'        => "Aksi",
        ),
        'action'    => array(
            'user_akses'      => 'Akses',
            'user_menus'      => 'Menu'
        ),
        'akses'     => array(
            'title'     =>"Akses User",

        ),
        'menu'      =>array(
            'title'     =>"Menu User",
        )
    ),
    'menu' => array(
        'title'     =>"Menu",
        'subtitle'  =>"",
        'title_box' =>"",
        'alert'     =>"",
        'add'       =>"Tambah",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'nama_menu'     => 'Nama Menu',
            'url'           => 'Url',
            'menu_grup'     => 'Menu Grup',
            'attribut'      => 'Attribut',
            'deskripsi'     => 'Deskripsi',
            'menu_utama'    => 'Menu Utama',
            'status'        => 'Status',
            'urutan'        => 'Urutan',
            'icon'          => 'Icon',
        ),
        'table'      => array(
            'nama_menu'     => 'Nama Menu',
            'url'           => 'Url',
            'menu_grup'     => 'Menu Grup',
            'attribut'      => 'Attribut',
            'deskripsi'     => 'Deskripsi',
            'menu_utama'    => 'Menu Utama',
            'status'        => 'Status',
            'urutan'        => 'Urutan',
        ),
    ),
    'group' => array(
        'title'     =>"Grup",
        'subtitle'  =>"",
        'title_box' =>"",
        'alert'     =>"",
        'add'       =>"Tambah",
        'edit'      =>"Rubah",
        'report'    =>"Report",
        'form'      => array(
            'nama_grup' => 'Nama grup',
            'status'     => 'Status',
            'keterangan' => 'Keterangan',
        ),
        'table'      => array(
            'nama_grup' => 'Nama grup',
            'status'     => 'Status',
            'keterangan' => 'Keterangan',
        ),
        'akses'     => array(
            'title'     =>"Akses Grup",
        ),
        'menu'     => array(
            'title'     =>"Akses Menu Grup",
        )
    ),
    'branch' => array(
        'title'     =>"Cabang",
        'subtitle'  =>"",
        'title_box' =>"",
        'alert'     =>"",
        'add'       =>"Tambah",
        'edit'      =>"Sunting",
        'form'      => array(
            'kode_cabang'       => "Kode Cabang",
            'm_kode_cabang'     => "Masukan Kode Cabang",
            'nama_cabang'       => 'Nama Cabang',
            'm_nama_cabang'     => 'Masukan Nama Cabang',
            'regional'          => 'Regional',
            'm_regional'        => 'Masukan Regional',
            'id_kota'           => 'Kota',
            'm_id_kota'         => 'Masukan Kota',
            'jenis'             => 'Jenis Cabang',
            'm_jenis'           => 'Masukan Jenis Cabang',
            'urutan'            => 'Urutan',
            'm_urutan'          => 'Masukan Urutan',
            'bm'                => 'BM',
            'm_bm'              => 'Masukan BM',
            'rm'                => 'RM',
            'm_rm'              => 'Masukan RM',
            'tgl_berdiri'       => 'Tanggal Berdiri',
            'm_tgl_berdiri'     => 'Masukan Tanggal Berdiri',
            'alamat'            => 'Alamat',
            'm_alamat'          => 'Masukan Alamat',
            'id_bank'           => 'Nama Bank',
            'm_id_bank'         => 'Masukan Nama Bank',
            'a_n_rek'           => 'AN Rekening',
            'm_a_n_rek'         => 'Masukan AN Rekening',
            'no_rekening'       => 'No. Rekening',
            'm_no_rekening'     => 'Masukan No. Rekening',
            'taget_pj'          => 'Target Pinjaman',
            'm_taget_pj'        => 'Masukan Target Pinjaman',
            'taget_smp'         => 'Target Simpanan',
            'm_taget_smp'       => 'Masukan Target Simpanan',
            'fl_jasa_baru'      => 'FL Jasa Baru',
            'm_fl_jasa_baru'      => 'Masukan FL Jasa Baru',
            'status'            => 'Status',
            'penampungan_da'      => 'Penampung DA',
            'penampungan_titipan_mps' => 'Penampungan Titipan MPS',
            'penampungan_titipan_mpp' => 'Penampungan Titipan MPP',
            'penampungan_titipan_bpa' => 'Penampungan Titipan BPA',
            'penampungan_titipan_bkt' => 'Penampungan Titipan BKT',
            'penampungan_titipan_bpp' => 'Penampungan Titipan BPP',
            'penampungan_titipan_bkpt' => 'Penampungan Titipan BKPT',
            'penampungan_titipan_bkpa' => 'Penampungan Titipan BKPA',
            'penampungan_titipan_mpp_ip' => 'Penampungan Titipan MPP IP',
            'penampungan_titipan_mpp_pp' => 'Penampungan Titipan MPP PP',
            'penampungan_titipan_mpp_kt' => 'Penampungan Titipan MPP KT',
            'penampungan_tfp_spsw'     => 'Penampungan TFP SPSW',
            'norek_konfiden'           => 'Norek Konfiden'    
        ),
    ),
    'akses' => array(
        'title'     =>"Akses",
        'subtitle'  =>"",
        'title_box' =>"",
        'alert'     =>"",
        'add'       =>"Tambah",
        'edit'      =>"Sunting",
        'field'     => array(
            'nama' => 'Nama Akses',
            'slug' => 'Slug',
            'keterangan' => 'Keterangan'
        ),
        'form'     => array(
            'nama'                  => 'Nama Akses',
            'm_nama_nama'           => 'Masukan Nama Akses',
            'slug'                  => 'Slug',
            'm_nama_slug'           => 'Masukan Slug',
            'keterangan'            => 'Keterangan',
            'm_nama_keterangan'     => 'Masukan Keterangan'
        ),
    ),
'bank' => array(
    'title'     =>"Bank",
    'add'       =>"Tambah",
    'edit'      =>"Ubah",
    'confirm'   => array(
        'title'         => "Apakah anda ingin melanjutkan proses ini ?"
    ),
    'form'      => array(
        'nama_bank'     => 'Nama Bank',
        'm_nama_bank'   => 'Masukan Nama Bank',
        'keyword'       => 'Kata Kunci',
        'm_keyword'     => 'Masukan Kata Kunci',
        'rtgs'          => 'RTGS',
        'm_rtgs'        => 'Masukan RTGS',
        'kliring'       => 'Kliring',
        'm_kliring'     => 'Masukan Kliring',
        'int_code'      => 'Code',
        'm_int_code'    => 'Masukan Code',
    ),
    'table'      => array(
        'nama_bank'     => 'Nama Bank',
        'keyword'       => 'Kata Kunci',
        'rtgs'          => 'RTGS',
        'kliring'       => 'Kliring',
        'int_code'      => 'Code',
    ),
),
'smk' => array(
    'member'=>array(
        'title'     =>"Keanggotaan Koperasi",
        'box_title' =>'',
        'add'       =>"Tambah",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'id_member'  => 'ID Member',
            'nama'   => 'Nama',
            'no_ktp'     => 'No Ktp',
            'no_cif'     => 'No Cif',
            'alamat'     => 'Alamat',
            'tlp1'   => 'No. Telepon I',
            'tlp2'   => 'No. Telepon II',
            'status_member'  => 'Status Member',
            'start_branch'   => 'Cabang Buka',
            'curr_branch'    => 'Cabang Sekarang',
            'dt_join'    => 'Tanggal Join',
            'tempat_lahir'   => 'Tempat Lahir',
            'tgl_lahir'  => 'Tgl Lahir',
            'agama'  => 'Agama',
            'jns_kelamin'    => 'Jenis Kelamin',
            'sts_perkawinan'     => 'Status Perkawinan',
            'alm_rt'     => 'Rt',
            'alm_rw'     => 'Rw',
            'alm_kelurahan'  => 'Kelurahan',
            'alm_kecamatan'  => 'Kecamatan',
            'alm_kode_pos'   => 'Kode Pos',
            'alm_koresponden'    => 'Koresponden',
            'sts_tmp_tinggal'    => 'Status Tmp Tinggal',
            'alm_kota'   => 'Kota',
            'tinggal_thn'    => 'Tinggal Tahun',
            'tinggal_bln'    => 'Tinggal Bulan',
            'jns_pekerjaan'  => 'Jenis Pekerjaan',
            'jabatan'    => 'Jabatan',
            'sts_kerja'  => 'Status Kerja',
            'kerja_thn'  => 'Kerja Thn',
            'kerja_bln'  => 'Kerja Bln',
            'alamat_kerja'   => 'Alamat Kerja',
            'kode_pos_kantor'    => 'Kode Pos Kantor',
            'tlp_kantor'     => 'Tlp Kantor',
            'email'  => 'Email',
            'ibu_kandung'    => 'Ibu Kandung',
            'jns_anggota'    => 'Jenis Anggota',
            'flg_ktp_nik'    => 'Flg Ktp Nik',

        ),
        'table'      => array(
            'id_member'  => 'ID Member',
            'nama'   => 'Nama',
            'jns_anggota'    => 'Jenis Anggota',
            'tlp1'   => 'No. Telp 1',
            'tlp2'   => 'No. Telp 2',
            'dt_join'    => 'Tgl. Join',
            'alamat'     => 'Alamat',
        ),
    ),
    'otor_anggota'=>array(
        'title'     =>"Otorisasi Anggota",
        'add'       =>"Tambah",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'table'      => array(
            'id_member'  => 'ID Member',
            'nama'       => 'Nama',
            'curr_branch'=> 'Cabang',
            'created_at' => 'Tgl. Trans',
            'alamat'     => 'Alamat',
            'otor_cabang'=> 'Otorisasi Cabang',
            'otor_pusat' => 'Otorisasi Pusat',
            'otor'       => 'Otorisasi',
            'dt_join'    => 'Tgl. Join',
        ),
    ),
    'otor_spsw'=>array(
        'title'     =>"Otorisasi SPSW",
        'add'       =>"Tambah",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'table'      => array(
            'id_member'  => 'ID Member',
            'nama'       => 'Nama',
            'curr_branch'=> 'Cabang',
            'created_at' => 'Tgl. Trans',
            'alamat'     => 'Alamat',
            'otor_cabang'=> 'Otorisasi Cabang',
            'otor_pusat' => 'Otorisasi Pusat',
            'otor'       => 'Otorisasi',
            'nominal'    => 'Nominal',
            'jns_bayar'    => 'Jenis Bayar',
        ),
    ),
    'otor_anggota_pusat'=>array(
        'title'     =>"Otorisasi Anggota Pusat",
        'add'       =>"Tambah",
        'edit'      =>"Ubah",
        'cabang'    =>"Pilih Cabang",
        's_cabang'  =>"Semua Cabang",
        'periode'   =>"Pilih Periode",
        'periode1'  =>"Periode Awal",
        'periode2'  =>"Periode Akhir",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'table'      => array(
            'id_member'  => 'ID Member',
            'nama'       => 'Nama',
            'curr_branch'=> 'Cabang',
            'created_at' => 'Tgl. Trans',
            'alamat'     => 'Alamat',
            'otor_cabang'=> 'Otorisasi Cabang',
            'otor_pusat' => 'Otorisasi Pusat',
            'otor'       => 'Otorisasi',
            'dt_join'    => 'Tgl. Join',
        ),
    ),
    'otor_spsw_pusat'=>array(
        'title'     =>"Otorisasi SPSW Pusat",
        'add'       =>"Tambah",
        'edit'      =>"Ubah",
        'cabang'    =>"Pilih Cabang",
        's_cabang'  =>"Semua Cabang",
        'periode'  =>"Periode",
        'periode1'  =>"Periode Awal",
        'periode2'  =>"Periode Akhir",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'table'      => array(
            'id_member'  => 'ID Member',
            'nama'       => 'Nama',
            'curr_branch'=> 'Cabang',
            'created_at' => 'Tgl. Trans',
            'alamat'     => 'Alamat',
            'otor_cabang'=> 'Otorisasi Cabang',
            'otor_pusat' => 'Otorisasi Pusat',
            'otor'       => 'Otorisasi',
            'nominal'    => 'Nominal',
            'jns_bayar'    => 'Jenis Bayar',
        ),
    ),
    'spsw'=>array(
        'title'     =>"Data SPSW",
        'add'       =>"Tambah",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'table'      => array(
            'id'         => 'Kode SMK',
            'id_member'  => 'ID Member',
            'nama'       => 'Nama',
            'tgl_bayar'  => 'Tgl. Bayar',
            'jns_bayar'  => 'Jenis Bayar',
            'nominal'    => 'Nominal',
            'cabang'     => 'Cabang',
        ),
        'form'      => array(
            'nama'      => 'Nama Anggota',
            'id_member' => 'No. Anggota',
            'alamat'    => 'Alamat',
            'status'    => 'Status Anggota',
            'jns_bayar' => 'Jenis Bayar',
        ),
    ),
),
'ref' => array(
    'title'     =>"Referensi",
    'add'       =>"Tambah Data Referensi",
    'edit'      =>"Ubah Data Referensi",
    'confirm'   => array(
        'title'         => "Apakah anda ingin melanjutkan proses ini ?"
    ),
    'form'      => array(
        'kode_ref'      => 'Kode Ref',
        'nama'          => 'Nama Referensi',
        'jenis'         => 'Jenis',
        'keterangan'    => 'Keterangan',
        'status'        => 'Status',
        'm_kode_ref'      => 'Masukan Kode Referensi',
        'm_nama'          => 'Masukan Nama Referensi',
        'm_jenis'         => 'Pilih Jenis',
        'm_keterangan'    => 'Masukan Keterangan',
        'm_status'        => 'Pilih Status',
        'm_nama_jenis'    => 'Masukan Jenis',
    ),
    'table'      => array(
        'kode_ref'      => 'Kode Referensi',
        'nama'          => 'Referensi',
        'jenis'         => 'Jenis',
        'keterangan'    => 'Keterangan',
        'status'        => 'Status',
        'nama_jenis'    => 'Jenis',
    ),
),
'sistem' => array(
    'report'=>array(
        'title'     =>"Report",
        'add'       =>"Tambah",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'nama'          => 'Nama',
            'url'           => 'Url',
            'keterangan'    => 'Keterangan',
            'parameter'     => 'Parameter',
            'jenis'         => 'Pilih Jenis',
            'jenis_table'   => 'Jenis',
            'status'        => 'Status',
        ),

    ),
),

'parametertable' => array(
    'kodetransaksi'=>array(
        'title'     =>"Kode Transaksi",
        'add'       =>"Tambah",
        'subtitle' => "Kode Transaksi",
        'title_box' => "Kode Transaksi",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'trn_code'      => 'Transaksi Kode',
            'nama'          => 'Keterangan Transaksi',
            'ndac'    => 'Ledger Account Debit',
            'ncac'     => 'Ledger Account Credit',

            'dac'    => 'No. Ledger',
            'cac'     => 'No. Ledger',


            'adv'     => 'Diperlukan Advise',
            'tcdbuku'   => 'TCD Buku',
            'status'    => 'Status',
            'kredit'    => 'Kredit',
            'debit'     => 'Debit',
            'flagrab'  => 'Jenis Rekening',
            'pending'   => 'Pending Otor',
            'rekapkode'   => 'Transaksi di Rekap Per Kode Transaksi',
            'kycp'      => 'KYCP',
            'trnteller' => 'Transaksi Antar Teller',
            'trnkoreksi' => 'Kode Transaksi u/. Koreksi',
            'jmlharibunga'  => '+ Jumlah Hari Saldo Perhitungan Bunga',
            'jmlharipenarikan'  => '+/- Jumlah Hari Efektif Saldo Penarikan',
            'tglboleh'  => 'Tanggal Boleh di Ubah',
            'vld'   => 'Diperlukan Validasi Db ?',
            'vldcr' => 'Diperlukan Validasi Cr ?',
            'otor'  => 'Diperlukan Otorisasi',
            'kdtrf' => 'Kode Transaksi Transfer',
            'adv_desc'  => 'Keterangan Advise',
            'sys'   => 'Kode System',
            'fcoa'  => 'No. Ledger Account Boleh Diubah?'
        ),

    ),

    'instansi'=>array(
        'title'     =>"Instansi",
        'add'       =>"Tambah",
        'subtitle' => "Instansi",
        'title_box' => "Instansi",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'kdcab'      => 'Kode Cabang',
            'kd_instansi'          => 'Kode Instansi',
            'kd_old'    => 'Kode Lama',
            'nm_instansi'     => 'Nama Instansi',
            'alamat1'    => 'Alamat1',
            'alamat2'     => 'Alamat2',
            'kota'     => 'Kota',
            'kodepos'   => 'Kode POS',
            'tlp'    => 'Telepon',
            'pimpinan'    => 'Pimpinan',
            'nippimpinan'     => 'NIP Pimpinan',
            'bendahara'  => 'Bendahara',
            'nipbendahara'   => 'NIP Bendahara',
            'noac'   => 'Rekening Debet',
            'status'      => 'status'
        ),

    ),


    'harilibur'=>array(
        'title'     =>"Hari Libur",
        'add'       =>"Tambah",
        'subtitle' => "Hari Libur",
        'title_box' => "Hari Libur",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        

    ),

    'accountofficer'=>array(
        'title'     =>"Account Officer",
        'add'       =>"Tambah",
        'subtitle' => "Account Officer",
        'title_box' => "Account Officer",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'kode_ao'      => 'Kode AO',
            'nm_ao'          => 'Nama AO',
            'jenis'    => 'Jenis',
            'tipe'    => 'Tipe',
            'kode_spv'    => 'Kode SPV',
            'kode_mgr'    => 'Kode MGR',
            'tipe'    => 'tipe'

        ),
        

    ),


    'grouptransaksi'=>array(
        'title'     =>"Group Transaksi",
        'add'       =>"Tambah",
        'subtitle' => "Group Transaksi",
        'title_box' => "Group Transaksi",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
    ),

    'groupsubledger'=>array(
        'title'     =>"Group Subledger",
        'add'       =>"Tambah",
        'subtitle' => "Group Subledger",
        'title_box' => "Group Subledger",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ), 
    ),



    'groupsandibi'=>array(
        'title'     =>"Group Sandi-BI",
        'add'       =>"Tambah",
        'subtitle' => "Group Sandi-BI",
        'title_box' => "Group Sandi-BI",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
    ),

    'tablesandibi'=>array(
        'title'     =>"Table Sandi-BI",
        'add'       =>"Tambah",
        'subtitle' => "Table Sandi-BI",
        'title_box' => "Table Sandi-BI",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'kd_bi'      => 'Kode BI',
            'kd_sandi'          => 'Kode Sandi',
            'keterangan'    => 'Keterangan',
            'keterangan1'    => 'Keterangan 1'
        ),     
    ),

    'kodepos'=>array(
        'title'     =>"Table Kode POS",
        'add'       =>"Tambah",
        'subtitle' => "Table Kode POS",
        'title_box' => "Table Kode POS",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'lokush'    => 'Kode Lokasi',
            'kota'      => 'Kab/Kota/Kotif',
            'provinsi'          => 'Provinsi',
            'zcd'    => 'Kode POS',
            'kelurahan'    => 'Kelurahan',
            'kecamatan'    => 'Kecamatan'
        ),     
    ),
    'jeniskendaraan'=>array(
        'title'     =>"Jenis Kendaraan",
        'add'       =>"Tambah",
        'subtitle' => "Jenis Kendaraan",
        'title_box' => "Jenis Kendaraan",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
    ),
    'merkkendaraan'=>array(
        'title'     =>"Merk Kendaraan",
        'add'       =>"Tambah",
        'subtitle' => "Merk Kendaraan",
        'title_box' => "Merk Kendaraan",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
    ),

      'tipekendaraan'=>array(
        'title'     =>"Table Tipe Kendaraan",
        'add'       =>"Tambah",
        'subtitle' => "Table Tipe Kendaraan",
        'title_box' => "Table Tipe Kendaraan",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'kd_jenis'      => 'Kode Jenis',
            'kd_merk'          => 'Kode Merk',
            'tipe'    => 'Kode Tipe',
            'keterangan'    => 'Tipe'
        ),
    ),
      'dealerkendaraan'=>array(
        'title'     =>"Table Dealer Kendaraan",
        'add'       =>"Tambah",
        'subtitle' => "Table Dealer Kendaraan",
        'title_box' => "Table Dealer Kendaraan",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        
    ),
      'bankkerjasama'=>array(
        'title'     =>"Table Bank Kerjasama",
        'add'       =>"Tambah",
        'subtitle' => "Table Bank Kerjasama",
        'title_box' => "Table Bank Kerjasama",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'kd_bank'    => 'Kode Lokasi',
            'nama_bank'      => 'Nama Bank',
            'alamat'          => 'Alamat',
            'alamat1'    => 'Alamat 1',
            'kota'    => 'Kota',
            'telpon'    => 'Telepon',
            'no_rek'    => 'No Rekening',
            'nogladm'    => 'ADM',
            'noglkrd'    => 'Cair',
            'noglkrd1'    => 'Cair 1',
            'noglpok'    => 'Pokok',
            'noglpok1'    => 'Pokok 1',
            'noglbng'    => 'Bunga',
            'noglbng1'    => 'Bunga 1'
        ),     
    ),
      'standbylimit'=>array(
        'title'     =>"Standby Limit",
        'add'       =>"Tambah",
        'subtitle' => "Standby Limit",
        'title_box' => "Standby Limit",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
    ),
      'pengikatan'=>array(
        'title'     =>"Pengikatan",
        'add'       =>"Tambah",
        'subtitle' => "Pengikatan",
        'title_box' => "Pengikatan",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
    ),

      'bankstandinginstruction'=>array(
        'title'     =>"Table Bank Standing Instruction",
        'add'       =>"Tambah",
        'subtitle' => "Table Bank Standing Instruction",
        'title_box' => "Table Bank Standing Instruction",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'kdbank'    => 'Kode Bank',
            'banknm'      => 'Nama Bank',
            'noac'          => 'Sub Ledger'
        ),
    ),
      'alasan'=>array(
        'title'     =>"Table Alasan",
        'add'       =>"Tambah",
        'subtitle' => "Table Alasan",
        'title_box' => "Table Alasan",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
    ),
      'kantorkas'=>array(
        'title'     =>"Table Kantor Kas",
        'add'       =>"Tambah",
        'subtitle' => "Table Kantor Kas",
        'title_box' => "Table Kantor Kas",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
    ),
      'tablenotaris'=>array(
        'title'     =>"Table Notaris",
        'add'       =>"Tambah",
        'subtitle' => "Table Notaris",
        'title_box' => "Table Notaris",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'nomor'    => 'Kode',
            'nama'      => 'Nama Notaris',
            'no_ijin'          => 'Nomor Ijin',
            'alamat'          => 'Alamat',
            'kota'          => 'Kota',
            'telpon'          => 'Telpon',
            'no_acc'          => 'Nomor Rekening',
            'jamin1'          => 'SBI',
            'jamin2'          => 'Tabungan dan Deposito',
            'jamin4'          => 'Perhiasan Emas dan Logam Mulia',
            'jamin5'          => 'Kendaraan Bermotor',
            'jamin6'          => 'Sebidang Tanah',
            'jamin7'          => 'Tanah dan Bangunan',
            'jamin8'          => 'Lain-lain Termasuk Surat Berharga',



        ),
    ),
      'asuransi'=>array(
        'title'     =>"Table Asuransi",
        'add'       =>"Tambah",
        'subtitle' => "Table Asuransi",
        'title_box' => "Table Asuransi",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'kode_ass'    => 'Kode',
            'nama'      => 'Nama Asuransi',
            'alamat'          => 'Alamat',
            'kota'          => 'Kota',
            'kode_pos'          => 'Kode POS',

            'telpon'          => 'Telpon',
            'no_acc'          => 'Nomor Rekening',
            'coperson'        => 'Contact Person',
            'kerjasama'        => 'Kerja Sama',
            'komisi_jiwa'          => 'Komisi Jiwa',



        ),
    ),
      'tablecabang'=>array(
        'title'     =>"Table Cabang",
        'add'       =>"Tambah",
        'subtitle' => "Table Cabang",
        'title_box' => "Table Cabang",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'Kd_cabang'    => 'Kode Cabang',
            'NamaCabang'      => 'Nama Cabang',
            'alamat1'          => 'Alamat 1',
            'alamat2'          => 'Alamat2',
            'kodya'          => 'Kota Madya',
            'Kota'          => 'Kota',
            'notelp'          => 'Telp.',
            'Kodepos'        => 'Kode POS',
            'Jabatan1'        => 'Jabatan Kepala Cabang',
            'Pejabat1'          => 'Nama Kepala Cabang',
            'Jabatan2'        => 'Jabatan Direktur Utama',
            'Pejabat2'          => 'Nama Direktur Utama',
            'Jabatan3'        => 'Jabatan Dir. Pinjaman',
            'Pejabat3'          => 'Nama Dir. Pinjaman',
            'Jabatan4'        => 'Jabatan KaBag Keu',
            'Pejabat4'          => 'Nama Kabag Keu',
            'Jabatan5'        => 'Jabatan KBOK',
            'Pejabat5'          => 'Nama Pejabat KBOK',
            'Jabatan6'        => 'Jabatan Kabiro Keu',
            'Pejabat6'          => 'Nama Kabiro Keu',
            'Jabatan7'        => 'Jabatan Admin Kredit',
            'Pejabat7'          => 'Nama Admin Kredit',
            'aktenotaris'       => 'Head Akte Notaris',
            'RAKPusat'      => 'RAK Pusat',
            'RAKOwn'     => 'RAK Cabang',
            'IdCabang'     => 'Cabang',
            'IdLembaga'     => 'Id Lembaga'


        ),
    ),

      'setupteller'=>array(
        'title'     =>"Table Setup Teller ID",
        'add'       =>"Tambah",
        'subtitle' => "Table Setup Teller ID",
        'title_box' => "Table Setup Teller ID",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'form'      => array(
            'user_id'    => 'ID User',
            'teller_id'      => 'Teller ID',
            'nosub_teller'          => 'Sub Ledger',
            'maximum_saldo'          => 'Maximum Saldo Kas',
            'maxtrnkredit'          => 'Maximum Transaksi Kredit'

        ),
    ),
),


'karyawan' => array(
    'cutitahunan'=>array(
        'title'     =>"Cuti Karyawan",
        'add'       =>"Tambah",
        'subtitle' => "Cuti Tahunan Karyawan",
        'title_box' => "Cuti Tahunan Karyawan",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
    ),
    'datapribadi'=>array(
        'title'     =>"Data Karyawan",
        'add'       =>"Tambah",
        'subtitle' => "Data Pribadi",
        'title_box' => "Data Pribadi",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
    ),
    'plafonpengobatan'=>array(
        'title'     =>"Data Plafon Pengobatan",
        'add'       =>"Tambah",
        'subtitle' => "Data Plafon Pengobatan",
        'title_box' => "Data Plafon Pengobatan",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
    ),
     'penilaian'=>array(
        'title'     =>"Penilaian Karyawan",
        'add'       =>"Tambah",
        'subtitle' => "Penilaian Karyawan",
        'title_box' => "Penilaian Karyawan",
        'edit'      =>"Ubah",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        )
    )        
),
'hrd' => array(
    'spsw'=>array(
        'title'     =>"Data Master SPSW",
        'add'       =>"Tambah",
        'subtitle'  => "Data SPSW",
        'title_box' => "Data SPSW",
        'edit'      =>"Ubah",
        'delete'    =>"Hapus",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'table'=>array(
            'title'     =>"Data Master SPSW",
            'add'       =>"Tambah",
            'subtitle'  => "Data SPSW",
            'title_box' => "Data SPSW",
            'edit'      =>"Ubah",
            'delete'    =>"Hapus",
        ),
        'form'=>array(
            'cabang'         =>"Cabang",
            'karyawan'       =>"Karyawan",
            'departemen'     =>"Departemen",
            'jabatan'        => "Jabatan",
            'simpok'         => "Simpanan Pokok",
            'simwa'          =>"Simpanan Wajib",
            'simta'          =>"Simpanan Tambahan",
            'price'          =>"Nilai SMK",
            'total'          =>"Total Tagihan SMK",
            'cicilan'        =>"Cicilan",
            'cicilan1'       =>"Cicilan 2",
            'jmlsmk'         =>"Jumlah SMK",
        )
    ),
    'datakaryawan'=>array(
        'title'     =>"Data Karyawan",
        'add'       =>"Tambah",
        'subtitle'  => "Data Karyawan",
        'title_box' => "Data Karyawan",
        'edit'      =>"Ubah",
        'delete'    =>"Hapus",
        'confirm'   => array(
            'title'         => "Apakah anda ingin melanjutkan proses ini ?"
        ),
        'table'=>array(
            'title'     =>"Data Karyawan",
            'add'       =>"Tambah",
            'subtitle'  => "Data Karyawan",
            'title_box' => "Data Karyawan",
            'edit'      =>"Ubah",
            'delete'    =>"Hapus",
        ),
        'form'=>array(
            'cabang'         =>"Cabang",
            'karyawan'       =>"Karyawan",
            'departemen'     =>"Departemen",
            'jabatan'        => "Jabatan",
            'simpok'         => "Simpanan Pokok",
            'simwa'          =>"Simpanan Wajib",
            'simta'          =>"Simpanan Tambahan",
            'price'          =>"Nilai SMK",
            'total'          =>"Total Tagihan SMK",
            'cicilan'        =>"Cicilan",
            'cicilan1'       =>"Cicilan 2",
            'jmlsmk'         =>"Jumlah SMK",
        )
    )
),
        'direktorat' => array(
            'title'     =>"Data Direktorat",
            
        ),
        'departemen' => array(
            'title'     =>"Data Departemen",
            
        ),
        'subdepartemen' => array(
            'title'     =>"Data Sub Departemen",
            
        ),
        'jabatan' => array(
            'title'     =>"Data Jabatan",
            
        ),
        'cuti' => array(
            'title'     =>"Data Cuti",
            
        ),
        'libur' => array(
            'title'     =>"Data Libur",
            
        ),
        'ramadhan' => array(
            'title'     =>"Data Ramadhan",
            
        ),
        'pinjaman' => array(
            'title'     =>"Data Pinjaman",
            
        ),
        'kasbon' => array(
            'title'     =>"Data Kasbon Karyawan",
            
        ),
        'pinjamanlain' => array(
            'title'     =>"Data Pinjaman Lain-Lain",
            
        ),
        'absen' => array(
            'title'     =>"Data Monitor Absen",
            
        ),
        'pjkaryawan' => array(
            'form'     =>  array(
                'nopinjam' => 'No. Pinjaman',
                'nilai'    => 'Nilai Pinjaman',
                'tanggal'  => 'Tanggal Peminjaman',
                'jasa'     => 'Jasa Pinjaman',
                'nik'      => 'NIK',
                'nama'     => 'NAMA',
                'mspinj'   => 'Masa Pinjaman',
                'cabang'   => 'Cabang',
                'cicil'    => 'Nilai Cicilan',
                'total'    => 'Total Pinjaman'
            ),
            
        ),
        'lembur' => array(
            'title'     =>"Data Monitor Lembur",
        ),
        'representatif' => array(
            'title'     =>"Data Monitor Representatif",
        ),
        'jamkerja' => array(
            'title'     =>"Data Jam Kerja",
            
        ),
        'coapenggajian' => array(
            'title'     =>"Data Kode Transaksi",
            
        ),
    ];

