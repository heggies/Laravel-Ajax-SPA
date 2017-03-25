<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MyController;

class AjaxRouteController extends Controller
{
    public function route($view, $data = null)
    {
      if (view()->exists($view)) {
        $response['success'] = 1;
        $response['html'] = view($view)->with($data)->render();
      }
      else {
        $response['success'] = 0;
        $response['message'] = "not found";
      }
      return $response;
    }
}
