<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Departement;

class EmployeController extends Controller
{
    /**
     * LISTE
     */
    public function index()
    {
        $employes = Employe::with('departement')->get();

        return view('employes.index', compact('employes'));
    }

    /**
     * CREATE FORM
     */
    public function create()
    {
        $departements = Departement::all();

        return view('employes.create', compact('departements'));
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'            => 'required|string|max:255',
            'prenom'         => 'required|string|max:255',
            'email'          => 'required|email|unique:employes,email',
            'telephone'      => 'required|digits:9',
            'poste'          => 'required|string|max:255',
            'departement_id' => 'required|exists:departements,id',
            'date_embauche'  => 'required|date',
            'salaire'        => 'required|numeric',

            'photo'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'documents.*'    => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120',
        ]);

        // PHOTO
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        // DOCUMENTS
        $documentsPaths = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $documentsPaths[] = $file->store('documents', 'public');
            }
        }

        // CREATE EMPLOYÉ
        $employe = Employe::create([
            'nom'            => $request->nom,
            'prenom'         => $request->prenom,
            'email'          => $request->email,
            'telephone'      => $request->telephone,
            'poste'          => $request->poste,
            'departement_id' => $request->departement_id,
            'date_embauche'  => $request->date_embauche,
            'salaire'        => $request->salaire,

            'photo'          => $photoPath,
            'documents'      => json_encode($documentsPaths),
        ]);

        // HISTORIQUE INITIAL
        $employe->historiquePostes()->create([
            'poste' => $request->poste,
            'date_debut' => now(),
        ]);

        return redirect()->route('employes.index')
            ->with('success', 'Employé ajouté avec succès');
    }

    /**
     * SHOW (DÉTAIL + HISTORIQUE)
     */
    public function show(Employe $employe)
    {
        $employe->load('departement', 'historiquePostes');

        return view('employes.show', compact('employe'));
    }

    /**
     * EDIT
     */
    public function edit(string $id)
    {
        $employe = Employe::findOrFail($id);
        $departements = Departement::all();

        return view('employes.edit', compact('employe', 'departements'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, string $id)
    {
        $employe = Employe::findOrFail($id);

        $request->validate([
            'nom'            => 'required|string|max:255',
            'prenom'         => 'required|string|max:255',
            'email'          => 'required|email|unique:employes,email,' . $id,
            'telephone'      => 'required|digits:9',
            'poste'          => 'required|string|max:255',
            'departement_id' => 'required|exists:departements,id',
            'date_embauche'  => 'required|date',
            'salaire'        => 'required|numeric',

            'photo'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'documents.*'    => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120',
        ]);

        // PHOTO
        if ($request->hasFile('photo')) {
            $employe->photo = $request->file('photo')->store('photos', 'public');
        }

        // DOCUMENTS
        $documents = json_decode($employe->documents ?? '[]');

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $documents[] = $file->store('documents', 'public');
            }
        }

        // HISTORIQUE POSTE (changement)
        if ($employe->poste !== $request->poste) {

            $last = $employe->historiquePostes()
                ->whereNull('date_fin')
                ->latest()
                ->first();

            if ($last) {
                $last->update([
                    'date_fin' => now()
                ]);
            }

            $employe->historiquePostes()->create([
                'poste' => $request->poste,
                'date_debut' => now(),
            ]);
        }

        // UPDATE DATA
        $employe->update([
            'nom'            => $request->nom,
            'prenom'         => $request->prenom,
            'email'          => $request->email,
            'telephone'      => $request->telephone,
            'poste'          => $request->poste,
            'departement_id' => $request->departement_id,
            'date_embauche'  => $request->date_embauche,
            'salaire'        => $request->salaire,
            'documents'      => json_encode($documents),
        ]);

        return redirect()->route('employes.index')
            ->with('success', 'Employé modifié avec succès');
    }

    /**
     * DELETE
     */
    public function destroy(string $id)
    {
        $employe = Employe::findOrFail($id);
        $employe->delete();

        return redirect()->route('employes.index')
            ->with('success', 'Employé supprimé avec succès');
    }
}