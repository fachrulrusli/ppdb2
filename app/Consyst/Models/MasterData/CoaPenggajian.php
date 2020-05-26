<?php namespace App\Consyst\Models\MasterData;
use Illuminate\Database\Eloquent\Model;
/**
 * Class JamKerja
 *
 * @author Hardiyansyah
 * @package Consyst\Models
 */
class CoaPenggajian extends Model
{
	public $timestamps = false;
    protected $table;
    protected $primaryKey = "";
    protected $guarded = [
        ];
    public $rules = array();

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
         $this->table = config("consyst.kodetransaksi.table");
         $this->primaryKey=config('consyst.kodetransaksi.primary_key');
        $this->rules = array(
        );
    }
}
