<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<!-- <link rel="stylesheet" href="https://openlayers.org/en/v5.3.0/css/ol.css" type="text/css"> -->

<!-- END CONTENT BODY -->
  <div class="m-heading-1 border-green m-bordered">
    @if(empty(Auth::user()->hp))
    <h5><span style="color: red">Anda belum mendaftarkan Nomor Whatsapp Anda, Harap untuk mendaftarkan nomor whatsapp Anda <button class="btn btn-danger" id="daftarwa">Daftarkan</button></span></h5>
    @else
    @endif
    <h3>Selamat Datang di, Aplikasi <b> {!! config('consyst.app_name') !!} </b>  Koperasi Sejahtera Bersama .
        <p>
            <img alt="" class="img-circle" src="{{$theme_path}}/layouts/layout/img/avatar.png" />
            <span class="username">{{Session::get('secret')['name']}}</span> | <i class="fa fa-bank"></i> CABANG :&nbsp; <strong>{!! Auth::user()->with('cabang')->findOrFail(Auth::user()->id_user)->cabang->nama_cabang  !!}</strong></h3>

            @if(Auth::user()->with('cabang')->findOrFail(Auth::user()->id_user)->cabang->id_cabang == '000' || Auth::user()->with('cabang')->findOrFail(Auth::user()->id_user)->cabang->id_cabang == '001')   

              @if (date('H:i:s') < $jampusat[0]->batas_masuk)
              <center><button class="animated-button1">Presensi Belum dibuka, Presensi dimulai dari Pukul {!!$jampusat[0]->batas_masuk!!}</button></center>


              @elseif(date('H:i:s') > $jampusat[0]->masuk AND date('H:i:s') < $jampusat[0]->pulang)
              <center><button class="animated-button1" id="btnPre">Kamu Sudah Telat, Tetap Presensi ?</button></center>
              @elseif(date('H:i:s') > $jampusat[0]->batas_pulang)
              <center><button class="animated-button1">Presensi pulang sudah ditutup !</button></center>
              @elseif($jampusat[0]->hari =='sabtu' OR $jampusat[0]->hari =='minggu')
              

              <center><button class="animated-button1">Operasional Libur !</button></center>
              @else
              <center><button class="animated-button1" id="btnPre">Presensi</button></center>
              @endif
            @else
              @if (date('H:i:s') < $jamcabang[0]->batas_masuk)
              <center><button class="animated-button1">Presensi Belum dibuka, Presensi dimulai dari Pukul {!!$jampusat[0]->batas_masuk!!}</button></center>


              @elseif(date('H:i:s') > $jamcabang[0]->masuk AND date('H:i:s') < $jamcabang[0]->pulang)
              <center><button class="animated-button1" id="btnPre">Kamu Sudah Telat, Tetap Presensi ?</button></center>
              @elseif(date('H:i:s') > $jamcabang[0]->batas_pulang)
              <center><button class="animated-button1">Presensi pulang sudah ditutup !</button></center>
              @elseif($jamcabang[0]->hari =='sabtu' OR $jamcabang[0]->hari =='minggu')
              

              <center><button class="animated-button1">Operasional Libur !</button></center>
              @else
              <center><button class="animated-button1" id="btnPre">Presensi</button></center>
              @endif

            @endif

            
    </p>
</div>
<br>
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <a onclick="Detail()">
          <div class="dashboard-stat2" style="background: #F5FFFA;">
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
          <div class="dashboard-stat2" style="background: #E6E6FA">
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
          <div class="dashboard-stat2" style="background: #FDF5E6">
            <div class="display">
              <div class="number">
               
                <table>
                <tr>
                  <td><small>Rawat Jalan</small></td>
                  <td width="20"></td>
                  <td><small>Rawat Inap</small> </td>
                </tr>
                <tr> 
                 <td><h5 class="font-blue-sharp" style="font-weight: bold; font-size: 16px;">
                  @if(!empty($sisaplafon1))
                  <span data-counter="counterup" >Rp.{{number_format($sisaplafon1[0]->SisaPlafon)}}</span>
                  @else
                  <span data-counter="counterup">0</span>
                  @endif
                </h5>
                  </td>
                  <td width="20"></td>
                  <td>
                  <h5 class="font-blue-sharp" style="font-weight: bold; font-size: 16px;">
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
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Ambil Foto Selfie Untuk Presensi</h4>
                        </div>
                        <div class='modal-body' style='background-color: #fff !important; color: #000 !important;'>
                            <div class="row">
                      
                                <center><span id="tanggal" class="clockdate jqclock"></span></center>
                                <center><span id="jam_server" class="jqclock clocktime">00:00:00</span></center>
                                <h2 id="timestamp"></h2>
                              <center><div id="my_camera"></div></center>
                              <input type="hidden" name="foto" id="foto">

                              <form>
                                <center><button type="button" class="btn btn-danger" id="takepicture"><i class="fa fa-camera"></i> TAKE PICTURE</button></center>
                              </form>
                              <center><div id="results"></div></center>
                       
                                   <div id="map"></div>
                                   <input type="hidden" name="lat" id="lat">
                                   <input type="hidden" name="lang" id="lang">
                              <div class="submit">     
                                <button type="button" class="btn btn-primary btn-lg pull-right" id="submit"><i class="fa fa-thumbs-up"></i>SUBMIT</button>
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
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                  aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Nomor Whatsapp</h4>
                </div>
                <div class='modal-body' style='background-color: #fff !important; color: #000 !important;'>
          
                    <div class="row">
                        <div class="panel panel-default">
                          <div class="panel-body">
                            <div class="text-center">
                              <h3><i class="fa fa-whatsapp fa-4x"></i></h3>
                              <h2 class="text-center" style="margin-top: 50px;">Daftarkan Nomor Whatsapp?</h2>
                              
                              <div class="panel-body">

                                {!! Form::open(array('id' => 'form-wa')) !!}

                                  <div class="form-group">
                                   <label>Masukkan Nomor Whatsapp Aktif</label>
                                   <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-whatsapp color-blue"></i></span>
                                    <input type="number" class="form-control" name="nowa" placeholder="ex : 0812345678910" aria-describedby="sizing-addon1" required> </div>
                                  </div>

                                  <div class="form-group">
                                    <button type="button" class="btn btn-lg btn-primary btn-block" id="savewa">
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

