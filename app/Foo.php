<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 03/12/15
 * Time: 03:51 ص
 */

namespace App;

class Bar {
    public function bar() {
        return 'Bar';
    }
}
class Foo
{
    public function quack(Bar $bar) {
        return 'Quack ' . $bar->bar();
    }

}