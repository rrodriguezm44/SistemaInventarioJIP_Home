<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    public function index()
    {
        $lotes = Lote::with('producto')->get();
        return view('admin.lotes.index', compact('lotes'));
        //return view('admin.lotes.index',compact('lotes'));
    }
}
