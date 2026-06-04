<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\Employe;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CongeController extends Controller
{
    /**
     * Liste des congés
     */
    public function index()
    {
        $conges = Conge::with('employe')->get();

        return view('conges.index', compact('conges'));
    }

    /**
     * Formulaire création
     */
    public function create()
    {
        $employes = Employe::all();

        return view('conges.create', compact('employes'));
    }

    /**
     * Enregistrer congé
     */
    public function store(Request $request)
    {
        $request->validate([
            'employe_id' => 'required|exists:employes,id',
            'type' => 'required',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'motif' => 'nullable|string',
        ]);

        Conge::create([
            'employe_id' => $request->employe_id,
            'type' => $request->type,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'motif' => $request->motif,
            'statut' => 'En attente',
        ]);

        return redirect()->route('conges.index')
            ->with('success', 'Demande de congé enregistrée');
    }

    /**
     * Afficher un congé
     */
    public function show(Conge $conge)
    {
        return view('conges.show', compact('conge'));
    }

    /**
     * Modifier congé
     */
    public function edit(Conge $conge)
    {
        $employes = Employe::all();

        return view('conges.edit', compact('conge', 'employes'));
    }

    /**
     * Mettre à jour congé
     */
    public function update(Request $request, Conge $conge)
    {
        $request->validate([
            'employe_id' => 'required|exists:employes,id',
            'type' => 'required',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'motif' => 'nullable|string',
            'statut' => 'required',
        ]);

        $conge->update([
            'employe_id' => $request->employe_id,
            'type' => $request->type,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'motif' => $request->motif,
            'statut' => $request->statut,
        ]);

        return redirect()->route('conges.index')
            ->with('success', 'Congé mis à jour');
    }

    /**
     * Supprimer congé
     */
    public function destroy(Conge $conge)
    {
        $conge->delete();

        return redirect()->route('conges.index')
            ->with('success', 'Congé supprimé');
    }

    /**
     * Approuver congé + déduction solde automatique
     */
    public function approuver(Conge $conge)
    {
        $jours = Carbon::parse($conge->date_debut)
            ->diffInDays(Carbon::parse($conge->date_fin)) + 1;

        $employe = $conge->employe;

        // éviter double déduction
        if ($conge->statut !== 'Approuvé') {

            if ($employe->solde_conges < $jours) {
                return redirect()->route('conges.index')
                    ->with('error', 'Solde de congés insuffisant');
            }

            $employe->update([
                'solde_conges' => $employe->solde_conges - $jours
            ]);
        }

        $conge->update([
            'statut' => 'Approuvé'
        ]);

        return redirect()->route('conges.index')
            ->with('success', 'Congé approuvé avec succès');
    }

    /**
     * Refuser congé
     */
    public function refuser(Conge $conge)
    {
        $conge->update([
            'statut' => 'Refusé'
        ]);

        return redirect()->route('conges.index')
            ->with('success', 'Congé refusé');
    }
}