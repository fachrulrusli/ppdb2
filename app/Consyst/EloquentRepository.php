<?php
namespace App\Consyst;

use Carbon\Carbon;
use Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request as httpRequest;
use Validator;
use Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
/**
 * Class EloquentRepository
 * @author Hardiyansyah
 * @package Consyst
 */
class EloquentRepository implements RepositoryInterface
{
    public $model;
    protected $tbName;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    #region Consyst\RepositoryInterface Members
    /**
     * Retrieve data array for populate field select
     *
     * @param string $column
     * @param string|null $key
     *
     * @return \Illuminate\Support\Collection|array
     */
    public function lists($column, $key = null)
    {
        return $this->model->lists($column, $key);
    }
    /**
     * Retrieve all data of repository
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        if ($this->model instanceof \Illuminate\Database\Eloquent\Builder) {
            $results = $this->model->get($columns);
        } else {
            $results = $this->model->all($columns);
        }
        $this->resetModel();
        return $this->parserResult($results);
    }
    /**
     * Retrieve all data of repository with OrderBy
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function allOrderBy($orderbyColoumn, $type)
    {
        if ($this->model instanceof \Illuminate\Database\Eloquent\Builder) {
            $results = $this->model->orderBy($orderbyColoumn, $type);
        } else {

            $results = $this->model->orderBy($orderbyColoumn, $type)->get();
        }
        $this->resetModel();
        return $this->parserResult($results);
    }

    /**
     * Find data by id
     *
     * @param  $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $model = $this->model->findOrFail($id, $columns);
        $this->resetModel();
        return $this->parserResult($model);
    }
    /**
     * Find data by field and value
     *
     * @param  $field
     * @param  $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findByField($field, $value = null, $columns = array('*'))
    {
        $model = $this->model->where($field, '=', $value)->get($columns)->first();

        return $this->parserResult($model);
    }
    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhere(array $where, $columns = array('*'))
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $this->model                   = $this->model->where($field, $condition, $val);
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
        $model = $this->model->get($columns);
        $this->resetModel();
        return $this->parserResult($model);
    }
    /**
     * Find data by multiple values in one field
     *
     * @param  $field
     * @param array $values
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhereIn($field, array $values, $columns = array('*'))
    {
        $this->applyCriteria();
        $model = $this->model->whereIn($field, $values)->get($columns);
        $this->resetModel();
        return $this->parserResult($model);
    }
    /**
     * Find data by excluding multiple values in one field
     *
     * @param  $field
     * @param array $values
     * @param array $columns
     *
     *
     * @return mixed
     */
    public function findWhereNotIn($field, array $values, $columns = array('*'))
    {

        $model = $this->model->whereNotIn($field, $values)->get($columns);
        $this->resetModel();
        return $this->parserResult($model);
    }
    /**
     * Save a new entity in repository
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        $atr= $attributes;
        if (Schema::hasColumn($this->model->getTable(), 'created_by'))
        {
            $atr = array_add($attributes,'created_by' , strtoupper(Session::get('secret.name')) );
        }
        if (Schema::hasColumn($this->model->getTable(), 'updated_by'))
        {
            $atr = array_add($atr,'updated_by' , strtoupper(Session::get('secret.name')) );
        }

        //$model = $this->model->newInstance(array_map('strtoupper', $atr));
        $model = $this->model->newInstance($atr);
        $model->save();
        $this->resetModel();
        return $this->parserResult($model);
    }
    /**
     * Update a entity in repository by id
     *
     * @param array $attributes
     * @param  $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id)
    {

        $model = $this->model->findOrFail($id);
        //$model->fill(array_map('strtoupper', $attributes));
        $model->fill($attributes);

        if (Schema::hasColumn($this->model->getTable(), 'updated_by'))
        {
            $atr = array_add($attributes,'created_by' , strtoupper(Session::get('secret.name')) );
        }
        $model->save();
        $this->resetModel();
        return $this->parserResult($model);
    }
    /**
     * Delete a entity in repository by id
     *
     * @param  $id
     *
     * @return int
     */
    public function delete($id)
    {
        $model         = $this->find($id);
        $originalModel = clone $model;
        $this->resetModel();
        $deleted = $model->delete();
        return $deleted;
    }

