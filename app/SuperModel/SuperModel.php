<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 03/12/15
 * Time: 05:41 م
 */

namespace App\SuperModel;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class SuperModel extends Model
{

    public function setException($e) {
        $this->exception = new $e;
    }
    protected function exceptionThrower() {
        if (isset($this->exception)) {
            throw $this->exception;
        } else {
            throw new ModelNotFoundException('SuperModel Error');
        }
    }
    public function recursiveModel($params)
    {
        $records = $this;
        foreach ($params as $col_name => $col_value)
        {
            $records = $records->where($col_name, $col_value);

        }
        return $records->get();

    }
    public function grabByParams($params) {
        $records = $this->recursiveModel($params);
        if(count($records) == 0) {
            $this->exceptionThrower();
        }
        $records_array = [];
        foreach ($records as $record){
            $records_array[] = $record->toArray();
        }
        return $records_array ;
    }
    public function grabByParamsFirst($params) {
        $records = $this->recursiveModel($params);
        if(count($records) == 0) {
            $this->exceptionThrower();
        }

        return $records->first()->toArray() ;
    }
    public function destroyByParams($params) {
        $records = $this->recursiveModel($params);
        if(count($records) == 0) {
            $this->exceptionThrower();
        }
        foreach ($records as $record) {

            $record->destroy($record->id);
        }
    }

    public function lastInsertion() {
        return $this->grabByParamsFirst(['id' => \DB::getPdo()->lastInsertId()]);

    }

    public function createByParams($params) {
        $this->create($params);
        return $this->lastInsertion();

    }

}