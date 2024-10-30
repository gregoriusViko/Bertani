<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function profile(){
        return view('profile');
    }

    function soba() {
        return view('soba');
    }

    function aoka() {
        return view('aoka');
    }
}
