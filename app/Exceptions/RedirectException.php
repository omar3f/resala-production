<?php

namespace App\Exceptions;

class RedirectException extends \Exception {

    protected $controller;


    public function setController($controller) {
        $this->controller = $controller;
    }
    public function controller() {
        return $this->controller;
    }
}
