@if(empty($datadoa1))
	<h3>Data Pembaca Doa tidak tersedia<h3>
@else
	<i>Assalaamu'alaikum Wr. Wb.</i>
	<p>Do'a senantiasa kami panjatkan semoga kita semua berada dalam keadaan sehat wal'afiat dan selalu berada dalam lindungan Allah SWT serta kesuksesan senantiasa menyertai aktivitas kita setiap hari. Amiin.</p> 
@foreach($datadoa1 as $data)
@foreach($datadoa3 as $datas)
	<p>Berikut kami informasikan untuk pembaca doa hari <strong>{{ $datas->ADate }}</strong> adalah : <strong>{{ $data->EmpMot }} (Do'a dan Motivasi)</strong> dan <b>{{ $data->EmpDoa }} (Baca Qur'an)</b>. 
@endforeach
@endforeach
	Mohon untuk hadir tepat pada waktunya dan mempersiapkan kata-kata motivasi yang akan disampaikan.</p>
	<p>Demikian kami informasikan, atas perhatian dan kerjasamanya diucapkan terima kasih.</p>
	<i>Wassalamu'alaikum Wr. Wb.</i> 
	<br /> 
	<br /> 
	<br /> 
	<font color='red'><b>Note : Kata-kata motivasi yang telah disampaikan mohon dikirimkan ke email : hrd@kspsb.id</b></font> 
	<br />
	<br />
@foreach($datadoa2 as $data)
@foreach($datadoa3 as $datas)
	<h3><b><u>Motivator dan Pembacaan Doa hari {{ $datas->ANextDate }} : {{ $data->EmpMot }}.
	@if(substr($datas->ANextDate,0,6) == "Jum'at") 
	<br />Motivasi disampaikan dalam Bahasa Inggris.
	@else	
	@endif
	</u></b></h3>
@endforeach
@endforeach
@endif
<h5><i>Pesan ini digenerate otomatis oleh sistem pada {{ date('Y-m-d, H:i:s') }}, tidak perlu direplay</i></h5> 