    /**
     * validator object for repo
     * @param  httpRequest $request form request
     * @return Validator            validator object
     */
    public function validate(httpRequest $request, $rule = '')
    {

        if ($request->action == 2) {

            $this->makeRules();
        }

        if (!empty($rule)) {
            $this->model->rules = $rule;

        }

        $validator = Validator::make($request->all(), $this->model->rules, [], $this->model->nicename);
        return $validator;

    }
    /**
     * Check if entity has relation
     *
     * @param string $relation
     * @return $this
     */
    public function has($relation)
    {
        $this->model = $this->model->has($relation);
        return $this;
    }
    /**
     * Load relations
     *
     * @param  $relations
     *
     * @return  $this
     */
    public function with($relations)
    {
        $this->model = $this->model->with($relations);
        return $this;
    }

    /**
     * Truncate data of model
     * @return mixed
     */
    public function truncate()
    {
        return $this->model->truncate();
    }
    /**
     * Set hidden fields
     *
     * @param array $fields
     * @return $this
     */
    public function hidden(array $fields)
    {
        $this->model->setHidden($fields);
        return $this;
    }
    /**
     * Set visible fields
     *
     * @param array $fields
     * @return $this
     */
    public function visible(array $fields)
    {
        $this->model->setVisible($fields);
        return $this;
    }
    /**
     * @throws RepositoryException
     */
    public function resetModel()
    {
        $this->makeModel();
    }
    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->model;
        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }
    /**
     * Update or Create an entity in repository
     *
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function updateOrCreate(array $attributes, $id)
    {
        $model = $this->model->updateOrCreate(['id' => $id], $attributes);
        $this->resetModel();
        return $this->parserResult($model);
    }
    /**
     * Wrapper result data, here result will be delifered
     *
     * @param mixed $result
     * @return mixed
     */
    public function parserResult($result)
    {

        // for now return object
        return $result;
    }

    /**
     * Make custom rule to ignore unique if updating record
     * @return null
     */
    protected function makeRules()
    {
        foreach ($this->model->rules as $key => $value) {
            if (str_contains($value, 'unique')) {
                // find posittion
                $pos                      = strpos($value, 'unique') - 1;
                $final                    = substr($value, 0, $pos);
                $this->model->rules[$key] = $final;
            }
        }

    }

    /**
     * pluck function on laravel, this function will replace list function , list function now deprecated
     * @param  string $column coloumn name
     * @param  string $key    key name
     */
    public function Pluck($column, $key = null)
    {
        return $this->model->pluck($column, $key);
    }

    /**
     * Save a new entity in repository with addition atribute ( mass assingment)
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function createEx(httpRequest $request)
    {

        $model = $this->model->newInstance();
        $model->fill($request->all());
        $model->created_by  = strtoupper($request->session()->get('secret.name'));
        $model->kode_cabang = Crypt::decrypt($request->session()->get('secret.kode_cabang'));
        $model->updated_by  = strtoupper($request->session()->get('secret.name'));
        $model->save();
        $this->resetModel();
        return $this->parserResult($model);
    }
    /**
     * change status of recod on model
     * @method doChangeStatus
     * @author Hardiyansyah
     * @param  integer      $id record id
     * @param  integer      $st status code
     * @return mixed
     */

    public function doChangeStatus($id,$st =1)
    {
        $model = $this->model->newInstance();
        $model->find($id);
        $model->status=$st;
        $model->updated_by  = strtoupper(session::get('secret.name'));
        $model->save();
        $this->resetModel();
        return $this->parserResult($model);

    }

    /**
     * change authored flag
     * @method doChangeAuthored
     * @author Hardiyansyah
     * @param  integer     $id Record id
     * @return mixed
     */
    public function doChangeAuthored($id)
    {
        $model = $this->model->newInstance();
        $model->find($id);
        $model->authored=1;
        $model->updated_by  = strtoupper(session::get('secret.name'));
        $model->authored_by  = strtoupper(session::get('secret.name'));
        $model->authored_at  = Carbon::now();
        $model->save();
        $this->resetModel();
        return $this->parserResult($model);
    }

    /**
     * Log function on repo
     * @method doLog
     * @author Hardiyansyah
     * @param  string  $message string meesage to store on log files
     * @param  integer $type    integer log type 0 - 8
     * @return none
     */
    public function doLog($message,$type=1)
    {
        switch ($type)
        {
            //debug, info, notice, warning, error, critical, alert, emergency
            case 0: // debug
                Log::debug($message);
                break;
            case 1: // info
                Log::info($message);
                break;
            case 2: //notice
                Log::notice($message);
                break;
            case 3: //warning
                Log::warning($message);
                break;
            case 4: //error
                Log::error($message);
                break;
            case 5: //critical
                Log::critical($message);
                break;
            case 6: //alert
                Log::alert($message);
                break;
            case 7: //emergency
                Log::emergency($message);
                break;
            default:
                Log::info($message);

        }
    }

}
