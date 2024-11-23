@extends('principal_template.principal_template')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('title')
    Ajoute élement repas
@endsection

@section('content')
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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Element</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($elements as $element)
                                    <tr>
                                        <td>{{ $element->element_composant }}</td>
                                        <td>
                                            <a class="btn btn-success edit-btn" title="Modifier" data-toggle="modal" data-target="#editModal"
                                                data-id="{{ $element->id }}"
                                                data-element="{{ $element->element_composant }}">
                                                <i class="far fa-arrow-alt-circle-up text-white"></i>
                                            </a>
                                            &nbsp;
                                            <a href="{{ route('delete_element',['id'=> $element->id ])}}" class="btn btn-danger delete-confirm" title="Supprimer">
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
                <h5 class="modal-title" id="formModal">Ajouter élément</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('form_element_post') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="element">Element</label>
                        <input type="text" class="form-control" name="element" id="element">
                    </div>
                    <button type="submit" class="btn btn-warning m-t-15 waves-effect">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Script -->


@endsection

@section('scripts')
<script>

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
