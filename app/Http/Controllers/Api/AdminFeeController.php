<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminFees;
use App\Http\Resources\AdminFeeResource;

class AdminFeeController extends Controller
{
    public function getPresentase()
    {
        return AdminFeeResource::collection(AdminFees::all());
    }
}
