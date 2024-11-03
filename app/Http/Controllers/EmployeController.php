<?php

namespace App\Http\Controllers;

use App\Models\Employe; // Assurez-vous que le modèle est importé si nécessaire
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = Employe::all();
        return view('employes.index', compact('employes'));
    }
}