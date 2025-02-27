<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function addToFavorites(Request $request)
    {
        $favorites = session()->get('favorites', []);
        $id = $request->input('id');
        if (!in_array($id, $favorites)) {
            $favorites[] = $id;
        }

        session(['favorites' => $favorites]);
        return response()->json(['success' => true, 'favorites' => $favorites]);
    }

    public function viewFavorites()
    {
        $favorites = session()->get('favorites', []);
        return view('favorites', compact('favorites'));
    }
}
