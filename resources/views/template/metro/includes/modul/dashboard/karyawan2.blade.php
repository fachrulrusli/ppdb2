<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<!-- <link rel="stylesheet" href="https://openlayers.org/en/v5.3.0/css/ol.css" type="text/css"> -->

<div style="height: 300px; margin-top:0">
    <div class="page-header" data-parallax="true" style="height: 300px; position: relative;">
        <img class="mySlides" src="https://www.watsons.co.id/medias/corona-banner-inpage.jpg?context=bWFzdGVyfHJvb3R8MTMzMTIzfGltYWdlL2pwZWd8aDM5L2hjMS84ODkyMjYzMzY2Njg2LmpwZ3wwMDA5OGVlMjcxZWM4MzA3NDEyNTc4MDA3ODVkNWMxMDU3OWRiZGRhZjc3MWY3ZGNhZGVhYzdhMmE5Yjk2NzZi" style="width:100%; height:300px;">
        <img class="mySlides" src="https://azgovernor.gov/sites/default/files/styles/panopoly_image_original/public/stayhome-bannerartboard_12x.png?itok=M2aPhb18" style="width:100%;  height:300px">
        <img class="mySlides" src="https://www.faurecia.com/sites/groupe/files/pages/StaySafe_banner1300x550.jpg" style="width:100%;  height:300px">
    </div>
