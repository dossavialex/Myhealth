@extends('principal_template.principal_template')
@section('title')
    Deatil repas
@endsection
@section('content')

<div class="row">


    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-warning">
          <div class="card-body">
                <div class="search-element" style="display: flex" style="width: 100%">
                    Les repas que vous avez mange le {{ date("d/m/Y", strtotime($date))}}
                </div>
          </div>
        </div>
      </div>
</div>

<div class="row">
    @php
        $n = 1;
    @endphp
    @foreach ($repas as $rep)
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card card-warning">
          <div class="card-header">
            <h4>Repas {{ $n }}</h4>
          </div>
          <div class="card-body">
            <p>Votre repas était composé de </p>
            @foreach ($rep->composants as $composant)
                    <p>{{ $composant->composant_repas }}</p>
            @endforeach
            <a href="{{ route('detailRepas',['id'=>$rep->id,'date'=>$date,'n'=>$n]) }}">voir plus</a>
          </div>
        </div>
      </div>
      @php
          $n++;
      @endphp
    @endforeach
  </div>
@endsection
