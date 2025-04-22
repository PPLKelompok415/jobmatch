<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyHomeController extends Controller
{
    public function index()
    {
        return view('CompanyHome'); // Mengarahkan ke view home.blade.php
    }
}