</div>
    <div class="main-raised main" style=" background: #17393a; position: relative;">
      <div class="profile-content" style="width: 100%">
        <div class="container">
          <div class="row">
            <div class="col-md-12 ml-auto mr-auto" style="margin-top: -10%;">
             <div class="profile">
              <div class="avatar">
                @if(empty($datapribadi[0]->photo))
                <center><img alt="" class="img-circle" src="{{$theme_path}}/layouts/layout/img/avatar.png" width="25%" /></center>
                @else
                <center><img alt="" class="img-circle" src="data:image/png;base64,{{ chunk_split(base64_encode($datapribadi[0]->photo)) }}" width="25%" /></center>
                @endif
              </div>
              <div class="name">
                <center><h3 class="font-white">{{Auth::user()->nama_user}}</h3>
                  <h4 class="font-white">{{$datapribadi[0]->jabatan}}</h4></center>
                </div>
              </div>
            </div>
          </div>
          <br>

          <div class="portlet light bordered" style="background: #17393a" >
            @if(empty(Auth::user()->hp))
            <h5><span style="color: red">Anda belum mendaftarkan Nomor Whatsapp Anda, Harap untuk mendaftarkan nomor whatsapp Anda <button class="btn btn-danger" id="daftarwa">Daftarkan</button></span></h5>
            @else
            @endif

            <div>
              @if(Auth::user()->with('cabang')->findOrFail(Auth::user()->id_user)->cabang->id_cabang == '000' || Auth::user()->with('cabang')->findOrFail(Auth::user()->id_user)->cabang->id_cabang == '001')   

              @if (date('H:i:s') < $jampusat[0]->batas_masuk)
              <center><button class="wetasphalt">Presensi Belum dibuka, Presensi dimulai dari Pukul {!!$jampusat[0]->batas_masuk!!}</button></center>

              @elseif(date('H:i:s') > $jampusat[0]->masuk AND date('H:i:s') < $jampusat[0]->pulang)
              <center><button class="wetasphalt" id="btnPre">Kamu Sudah Telat, Tetap Presensi ?</button></center>
              @elseif(date('H:i:s') > $jampusat[0]->batas_pulang)
              <center><button class="wetasphalt">Presensi pulang sudah ditutup !</button></center>
              @elseif($jampusat[0]->hari =='sabtu' OR $jampusat[0]->hari =='minggu')


              <center><button class="wetasphalt">Operasional Libur !</button></center>
              @else
              <center><button class="wetasphalt" id="btnPre">Presensi</button></center>
              @endif
              @else
              @if (date('H:i:s') < $jamcabang[0]->batas_masuk)
              <center><button class="wetasphalt">Presensi Belum dibuka, Presensi dimulai dari Pukul {!!$jampusat[0]->batas_masuk!!}</button></center>


              @elseif(date('H:i:s') > $jamcabang[0]->masuk AND date('H:i:s') < $jamcabang[0]->pulang)
              <center><button class="wetasphalt" id="btnPre">Kamu Sudah Telat, Tetap Presensi ?</button></center>
              @elseif(date('H:i:s') > $jamcabang[0]->batas_pulang)
              <center><button class="wetasphalt">Presensi pulang sudah ditutup !</button></center>
              @elseif($jamcabang[0]->hari =='sabtu' OR $jamcabang[0]->hari =='minggu')


              <center><button class="wetasphalt">Operasional Libur !</button></center>
              @else
              <center><button class="wetasphalt" id="btnPre">Presensi</button></center>
              @endif

              @endif


            </p>
          </div>
        </div>
      </div>
      </div>
    </div>
      <div style="width: 100%; padding-top: 10px;">
        <div class="row">
          <div class="col-md-12 ml-auto mr-auto">
            <div class="row">

              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a onclick="Detail()">
                  <div class="dashboard-stat2" style="background: #3f3f3c;">
                    <div class="display">
                      <div class="number">
                        <h3 class="font-green-sharp">
                          <span data-counter="counterup" >{!!$jumlahtelat!!}</span>
                          <small class="font-green-sharp"></small>
                        </h3>
                        <small>JUMLAH TERLAMBAT</small>
                      </div>
                      <div class="icon">
                        <i class="icon-clock"></i>
                      </div>
                    </div>
                    <div class="progress-info">
                      <div class="progress">
                        <span style="width: 100%;" class="progress-bar progress-bar-success green-sharp">
                          <span class="sr-only">Periode April 2020</span>
                        </span>
                      </div>
                      <div class="status">
                        <div class="status-title"> Periode </div>
                        <div class="status-number"> {!!strftime("%B %Y")!!}</div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a onclick="DetailCuti()">
                  <div class="dashboard-stat2" style="background: #2F4F4F">
                    <div class="display">
                      <div class="number">
                        <h3 class="font-red-haze">
                          @if(!empty($sisacuti))
                          <span data-counter="counterup" >{{$sisacuti[0]->sisa_cuti}}</span>
                          @else
                          <span data-counter="counterup" >0</span>
                          @endif
                        </h3>
                        <small>SISA CUTI</small>
                      </div>
                      <div class="icon">
                        <i class="icon-calendar"></i>
                      </div>
                    </div>
                    @if(!empty($sisacuti))
                    <div class="status font-red-haze" style="font-size: 12px; margin-top: -15px;">Sudah dipotong dengan cuti bersama (4 hari)</div>
                    @else
                    @endif
                    <div class="progress-info">
                      <div class="progress">
                        <span style="width: 100%;" class="progress-bar progress-bar-success red-haze">
                          <span class="sr-only"></span>
                        </span>
                      </div>
                      <div class="status">
                        <div class="status-title">PERIODE</div>
                        <div class="status-number">{!!strftime("%Y")!!}</div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <a onclick="DetailPlafon()">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="dashboard-stat2" style="background: #004d40">
                    <div class="display">
                      <div class="number">

                        <table>
                          <tr>
                            <td><small>Rawat Jalan</small></td>
                            <td width="10"></td>
                            <td><small>Rawat Inap</small> </td>
                          </tr>
                          <tr> 
                           <td><h5 class="font-blue-sharp" style="font-weight: bold; font-size: 14px;">
                            @if(!empty($sisaplafon1))
                            <span data-counter="counterup" >Rp.{{number_format($sisaplafon1[0]->SisaPlafon)}}</span>
                            @else
                            <span data-counter="counterup">0</span>
                            @endif
                          </h5>
                        </td>
                        <td width="10"></td>
                        <td>
                          <h5 class="font-blue-sharp" style="font-weight: bold; font-size: 14px;">
                            @if(!empty($sisaplafon2))
                            <span data-counter="counterup" >Rp.{{number_format($sisaplafon2[0]->SisaPlafon)}}</span>
                            @else
                            <span data-counter="counterup">0</span>
                            @endif
                          </h5></td>
                        </tr>
                      </table>
                    </div>
                    <div class="icon">
                      <i class="fa fa-medkit"></i>
                    </div>
                  </div>
                  <div class="progress-info">
                    <div class="progress">
                      <span style="width: 100%;" class="progress-bar progress-bar-success blue-sharp">
                        <span class="sr-only"></span>
                      </span>
                    </div>
                    <div class="status">
                      <div class="status-title">SISA PLAFOND</div>
                      <div class="status-number">{!!strftime("%Y")!!}</div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
       <!--  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="dashboard-stat2 ">
            <div class="display">
              <div class="number">
                <h3 class="font-purple-soft">
                  <span data-counter="counterup" data-value="276"></span>
                </h3>
                <small>NEW USERS</small>
              </div>
              <div class="icon">
                <i class="icon-user"></i>
              </div>
            </div>
            <div class="progress-info">
              <div class="progress">
                <span style="width: 57%;" class="progress-bar progress-bar-success purple-soft">
                  <span class="sr-only">56% change</span>
                </span>
              </div>
              <div class="status">
                <div class="status-title"> change </div>
                <div class="status-number"> 57% </div>
              </div>
            </div>
          </div>
        </div> -->
            </div>      
          </div>
        </div>
      </div>

