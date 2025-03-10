<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all(); // Obtiene todas las categorías
        return view('home', compact('categorias'));
    }
}
