<?php

namespace App\Http\Controllers;

use App\Reference;
use Illuminate\Http\Request;

class ReferencesController extends Controller
{
    public function index()
    {
        $references = Reference::all();

        return view('references.index', compact('references'));
    }

    public function show(Reference $reference)
    {
        return view('references.show', compact('reference'));
    }

    public function store()
    {
        $attributes = request()->validate([
            'term' => 'required',
            'slug' => 'required',
            'type' => 'required|in:ID,PV,SL,SY'
        ]);

        Reference::create($attributes);

        return redirect('/references');
    }
}