<script src="https://maps.googleapis.com/maps/api/js?key={!! config('consyst.google_key') !!}"></script>
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
    .animated-button {
      background: linear-gradient(-30deg, #0b1b3d 50%, #08142b 50%);
      padding: 20px 40px;
      margin: 12px;
      display: inline-block;
      -webkit-transform: translate(0%, 0%);
      transform: translate(0%, 0%);
      overflow: hidden;
      color: #d4e0f7;
      font-size: 20px;
      letter-spacing: 2.5px;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
      -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .animated-button::before {
      content: '';
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      background-color: #8592ad;
      opacity: 0;
      -webkit-transition: .2s opacity ease-in-out;
      transition: .2s opacity ease-in-out;
    }

    .animated-button:hover::before {
      opacity: 0.2;
    }

    .animated-button span {
      position: absolute;
    }

    .animated-button span:nth-child(1) {
      top: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, right top, left top, from(rgba(8, 20, 43, 0)), to(#2662d9));
      background: linear-gradient(to left, rgba(8, 20, 43, 0), #2662d9);
      -webkit-animation: 2s animateTop linear infinite;
      animation: 2s animateTop linear infinite;
    }

    @-webkit-keyframes animateTop {
      0% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
      100% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }

    @keyframes animateTop {
      0% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
      100% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }

    .animated-button span:nth-child(2) {
      top: 0px;
      right: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left bottom, left top, from(rgba(8, 20, 43, 0)), to(#2662d9));
      background: linear-gradient(to top, rgba(8, 20, 43, 0), #2662d9);
      -webkit-animation: 2s animateRight linear -1s infinite;
      animation: 2s animateRight linear -1s infinite;
    }

    @-webkit-keyframes animateRight {
      0% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
      100% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
    }

    @keyframes animateRight {
      0% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
      100% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
    }

    .animated-button span:nth-child(3) {
      bottom: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, left top, right top, from(rgba(8, 20, 43, 0)), to(#2662d9));
      background: linear-gradient(to right, rgba(8, 20, 43, 0), #2662d9);
      -webkit-animation: 2s animateBottom linear infinite;
      animation: 2s animateBottom linear infinite;
    }

    @-webkit-keyframes animateBottom {
      0% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
      100% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
    }

    @keyframes animateBottom {
      0% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
      100% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
    }

    .animated-button span:nth-child(4) {
      top: 0px;
      left: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left top, left bottom, from(rgba(8, 20, 43, 0)), to(#2662d9));
      background: linear-gradient(to bottom, rgba(8, 20, 43, 0), #2662d9);
      -webkit-animation: 2s animateLeft linear -1s infinite;
      animation: 2s animateLeft linear -1s infinite;
    }

    @-webkit-keyframes animateLeft {
      0% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
    }

    @keyframes animateLeft {
      0% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
    }

    .animated-button1 {
      background: linear-gradient(-30deg, #3d0b0b 50%, #2b0808 50%);
      padding: 20px 40px;
      margin: 12px;
      display: inline-block;
      -webkit-transform: translate(0%, 0%);
      transform: translate(0%, 0%);
      overflow: hidden;
      color: #f7d4d4;
      font-size: 20px;
      letter-spacing: 2.5px;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
      -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .animated-button1::before {
      content: '';
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      background-color: #ad8585;
      opacity: 0;
      -webkit-transition: .2s opacity ease-in-out;
      transition: .2s opacity ease-in-out;
    }

    .animated-button1:hover::before {
      opacity: 0.2;
    }

    .animated-button1 span {
      position: absolute;
    }

    .animated-button1 span:nth-child(1) {
      top: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, right top, left top, from(rgba(43, 8, 8, 0)), to(#d92626));
      background: linear-gradient(to left, rgba(43, 8, 8, 0), #d92626);
      -webkit-animation: 2s animateTop linear infinite;
      animation: 2s animateTop linear infinite;
    }

    @keyframes animateTop {
      0% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
      100% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }

    .animated-button1 span:nth-child(2) {
      top: 0px;
      right: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left bottom, left top, from(rgba(43, 8, 8, 0)), to(#d92626));
      background: linear-gradient(to top, rgba(43, 8, 8, 0), #d92626);
      -webkit-animation: 2s animateRight linear -1s infinite;
      animation: 2s animateRight linear -1s infinite;
    }

    @keyframes animateRight {
      0% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
      100% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
    }

    .animated-button1 span:nth-child(3) {
      bottom: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, left top, right top, from(rgba(43, 8, 8, 0)), to(#d92626));
      background: linear-gradient(to right, rgba(43, 8, 8, 0), #d92626);
      -webkit-animation: 2s animateBottom linear infinite;
      animation: 2s animateBottom linear infinite;
    }

    @keyframes animateBottom {
      0% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
      100% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
    }

    .animated-button1 span:nth-child(4) {
      top: 0px;
      left: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left top, left bottom, from(rgba(43, 8, 8, 0)), to(#d92626));
      background: linear-gradient(to bottom, rgba(43, 8, 8, 0), #d92626);
      -webkit-animation: 2s animateLeft linear -1s infinite;
      animation: 2s animateLeft linear -1s infinite;
    }

    @keyframes animateLeft {
      0% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
    }

    .animated-button2 {
      background: linear-gradient(-30deg, #3d240b 50%, #2b1a08 50%);
      padding: 20px 40px;
      margin: 12px;
      display: inline-block;
      -webkit-transform: translate(0%, 0%);
      transform: translate(0%, 0%);
      overflow: hidden;
      color: #f7e6d4;
      font-size: 20px;
      letter-spacing: 2.5px;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
      -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .animated-button2::before {
      content: '';
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      background-color: #ad9985;
      opacity: 0;
      -webkit-transition: .2s opacity ease-in-out;
      transition: .2s opacity ease-in-out;
    }

    .animated-button2:hover::before {
      opacity: 0.2;
    }

    .animated-button2 span {
      position: absolute;
    }

    .animated-button2 span:nth-child(1) {
      top: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, right top, left top, from(rgba(43, 26, 8, 0)), to(#d98026));
      background: linear-gradient(to left, rgba(43, 26, 8, 0), #d98026);
      -webkit-animation: 2s animateTop linear infinite;
      animation: 2s animateTop linear infinite;
    }

    @keyframes animateTop {
      0% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
      100% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }

    .animated-button2 span:nth-child(2) {
      top: 0px;
      right: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left bottom, left top, from(rgba(43, 26, 8, 0)), to(#d98026));
      background: linear-gradient(to top, rgba(43, 26, 8, 0), #d98026);
      -webkit-animation: 2s animateRight linear -1s infinite;
      animation: 2s animateRight linear -1s infinite;
    }

    @keyframes animateRight {
      0% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
      100% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
    }

    .animated-button2 span:nth-child(3) {
      bottom: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, left top, right top, from(rgba(43, 26, 8, 0)), to(#d98026));
      background: linear-gradient(to right, rgba(43, 26, 8, 0), #d98026);
      -webkit-animation: 2s animateBottom linear infinite;
      animation: 2s animateBottom linear infinite;
    }

    @keyframes animateBottom {
      0% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
      100% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
    }

    .animated-button2 span:nth-child(4) {
      top: 0px;
      left: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left top, left bottom, from(rgba(43, 26, 8, 0)), to(#d98026));
      background: linear-gradient(to bottom, rgba(43, 26, 8, 0), #d98026);
      -webkit-animation: 2s animateLeft linear -1s infinite;
      animation: 2s animateLeft linear -1s infinite;
    }

    @keyframes animateLeft {
      0% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
    }

    .animated-button3 {
      background: linear-gradient(-30deg, #3d3d0b 50%, #2b2b08 50%);
      padding: 20px 40px;
      margin: 12px;
      display: inline-block;
      -webkit-transform: translate(0%, 0%);
      transform: translate(0%, 0%);
      overflow: hidden;
      color: #f7f7d4;
      font-size: 20px;
      letter-spacing: 2.5px;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
      -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .animated-button3::before {
      content: '';
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      background-color: #adad85;
      opacity: 0;
      -webkit-transition: .2s opacity ease-in-out;
      transition: .2s opacity ease-in-out;
    }

    .animated-button3:hover::before {
      opacity: 0.2;
    }

    .animated-button3 span {
      position: absolute;
    }

    .animated-button3 span:nth-child(1) {
      top: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, right top, left top, from(rgba(43, 43, 8, 0)), to(#d9d926));
      background: linear-gradient(to left, rgba(43, 43, 8, 0), #d9d926);
      -webkit-animation: 2s animateTop linear infinite;
      animation: 2s animateTop linear infinite;
    }

    @keyframes animateTop {
      0% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
      100% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }

    .animated-button3 span:nth-child(2) {
      top: 0px;
      right: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left bottom, left top, from(rgba(43, 43, 8, 0)), to(#d9d926));
      background: linear-gradient(to top, rgba(43, 43, 8, 0), #d9d926);
      -webkit-animation: 2s animateRight linear -1s infinite;
      animation: 2s animateRight linear -1s infinite;
    }

    @keyframes animateRight {
      0% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
      100% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
    }

    .animated-button3 span:nth-child(3) {
      bottom: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, left top, right top, from(rgba(43, 43, 8, 0)), to(#d9d926));
      background: linear-gradient(to right, rgba(43, 43, 8, 0), #d9d926);
      -webkit-animation: 2s animateBottom linear infinite;
      animation: 2s animateBottom linear infinite;
    }

    @keyframes animateBottom {
      0% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
      100% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
    }

    .animated-button3 span:nth-child(4) {
      top: 0px;
      left: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left top, left bottom, from(rgba(43, 43, 8, 0)), to(#d9d926));
      background: linear-gradient(to bottom, rgba(43, 43, 8, 0), #d9d926);
      -webkit-animation: 2s animateLeft linear -1s infinite;
      animation: 2s animateLeft linear -1s infinite;
    }

    @keyframes animateLeft {
      0% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
    }

    .animated-button4 {
      background: linear-gradient(-30deg, #243d0b 50%, #1a2b08 50%);
      padding: 20px 40px;
      margin: 12px;
      display: inline-block;
      -webkit-transform: translate(0%, 0%);
      transform: translate(0%, 0%);
      overflow: hidden;
      color: #e6f7d4;
      font-size: 20px;
      letter-spacing: 2.5px;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
      -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .animated-button4::before {
      content: '';
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      background-color: #99ad85;
      opacity: 0;
      -webkit-transition: .2s opacity ease-in-out;
      transition: .2s opacity ease-in-out;
    }

    .animated-button4:hover::before {
      opacity: 0.2;
    }

    .animated-button4 span {
      position: absolute;
    }

    .animated-button4 span:nth-child(1) {
      top: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, right top, left top, from(rgba(26, 43, 8, 0)), to(#80d926));
      background: linear-gradient(to left, rgba(26, 43, 8, 0), #80d926);
      -webkit-animation: 2s animateTop linear infinite;
      animation: 2s animateTop linear infinite;
    }

    @keyframes animateTop {
      0% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
      100% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }

    .animated-button4 span:nth-child(2) {
      top: 0px;
      right: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left bottom, left top, from(rgba(26, 43, 8, 0)), to(#80d926));
      background: linear-gradient(to top, rgba(26, 43, 8, 0), #80d926);
      -webkit-animation: 2s animateRight linear -1s infinite;
      animation: 2s animateRight linear -1s infinite;
    }

    @keyframes animateRight {
      0% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
      100% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
    }

    .animated-button4 span:nth-child(3) {
      bottom: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, left top, right top, from(rgba(26, 43, 8, 0)), to(#80d926));
      background: linear-gradient(to right, rgba(26, 43, 8, 0), #80d926);
      -webkit-animation: 2s animateBottom linear infinite;
      animation: 2s animateBottom linear infinite;
    }

    @keyframes animateBottom {
      0% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
      100% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
    }

    .animated-button4 span:nth-child(4) {
      top: 0px;
      left: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left top, left bottom, from(rgba(26, 43, 8, 0)), to(#80d926));
      background: linear-gradient(to bottom, rgba(26, 43, 8, 0), #80d926);
      -webkit-animation: 2s animateLeft linear -1s infinite;
      animation: 2s animateLeft linear -1s infinite;
    }

    @keyframes animateLeft {
      0% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
    }

    .animated-button5 {
      background: linear-gradient(-30deg, #0b3d0b 50%, #082b08 50%);
      padding: 20px 40px;
      margin: 12px;
      display: inline-block;
      -webkit-transform: translate(0%, 0%);
      transform: translate(0%, 0%);
      overflow: hidden;
      color: #d4f7d4;
      font-size: 20px;
      letter-spacing: 2.5px;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
      -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .animated-button5::before {
      content: '';
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      background-color: #85ad85;
      opacity: 0;
      -webkit-transition: .2s opacity ease-in-out;
      transition: .2s opacity ease-in-out;
    }

    .animated-button5:hover::before {
      opacity: 0.2;
    }

    .animated-button5 span {
      position: absolute;
    }

    .animated-button5 span:nth-child(1) {
      top: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, right top, left top, from(rgba(8, 43, 8, 0)), to(#26d926));
      background: linear-gradient(to left, rgba(8, 43, 8, 0), #26d926);
      -webkit-animation: 2s animateTop linear infinite;
      animation: 2s animateTop linear infinite;
    }

    @keyframes animateTop {
      0% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
      100% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }

    .animated-button5 span:nth-child(2) {
      top: 0px;
      right: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left bottom, left top, from(rgba(8, 43, 8, 0)), to(#26d926));
      background: linear-gradient(to top, rgba(8, 43, 8, 0), #26d926);
      -webkit-animation: 2s animateRight linear -1s infinite;
      animation: 2s animateRight linear -1s infinite;
    }

    @keyframes animateRight {
      0% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
      100% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
    }

    .animated-button5 span:nth-child(3) {
      bottom: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, left top, right top, from(rgba(8, 43, 8, 0)), to(#26d926));
      background: linear-gradient(to right, rgba(8, 43, 8, 0), #26d926);
      -webkit-animation: 2s animateBottom linear infinite;
      animation: 2s animateBottom linear infinite;
    }

    @keyframes animateBottom {
      0% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
      100% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
    }

    .animated-button5 span:nth-child(4) {
      top: 0px;
      left: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left top, left bottom, from(rgba(8, 43, 8, 0)), to(#26d926));
      background: linear-gradient(to bottom, rgba(8, 43, 8, 0), #26d926);
      -webkit-animation: 2s animateLeft linear -1s infinite;
      animation: 2s animateLeft linear -1s infinite;
    }

    @keyframes animateLeft {
      0% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
    }

    .animated-button6 {
      background: linear-gradient(-30deg, #0b3d24 50%, #082b1a 50%);
      padding: 20px 40px;
      margin: 12px;
      display: inline-block;
      -webkit-transform: translate(0%, 0%);
      transform: translate(0%, 0%);
      overflow: hidden;
      color: #d4f7e6;
      font-size: 20px;
      letter-spacing: 2.5px;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
      -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .animated-button6::before {
      content: '';
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      background-color: #85ad99;
      opacity: 0;
      -webkit-transition: .2s opacity ease-in-out;
      transition: .2s opacity ease-in-out;
    }

    .animated-button6:hover::before {
      opacity: 0.2;
    }

    .animated-button6 span {
      position: absolute;
    }

    .animated-button6 span:nth-child(1) {
      top: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, right top, left top, from(rgba(8, 43, 26, 0)), to(#26d980));
      background: linear-gradient(to left, rgba(8, 43, 26, 0), #26d980);
      -webkit-animation: 2s animateTop linear infinite;
      animation: 2s animateTop linear infinite;
    }

    @keyframes animateTop {
      0% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
      100% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }

    .animated-button6 span:nth-child(2) {
      top: 0px;
      right: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left bottom, left top, from(rgba(8, 43, 26, 0)), to(#26d980));
      background: linear-gradient(to top, rgba(8, 43, 26, 0), #26d980);
      -webkit-animation: 2s animateRight linear -1s infinite;
      animation: 2s animateRight linear -1s infinite;
    }

    @keyframes animateRight {
      0% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
      100% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
    }

    .animated-button6 span:nth-child(3) {
      bottom: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, left top, right top, from(rgba(8, 43, 26, 0)), to(#26d980));
      background: linear-gradient(to right, rgba(8, 43, 26, 0), #26d980);
      -webkit-animation: 2s animateBottom linear infinite;
      animation: 2s animateBottom linear infinite;
    }

    @keyframes animateBottom {
      0% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
      100% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
    }

    .animated-button6 span:nth-child(4) {
      top: 0px;
      left: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left top, left bottom, from(rgba(8, 43, 26, 0)), to(#26d980));
      background: linear-gradient(to bottom, rgba(8, 43, 26, 0), #26d980);
      -webkit-animation: 2s animateLeft linear -1s infinite;
      animation: 2s animateLeft linear -1s infinite;
    }

    @keyframes animateLeft {
      0% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
    }

    .animated-button7 {
      background: linear-gradient(-30deg, #0b3d3d 50%, #082b2b 50%);
      padding: 20px 40px;
      margin: 12px;
      display: inline-block;
      -webkit-transform: translate(0%, 0%);
      transform: translate(0%, 0%);
      overflow: hidden;
      color: #d4f7f7;
      font-size: 20px;
      letter-spacing: 2.5px;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
      -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .animated-button7::before {
      content: '';
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      background-color: #85adad;
      opacity: 0;
      -webkit-transition: .2s opacity ease-in-out;
      transition: .2s opacity ease-in-out;
    }

    .animated-button7:hover::before {
      opacity: 0.2;
    }

    .animated-button7 span {
      position: absolute;
    }

    .animated-button7 span:nth-child(1) {
      top: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, right top, left top, from(rgba(8, 43, 43, 0)), to(#26d9d9));
      background: linear-gradient(to left, rgba(8, 43, 43, 0), #26d9d9);
      -webkit-animation: 2s animateTop linear infinite;
      animation: 2s animateTop linear infinite;
    }

    @keyframes animateTop {
      0% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
      100% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }

    .animated-button7 span:nth-child(2) {
      top: 0px;
      right: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left bottom, left top, from(rgba(8, 43, 43, 0)), to(#26d9d9));
      background: linear-gradient(to top, rgba(8, 43, 43, 0), #26d9d9);
      -webkit-animation: 2s animateRight linear -1s infinite;
      animation: 2s animateRight linear -1s infinite;
    }

    @keyframes animateRight {
      0% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
      100% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
    }

    .animated-button7 span:nth-child(3) {
      bottom: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, left top, right top, from(rgba(8, 43, 43, 0)), to(#26d9d9));
      background: linear-gradient(to right, rgba(8, 43, 43, 0), #26d9d9);
      -webkit-animation: 2s animateBottom linear infinite;
      animation: 2s animateBottom linear infinite;
    }

    @keyframes animateBottom {
      0% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
      100% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
    }

    .animated-button7 span:nth-child(4) {
      top: 0px;
      left: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left top, left bottom, from(rgba(8, 43, 43, 0)), to(#26d9d9));
      background: linear-gradient(to bottom, rgba(8, 43, 43, 0), #26d9d9);
      -webkit-animation: 2s animateLeft linear -1s infinite;
      animation: 2s animateLeft linear -1s infinite;
    }

    @keyframes animateLeft {
      0% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
    }

    .animated-button8 {
      background: linear-gradient(-30deg, #0b243d 50%, #081a2b 50%);
      padding: 20px 40px;
      margin: 12px;
      display: inline-block;
      -webkit-transform: translate(0%, 0%);
      transform: translate(0%, 0%);
      overflow: hidden;
      color: #d4e6f7;
      font-size: 20px;
      letter-spacing: 2.5px;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
      -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .animated-button8::before {
      content: '';
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      background-color: #8599ad;
      opacity: 0;
      -webkit-transition: .2s opacity ease-in-out;
      transition: .2s opacity ease-in-out;
    }

    .animated-button8:hover::before {
      opacity: 0.2;
    }

    .animated-button8 span {
      position: absolute;
    }

    .animated-button8 span:nth-child(1) {
      top: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, right top, left top, from(rgba(8, 26, 43, 0)), to(#2680d9));
      background: linear-gradient(to left, rgba(8, 26, 43, 0), #2680d9);
      -webkit-animation: 2s animateTop linear infinite;
      animation: 2s animateTop linear infinite;
    }

    @keyframes animateTop {
      0% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
      100% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }

    .animated-button8 span:nth-child(2) {
      top: 0px;
      right: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left bottom, left top, from(rgba(8, 26, 43, 0)), to(#2680d9));
      background: linear-gradient(to top, rgba(8, 26, 43, 0), #2680d9);
      -webkit-animation: 2s animateRight linear -1s infinite;
      animation: 2s animateRight linear -1s infinite;
    }

    @keyframes animateRight {
      0% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
      100% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
    }

    .animated-button8 span:nth-child(3) {
      bottom: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, left top, right top, from(rgba(8, 26, 43, 0)), to(#2680d9));
      background: linear-gradient(to right, rgba(8, 26, 43, 0), #2680d9);
      -webkit-animation: 2s animateBottom linear infinite;
      animation: 2s animateBottom linear infinite;
    }

    @keyframes animateBottom {
      0% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
      100% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
    }

    .animated-button8 span:nth-child(4) {
      top: 0px;
      left: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left top, left bottom, from(rgba(8, 26, 43, 0)), to(#2680d9));
      background: linear-gradient(to bottom, rgba(8, 26, 43, 0), #2680d9);
      -webkit-animation: 2s animateLeft linear -1s infinite;
      animation: 2s animateLeft linear -1s infinite;
    }

    @keyframes animateLeft {
      0% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
    }

    .animated-button9 {
      background: linear-gradient(-30deg, #0b0b3d 50%, #08082b 50%);
      padding: 20px 40px;
      margin: 12px;
      display: inline-block;
      -webkit-transform: translate(0%, 0%);
      transform: translate(0%, 0%);
      overflow: hidden;
      color: #d4d4f7;
      font-size: 20px;
      letter-spacing: 2.5px;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
      -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .animated-button9::before {
      content: '';
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      background-color: #8585ad;
      opacity: 0;
      -webkit-transition: .2s opacity ease-in-out;
      transition: .2s opacity ease-in-out;
    }

    .animated-button9:hover::before {
      opacity: 0.2;
    }

    .animated-button9 span {
      position: absolute;
    }

    .animated-button9 span:nth-child(1) {
      top: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, right top, left top, from(rgba(8, 8, 43, 0)), to(#2626d9));
      background: linear-gradient(to left, rgba(8, 8, 43, 0), #2626d9);
      -webkit-animation: 2s animateTop linear infinite;
      animation: 2s animateTop linear infinite;
    }

    @keyframes animateTop {
      0% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
      100% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }

    .animated-button9 span:nth-child(2) {
      top: 0px;
      right: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left bottom, left top, from(rgba(8, 8, 43, 0)), to(#2626d9));
      background: linear-gradient(to top, rgba(8, 8, 43, 0), #2626d9);
      -webkit-animation: 2s animateRight linear -1s infinite;
      animation: 2s animateRight linear -1s infinite;
    }

    @keyframes animateRight {
      0% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
      100% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
    }

    .animated-button9 span:nth-child(3) {
      bottom: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, left top, right top, from(rgba(8, 8, 43, 0)), to(#2626d9));
      background: linear-gradient(to right, rgba(8, 8, 43, 0), #2626d9);
      -webkit-animation: 2s animateBottom linear infinite;
      animation: 2s animateBottom linear infinite;
    }

    @keyframes animateBottom {
      0% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
      100% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
    }

    .animated-button9 span:nth-child(4) {
      top: 0px;
      left: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left top, left bottom, from(rgba(8, 8, 43, 0)), to(#2626d9));
      background: linear-gradient(to bottom, rgba(8, 8, 43, 0), #2626d9);
      -webkit-animation: 2s animateLeft linear -1s infinite;
      animation: 2s animateLeft linear -1s infinite;
    }

    @keyframes animateLeft {
      0% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
    }

    .animated-button10 {
      background: linear-gradient(-30deg, #240b3d 50%, #1a082b 50%);
      padding: 20px 40px;
      margin: 12px;
      display: inline-block;
      -webkit-transform: translate(0%, 0%);
      transform: translate(0%, 0%);
      overflow: hidden;
      color: #e6d4f7;
      font-size: 20px;
      letter-spacing: 2.5px;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
      -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .animated-button10::before {
      content: '';
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      background-color: #9985ad;
      opacity: 0;
      -webkit-transition: .2s opacity ease-in-out;
      transition: .2s opacity ease-in-out;
    }

    .animated-button10:hover::before {
      opacity: 0.2;
    }

    .animated-button10 span {
      position: absolute;
    }

    .animated-button10 span:nth-child(1) {
      top: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, right top, left top, from(rgba(26, 8, 43, 0)), to(#8026d9));
      background: linear-gradient(to left, rgba(26, 8, 43, 0), #8026d9);
      -webkit-animation: 2s animateTop linear infinite;
      animation: 2s animateTop linear infinite;
    }

    @keyframes animateTop {
      0% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
      100% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }

    .animated-button10 span:nth-child(2) {
      top: 0px;
      right: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left bottom, left top, from(rgba(26, 8, 43, 0)), to(#8026d9));
      background: linear-gradient(to top, rgba(26, 8, 43, 0), #8026d9);
      -webkit-animation: 2s animateRight linear -1s infinite;
      animation: 2s animateRight linear -1s infinite;
    }

    @keyframes animateRight {
      0% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
      100% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
    }

    .animated-button10 span:nth-child(3) {
      bottom: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, left top, right top, from(rgba(26, 8, 43, 0)), to(#8026d9));
      background: linear-gradient(to right, rgba(26, 8, 43, 0), #8026d9);
      -webkit-animation: 2s animateBottom linear infinite;
      animation: 2s animateBottom linear infinite;
    }

    @keyframes animateBottom {
      0% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
      100% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
    }

    .animated-button10 span:nth-child(4) {
      top: 0px;
      left: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left top, left bottom, from(rgba(26, 8, 43, 0)), to(#8026d9));
      background: linear-gradient(to bottom, rgba(26, 8, 43, 0), #8026d9);
      -webkit-animation: 2s animateLeft linear -1s infinite;
      animation: 2s animateLeft linear -1s infinite;
    }

    @keyframes animateLeft {
      0% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
    }

    .animated-button11 {
      background: linear-gradient(-30deg, #3d0b3d 50%, #2b082b 50%);
      padding: 20px 40px;
      margin: 12px;
      display: inline-block;
      -webkit-transform: translate(0%, 0%);
      transform: translate(0%, 0%);
      overflow: hidden;
      color: #f7d4f7;
      font-size: 20px;
      letter-spacing: 2.5px;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
      -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .animated-button11::before {
      content: '';
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      background-color: #ad85ad;
      opacity: 0;
      -webkit-transition: .2s opacity ease-in-out;
      transition: .2s opacity ease-in-out;
    }

    .animated-button11:hover::before {
      opacity: 0.2;
    }

    .animated-button11 span {
      position: absolute;
    }

    .animated-button11 span:nth-child(1) {
      top: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, right top, left top, from(rgba(43, 8, 43, 0)), to(#d926d9));
      background: linear-gradient(to left, rgba(43, 8, 43, 0), #d926d9);
      -webkit-animation: 2s animateTop linear infinite;
      animation: 2s animateTop linear infinite;
    }

    @keyframes animateTop {
      0% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
      100% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }

    .animated-button11 span:nth-child(2) {
      top: 0px;
      right: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left bottom, left top, from(rgba(43, 8, 43, 0)), to(#d926d9));
      background: linear-gradient(to top, rgba(43, 8, 43, 0), #d926d9);
      -webkit-animation: 2s animateRight linear -1s infinite;
      animation: 2s animateRight linear -1s infinite;
    }

    @keyframes animateRight {
      0% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
      100% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
    }

    .animated-button11 span:nth-child(3) {
      bottom: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, left top, right top, from(rgba(43, 8, 43, 0)), to(#d926d9));
      background: linear-gradient(to right, rgba(43, 8, 43, 0), #d926d9);
      -webkit-animation: 2s animateBottom linear infinite;
      animation: 2s animateBottom linear infinite;
    }

    @keyframes animateBottom {
      0% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
      100% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
    }

    .animated-button11 span:nth-child(4) {
      top: 0px;
      left: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left top, left bottom, from(rgba(43, 8, 43, 0)), to(#d926d9));
      background: linear-gradient(to bottom, rgba(43, 8, 43, 0), #d926d9);
      -webkit-animation: 2s animateLeft linear -1s infinite;
      animation: 2s animateLeft linear -1s infinite;
    }

    @keyframes animateLeft {
      0% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
    }

    .animated-button12 {
      background: linear-gradient(-30deg, #3d0b24 50%, #2b081a 50%);
      padding: 20px 40px;
      margin: 12px;
      display: inline-block;
      -webkit-transform: translate(0%, 0%);
      transform: translate(0%, 0%);
      overflow: hidden;
      color: #f7d4e6;
      font-size: 20px;
      letter-spacing: 2.5px;
      text-align: center;
      text-transform: uppercase;
      text-decoration: none;
      -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .animated-button12::before {
      content: '';
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      background-color: #ad8599;
      opacity: 0;
      -webkit-transition: .2s opacity ease-in-out;
      transition: .2s opacity ease-in-out;
    }

    .animated-button12:hover::before {
      opacity: 0.2;
    }

    .animated-button12 span {
      position: absolute;
    }

    .animated-button12 span:nth-child(1) {
      top: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, right top, left top, from(rgba(43, 8, 26, 0)), to(#d92680));
      background: linear-gradient(to left, rgba(43, 8, 26, 0), #d92680);
      -webkit-animation: 2s animateTop linear infinite;
      animation: 2s animateTop linear infinite;
    }

    @keyframes animateTop {
      0% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
      100% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
    }

    .animated-button12 span:nth-child(2) {
      top: 0px;
      right: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left bottom, left top, from(rgba(43, 8, 26, 0)), to(#d92680));
      background: linear-gradient(to top, rgba(43, 8, 26, 0), #d92680);
      -webkit-animation: 2s animateRight linear -1s infinite;
      animation: 2s animateRight linear -1s infinite;
    }

    @keyframes animateRight {
      0% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
      100% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
    }

    .animated-button12 span:nth-child(3) {
      bottom: 0px;
      left: 0px;
      width: 100%;
      height: 2px;
      background: -webkit-gradient(linear, left top, right top, from(rgba(43, 8, 26, 0)), to(#d92680));
      background: linear-gradient(to right, rgba(43, 8, 26, 0), #d92680);
      -webkit-animation: 2s animateBottom linear infinite;
      animation: 2s animateBottom linear infinite;
    }

    @keyframes animateBottom {
      0% {
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
      }
      100% {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
      }
    }

    .animated-button12 span:nth-child(4) {
      top: 0px;
      left: 0px;
      height: 100%;
      width: 2px;
      background: -webkit-gradient(linear, left top, left bottom, from(rgba(43, 8, 26, 0)), to(#d92680));
      background: linear-gradient(to bottom, rgba(43, 8, 26, 0), #d92680);
      -webkit-animation: 2s animateLeft linear -1s infinite;
      animation: 2s animateLeft linear -1s infinite;
    }

    @keyframes animateLeft {
      0% {
        -webkit-transform: translateY(-100%);
        transform: translateY(-100%);
      }
      100% {
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
      }
    }
  </style>
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
        '<h3>Here is your image:</h3>' + 
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
