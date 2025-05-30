<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Clients;
use Illuminate\View\View;

class ClientsController extends Controller
{
    public function index(): View
    {
        $clients = Clients::all();
        return view ('clients.index')->with('clients', $clients);
    }

    public function create(): View
    {
        return view('clients.create');
    }

    // Exemple dans clientsController
public function store(Request $request)
{
    $request->validate([
    'nom' => 'required|string|max:255',
    'prenom' => 'required|string|max:255',
    'numero' => 'required|integer|min:0',
    'profession' => 'required|string|max:255',
    
]);


    Clients::create($request->all());


    return redirect()->route('clients.index')->with('success', 'client ajouté avec succès.');
}

    public function show(string $id): View  
    {
        $clients= clients::find($id);
        return view('clients.show')->with('clients', $clients);
    }

     public function edit(string $id): View  
    {
        $clients= clients::find($id);
        return view('clients.edit')->with('clients', $clients);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $clients = clients::find($id);
        $input = $request->all();
        $clients->update($input);
        return redirect('clients')->with('flash_message', 'clients modifie');
    }

    public function destroy(string $id): RedirectResponse
    {
        clients::destroy($id);
        return redirect('clients')->with('flash_message', 'Ce client a ete supprimer avec succes');
    }

}
