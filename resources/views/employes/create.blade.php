<form action="{{ route('employes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="nom" placeholder="Nom" required>

    <input type="text" name="prenom" placeholder="Prénom" required>

    <input type="email" name="email" placeholder="Email" required>

    <input type="text" name="telephone" placeholder="Téléphone (9 chiffres)" required maxlength="9" pattern="[0-9]{9}">

    <input type="text" name="poste" placeholder="Poste" required>

    <input type="file" name="photo" accept="image/*">

    <input type="file" name="documents[]" multiple>

    <select name="departement_id" required>
        <option value="">Choisir un département</option>

        @foreach($departements as $departement)
            <option value="{{ $departement->id }}">
                {{ $departement->nom }}
            </option>
        @endforeach
    </select>

    <input type="date" name="date_embauche" required>

    <input type="number" step="0.01" name="salaire" placeholder="Salaire" required>

    <!-- AJOUT PHOTO -->
    <input type="file" name="photo">

    <button type="submit">Enregistrer</button>
</form>