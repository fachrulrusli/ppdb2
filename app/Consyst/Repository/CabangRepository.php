<?php namespace App\Consyst\Repository;

use Illuminate\Support\Facades\Config;
use App\Consyst\Contracts\ICabangRepository as cInterface;
use App\Consyst\EloquentRepository as BaseInterface;
use App\Consyst\Models\Cabang;
use App\Consyst\Models\Kota;
use App\Consyst\Models\Bank;
Use DB;
/**
 * Cabang repository
 * @author Hardiyansyah
 * @package Consyst\Repository
 */
class CabangRepository extends BaseInterface implements cInterface
{
    protected $parent;
    
    protected $vname;
    public function __construct()
    {
        parent::__construct(new Cabang());
        $this->parent = Config::get("consyst.cabang.parent");
        $this->tbName = Config::get("consyst.cabang.table");
    }

    public function getReference()
    {
        return (object)array(
            'kota' => Kota::all()->pluck('FullName', 'id'),
            'bank' => Bank::all()->pluck('FullName', 'id_bank'),
        );
    }
    /**
     * Change status
     * @param  integer $id id
     * @param  integer $value beetween 0 to 1, 1 for aktive and 0 for non active
     * @return mixed
     */
    public function changeStatus($id, $value)
    {
        return \DB::table($this->tbName)
            ->where('id_cabang', $id)
            ->update(['status' => $value]);
    }

    public function getData()
    {
        return Cabang::whereIn('jenis', [2,3,1])->where('status',1)->select('id_cabang','nama_cabang')
            ->get();
    }

