<!DOCTYPE html>
<html>
<head>

<style>
.table2 {
  border-collapse: collapse;
}

.table2,.tr2,.th2,.td2{
  border: 1px solid black;
}
</style>

Assalamualaikum wr.wb.

 

<p>Do'a senantiasa kami panjatkan semoga kita semua berada dalam keadaan sehat wal'afiat dan selalu berada dalam lindungan Tuhan YME, serta kesuksesan senantiasa menyertai aktivitas kita setiap hari. Aamiin.</p>
<p>Sehubungan dengan memasuki periode penilaian, berikut kami informasikan data terkait penilaian</p>
 @if(empty($html1))
 @else
<p>Anda akan dinilai oleh :</p>
@php $a = 1 @endphp
<table width:30%;>
@foreach($html1 as $data)

	<tr>
		<td>{{$a++}}.</td>
		<td>{{$data->AppraisalTypeDesc}}
		@if($data->AppraisalTypeDesc == 'Atasan' || $data->AppraisalTypeDesc == 'Bawahan' )
		: <span style="font-weight: bold">{{$data->nama}}</span> </td>
		@else
		</td>
		@endif
	</tr>
@endforeach
</table>
@endif

@if(empty($html2))
<p>Terima Kasih, Penilaian Anda Sudah Selesai</p>
@else
<p>Anda harus menilai karyawan berikut di bawah ini :</p> 
	
		<table style="width:100%;" class="table2">
			<tr class="tr2" style="font-weight: bold">
				<td class="td2">NIK</td>
				<td class="td2">NAMA</td>
				<td class="td2">DEPARTEMENT</td>
				<td class="td2">CABANG</td>
				<td class="td2">TIPE PENILAI</td>
				<td class="td2">MULAI PENILAIAN</td>
				<td class="td2">MAKSIMAL PENGERJAAN</td>

			</tr>	
			@foreach($html2 as $data)
				@if(empty($data))
					<h2 style="font-weight: bold">Terima Kasih, Sudah Selesai ....</h2>
				@else

				
			<tr class="tr2">
				<td style="text-align: left;" class="td2">{{ $data->nik }}</td>
				<td style="text-align: left;" class="td2">{{ $data->nama }}</td>
				<td style="text-align: left;" class="td2">{{ $data->Departemen }}</td>
				<td style="text-align: left;" class="td2">{{ $data->Cabang }}</td>
				<td style="text-align: left;" class="td2">Evaluasi {{ $data->AppraisalTypeDesc }}</td>
				<td style="text-align: left;font-weight: bold" class="td2">{{ $data->StartDate }}</td>
				<td style="text-align: left;font-weight: bold" class="td2">{{ $data->ExpDate }}</td>



			</tr>
				@endif
			@endforeach
		</table>
@endif

<p>Untuk itu mohon keaktifan saudara untuk dapat mengingatkan kepada tim penilai terkait penilaian kinerja saudara, dan diharapkan untuk masuk ke web hrd <a href="http://psdm.kspsb.id/">Humanys Web V.1</a> untuk melakukan penilaian.</p>

 @foreach($html2 as $data)

<p><b>Penilaian tersebut harus dilakukan hingga tanggal {{ $data->ExpDate }}. Apabila penilaian belum lengkap setelah melewati batas tersebut, maka akan mempengaruhi hasil akhir penilaian saudara.</b></p>
<p>Demikian informasi yang dapat disampaikan. Terima kasih atas kerjasama yang baik.</p>

@endforeach
 
<br>
<br>
<p>Wassalamualaikum wr.wb.</p>

 

 <br>
<br>
<p>Dept. PSDM</p>
</body>
</html>
