@extends('layouts.app')

@section('content')

    <div class="container">

          <div class="columns is-marginless is-centered">
            <div class="column is-10">
                <nav class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                          @if($kathigitesCount)
                          Καθηγητές: {{$kathigitesCount}}
                          @else
                           Εισαγωγή Καθηγητών
                           @endif
                        </p>
                        @if(Session::get('insertedUsersCount'))
                        <p class="card-header-title has-text-success">
                            Έγινε εισαγωγή-ενημέρωση {{Session::get('insertedUsersCount')}} καθηγητών
                            και {{Session::get('insertedAnatheseisCount')}} αναθέσεων
                        </p>
                        @endif
                        @if(Session::get('delKathigitesCount'))
                        <p class="card-header-title has-text-success">
                            Έγινε διαγραφή {{Session::get('delKathigitesCount')}} καθηγητών
                        </p>
                        @endif
                    </header>
                    <form name="formKath" id="formKath" role="form" method="POST" action="{{ url('/insertusers') }}" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="card-content">
                      <nav class="level is-mobile">
                        <a class="button level-item" onclick="chkDelKathigites(event)" @if(!$kathigitesCount) disabled @endif >
                          <span class="icon">
                            <i class="fa fa-trash"></i>
                          </span>
                          <span>Διαγραφή</span>
                        </a>
                        <div id="file-kathigites" class="file has-name level-item has-text-centered">
                          <label class="file-label">
                            <input class="file-input" type="file" name="file_kath">
                            <span class="file-cta">
                              <span class="file-icon">
                                <i class="fa fa-search"></i>
                              </span>
                              <span class="file-label">
                                Επιλογή xls
                              </span>
                            </span>
                            <span class="file-name">
                              ---
                            </span>
                          </label>
                        </div>
                        <button id="sbmt_kath" class="button level-item" type="submit" disabled >
                          <span class="icon">
                            <i class="fa fa-upload"></i>
                          </span>
                          <span>Εισαγωγή xls</span>
                        </button>
                        <a class="button level-item" href="{{ url('/export/kathxls') }}" >
                          <span class="icon">
                            <i class="fa fa-download"></i>
                          </span>
                          <span>Εξαγωγή xls</span>
                        </a>
                    </nav>
                    </div>
                  </form>
                </nav>
            </div>
        </div>


        <div class="columns is-marginless is-centered">
            <div class="column is-10">
                <nav class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            @if($studentsCount)
                            Μαθητές: {{$studentsCount}}
                            @else
                             Εισαγωγή Μαθητών
                             @endif
                        </p>
                        @if(Session::get('insertedStudentsCount'))
                        <p class="card-header-title has-text-success">
                            Έγινε εισαγωγή-ενημέρωση {{Session::get('insertedStudentsCount')}} μαθητών
                            και {{Session::get('insertedTmimataCount')}} τμημάτων
                        </p>
                        @endif
                        @if(Session::get('delStudentsCount'))
                        <p class="card-header-title has-text-success">
                            Έγινε διαγραφή {{Session::get('delStudentsCount')}} μαθητών
                        </p>
                        @endif
                    </header>

                    <form name="formMath" id="formMath" role="form" method="POST" action="{{ url('/insertstudents') }}" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="card-content">
                      <nav class="level is-mobile">
                        <a class="button level-item" onclick="chkDelStudents(event)" @if(!$studentsCount) disabled @endif >
                          <span class="icon">
                            <i class="fa fa-trash"></i>
                          </span>
                          <span>Διαγραφή</span>
                        </a>
                        <div id="file-mathites" class="file has-name level-item has-text-centered">
                          <label class="file-label">
                            <input class="file-input" type="file" name="file_math">
                            <span class="file-cta">
                              <span class="file-icon">
                                <i class="fa fa-search"></i>
                              </span>
                              <span class="file-label">
                                Επιλογή xls
                              </span>
                            </span>
                            <span class="file-name">
                              ---
                            </span>
                          </label>
                        </div>
                        <button id="sbmt_math" class="button level-item" type="submit" disabled >
                          <span class="icon">
                            <i class="fa fa-upload"></i>
                          </span>
                          <span>Εισαγωγή xls</span>
                        </button>
                          <a class="button level-item" href="{{ url('/export/mathxls') }}" >
                            <span class="icon">
                              <i class="fa fa-download"></i>
                            </span>
                            <span>Εξαγωγή xls</span>
                          </a>
                    </nav>
                    </div>
                  </form>
                </nav>
            </div>
        </div>

                <div class="columns is-marginless is-centered">
                    <div class="column is-10">
                        <nav class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                  @if($programCount)
                                  Ώρες: {{$programCount}}
                                  @else
                                   Εισαγωγή προγράμματος
                                   @endif
                                </p>
                                @if(Session::get('insertedProgram'))
                                <p class="card-header-title has-text-success">
                                    Έγινε εισαγωγή του προγράμματος
                                </p>
                                @endif
                                @if(Session::get('deletedProgram'))
                                <p class="card-header-title has-text-success">
                                  Έγινε διαγραφή του προγράμματος
                                </p>
                                @endif
                            </header>

                            <form name="formProg" id="formProg" role="form" method="POST" action="{{ url('/insertprogram') }}" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="card-content">
                              <nav class="level is-mobile">
                                <a class="button level-item" onclick="chkDelProgram(event)" @if(!$programCount) disabled @endif >
                                  <span class="icon">
                                    <i class="fa fa-trash"></i>
                                  </span>
                                  <span>Διαγραφή</span>
                                </a>
                                <div id="file-program" class="file has-name level-item has-text-centered">
                                  <label class="file-label">
                                    <input class="file-input" type="file" name="file_prog">
                                    <span class="file-cta">
                                      <span class="file-icon">
                                        <i class="fa fa-search"></i>
                                      </span>
                                      <span class="file-label">
                                        Επιλογή xls
                                      </span>
                                    </span>
                                    <span class="file-name">
                                      ---
                                    </span>
                                  </label>
                                </div>
                                <button id="sbmt_prog" class="button level-item" type="submit" disabled >
                                  <span class="icon">
                                    <i class="fa fa-upload"></i>
                                  </span>
                                  <span>Εισαγωγή xls</span>
                                </button>
                                <a class="button level-item" href="{{ url('/export/progxls') }}" >
                                  <span class="icon">
                                    <i class="fa fa-download"></i>
                                  </span>
                                  <span>Εξαγωγή xls</span>
                                </a>
                            </nav>
                            </div>
                          </form>
                        </nav>
                    </div>
                </div>


                <div class="columns is-marginless is-centered">
                    <div class="column is-10">
                        <nav class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                  @php($apousiesDaysCount = (new App\Apousie)->apousiesDaysCount())
                                  @if($apousiesDaysCount)
                                  Ημέρες με απουσίες: {{$apousiesDaysCount}}
                                  @else
                                  Δεν καταχωρίστηκαν ημέρες απουσιών
                                  @endif
                                </p>
                            </header>

                            <form name="formProg" id="formProg" role="form" method="POST" action="{{ url('/insertprogram') }}" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="card-content">
                              <nav class="level is-mobile">
                                <a class="button level-item" onclick="chkDelApousiesDays(event)" @if(! $apousiesDaysCount) disabled @endif >
                                  <span class="icon">
                                    <i class="fa fa-trash"></i>
                                  </span>
                                  <span>Διαγραφή όλων ημερών με απουσίες εκτός από</span>
                                </a>
                                <input id="daysToKeep" class="input column is-2  has-text-centered" type="text" />
                            </nav>
                            </div>
                          </form>
                        </nav>
                    </div>
                </div>

                <div class="columns is-marginless is-centered">
                    <div class="column is-10">
                        <nav class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                  Ρυθμίσεις
                                </p>
                                @if(Session::get('setDone'))
                                <p class="card-header-title has-text-success">
                                    Έγινε ενημέρωση των ρυθμίσεων
                                </p>
                                @endif
                            </header>

                            <form name="formSet" id="formSet" role="form" method="POST" action="{{ url('/set') }}" >
                            {{ csrf_field() }}
                            <div class="card-content">
                              <div class="columns is-centered">
                                <div class="column is-narrow">
                                  <table class="table">
                                <tr>
                                  <td>Να επιτρέπεται η Εγγραφή νέων χρηστών</td>
                                  <td class="has-text-centered"><input name="allowRegister"  type="checkbox" @if(App\Config::getConfigValueOf('allowRegister')) checked @endif ></td>
                                </tr>
                                <tr>
                                  <td>Οι ώρες να είναι ξεκλείδωτες</td>
                                  <td class="has-text-centered"><input name="hoursUnlocked" type="checkbox" @if(App\Config::getConfigValueOf('hoursUnlocked')) checked @endif ></td>
                                </tr>
                                <tr>
                                  <tr>
                                    <td>Επιτρέπεται η εισαγωγή απουσιών εκτός ωραρίου</td>
                                    <td class="has-text-centered"><input name="allowTeachersSaveAtNotActiveHour" type="checkbox" @if(App\Config::getConfigValueOf('allowTeachersSaveAtNotActiveHour')) checked @endif ></td>
                                  </tr>
                                  <tr>
                                  <td>Επιτρέπεται στους καθηγητές να ξεκλειδώνουν τις ώρες</td>
                                  <td class="has-text-centered"><input name="letTeachersUnlockHours" type="checkbox" @if(App\Config::getConfigValueOf('letTeachersUnlockHours')) checked @endif ></td>
                                </tr>
                                <tr>
                                  <td>Να μη κρύβονται οι επόμενες ώρες</td>
                                  <td class="has-text-centered"><input name="showFutureHours" type="checkbox" @if(App\Config::getConfigValueOf('showFutureHours')) checked @endif ></td>
                                </tr>
                                <tr>
                                  <td>Επιτρέπεται η εισαγωγή απουσιών Σαββατοκύριακο</td>
                                  <td class="has-text-centered"><input name="allowWeekends" type="checkbox" @if(App\Config::getConfigValueOf('allowWeekends')) checked @endif ></td>
                                </tr>
                                <tr>
                                  <td>Όνομα σχολείου</td>
                                  <td class="has-text-centered"><input  name="schoolName" class="input has-text-centered" type="text" value="{{App\Config::getConfigValueOf('schoolName')}}"></td>
                                </tr>
                                <tr>
                                  <tr>
                                    <td>Ορισμός Ημνιας εισαγωγής απουσιών</td>
                                    <td class="has-text-centered"><input  name="setCustomDate" class="input has-text-centered" type="text" value="{{App\Config::getConfigValueOf('setCustomDate')}}"></td>
                                  </tr>
                                  <tr>
                                  <td>Ζώνη ώρας</td>
                                  <td class="has-text-centered"><input  name="timeZone" class="input has-text-centered" type="text" value="{{App\Config::getConfigValueOf('timeZone')}}"></td>
                                </tr>
                                <td class="has-text-centered" colspan="2">
                                  <button class="button" type="submit" >
                                    <span class="icon">
                                      <i class="fa fa-trash"></i>
                                    </span>
                                    <span>Αποθήκευση</span>
                                  </button>
                                </td>
                                <tr>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                          </form>
                        </nav>
                    </div>
                </div>



    </div>

