<?php namespace App\Consyst\Models\MasterData;
use Illuminate\Database\Eloquent\Model;
/**
 * Class JamKerja
 *
 * @author Hardiyansyah
 * @package Consyst\Models
 */
class Berita extends Model
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
         $this->table = config("consyst.berita.table");
         $this->primaryKey=config('consyst.berita.primary_key');

    }
}
