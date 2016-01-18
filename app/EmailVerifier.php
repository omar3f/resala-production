<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 03/12/15
 * Time: 04:05 ص
 */

namespace App;


use \App\Exceptions\RedirectException;
use Illuminate\Database\Eloquent\Model;

class EmailVerifier
{
    protected $oldModel;
    protected $newModel;
    public function setModels(\App\ModelExtension\ExtraModel $oldModel, \App\ModelExtension\ExtraModel $newModel) {
        $this->oldModel = $oldModel;
        $this->newModel = $newModel;
    }
    public function destroyOldRecord($identifiers) {
        $this->oldModel->destroyByParams($identifiers);
    }

    public function createNewRecord($identifiers) {
        $this->newModel->create($identifiers);
    }

}