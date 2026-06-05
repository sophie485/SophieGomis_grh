<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Employe;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContratController extends Controller
{
    /**
     * Liste des contrats
     */
    public function index()
    {
        $contrats = Contrat::with('employe')->get();

        $alertes = Contrat::with('employe')
            ->whereNotNull('date_fin')
            ->whereDate('date_fin', '>=', Carbon::today())
            ->whereDate('date_fin', '<=', Carbon::today()->addDays(30))
            ->get();

        return view('contrats.index', compact('contrats', 'alertes'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        $employes = Employe::all();

        return view('contrats.create', compact('employes'));
    }

    /**
     * Enregistrement
     */
    public function store(Request $request)
    {
        $request->validate([
            'employe_id' => 'required|exists:employes,id',
            'type' => 'required|in:CDI,CDD,Stage,Freelance',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'salaire' => 'nullable|numeric|min:0',
        ]);

        if ($request->type !== 'CDI' && empty($request->date_fin)) {
            return back()
                ->withErrors([
                    'date_fin' => 'La date de fin est obligatoire pour ce type de contrat.'
                ])
                ->withInput();
        }

        Contrat::create([
            'employe_id' => $request->employe_id,
            'type' => $request->type,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->type === 'CDI' ? null : $request->date_fin,
            'salaire' => $request->salaire,
            'statut' => 'Actif',
        ]);

        return redirect()
            ->route('contrats.index')
            ->with('success', 'Contrat ajouté avec succès.');
    }

    /**
     * Affichage d'un contrat
     */
    public function show(Contrat $contrat)
    {
        return view('contrats.show', compact('contrat'));
    }

    /**
     * Formulaire modification
     */
    public function edit(Contrat $contrat)
    {
        $employes = Employe::all();

        return view('contrats.edit', compact('contrat', 'employes'));
    }

    /**
     * Mise à jour
     */
    public function update(Request $request, Contrat $contrat)
    {
        $request->validate([
            'employe_id' => 'required|exists:employes,id',
            'type' => 'required|in:CDI,CDD,Stage,Freelance',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'salaire' => 'nullable|numeric|min:0',
            'statut' => 'required',
        ]);

        if ($request->type !== 'CDI' && empty($request->date_fin)) {
            return back()
                ->withErrors([
                    'date_fin' => 'La date de fin est obligatoire pour ce type de contrat.'
                ])
                ->withInput();
        }

        $contrat->update([
            'employe_id' => $request->employe_id,
            'type' => $request->type,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->type === 'CDI' ? null : $request->date_fin,
            'salaire' => $request->salaire,
            'statut' => $request->statut,
        ]);

        return redirect()
            ->route('contrats.index')
            ->with('success', 'Contrat modifié avec succès.');
    }

    /**
     * Suppression
     */
    public function destroy(Contrat $contrat)
    {
        $contrat->delete();

        return redirect()
            ->route('contrats.index')
            ->with('success', 'Contrat supprimé avec succès.');
    }
}