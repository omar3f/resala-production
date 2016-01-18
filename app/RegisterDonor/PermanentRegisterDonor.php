<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 01/12/15
 * Time: 08:35 م
 */

namespace App\RegisterDonor;
use App\RegisterDonor;


class PermanentRegisterDonor implements RegisterDonorInterface
{
public function register($request)
{
    // TODO: Implement register() method.
    \App\Donor::create($request->all());
}
}