<script>
  const fileInput_k = document.querySelector('#file-kathigites input[type=file]');
  fileInput_k.onchange = () => {
    if (fileInput_k.files.length > 0) {
      document.getElementById("sbmt_kath").disabled = false;
      const fileName = document.querySelector('#file-kathigites .file-name');
      fileName.textContent = fileInput_k.files[0].name;
    }
  }
  const fileInput_m = document.querySelector('#file-mathites input[type=file]');
  fileInput_m.onchange = () => {
    if (fileInput_m.files.length > 0) {
      document.getElementById("sbmt_math").disabled = false;
      const fileName = document.querySelector('#file-mathites .file-name');
      fileName.textContent = fileInput_m.files[0].name;
    }
  }
  const fileInput_p = document.querySelector('#file-program input[type=file]');
  fileInput_p.onchange = () => {
    if (fileInput_p.files.length > 0) {
      document.getElementById("sbmt_prog").disabled = false;
      const fileName = document.querySelector('#file-program .file-name');
      fileName.textContent = fileInput_p.files[0].name;
    }
  }
  function chkDelKathigites(e){
    e.preventDefault();
    @if($kathigitesCount)
    if (confirm('Θέλετε να διαγραφούν {{$kathigitesCount}} καθηγητές;')) window.location.href = "{{ url('/delkath') }}";
    @endif
  }
  function chkDelStudents(e){
    e.preventDefault();
    @if($studentsCount)
    if (confirm('Θέλετε να διαγραφούν {{$studentsCount}} μαθητές;')) window.location.href = "{{ url('/delmath') }}";
    @endif
  }
  function chkDelProgram(e){
    e.preventDefault();
    @if($programCount)
    if (confirm('Θέλετε να διαγραφεί το πρόγραμμα;')) window.location.href = "{{ url('/delprog') }}";
    @endif
  }
  function chkDelApousiesDays(e){
    e.preventDefault();
    @if($apousiesDaysCount)
    var keepDays = document.getElementById('daysToKeep').value
    if (keepDays) {
      msg = 'Θέλετε να διαγραφούν όλες οι ημέρες με απουσίες εκτός από τις τελευταίες ' + keepDays + ';'
    }else{
      msg = 'Θέλετε να διαγραφούν όλες οι ημέρες με απουσίες;'
    }
    if (confirm(msg))  window.location.href ="{{ url('/delapou') }}/" +  keepDays
    @endif
  }

</script>
@endsection
