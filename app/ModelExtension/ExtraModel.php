<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 03/12/15
 * Time: 07:38 ص
 */

namespace App\ModelExtension;

use Illuminate\Database\Eloquent\Model;


class ExtraModel
{
    protected $model;
    protected $exception;




    public function setModel(Model $model) {
        $this->model = $model;
    }
    public function getModel() {
        return $this->model;
    }
    public function setException($e) {
        $this->exception = $e;
    }

    public function recursiveModel($params) {
        $records = $this->model;
        foreach ($params as $col_name => $col_value)
        {
            $records = $records->where($col_name, $col_value);

        }
        return $records->get();

    }
    public function grabByParams($params) {
        $records = $this->recursiveModel($params);
        if(count($records) == 0) {
            throw $this->exception;
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
            throw $this->exception;
        }

        return $records->first()->toArray() ;
    }
    public function destroyByParams($params) {
        $records = $this->recursiveModel($params);
        if(count($records) == 0) {
            throw $this->exception;
        }
        foreach ($records as $record) {

            $record->destroy($record->id);
        }
    }

    public function createByParams($params) {
        $this->model->create($params);
    }



}