<nav class="quick-nav">
  <a class="quick-nav-trigger">
    <span aria-hidden="true"></span>
  </a>
  <ul>
    <li>
      <a onclick="ThemeOne()" class="active">
        <span>Light Mode</span>
        <i class="fa fa-map-o"></i>
      </a>
    </li>
    <li>
      <a onclick="ThemeTwo()">
        <span>Dark Mode</span>
        <i class="fa fa-map"></i>
      </a>
    </li>
   
  </ul>
  <span aria-hidden="true" class="quick-nav-bg"></span>
</nav>
<div class="quick-nav-overlay"></div>

<!-- END CONTENT BODY -->
  <div id="myModal" class="modal modal-success fade">
            <div class="modal-dialog">
                <div class="modal-content" style="background:#17393a;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title font-white">Ambil Foto Selfie Untuk Presensi</h4>
                        </div>
                        <div class='modal-body' style='background-color: #17393a !important; color: #000 !important;'>
                            <div class="row">
                      
                                <center><span id="tanggal" class="clockdate jqclock"></span></center>
                                <center><span id="jam_server" class="jqclock clocktime">00:00:00</span></center>
                                <h2 id="timestamp"></h2>
                              <center><div id="my_camera"></div></center>
                              <input type="hidden" name="foto" id="foto">

                              <form>
                                <center><button type="button" class="btn btn-danger" id="takepicture" style="background: #8B0000"><i class="fa fa-camera"></i> TAKE PICTURE</button></center>
                              </form>
                              <center><div id="results" style="background:#17393a;"></div></center>
                       
                                   <div id="map"></div>
                                   <input type="hidden" name="lat" id="lat">
                                   <input type="hidden" name="lang" id="lang">
                              <div class="submit">     
                                <button type="button" class="btn btn-primary btn-lg pull-right" id="submit" style="background: #006400"><i class="fa fa-thumbs-up"></i>SUBMIT</button>
                              </div>  
                            </div>

                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div><!-- /.modal-content -->
                    <div class="modal-footer">
                    </div>
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>





        <div id="myModal2" class="modal modal-success fade">
          <div class="modal-dialog">
            <div class="modal-content" style="background:#17393a;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                  aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title font-white">Nomor Whatsapp</h4>
                </div>
                <div class='modal-body' style='background-color: #17393a !important; color: #000 !important;'>
          
                    <div class="row">
                        <div class="panel panel-default">
                          <div class="panel-body" style="background-color: #17393a">
                            <div class="text-center">
                              <h3><i class="fa fa-whatsapp fa-4x font-white"></i></h3>
                              <h2 class="text-center font-white" style="margin-top: 50px;">Daftarkan Nomor Whatsapp?</h2>
                              
                              <div class="panel-body">

                                {!! Form::open(array('id' => 'form-wa')) !!}

                                  <div class="form-group">
                                   <label class="font-white">Masukkan Nomor Whatsapp Aktif</label>
                                   <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-whatsapp color-blue"></i></span>
                                    <input type="number" class="form-control" name="nowa" placeholder="ex : 0812345678910" aria-describedby="sizing-addon1" required> </div>
                                  </div>

                                  <div class="form-group">
                                    <button type="button" style="background: #006400" class="btn btn-lg btn-primary btn-block" id="savewa">
                                      <i class="fa fa-btn fa-send"></i>Save My Number
                                    </button>
                                  </div> 
                                {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  
                  <!-- END EXAMPLE TABLE PORTLET-->
                </div>
              </div><!-- /.modal-content -->
              <div class="modal-footer">
              </div>
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        </div>    

<script src="https://maps.googleapis.com/maps/api/js?key={!! config('consyst.google_key') !!}&libraries=geometry"></script>
<script type="text/javascript" src="//gitcdn.link/repo/Lwangaman/jQuery-Clock-Plugin/master/jqClock.min.js"></script> 
<style>
    form { margin-top: 15px; }
    form > input { margin-right: 15px; }
    #results { background:#FFF; }
    #map { 
      height: 200px;
      margin-top: 10px;
      width: 100%;
    }
    #my_camera{
      margin-bottom: -2%;
      margin-top: -5%;
    }
    #jam_server{
      font-size: 50px;
      font-weight: bold;
      font-family: sans-serif;
      margin-bottom: 10px;
    }
    .img{
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 5px;
    }
    .submit{
      margin-top: 10px;
      margin-right: 10px;
    }
    #clocks-container { border: 1px groove White; border-radius: 15px; padding: 5px; width: 100%; margin: 30px auto; background-color: LightGray; text-align: center; } 
    /* SAMPLE CSS STYLES FOR JQUERY CLOCK PLUGIN */ 
    .jqclock { text-align:center; border: 2px #369 ridge; background-color: #69B;  width: 100%; box-shadow: 5px 5px 15px #005; } 
    .clockdate { color: DarkRed; font-weight: bold; background-color: #7AC; margin-bottom: 0px; font-size: 18px; display: block; padding: 10px 0; } 
    .clocktime { border: 2px inset DarkBlue; background-color: #444; padding: 0px 0; font-size: 50px; font-family: "Courier"; color: LightGreen; margin: 2px; display: block; font-weight:bold; text-shadow: 1px 1px 1px Black; } 
    html *{
    -webkit-font-smoothing: antialiased;
}
.wetasphalt {
 width: 50%;
  background: #2F4F4F;
  border-bottom: #2c3e50 3px solid;
  border-left: #2c3e50 1px solid;
  border-right: #2c3e50 1px solid;
  border-radius: 6px;
  text-align: center;
  color: white;
  padding: 10px;
  font-size: 16px;
  font-weight: 800;
}

.wetasphalt:hover {
  opacity: 0.8;
}

.wetasphalt:active {
  width: 50%;
  background: #2D3F51;
  border-bottom: #2c3e50 1px solid;
  border-left: #2c3e50 1px solid;
  border-right: #2c3e50 1px solid;
  border-radius: 6px;
  text-align: center;
  color: white;
  padding: 10px;
  margin-top: 3px;
}
.h6, h6 {
    font-size: .75rem !important;
    font-weight: 500;
    line-height: 1.5em;
    text-transform: uppercase;
}
.mySlides {display:none;}
.name h6 {
    margin-top: 10px;
    margin-bottom: 10px;
}



.fixed-top {
    position: fixed;
    z-index: 1030;
    left: 0;
    right: 0;
}

.profile-page .page-header {
    height: 380px;
    background-position:center;
}



.main-raised {
    margin: -60px 30px 0;
    border-radius: 6px;
    box-shadow: 0 16px 24px 2px rgba(0,0,0,.14), 0 6px 30px 5px rgba(0,0,0,.12), 0 8px 10px -5px rgba(0,0,0,.2);
}

.main {
    background: #FFF;
}

.swal-container {
  z-index: 200000000;
};
.swal2-container {
  z-index: 200000000;
}

.profile-page .profile {
    text-align: center;
}

.profile-page .profile img {
    max-width: 160px;
    width: 100%;
    margin: 0 auto;
    -webkit-transform: translate3d(0,-50%,0);
    -moz-transform: translate3d(0,-50%,0);
    -o-transform: translate3d(0,-50%,0);
    -ms-transform: translate3d(0,-50%,0);
    transform: translate3d(0,-50%,0);
}

.img-raised {
    box-shadow: 0 5px 15px -8px rgba(0,0,0,.24), 0 8px 10px -5px rgba(0,0,0,.2);
}

.rounded-circle {
    border-radius: 50%!important;
}

.img-fluid, .img-thumbnail {
    max-width: 100%;
    height: auto;
}


.profile-page .description {
    margin: 1.071rem auto 0;
    max-width: 600px;
    color: #999;
    font-weight: 300;
}

p {
    font-size: 14px;
    margin: 0 0 10px;
}

.profile-page .profile-tabs {
    margin-top: 4.284rem;
}

.profile-page .gallery {
    margin-top: 3.213rem;
    padding-bottom: 50px;
}

.profile-page .gallery img {
    width: 100%;
    margin-bottom: 2.142rem;
}

.profile-page .profile .name{
    margin-top: -80px;
}

img.rounded {
    border-radius: 6px!important;
}

.tab-content>.active {
    display: block;
}

/*buttons*/

/* footer */

footer{
    margin-top: 10px;
    color: #555;
    padding: 25px;
    font-weight: 300;
    
}
.footer p{
    margin-bottom: 0;
    font-size: 14px;
    margin: 0 0 10px;
    font-weight: 300;
}
footer p a{
    color: #555;
    font-weight: 400;
}

footer p a:hover {
    color: #9f26aa;
    text-decoration: none;
}

  </style>
<script>
var slideIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; 
  }
  slideIndex++;
  if (slideIndex > x.length) {slideIndex = 1} 
  x[slideIndex-1].style.display = "block"; 
  setTimeout(carousel, 3000); 
}
</script>


<script language="JavaScript">


  Webcam.set({
    width: 220,
    height: 280,
    image_format: 'jpeg',
    jpeg_quality: 90
  });
  Webcam.attach('#my_camera');
 </script>
 <script type="text/javascript">

  // set geolocation
  var x = navigator.geolocation;
  x.getCurrentPosition(success, failure);

  // function get current position success
  function success(position){
    var myLat = position.coords.latitude;
    var myLong = position.coords.longitude;
    document.getElementById('lat').value = myLat;
    document.getElementById('lang').value = myLong;

  var coords = new google.maps.LatLng(myLat, myLong);
  var mapOptions = {
    zoom: 16,
    center: coords,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById("map"), mapOptions);
  var marker = new google.maps.Marker({map: map, position: coords});


  }

  ///// INI UNTUK MENGAMBIL JARAK METERS & KILOMETERS KE KSB DARI LIVE LOCATION

  // var x = navigator.geolocation;
  // var map, markerA, markerB;
  // x.getCurrentPosition(success, failure);

  // // function get current position success
  // function success(position){
  //   var myLat = position.coords.latitude;
  //   var myLong = position.coords.longitude;
  //   document.getElementById('lat').value = myLat;
  //   document.getElementById('lang').value = myLong;

  // var coords = new google.maps.LatLng(myLat, myLong);
  // var mapOptions = {
  //   zoom: 16,
  //   center: coords,
  //   mapTypeId: google.maps.MapTypeId.ROADMAP
  // }
  // var map = new google.maps.Map(document.getElementById("map"), mapOptions);

  //   markerA = new google.maps.Marker({
  //     position: coords,
  //     map: map,
  //     title: "Marker A"
  //   });

  //   // 3. Put second marker in Bogota
  //   markerB = new google.maps.Marker({
  //     position: {
  //       lat: -6.5891900, 
  //       lng: 106.8052000
  //     },
  //     map: map,
  //     icon: {
  //       url: 'https://www.google.com/images/branding/product/ico/maps15_bnuw3a_32dp.ico'
  //     },
  //     title: "Marker B"
  //   });

  //   var distanceInMeters = google.maps.geometry.spherical.computeDistanceBetween(
  //     markerA.getPosition(),
  //     markerB.getPosition()
  //     );

  //   // Outputs: Distance in Meters:  286562.7470149898
  //   console.log("Distance in Meters: ", distanceInMeters+' m');

  //   // Outputs: Distance in Kilometers:  286.5627470149898
  //   console.log("Distance in Kilometers: ", (distanceInMeters * 0.001 +' km'));

  // }

  function failure(){
    alert('geolocation failure!');
  }


  $(document).ready(function(){ 



    var tanggallengkap = new String();
    var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
    namahari = namahari.split(" ");
    var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
    namabulan = namabulan.split(" ");
    var tgl = new Date();
    var hari = tgl.getDay();
    var tanggal = tgl.getDate();
    var bulan = tgl.getMonth();
    var tahun = tgl.getFullYear();
    tanggallengkap = namahari[hari] + ", " +tanggal + " " + namabulan[bulan] + " " + tahun;
    document.getElementById("tanggal").innerHTML = tanggallengkap;

  }); 


  function Detail(){
    Consyst.loadForm("{{route('kary-terlambat')}}");
  }

  function DetailCuti(){
    Consyst.loadForm("{{route('kary-cuti')}}");
  }
  function DetailPlafon(){
    Consyst.loadForm("{{route('plafonpengobatan')}}");
  }
  function ThemeOne(){
    $.ajax({
        type: 'POST',
        url: '{{route('change-theme')}}',
        data: {theme:1},
        dataType: "json",
        success: function (data) {
          $(function(){
            setInterval(location.reload(), 1000);
          });
        }
      });
  }
  function ThemeTwo(){
      $.ajax({
        type: 'POST',
        url: '{{route('change-theme')}}',
        data: {theme:2},
        dataType: "json",
        success: function (data) {
          $(function(){
            setInterval(location.reload(), 1000);
          });
        }
      });
  }


  document.getElementById("submit").disabled = true;
  $('#myModal').on('hidden.bs.modal', function () {
     // location.reload();
   }) 
  $("#btnPre").on('click', function () {
    $('#myModal').modal('show');
    $(function(){
    setInterval(timestamp, 1000);//fungsi yang dijalan setiap detik, 1000 = 1 detik
    });

    //Fungi ajax untuk Menampilkan Jam dengan mengakses File ajax_timestamp.php
    function timestamp() {
      $.ajax({
        url: '{{route('jamserver')}}',
        success: function(data) {
          $('#jam_server').html(data);
        },
      });
    }

  });
  $("#submit").on('click', function () {
    var foto = document.getElementById("foto").value;
    var lat = document.getElementById("lat").value;
    var lang = document.getElementById("lang").value;
    var jam = document.getElementById("jam_server").innerHTML;
    $('#myModal').modal('hide');
    swal({
        title: "",
        text: "Data Presensi akan diproses",
        type: "info",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Lanjutkan!",
        cancelButtonText: "Tidak, Batalkan!",
        html: true,
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm:true
    }, function () {
      $.ajax({
        type: 'POST',
        url: '{{route('absen-wfh')}}',
        data: {foto : foto, jam: jam, lat : lat, lang:lang},
        dataType: "json",
        success: function (data) {
          Consyst.dialogInfoX("Terimakasih!", "Presensi recorded");
              $(function(){
              setInterval(location.reload(), 5000);
            });
        }
      });
      });
  });

 $("#takepicture").on('click', function () {
  
      Webcam.snap( function(data_uri) {
        document.getElementById('results').innerHTML = 
        '<h3 class="font-white">Here is your image:</h3>' + 
        '<img class="img" src="'+data_uri+'"/>';
        document.getElementById('foto').value = data_uri;
        if(data_uri){
          document.getElementById("submit").disabled = false;
        }
      } 
      );
  });


  $("#daftarwa").on('click', function () {
    $('#myModal2').modal('show');
  });

  $("#savewa").click(function(){
    var formData = $('#form-wa').serialize();
    
    $.ajax({
      type: 'POST',
      url: '{!! route('save-number-wa')!!}',
      data: formData,
      dataType: "json",
      success: function (data)
      {
        if (data.status===99) {
          Consyst.msgInfo("Data Berhasil Disimpan");
          setTimeout(window.location.reload.bind(window.location), 250);
        } else if(data.status === 50) {
          Consyst.msgError("Tidak Boleh Kosong");
        } else {
          Consyst.msgError("Data Gagal Disimpan");

        }
      }
    });

  });
</script>
