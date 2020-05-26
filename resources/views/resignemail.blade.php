<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 3px;
}
</style>

<i>Assalamu'alaikum Wr. Wb.</i> 
<p>Do'a senantiasa kami panjatkan semoga kita semua berada dalam keadaan sehat wal'afiat dan selalu berada dalam lindungan Allah SWT serta kesuksesan senantiasa menyertai aktivitas kita setiap hari. Amiin.</p>

@if(empty($dataresign))
<h3>Data Tidak Tersedia</h3>
@else
@foreach($blnprd as $data)
<p><strong>Berikut terlampir Daftar Nama Karyawan Non-Aktiv per {{$data->APrePrd}}</strong></p>
@endforeach
@php $a = 1 @endphp
<table style="width:95%">
<tr>
<th>No.</th>
<th style="text-align: center;">N I K</th>
<th style="text-align: center;">Nama Karyawan</th>
<th style="text-align: center;">Lokasi</th>
<th style="text-align: center;">Jabatan</th>
<th style="text-align: center;">Tgl. Resign</th>
</tr>
@foreach($dataresign as $data)
<tr>
<td>{{$a++}}</td>
<td style="text-align: center;">{{$data->nik}}</td>
<td>{{$data->nama}}</td>
<td>{{$data->lokasi}}</td>
<td>{{$data->jabatan}}</td>
<td style="text-align: center;">{{date('d-m-Y', strtotime($data->tglResign))}}</td>
</tr>
@endforeach
</table>
@endif

@if(empty($databaru))
<h3>Data Tidak Tersedia</h3>
@else
@foreach($blnprd as $data)
<p><strong>Berikut terlampir Daftar Nama Karyawan Baru per {{$data->APrd}}</strong></p>
@endforeach
@php $a = 1 @endphp
<table style="width:95%">
<tr>
<th>No.</th>
<th style="text-align: center;">N I K</th>
<th style="text-align: center;">Nama Karyawan</th>
<th style="text-align: center;">Lokasi</th>
<th style="text-align: center;">Jabatan</th>
<th style="text-align: center;">Tgl. Efektif</th>
</tr>
@foreach($databaru as $data)
<tr>
<td>{{$a++}}</td>
<td style="text-align: center;">{{$data->nik}}</td>
<td>{{$data->nama}}</td>
<td>{{$data->lokasi}}</td>
<td>{{$data->jabatan}}</td>
<td style="text-align: center;">{{date('d-m-Y', strtotime($data->tglefektif))}}</td>
</tr>
@endforeach
</table>
@endif

<p>Demikian disampaikan untuk diketahui. Untuk departemen terkait agar dapat berkoordinasi sehingga dapat mempersiapkan segala sesuatunya dengan baik dan berjalan lancar. Atas perhatian dan kerjasamanya, diucapkan terima kasih.</p>
<i>Wassalamu'alaikum Wr. Wb.</i>
<br><br>
<h5><i>Pesan ini digenerate otomatis oleh sistem pada {{ date('Y-m-d, H:i:s') }}, tidak perlu direplay</i></h5>