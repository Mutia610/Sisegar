<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Resources\SliderResource;

class SliderController extends Controller
{
    public function slider()
    {
        return  SliderResource::collection(Slider::all());
    }
}
