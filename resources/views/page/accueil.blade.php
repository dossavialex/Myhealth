@extends('principal_template.principal_template')
@section('css_form')
<link rel="stylesheet" href="{{ asset('assets/bundles/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}">
<link rel="stylesheet" href="{{asset('assets/css/components.css')}}">
@endsection

@section('title')
    Accueil
@endsection

@section('content')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Liste des éléments</h4>
                <div class="card-header-action">
                    <a href="{{ route('form_view') }}" class="btn btn-warning" >
                        <i class="fas fa-plus"></i> Ajouter repas
                      </a>
                </div>
            </div>
            @php
                $n = 1;
            @endphp
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Date repas</th>
                                <th>Nombre de repas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($repasLimite as $key=>$repas)
                            <tr>
                                <td>{{ $n }}</td>
                                <td>{{ $key }}</td>
                                <td>{{ $repas }}</td>

                                <td>
                                    <a class="btn btn-warning edit-btn" title="Voir"  href="{{ route('detailRepasday',['date'=> $key ])}}" >
                                        <i class="far fa-eye text-white"></i>
                                    </a>
                                </td>
                            </tr>
                            @php
                                $n++
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('script_form')
    <script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
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
