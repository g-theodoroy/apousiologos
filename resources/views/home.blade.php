@extends('layouts.app')

@php($isAdmin = Auth::user()->role_description() == "Διαχειριστής")

@section('content')

    <div class="container">
        <div class="columns is-marginless is-centered">
            <div class="column is-10">
                <nav class="card">
                  <form name="formApousies" id="formApousies" role="form" method="POST" action="{{ url('/home', $selectedTmima ) }}">
                  {{ csrf_field() }}
                    <header class="card-header">
                      <div class="level">
                        <p class="card-header-title level-item column is-narrow has-text-centered">
                          @php($now = Carbon\Carbon::Now()->format("d/m/y"))
                          @if($isAdmin)
                          <input class="input" id="date" name="date" type="text" value="{{ $date }}" size="3" />
                          <a href="{{ url('/home' , $selectedTmima ) }}" onclick="changeDate(this, event)"><span class="icon"><i class="fa fa-search"></i></span></a>
                          @else
                          {{ $now  }}
                          <input class="input" id="date" name="date" type="hidden" value="{{ $now }}" size="3" />
                          @endif
                        </p>
                        <p class="box card-header-title level-item column">
                          @foreach($anatheseis as $anathesi)
                          <a href="{{ url('/home' , $anathesi->tmima ) }}" >{{$anathesi->tmima}}</a>&nbsp;
                          @endforeach
                          @if($isAdmin)
                          <a href="{{ url('/home/0')}}" ><span class="icon"><i class="fa fa-times"></i></span></a>&nbsp;
                          @endif
                        </p>
                      </div>
                    </header>
                    @if($isAdmin && $sumApousies)
                    <div class="card-content">
                      <div class="columns is-centered">
                        <div class="column is-narrow">
                      <table class="table is-narrow">
                        <thead>
                          <tr>
                            <th>Τάξη</th>
                            <th>1 ώρα</th>
                            <th>2 ώρες</th>
                            <th>3 και πανω</th>
                            <th>Σύνολο</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach( $taxeis as $taxi)
                          <tr>
                            <th class='has-text-centered'>{{$taxi}}</th>
                            @foreach($sumApousies[$taxi] as $key => $value)
                            <th class='has-text-centered'>{{$value ? $value : ''}}</th>
                            @endforeach
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                    @endif
                    <div class="card-content">
                      <div class="columns is-centered">
                        <div class="column is-narrow">
                          <div class="level has-text-centered ">
                            @if(($selectedTmima && count($arrStudents)) || ($isAdmin && count($arrStudents)))
                          <p class="card-header-title level-item">
                            {{$selectedTmima?$selectedTmima:'Όλα τα τμήματα'}}{{$activeHour}}
                            @if($isAdmin)
                            <br>{{$date}}
                            @endif
                          </p>

                          @if(! $isAdmin && ! $activeHour)
                          <p class="card-header-title level-item">
                            Εκτός ωραρίου
                          </p>
                          @endif
                          @if(  $isAdmin ||  $activeHour != 0)
                          <a class="button level-item" onclick="formValidateDate()" >
                            <span class="icon">
                              <i class="fa fa-save"></i>
                            </span>
                            <span>Αποθήκευση</span>
                          </a>
                          @if($letTeachersUnlockHours && $activeHour > 0)
                          <a class="button level-item" onclick="unlockChks()" >
                            <span class="icon">
                              <i class="fa fa-key"></i>
                            </span>
                            <span>Ξεκλείδωμα</span>
                          </a>
                          @endif
                          @endif
                        </div>

                      <table class="table is-narrow">
                      <thead>
                        <tr>
                          @if(! $selectedTmima)
                          <th>{{!$selectedTmima && count($arrStudents)?count($arrStudents):''}}</th>
                          @endif
                          <th>{{!$selectedTmima ?'Τμ':''}}</th>
                          <th>Ονοματεπώνυμο</th>
                          <th @if(! $isAdmin && ! $activeHour ) style="display:none;" @endif><span class="icon">
                            <i class="fa fa-calculator"></i>
                          </span></th>
                          @for($i = 1; $i < $totalHours + 1; $i++)
                          @if($activeHour>0)
                            <th @if($i == $activeHour ) style="background-color: #f2f2f2;" @endif @if(!$isAdmin && ! $showFutureHours && $i > $activeHour ) style="display:none;" @endif >{{$i}}η</th>
                          @elseif(!$isAdmin && $activeHour==0)
                            <th style="display:none;" >{{$i}}η</th>
                          @else
                          <th @if($i % 2 != 0) style="background-color: #f2f2f2;" @endif >{{$i}}η</th>
                          @endif
                          @endfor
                        </tr>
                      </thead>
                    <tbody>
                      @foreach($arrStudents as $student)
                        <tr>
                          @if(! $selectedTmima)
                          <td class="has-text-centered" title="{{$student['tmimata']}}">
                          {{$loop->index  + 1}}
                        </td>
                          @endif
                          <td class="has-text-centered" title="{{$student['tmimata']}}">
                          {{ $selectedTmima ? $loop->index  + 1 :  $student['tmima']}}
                        </td>
                          <td>
                            <input class="input" id="ap{{$student['id']}}" name="ap{{$student['id']}}" value="{{$student['apousies']}}" type="hidden" size="5" />
                            {{$student['eponimo']}} {{$student['onoma']}}
                          </td>
                          <th class="has-text-centered" @if(! $isAdmin && ! $activeHour ) style="display:none;" @endif>{{array_sum(preg_split("//",$student['apousies'] ))>0?array_sum(preg_split("//",$student['apousies'] )):''}}</th>
                          @for($i = 1; $i < $totalHours + 1; $i++)
                          @if($activeHour>0)
                            <th @if($i == $activeHour ) style="background-color: #f2f2f2;" @endif  @if( ! $isAdmin && ! $showFutureHours && $i > $activeHour ) style="display:none;" @endif >
                          @elseif(!$isAdmin && $activeHour==0)
                            <th style="display:none;" >
                          @else
                            <th @if($i % 2 != 0) style="background-color: #f2f2f2;" @endif >
                          @endif
                            <input type="checkbox" onclick="chkClicked(this.checked,{{$student['id']}},{{$i-1}})" @if($student['apousies'][$i-1]) checked @endif @if( ! $hoursUnlocked && $i != $activeHour ) disabled @endif >
                          </th>
                          @endfor

                      @endforeach
                    </tbody>
                  </table>

                  <div class="level has-text-centered ">
                  <p class="card-header-title level-item">
                    {{$selectedTmima?$selectedTmima:'Όλα τα τμήματα'}}
                    @if($isAdmin)
                    <br>{{$date}}
                    @endif
                  </p>
                  @if(! $isAdmin && ! $activeHour)
                  <p class="card-header-title level-item">
                    Εκτός ωραρίου
                  </p>
                  @endif
                  @if( $isAdmin || $activeHour != 0)
                  <a class="button level-item" onclick="formValidateDate()" >
                    <span class="icon">
                      <i class="fa fa-save"></i>
                    </span>
                    <span>Αποθήκευση</span>
                  </a>
                  @if($letTeachersUnlockHours && $activeHour > 0)
                  <a class="button level-item" onclick="unlockChks()" >
                    <span class="icon">
                      <i class="fa fa-key"></i>
                    </span>
                    <span>Ξεκλείδωμα</span>
                  </a>
                  @endif
                  @endif
                </div>

                </form>
                @else
                <p class="title">
                  <br>
                  @if($isAdmin)
                  @if(! App\User::get_num_of_kathigites())
                  <a href="{{ route('admin') }}">Πρέπει να εισάγετε καθηγητές</a><br>
                  <br>
                  <i class="fa fa-frown-o" aria-hidden="true"></i><br>
                  @elseif(! App\Student::get_num_of_students())
                  <a href="{{ route('admin') }}">Πρέπει να εισάγετε μαθητές</a><br>
                  <br>
                  <i class="fa fa-frown-o" aria-hidden="true"></i><br>
                  @else
                  Ωραία!<br>
                  Δεν λείπει κανείς!<br><br>
                  <i class="fa fa-smile-o" aria-hidden="true"></i><br>
                  @endif
                  @else
                  @if (! App\User::get_num_of_kathigites() || ! App\Student::get_num_of_students())
                  Δυστυχώς υπολείπονται ρυθμίσεις και<br>
                  η εφαρμογή δεν είναι λειτουργική
                  <br>
                  <br>
                  <i class="fa fa-frown-o" aria-hidden="true"></i><br>
                  @else
                  Επιλέξτε ένα τμήμα
                  @endif
                  @endif
                </p>
                @endif
                </div>
              </div>
            </div>
        </div>


        </form>
        </div>
      </div>
      </div>
    </div>
    </nav>
  </div>
  </div>
