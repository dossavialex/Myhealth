@extends('principal_template.principal_template')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('title')
    Ajout composant repas
@endsection

@section('content')
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
<!-- Main Content -->
<section class="section">
    <div class="section-body">
        <!-- Error Message -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif

        <!-- Table with List of Elements -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Liste des éléments</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addElementModal">
                                Ajouter
                            </a>
                        </div>
                    </div>
                    <input type="text" value="{{ $elements }}" id="elements" style="display: none">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Composant</th>
                                        <th>Elements</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($composants as $composant)
                                    <tr>
                                        <td>{{ $composant->composant_repas }}</td>
                                        <td>
                                            @foreach ($composant->elements as $element)
                                                    {{ $element->element_composant }} ,
                                            @endforeach
                                        </td>
                                        <td>
                                            <img alt="image" src="{{ url('storage/' . $composant->image_composants) }}" width="35">
                                        </td>
                                        <td>
                                            <a class="btn btn-success edit-btn" title="Modifier"  href="{{ route('modif_composant',['id'=> $composant->id ]) }}">
                                                <i class="far fa-arrow-alt-circle-up text-white"></i>
                                            </a>
                                            &nbsp;
                                            <a href="{{ route('delete_composant',['id'=> $composant->id ])}}" class="btn btn-danger delete-confirm" title="Supprimer">
                                                <i class="fas fa-trash-alt text-white"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal pour modifier un élément -->
<div class="modal fade" id="{{ 'editModal' }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Modifier un élément</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form  method="post" action="{{ route('form_element_modif_post') }}" id="editForm">
            @csrf
            <input type="hidden" name="id" id="elementId"> <!-- champ caché pour l'ID -->
            <div class="form-group">
              <label for="elementName">Element</label>
              <input type="text" class="form-control" id="elementName" name="element">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-warning">Modifier</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Add Element Modal -->
<div class="modal fade" id="addElementModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Ajouter composant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('post_ajout_composant') }}" method="post" id="composant"  enctype="multipart/form-data">
                    @csrf
                    <button id="addSelectButton" class="btn btn-warning">Ajouter pour choisir un élément</button>
                    <div class="form-group">
                        <label for="element">Composant</label>
                        <input type="text" class="form-control" name="composant" id="element">
                    </div>
                    <div class="form-group">
                        <label for="element">Image composant</label>
                        <input type="file" class="form-control" name="image_composant" id="image" accept="image/png, image/jpeg">
                    </div>
                    <br>
                    <div id="selectContainer" ></div>
                    <button type="submit" class="btn btn-warning m-t-15 waves-effect" id="ajouComposant">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Script -->


@endsection

@section('scripts')
<script>
    const addSelectButton = document.getElementById('addSelectButton');
const selectContainer = document.getElementById('selectContainer');

var valeurEnJavaScript = document.getElementById('elements');
    valeurEnJavaScript = JSON.parse(valeurEnJavaScript.value);
    var tableauEl = [];


    for(var i = 0; i < valeurEnJavaScript.length;i++){
            tableauEl.push(valeurEnJavaScript[i].element_composant);
    }

function createSelect(showRemoveButton = false) {
    const newSelectContainer = document.createElement('div');
    newSelectContainer.classList.add('dropdown');
    newSelectContainer.style.display = 'flex';

    const newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.placeholder = 'Choisir élément';
    newInput.name = 'element[]';
    newInput.autocomplete = 'off';
    const space = document.createElement('span');
    newSelectContainer.appendChild(newInput);
    space.innerHTML = '&nbsp;'; // Ajoute un espace
    newSelectContainer.appendChild(space); //


    const optionsList = document.createElement('div');
    optionsList.classList.add('options');
    newSelectContainer.appendChild(optionsList);

    const options = tableauEl;

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
createSelect(false);

addSelectButton.addEventListener('click',function(event) {
    event.preventDefault();
    createSelect(true)
});


document.getElementById('ajouComposant').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission

    let element = document.querySelectorAll('input[name="element[]"]');
    console.log(element);

    let elementValues = [];
    let invalidValues = [];
    let texteValues = [];

    element.forEach(input => {
        const value = input.value.trim();
        if (value !== '') {
            const isValid = tableauEl.includes(value);
            if (isValid) {
                elementValues.push(value);
            } else {
                invalidValues.push(value);
            }
        }
    });

    /*texte.forEach(input => {
        const value = input.value.trim();
        texteValues.push(value);
    });*/
    console.log(elementValues.length);
    if (elementValues.length == 0) {
        alert(`Vous n'avez choisi aucun élément`);
    }else{
        document.getElementById('composant').submit();
    }

});

        $(document).ready(function() {
            // Quand le bouton "Modifier" est cliqué
            $('.edit-btn').on('click', function() {
                // Récupérer les données de l'élément depuis les attributs data
                var id = $(this).data('id');
                var element = $(this).data('element');

                // Remplir les champs du formulaire dans le modal
                $('#elementId').val(id);
                $('#elementName').val(element);
            });
        });

    $('.delete-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Voulez-vous vraiment supprimer cet élément?',
            text: 'Toutes les informations relatives à cet élément seront perdues.',
            icon: 'warning',
            buttons: ["Annuler", "Oui!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
</script>
<script src="{{ asset('assets/bundles/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/buttons.flash.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/jszip.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/js/page/datatables.js')}}"></script>
<script src="{{ asset('assets/bundles/prism/prism.js') }}"></script>
@endsection
