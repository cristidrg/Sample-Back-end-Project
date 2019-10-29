<?php

use App\Prop;
use App\Org;

use Illuminate\Support\Facades\Input;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/org/1');
});
Route::resource('org', 'OrgController');
Route::resource('user', 'UserController');
Route::resource('prop', 'PropController');
Route::resource('technology', 'TechnologyController');

Route::any('/search',function() {
    $q = Input::get( 'search_title' );
    $monitor = Input::get('monitor');
    $a11y = Input::get('a11y');
    $perf = Input::get('perf');
    $seo = Input::get('seo');

    $propResults = collect([]);;

    if ($q != "") {
        $propResults = Prop::where('title', 'LIKE', '%'.$q.'%')->get();
    }

    if ($a11y != null) {
        if ($a11y == "green") {
            $propResults = $propResults->merge(Prop::whereBetween('a11yScore', [0.9, 1])->get());
        } else if ($a11y == "yellow") {
            $propResults = $propResults->merge(Prop::whereBetween('a11yScore', [0.5, 0.89])->get());
        } else if ($a11y == "red") {
            $propResults = $propResults->merge(Prop::whereBetween('a11yScore', [0, 0.49])->get());
        }
    }

    if ($seo != null) {
        if ($seo == "green") {
            $propResults = $propResults->merge(Prop::whereBetween('seoScore', [0.9, 1])->get());
        } else if ($seo == "yellow") {
            $propResults = $propResults->merge(Prop::whereBetween('seoScore', [0.5, 0.89])->get());
        } else if ($seo == "red") {
            $propResults = $propResults->merge(Prop::whereBetween('seoScore', [0, 0.49])->get());
        }
    }

    if ($perf != null) {
        if ($perf == "green") {
            $propResults = $propResults->merge(Prop::whereBetween('perfScore', [0.9, 1])->get());
        } else if ($perf == "yellow") {
            $propResults = $propResults->merge(Prop::whereBetween('perfScore', [0.5, 0.89])->get());
        } else if ($perf == "red") {
            $propResults = $propResults->merge(Prop::whereBetween('perfScore', [0, 0.49])->get());
        }
    }

    $allProps = Prop::all();

    if ($monitor != null) {
        foreach ($allProps as $prop) {
            if ($prop->monitor->uptime_status == $monitor) {
                $propResults = $propResults->push($prop);
            }
        }
    }

    return view('search', [
        'propResults' => $propResults,
        'monitor' => $monitor,
        'perf' => $perf,
        'a11y' => $a11y,
        'seo' => $seo,
        'q' => $q,
    ]);
});
