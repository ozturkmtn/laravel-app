<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;

class HelloController extends Controller
{
    public function index(Route $route)
    {

        if (!empty($redirect)) {
            return Redirect::route('mello');
        }

        return view('hello.index');
    }

    public function mello()
    {
        return Redirect::route('foo');
        echo 'MELLO';die();
    }

    public function boo()
    {
        return Redirect::route('foo');
        echo 'boo';die();
    }

    public function foo()
    {
        echo 'foo';die();
    }

/*

*/



}
