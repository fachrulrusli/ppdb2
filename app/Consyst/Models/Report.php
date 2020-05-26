<?php namespace App\Consyst\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * Class Report
 *
 * @author Hardiyansyah
 * @package App\Consyst\Models
 */
Class Report extends Model
{
    protected $table;
    protected $fillable =['nama','url','keterangan','parameter','jenis','status',];

    Public $nicename = array(
        'nama'	 => 'Nama',
        'url'	 => 'Url',
        'keterangan'	 => 'Keterangan',
        'parameter'	 => 'Parameter',
        'jenis'	 => 'Jenis',
        'status'	 => 'Status',
    );

    public $rules = array();
    public $timestamps = false;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('consyst.report.table');
        $this->primaryKey=config('consyst.report.primary_key');
        $this->rules = array(
            'nama' => 'required'
        );

    }
    /**
     * Define Many to many relation to table grup
     *
     * @author Hardiyansyah
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grups()
    {
        return $this->belongsToMany(Config::get("consyst.model_namespace") . "\Grup", Config::get('consyst.group_report.table'), Config::get('consyst.group_report.foreign_key'), Config::get('consyst.group_report.primary_key'));
    }
}

