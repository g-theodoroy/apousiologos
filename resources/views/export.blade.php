@extends('layouts.app')

@section('content')

    <div class="container">

          <div class="columns is-marginless is-centered">
            <div class="column is-10">
                <nav class="card">
                    <header class="card-header">
                      <p class="card-header-title">
                        Εξαγωγή απουσιών για τις Ημερομηνίες
                      </p>
                      <p class="card-header-title">
                        κενές ημ/νιες = σήμερα: {{Carbon\Carbon::Now()->format("d/m/y")}}
                      </p>
                    </header>
                    <form name="formexport" id="formexport" role="form" method="POST" action="{{ url('/export/apouxls') }}" >
                    {{ csrf_field() }}
                    <div class="card-content">
                      <nav class="level">

                        <div class="level-item">
                          <div class="field-label is-normal">
                            <label class="label">Από&nbsp;</label>
                          </div>
                          <div class="field-body">
                            <div >
                              <p class="control">
                                <input name="apoDate" class="input" type="text" placeholder="ηη/μμ/εε" size="5">
                              </p>
                            </div>
                          </div>
                        </div>


                        <div class="level-item">
                          <div class="field-label is-normal">
                            <label class="label">Έως&nbsp;</label>
                          </div>
                          <div class="field-body">
                            <div >
                              <p class="control">
                                <input  name="eosDate" class="input" type="text" placeholder="ηη/μμ/εε" size="5">
                              </p>
                            </div>
                          </div>
                        </div>

                        <div class="level-item">
                        <button class="field button" type="submit" >
                          <span class="icon">
                            <i class="fa fa-download"></i>
                          </span>
                          <span>Εξαγωγή xls</span>
                        </button>
                      </div>

                    </nav>
                    </div>
                  </form>
                </nav>
            </div>
        </div>




    </div>

<script>

</script>
@endsection
