<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\PackageUserService;


class PackageUserController extends Controller
{


    protected $service;

    public function __construct(PackageUserService $service){
        $this->service = $service;
    }



}
