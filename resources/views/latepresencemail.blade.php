<style>
TH, TD {font-family: Consolas; font-size: 11pt;}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 3px;
}
table th {
  background-color: "#1F497D";
  color: white;
}
</style>

<i>Assalamu'alaikum Wr. Wb.</i> 
<p>Do'a senantiasa kami panjatkan semoga kita semua berada dalam keadaan sehat wal'afiat dan selalu berada dalam lindungan Allah SWT serta kesuksesan senantiasa menyertai aktivitas kita setiap hari. Amiin.</p>
<p>Berdasarkan daftar kehadiran yang terbaca oleh fingerscan Kantor Pusat KSP Sejahtera Bersama, berikut kami informasikan karyawan yang terlambat hadir dan/atau tidak melakukan absensi fingerscan.</p>
<p style="font-family: Consolas; font-size: 11pt;"><strong><center>DAFTAR NAMA KARYAWAN TERLAMBAT<br>DAN TIDAK MELAKUKAN DAFTAR HADIR</center></strong></p>
<br>{{ $tgl }}<br><br>
@php $a = 1 @endphp
<table style="width:100%">
<tr>
<th style="text-align: center;">No.</th>
<th style="text-align: center;">N I K</th>
<th>Nama Karyawan</th>
<th>Departemen</th>
<th>Jabatan</th>
<th style="text-align: center;">Jam Masuk</th>
</tr>
@foreach($datafinger1 as $data)
<tr bgcolor="yellow">
<td align="right">{{$a++}}</td>
<td style="text-align: center;">{{$data->EmpId}}</td>
<td>{{$data->NAME}}</td>
<td>{{$data->Departement}}</td>
<td>{{$data->Jobs}}</td>
<td style="text-align: center;">{{date('H:i:s', strtotime($data->EntryTime))}}</td>
</tr>
@endforeach
@foreach($datafinger2 as $data)
<tr bgcolor="#92D050">
<td align="right">{{$a++}}</td>
<td style="text-align: center;">{{$data->EmpId}}</td>
<td>{{$data->Name}}</td>
<td>{{$data->Departement}}</td>
<td>{{$data->Jobs}}</td>
<td>{{$data->EntryTime}}</td>
</tr>
@endforeach
@foreach($datafinger3 as $data)
<tr bgcolor="#548DD4" >
<td align="right">{{$a++}}</td>
<td style="text-align: center;">{{$data->EmpId}}</td>
<td>{{$data->Name}}</td>
<td>{{$data->Departement}}</td>
<td>{{$data->Jobs}}</td>
<td>{{$data->EntryTime}}</td>
</tr>
@endforeach
</table>
<p>Kepada karyawan yang tertera dalam daftar email ini (<strong>Terlambat atau Tanpa Keterangan</strong>) harap diperhatikan kehadirannya, agar dapat menambah nilai produktifitas bagi perusahaan.</p>Terima Kasih.<br><br>
<i>Wassalamu'alaikum Wr. Wb.</i>
<br><br>
<h5><i>Pesan ini digenerate otomatis oleh sistem pada {{ date('Y-m-d, H:i:s') }}, tidak perlu direplay</i></h5>