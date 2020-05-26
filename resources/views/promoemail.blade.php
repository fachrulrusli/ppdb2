<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 3px;
}
</style>

<p>Berikut disampaikan karyawan yang mendekati akhir dalam masa Promosi Jabatan, dan diperlukan penilaian untuk penindaklanjutan promosi tersebut.</p>
@if(empty($datapromo))
<h3>Data Tidak Tersedia</h3>
@else
@php $a = 1 @endphp
<table style="width:85%;">
<tr>
<th>No.</th>
<th style="text-align: center;">N I K</th>
<th>Nama Karyawan</th>
<th>No. SK</th>
<th style="text-align: center;">Tgl. Berakhir</th>
</tr>
@foreach($datapromo as $data)
<tr>
<td>{{$a++}}</td>
<td style="text-align: center;">{{$data->nik}}</td>
<td>{{$data->nama}}</td>
<td>{{$data->no_sk}}</td>
<td style="text-align: center;">{{ date('d-m-Y', strtotime($data->end_date))}}</td>
</tr>
@endforeach
</table>
@endif
<p>Demikian pemberitahuan ini disampaikan, harap lakukan posting pada Aplikasi Humanys untuk menghentikan pemberitahuan atas karyawan yang telah dilakukan penilaian.</p>

<h5><i>Pesan ini digenerate otomatis oleh sistem pada {{ date('Y-m-d, H:i:s') }}, tidak perlu direplay</i></h5>