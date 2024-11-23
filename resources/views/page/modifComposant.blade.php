@extends('principal_template.principal_template')
@section('css_form')
<link rel="stylesheet" href="{{ asset('assets/bundles/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}">
<link rel="stylesheet" href="{{asset('assets/css/components.css')}}">
@endsection

@section('title')
    Modifié composant
@endsection

@section('content')
<style>
    <style>
    .dropdown {
        position: relative;
        margin-bottom: 10px;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .options {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: white;
        z-index: 1000;
        display: none;
        max-height: 200px;
        overflow-y: auto;
    }

    .option {
        padding: 10px;
        cursor: pointer;
    }

    .option:hover {
        background-color: #f0f0f0;
    }

    .not-found {
        color: red;
        text-align: center;
        padding: 10px;
    }
</style>

</style>
<div class="col-12 col-md-12 col-lg-12">
    @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div><br />
@endif
    <div class="card">
      <div class="card-header">
        <h4>Modifier ce composent de repas repas </h4>
      </div>
      <div class="card-body">

        <img class="mr-3" src="{{ url('storage/' . $composant->image_composants) }}" alt="Generic placeholder image" width="50" height="50">
        <form action="{{ route('post_modif_photo_composant',['id'=> $composant->id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="element">Modifier image composant</label>
                <input type="file" class="form-control" name="image_composant" id="image" accept="image/png, image/jpeg">
            </div>
            <button type="submit" class="btn btn-warning m-t-15 waves-effect" id="ajouComposant">Modifier</button>
        </form>
        <br>
    <div style="display: flex">
        <button id="addSelectButton" class="btn btn-warning">Ajouter un compoasnt</button> &nbsp;
        <!--button id="addInputButton" class="btn btn-warning">Saisir un compoasnt</button-->
    </div>
    <br>

    <form action="{{ route('post_modif_composant',['id'=> $composant->id]) }}" method="POST" id="add_repas">
        @csrf

        <input type="text" value="{{ $composant->composant_repas }}" @readonly(true) >
        @foreach ($composant->elements as $element)

        <div class="form-group">
            <label>Select2</label>
            <select class="form-control select2"  name="select[]">
                <option selected  value="{{  $element->element_composant}}">{{  $element->element_composant}}</option>
            @foreach ($elements as $element)
                <option value="{{ $element->element_composant }}">{{ $element->element_composant }}</option>
            @endforeach
            </select>
          </div>

        @endforeach
        <div id="selectContainer" ></div>
          <input type="text" value="{{ $elements }}" id="elements" style="display: none">
        <br>
        <input type="submit" value="Enregistrer"  class="btn btn-warning" id="Modifier">
    </form>
        <script>
const addSelectButton = document.getElementById('addSelectButton');
const selectContainer = document.getElementById('selectContainer');

var valeurEnJavaScript = document.getElementById('elements');
    valeurEnJavaScript = JSON.parse(valeurEnJavaScript.value);
    //console.log(valeurEnJavaScript);
    var tableauCp = [];


    for(var i = 0; i < valeurEnJavaScript.length;i++){
            tableauCp.push(valeurEnJavaScript[i].element_composant);
    }


function createSelect(showRemoveButton = false) {
    const newSelectContainer = document.createElement('div');
    newSelectContainer.classList.add('dropdown');
    newSelectContainer.style.display = 'flex';

    const newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.placeholder = 'Rechercher...';
    newInput.name = 'repas[]';
    newInput.autocomplete = 'off';
    const space = document.createElement('span');
    newSelectContainer.appendChild(newInput);
    space.innerHTML = '&nbsp;'; // Ajoute un espace
    newSelectContainer.appendChild(space); //


    const optionsList = document.createElement('div');
    optionsList.classList.add('options');
    newSelectContainer.appendChild(optionsList);

    const options = tableauCp;

    options.forEach(optionText => {
        const option = document.createElement('div');
        option.classList.add('option');
        option.textContent = optionText;

        option.addEventListener('click', function() {
            newInput.value = optionText;
            optionsList.style.display = 'none';
        });

        optionsList.appendChild(option);
    });

    newInput.addEventListener('focus', function() {
        optionsList.style.display = 'block';
    });

    newInput.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const optionElements = optionsList.getElementsByClassName('option');
        let found = false;

        Array.from(optionElements).forEach(option => {
            const text = option.textContent.toLowerCase();
            option.style.display = text.includes(filter) ? '' : 'none';
            if (text.includes(filter)) found = true;
        });

        // Gérer l'affichage de l'élément "Pas trouvé"
        let notFoundElement = optionsList.querySelector('.not-found');
        if (!found && filter) {
            if (!notFoundElement) {
                notFoundElement = document.createElement('div');
                notFoundElement.classList.add('not-found', 'option');
                notFoundElement.textContent = 'Pas trouvé';
                optionsList.appendChild(notFoundElement);
            }
        } else {
            if (notFoundElement) notFoundElement.remove();
        }
    });

    document.addEventListener('click', function(event) {
        if (!newSelectContainer.contains(event.target)) {
            optionsList.style.display = 'none';
        }
    });

    // Ajouter un bouton pour retirer le select si demandé
    if (showRemoveButton) {
        const removeButton = document.createElement('button');

        removeButton.innerHTML = '<i class="far fa-times-circle"></i>';
        removeButton.className = "btn btn-danger"
        removeButton.addEventListener('click', function() {
            selectContainer.removeChild(newSelectContainer);
            selectContainer.removeChild(brElement); // Retirer le <br> associé

        });


        newSelectContainer.appendChild(removeButton);
    }

    // Créer un élément <br> pour l'espacement
    const brElement = document.createElement('br');
    selectContainer.appendChild(brElement);

    // Ajouter le select et le <br> au conteneur
    selectContainer.appendChild(newSelectContainer);
    selectContainer.appendChild(brElement);
}