    public function getDatabaru(){
        DB::statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
        $stmt = "SELECT * FROM
                        YASIN.kspsb.dbo.SUBBRANCH a 
                        WHERE
                        NOT EXISTS (
                        SELECT * 
                        FROM
                        [annur].[consyst].[dbo].[sys_ms_cabang] b 
                        WHERE
                        a.Kd_cabang = b.id_cabang 
                )";
        return DB::select(DB::raw($stmt));
    }
    public function SaveCabangAll($kode_lama,$id_cabang,$nama_cabang,$regional,$urutan,$bm,$rm,$tgl_berdiri,$alamat,$anrek,$norek,$jenis,$status,$id_kota,$id_bank){

        DB::statement('SET ANSI_NULLS ON; SET ANSI_WARNINGS ON');
        $stmt = "
                DELETE FROM [annur].[citra].[dbo].[ms_kantor] WHERE Kode_lama = '$kode_lama' AND kode_sigma = '$id_cabang'
                INSERT INTO [annur].[citra].[dbo].[ms_kantor] 
                (Kode_lama,kode_sigma, nama, Target, Regional, urutan, BM, RM, tgl_berdiri,NoUrut, NamaCab, Alamat, NamaPemRek,NamaBank, NoRekening,NamaBM,TargetMinimal,tlp, FlgJasaBaru, kliring_kode, jenis_kantor, status,kota, ID_KOTA,Active,kode_bank,jenis_cabang) 
                VALUES ('$kode_lama','$id_cabang', '$nama_cabang',null,'$regional', '$urutan', '$bm', '$rm', '$tgl_berdiri','$urutan','$nama_cabang', '$alamat', '$anrek','','$norek','',null,'','','','$jenis', '$status','','$id_kota','1','$id_bank','')

                DELETE FROM [KSB-SERVER].[Antaran].[dbo].[kantorCabang] WHERE ket = '$id_cabang' 
                INSERT INTO [KSB-SERVER].[Antaran].[dbo].[kantorCabang] (namaKantor, ket) VALUES ('$nama_cabang', '$id_cabang')

                DELETE FROM [KSB-SERVER].[AuditManagement].[dbo].[ms_cabang] WHERE CabangID = '$id_cabang'
                INSERT INTO [KSB-SERVER].[AuditManagement].[dbo].[ms_cabang] (CabangID, Regional, NamaCabang, TglOpen, SKFile, Kota) VALUES ('$id_cabang', null, '$nama_cabang', '$tgl_berdiri',null, '$id_kota')

                DELETE FROM [KSB-SERVER].[bprsatu].[dbo].[MS_CABANG] WHERE CA_CODE = '$id_cabang'    
                INSERT INTO [KSB-SERVER].[bprsatu].[dbo].[MS_CABANG] (CA_STAT, CA_CODE, CA_NAME, CA_ALAMAT1) VALUES ('1', '$id_cabang', '$nama_cabang',substring('$alamat',1,30) )

                DELETE FROM [KSB-SERVER].[Keuangan].[dbo].[Kantor] WHERE [Kode Cabang] = '$id_cabang'
                INSERT INTO [KSB-SERVER].[Keuangan].[dbo].[Kantor] ([Kode Cabang], [Nama Kantor], [Target], [Regional], [NoUrut], [NamaCab], [No Rekening], [Pemilik Rekining],[singkatan]) VALUES ('$id_cabang', '$nama_cabang', null,'$regional', '$urutan', '$nama_cabang', '$norek','$anrek',null)

                DELETE FROM [KSB-SERVER].[KSB].[dbo].[cabangRef] WHERE KodeSigma = '$id_cabang'
                INSERT INTO [KSB-SERVER].[KSB].[dbo].[cabangRef] (KodeCabang, KodeSigma, NamaKantor) VALUES ('$kode_lama', '$id_cabang','$nama_cabang')

                DELETE FROM [KSB-SERVER].[KSB].[dbo].[Kantor] WHERE [Kode Kantor] = '$id_cabang'
                INSERT INTO [KSB-SERVER].[KSB].[dbo].[Kantor] ([Kode Kantor], [Nama Kantor], [Target], [Regional],[BM], [RM], [Tgl Berdiri], [Alamat], [Active], [NamaPemRek], [NamaBank], [NoRekening], [NamaBM],[TargetMinimal], [tlp]) VALUES ('$id_cabang', '$nama_cabang', null,'$regional','$bm','$rm','$tgl_berdiri', '$alamat','1','$anrek','$id_bank','$norek','$bm',null,null)

                DELETE FROM [KSB-SERVER].[pendamping].[dbo].[cabangRef] WHERE KodeSigma = '$id_cabang'
                INSERT INTO [KSB-SERVER].[pendamping].[dbo].[cabangRef] (KodeCabang, KodeSigma, NamaKantor, Regional, JasaBaru) VALUES ('$kode_lama', '$id_cabang','$nama_cabang','$regional',null)

                DELETE FROM [KSB-SERVER].[pendamping].[dbo].[cabangRef2] WHERE KodeSigma = '$id_cabang'
                INSERT INTO [KSB-SERVER].[pendamping].[dbo].[cabangRef2] (KodeCabang, KodeSigma, NamaKantor) VALUES ('$kode_lama', '$id_cabang','$nama_cabang')

                DELETE FROM [KSB-SERVER].[pendamping].[dbo].[Kantor] WHERE kode_sigma = '$id_cabang'
                INSERT INTO [KSB-SERVER].[pendamping].[dbo].[Kantor] ([Kode_lama], [kode_sigma], [nama], [Target], [Regional],[NoUrut], [BM], [RM], [tgl_berdiri], [NamaCab], [Alamat], [Active], [NamaPemRek], [NamaBank], [NoRekening], [NamaBM], [TargetMinimal], [tlp], [FlgJasaBaru], [kode_bank], [urutan], [kliring_kode], [jenis_kantor], [status], [kota], [ID_KOTA], [jenis_cabang]) 
                    VALUES ('$kode_lama','$id_cabang', '$nama_cabang', null,'$regional',null,'$bm','$rm','$tgl_berdiri','$nama_cabang', '$alamat','1','$anrek','$id_bank','$norek','$bm',null,null,null,'$id_bank', '$urutan', null, '$jenis','1',null, '$id_kota',null)

                DELETE FROM [KSB-SERVER].[pendamping].[dbo].[Kantor_] WHERE [Kode Kantor] = '$id_cabang'  
                INSERT INTO [KSB-SERVER].[pendamping].[dbo].[Kantor_] ([Kode Kantor], [Nama Kantor], [Target], [Regional],[NoUrut], [BM], [RM], [Tgl Berdiri], [NamaCab], [Alamat], [Active], [NamaPemRek], [NamaBank], [NoRekening], [NamaBM], [TargetMinimal], [tlp]) 
                    VALUES ('$id_cabang', '$nama_cabang', null,'$regional',null,'$bm','$rm','$tgl_berdiri','$nama_cabang', '$alamat','1','$anrek','$id_bank','$norek','$bm',null,null)  

                DELETE FROM [yasin].[smk].[dbo].[ref_kantor] WHERE kode_cabang = '$id_cabang'    
                INSERT INTO [yasin].[smk].[dbo].[ref_kantor] 
                ([kode_cabang_humanys], [kode_cabang], [kode_cabang_lama], [nama])
                    VALUES ('$id_cabang', '$id_cabang', '$kode_lama','$nama_cabang')        

                DELETE FROM [yasin].[smk].[dbo].[SUBBRANCH] WHERE Kd_cabang = '$id_cabang'    
                INSERT INTO [yasin].[smk].[dbo].[SUBBRANCH] ([Kd_cabang], [flgstatus], [NamaCabang], [alamat1]) 
                    VALUES ('$id_cabang','Y', '$nama_cabang','$alamat')    
                "
                ;
        return DB::insert($stmt);
    }



}
