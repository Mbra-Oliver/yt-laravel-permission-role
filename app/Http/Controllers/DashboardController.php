<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $employes = Employe::all();
        $connectedUser =auth()->user();
        return view('admin.dashboard',compact('employes','connectedUser'));
    }

        public function handleLogout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


    public function manageData(Employe $employe){
dd($employe);
    }
}
