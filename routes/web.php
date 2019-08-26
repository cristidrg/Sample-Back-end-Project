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

Route::get('/', 'Controller@home');
Route::get('/org/1', function () {
    return redirect('/');
});
Route::get('/org/{org}', 'OrgController@show');
Route::get('/prop/{prop}', 'PropController@show');



Route::any('/search',function() {
    $q = Input::get( 'search_title' );
    
    $monitor_up = Input::get('monitor_up');
    $monitor_down = Input::get('monitor_down');

    $a11y_green = Input::get('a11y_green');
    $a11y_yellow = Input::get('a11y_yellow');
    $a11y_red = Input::get('a11y_yellow');

    $seo_green = Input::get('seo_green');
    $seo_yellow = Input::get('seo_yellow');
    $seo_red = Input::get('seo_red');

    $perf_green = Input::get('perf_green');
    $perf_yellow = Input::get('perf_yellow');
    $perf_red = Input::get('perf_red');

    $propResults = collect(new Prop);;
    $orgResults = collect(new Org);;

    if ($q != "" ) {
        $propResults = Prop::where('title', 'LIKE', '%'.$q.'%')->get();
        $orgResults = Org::where('title', 'LIKE', '%'.$q.'%')->get();
    }

    if ($a11y_green) {
        $propResults = $propResults->merge(Prop::whereBetween('a11yScore', [0.9, 1])->get());
    }

    if ($a11y_yellow) {
        $propResults = $propResults->merge(Prop::whereBetween('a11yScore', [0.5, 0.89])->get());
    }

    if ($a11y_red) {
        $propResults = $propResults->merge(Prop::whereBetween('a11yScore', [0, 0.49])->get());
    }

    if ($seo_green) {
        $propResults = $propResults->merge(Prop::whereBetween('seoScore', [0.9, 1])->get());
    }

    if ($seo_yellow) {
        $propResults = $propResults->merge(Prop::whereBetween('seoScore', [0.5, 0.89])->get());
    }

    if ($seo_red) {
        $propResults = $propResults->merge(Prop::whereBetween('seoScore', [0, 0.49])->get());
    }

    if ($perf_green) {
        $propResults = $propResults->merge(Prop::whereBetween('perfScore', [0.9, 1])->get());
    }

    if ($perf_yellow) {
        $propResults = $propResults->merge(Prop::whereBetween('perfScore', [0.5, 0.89])->get());
    }

    if ($perf_red) {
        $propResults = $propResults->merge(Prop::whereBetween('perfScore', [0, 0.49])->get());
    }

    $allProps = Prop::all();

    if ($monitor_up) {
        foreach ($allProps as $prop) {
            if ($prop->monitor->uptime_status == 'up') {
                $propResults = $propResults->push($prop);
            }
        }
    }

    if ($monitor_down) {
        foreach ($allProps as $prop) {
            if ($prop->monitor->uptime_status == 'down') {
                $propResults = $propResults->push($prop);
            }
        }
    }


    return view('search', [
        'orgResults' => $orgResults,
        'propResults' => $propResults,
        'q' => $q
    ]);
});
