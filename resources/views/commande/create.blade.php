@extends('layout')

@section('content')
<style>
    /* Style message d'erreur waouh */
    #errorOrdonnance {
        background-color: #f8d7da; /* rouge clair */
        border: 1.5px solid #f44336; /* rouge vif */
        color: #b71c1c; /* texte rouge foncé */
        padding: 8px 12px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.9rem;
        margin-top: 6px;
        box-shadow: 0 0 6px rgba(244, 67, 54, 0.5);
        transition: opacity 0.3s ease-in-out;
    }

    /* Input ordonnance en erreur */
    input.form-control.error {
        border-color: #f44336 !important;
        box-shadow: 0 0 8px #f44336;
        transition: box-shadow 0.3s ease-in-out;
    }

    /* Transition légère sur les inputs */
    input.form-control, select.form-select {
        transition: border-color 0.25s ease, box-shadow 0.25s ease;
    }

    /* Label dynamique */
    .form-label {
        font-weight: 600;
        color: #333;
    }

    /* Bouton */
    button.btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 22px;
        font-size: 1.1rem;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    button.btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<div class="container mt-4">
    <h2>Passer une Commande</h2>

    <form id="commandeForm" action="{{ route('commandes.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="mb-3">
            <label for="produit_id" class="form-label">Produit</label>
            <select name="produit_id" id="produit_id" class="form-select" required>
                <option value="">-- Choisir un produit --</option>
                @foreach($produits as $produit)
                    <option 
                        value="{{ $produit->id }}" 
                        data-ordonnance_obligatoire="{{ $produit->ordonnance_obligatoire ? '1' : '0' }}"
                        data-prix="{{ $produit->prix }}"
                        {{ old('produit_id') == $produit->id ? 'selected' : '' }}
                    >
                        {{ $produit->nom }} ({{ number_format($produit->prix, 0, ',', ' ') }} FCFA)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control" min="1" value="{{ old('quantite') }}" required>
        </div>

        <div class="mb-3">
            <label for="prix_total" class="form-label">Prix total (FCFA)</label>
            <input type="text" id="prix_total" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label for="ordonnance_pdf" class="form-label">Ordonnance (PDF)</label>
            <input 
                type="file" 
                name="ordonnance_pdf" 
                id="ordonnance_pdf" 
                class="form-control" 
                accept="application/pdf"
                disabled
            >
            <small class="text-muted" id="ordonnanceHelp">Ce champ est requis uniquement pour les produits soumis à ordonnance.</small>
            <div id="errorOrdonnance" class="text-danger mt-1" style="display:none;"></div>
        </div>

        <button type="submit" class="btn btn-primary">Commander</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const produitSelect = document.getElementById('produit_id');
    const quantiteInput = document.getElementById('quantite');
    const prixTotalInput = document.getElementById('prix_total');
    const ordonnanceInput = document.getElementById('ordonnance_pdf');
    const ordonnanceHelp = document.getElementById('ordonnanceHelp');
    const errorOrdonnance = document.getElementById('errorOrdonnance');
    const form = document.getElementById('commandeForm');

    function toggleOrdonnanceField() {
        const selectedOption = produitSelect.options[produitSelect.selectedIndex];
        const ordonnanceObligatoire = selectedOption ? selectedOption.getAttribute('data-ordonnance_obligatoire') : '0';

        if (ordonnanceObligatoire === '1') {
            ordonnanceInput.disabled = false;
            ordonnanceHelp.textContent = "Ce produit nécessite une ordonnance. Veuillez joindre un fichier PDF.";
            ordonnanceHelp.style.color = "red";
        } else {
            ordonnanceInput.disabled = true;
            ordonnanceInput.value = null; // reset file input
            ordonnanceHelp.textContent = "Ce produit ne nécessite pas d'ordonnance.";
            ordonnanceHelp.style.color = "green";
            errorOrdonnance.style.display = 'none';
            errorOrdonnance.textContent = '';
            ordonnanceInput.classList.remove('error');
        }
    }

    function updatePrixTotal() {
        const selectedOption = produitSelect.options[produitSelect.selectedIndex];
        if (!selectedOption) {
            prixTotalInput.value = '';
            return;
        }

        const prixUnitaire = parseFloat(selectedOption.getAttribute('data-prix'));
        const quantite = parseInt(quantiteInput.value) || 0;

        if (!isNaN(prixUnitaire) && quantite > 0) {
            const total = prixUnitaire * quantite;
            prixTotalInput.value = total.toLocaleString('fr-FR') + ' FCFA';
        } else {
            prixTotalInput.value = '';
        }
    }

    form.addEventListener('submit', function(event) {
        const selectedOption = produitSelect.options[produitSelect.selectedIndex];
        if (!selectedOption) {
            errorOrdonnance.style.display = 'block';
            errorOrdonnance.textContent = "Veuillez sélectionner un produit.";
            event.preventDefault();
            return;
        }

        const ordonnanceObligatoire = selectedOption.getAttribute('data-ordonnance_obligatoire') === '1';
        const fichierOrdonnancePresent = ordonnanceInput.files.length > 0;

        if (ordonnanceObligatoire && !fichierOrdonnancePresent) {
            event.preventDefault();
            errorOrdonnance.style.display = 'block';
            errorOrdonnance.textContent = "Ce produit nécessite une ordonnance. Veuillez joindre un fichier PDF pour continuer.";
            ordonnanceInput.classList.add('error');
            ordonnanceInput.focus();
        } else {
            errorOrdonnance.style.display = 'none';
            errorOrdonnance.textContent = '';
            ordonnanceInput.classList.remove('error');
        }
    });

    produitSelect.addEventListener('change', () => {
        toggleOrdonnanceField();
        updatePrixTotal();
        errorOrdonnance.style.display = 'none';
        errorOrdonnance.textContent = '';
        ordonnanceInput.classList.remove('error');
    });

    quantiteInput.addEventListener('input', updatePrixTotal);

    // Initial call
    toggleOrdonnanceField();
    updatePrixTotal();
});
</script>
@endsection
