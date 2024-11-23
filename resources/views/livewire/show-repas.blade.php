<div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-warning">
              <div class="card-body">
                    <div class="search-element" style="display: flex" style="width: 100%">
                        <div class="form-group" style="width: 100%">
                      <label>Rechcher le jour de votre repas</label>
                      <select class="form-control select2"  name="select[]" wire:model.live="search" >
                      @foreach ($dates as $key=> $date)
                          <option value="{{ $key }}">{{ $key }}</option>
                      @endforeach
                      </select>
                      </div>
                      <button class="btn" type="submit">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
              </div>
            </div>
          </div>
    </div>

    <div class="row">
        @foreach ($repasLimite as $key => $rep)
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card card-warning">
              <div class="card-header">
                <h4>{{ date("d/m/Y", strtotime($key))}}</h4>
              </div>

              <div class="card-body">
                <p>Vous avez mangé {{ $rep }} repas  ce jour ci</p>
                <a href="{{ route('detailRepasday',['date'=> $key ])}}" style="color:orange">voir plus</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

</div>