</div>

<script>
String.prototype.replaceAt = function(index, replacement) {
    return this.substr(0, index) + replacement + this.substr(index + replacement.length);
}
function chkClicked (checked, am, position){
  apval = document.getElementById('ap'+ am).value
  if(checked==true){
    if (!apval) apval = '{{str_repeat ( '0' , $totalHours )}}'
    apval = apval.replaceAt(position, "1")
  }else{
    apval = apval.replaceAt(position, "0")
    if (apval == '{{str_repeat ( '0' , $totalHours )}}' ) apval = ''
  }
  document.getElementById('ap'+ am).value = apval
}

function unlockChks(){
  if(! confirm("Είστε σίγουροι ότι θλελετε να ξεκλειδώσετε τα κουτιά;"))return false
  var checkboxes = document.querySelectorAll('input[type="checkbox"]')
  for (var checkbox of checkboxes) {
    checkbox.disabled = false
  }
}
function changeDate(element, e){
var mydate = document.getElementById('date').value
mydate = "20" + mydate.substring(6,8) + mydate.substring(3,5) + mydate.substring(0,2)
element.href = element.href + '/' + mydate
return true;
}
function formValidateDate(){
  var dateToCommit = document.getElementById('date').value
  if ( dateToCommit !== '{{$date}}'){
    if (! confirm('Καταχωρίζετε απουσίες της ημέρας: {{$date}} σε διαφορετική ημέρα: ' + dateToCommit +'. Θέλετε να συνεχίσετε;')) return
  }
  document.getElementById('formApousies').submit()
}
</script>

@endsection
