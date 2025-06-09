<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Pharmaciens;
use Illuminate\View\View;

class PharmaciensController extends Controller
{
    public function index(): View
    {
        $pharmaciens = Pharmaciens::all();
        return view ('pharmaciens.index')->with('pharmaciens', $pharmaciens);
    }

    public function create(): View
    {
        return view('pharmaciens.create');
    }

    // Exemple dans PharmaciensController
public function store(Request $request)
{
    $request->validate([
    'nom' => 'required|string|max:255',
    'prenom' => 'required|string|max:255',
    'genre' => 'required|string|max:10',
    'poste' => 'required|string|max:255',
    ]);


    Pharmaciens::create($request->all());

    return redirect()->route('pharmaciens.index')->with('success', 'pharmacien ajouté avec succès.');
}

    public function show(string $id): View  
    {
        $pharmaciens= Pharmaciens::find($id);
        return view('pharmaciens.show')->with('pharmaciens', $pharmaciens);
    }

     public function edit(string $id): View  
    {
        $pharmaciens= Pharmaciens::find($id);
        return view('pharmaciens.edit')->with('pharmaciens', $pharmaciens);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $pharmaciens = Pharmaciens::find($id);
        $input = $request->all();
        $pharmaciens->update($input);
        return redirect('pharmaciens')->with('flash_message', 'pharmaciens modifie');
    }

    public function destroy(string $id): RedirectResponse
    {
        pharmaciens::destroy($id);
        return redirect('pharmaciens')->with('flash_message', 'Ce pharmaciens a ete supprimer avec succes');
    }

}
