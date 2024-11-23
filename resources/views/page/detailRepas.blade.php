@extends('principal_template.principal_template')
@section('title')
    Details jour
@endsection
@section('content')

<div class="row">


    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-warning">
          <div class="card-body">
                <div class="search-element" style="display: flex" style="width: 100%">
                    Le  repas {{ $n }} que vous avez mange le {{ date("d/m/Y", strtotime($date)) }}
                </div>
          </div>
        </div>
      </div>
</div>

<div class="row">

    @foreach ($repas->composants as $composant)
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
              <div class="card-header">
                <h4></h4>
              </div>
              <div class="card-body">
                <div class="media">
                  <img class="mr-3" src="{{ url('storage/' . $composant->image_composants) }}" alt="Generic placeholder image">
                  <div class="media-body">
                    <h5 class="mt-0">{{ $composant->composant_repas }}</h5>
                        @foreach ($composant->elements as $element)
                            {{ $element->element_composant }},
                        @endforeach
                  </div>
                </div>
              </div>
            </div>
        </div>
    @endforeach

        </div>
      </div>
  </div>
@endsection