// Créer un select par défaut au chargement sans bouton "Retirer"
//createSelect(false);

addSelectButton.addEventListener('click', () => createSelect(true));


const addInputButton = document.getElementById('addInputButton');
const inputContainer = document.getElementById('inputContainer');

function createInput(showRemoveButton = true) {
    const newInputContainer = document.createElement('div');
    newInputContainer.classList.add('input-group');

    const newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.placeholder = 'Entrez votre texte...';
    newInput.className = 'form-control';
    newInput.name = 'texte[]';
    newInput.autocomplete = 'off';

    const removeButton = showRemoveButton ? document.createElement('button') : null;
    if (removeButton) {
        removeButton.innerHTML = '<i class="far fa-times-circle"></i>';
        removeButton.className = "btn btn-danger"
        /*const newIcon = document.createElement('i');
        newIcon.className = "far fa-times-circle"
        newInputContainer.appendChild(removeButton);*/

        //removeButton.className = 'remove-button'; // Ajoutez une classe pour le style
        removeButton.addEventListener('click', function() {
            inputContainer.removeChild(newInputContainer);
            inputContainer.removeChild(brElement);
        });
    }
    const brElement = document.createElement('br');

    // Ajout des éléments dans le conteneur avec display flex
    newInputContainer.appendChild(newInput);
    if (removeButton) {
        const space = document.createElement('span');
        space.innerHTML = '&nbsp;'; // Ajoute un espace
        newInputContainer.appendChild(space);
        newInputContainer.appendChild(removeButton);
        newInputContainer.appendChild(brElement);
    }

    inputContainer.appendChild(newInputContainer);
    inputContainer.appendChild(brElement);
}

// Écouteur d'événements pour ajouter un input lorsqu'on clique sur le bouton
addInputButton.addEventListener('click', () => createInput(true));


// Add an event listener to the 'Enregistrer' button
document.getElementById('enregistrer').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission

    let repas = document.querySelectorAll('input[name="repas[]"]');
    let texte = document.querySelectorAll('input[name="texte[]"]');

    let repasValues = [];
    let invalidValues = [];
    let texteValues = [];

    repas.forEach(input => {
        const value = input.value.trim();
        if (value !== '') {
            const isValid = tableauCp.includes(value);
            if (isValid) {
                repasValues.push(value);
            } else {
                invalidValues.push(value);
            }
        }
    });

    texte.forEach(input => {
        const value = input.value.trim();
        texteValues.push(value);
    });

    /*if (repasValues.length > 0) {
        alert(`Valeurs valides: ${repasValues.join(', ')}, Valeurs input text: ${texteValues.join(', ')}`);
    }
    if (invalidValues.length > 0) {
        alert(`Erreur: ${invalidValues.join(', ')} n'est pas une option valide.`);
    }*/

    document.getElementById('add_repas').submit();
});

        </script>


<script>

</script>

      </div>
    </div>
  </div>
@endsection

@section('script_form')

<script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/bundles/select2/dist/css/select2.min.css') }}"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/page/forms-advanced-forms.js') }}"></script>
@endsection
