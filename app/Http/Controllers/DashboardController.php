<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard'); // Assurez-vous de créer une vue `dashboard.blade.php`
    }
}