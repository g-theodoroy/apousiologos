@extends('layouts.app')

@section('content')

<link href="{{ asset('css/dataTables.bulma.min.css') }}" rel="stylesheet" >

    <div class="container">

          <div class="columns is-marginless is-centered">
            <div class="column">
                <nav class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                          Μαθητές
                        </p>
                        <a class="button" href="javascript:void(0)" id="newStudent">Εγγραφή μαθητή</a>
                    </header>
                    <div class="card-content">
                      <div class="table-container">
                          <table class="table yajra-datatable is-fullwidth is-hoverable" >
                            <thead>
                              <tr>
                                <th class='has-text-centered' style="background-color: #f2f2f2;" >Α/Α</th>
                                <th class='has-text-centered' style="background-color: #f2f2f2;" >Αρ.Μητρώου</th>
                                <th class='has-text-centered' style="background-color: #f2f2f2;" >Επώνυμο</th>
                                <th class='has-text-centered' style="background-color: #f2f2f2;" >Όνομα</th>
                                <th class='has-text-centered' style="background-color: #f2f2f2;" >Πατρώνυμο</th>
                                <th class='has-text-centered' style="background-color: #f2f2f2;" >Τμήμα</th>
                                <th class='has-text-centered' style="background-color: #f2f2f2;" >Τμήμα</th>
                                <th class='has-text-centered' style="background-color: #f2f2f2;" >Τμήμα</th>
                                <th class='has-text-centered' style="background-color: #f2f2f2;" >Τμήμα</th>
                                <th class='has-text-centered' style="background-color: #f2f2f2;" >Τμήμα</th>
                                <th class='has-text-centered' style="background-color: #f2f2f2;" >Ενέργεια</th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                    </div>
                </nav>
            </div>
        </div>


        <div id="ajaxModel" class="modal">
          <div class="modal-background"></div>
          <div class="modal-card">
            <header class="modal-card-head">
              <p id="modalTitle" class="modal-card-title">Εισαγωγή Μαθητή</p>
              <button id="closeModalStudent" class="delete" aria-label="close" ></button>
            </header>
            <section class="modal-card-body">

              <!-- Content ... -->
              <form id="studentsForm" class="form-horizontal" >
              @csrf

              <fieldset>

              <div class="field"><label class="label">Αρ. Μητρώου</label></div>

              <!-- Text input-->
              <div class="field is-grouped">
                <div class="control">
                  <input id="am" name="am" type="text" placeholder="Αρ. Μητρώου" class="input" required >
                  <p id='amError' class="help is-danger"></p>
                </div>
              </div>

              <!-- Text input-->
              <div class="field">
                <label class="label" for="eponimo">Επώνυμο</label>
                <div class="control">
                  <input id="eponimo" name="eponimo" type="text" placeholder="Επώνυμο" class="input" required >
                  <p id='eponimoError' class="help is-danger"></p>
                </div>
              </div>

              <!-- Text input-->
              <div class="field">
                <label class="label" for="onoma">Όνομα</label>
                <div class="control">
                  <input id="onoma" name="onoma" type="text" placeholder="Όνομα" class="input" required >
                  <p id='onomaError' class="help is-danger"></p>
                </div>
              </div>

              <!-- Text input-->
              <div class="field">
                <label class="label" for="patronimo">Πατρώνυμο</label>
                <div class="control">
                  <input id="patronimo" name="patronimo" type="text" placeholder="Πατρώνυμο" class="input" required>
                  <p id='patronimoError' class="help is-danger"></p>
                </div>
              </div>

              <!-- Text input-->
              <div class="field"><label class="label">Τμήματα</label></div>

              <div class="field is-grouped">

                <div class="control">
                  <input id="t1" name="tmima[]" type="text" placeholder="Τμήμα" class="input">
                </div>

                <div class="control">
                  <input id="t2" name="tmima[]" type="text" placeholder="Τμήμα" class="input">
                </div>

              </div>

              <div class="field is-grouped">

                <div class="control">
                  <input id="t3" name="tmima[]" type="text" placeholder="Τμήμα" class="input">
                </div>

                <div class="control">
                  <input id="t4" name="tmima[]" type="text" placeholder="Τμήμα" class="input">
                </div>

              </div>

              <!-- Text input-->
              <div class="field is-grouped">
                <div class="control">
                  <input id="t5" name="tmima[]" type="text" placeholder="Τμήμα" class="input">
                </div>
              </div>

              </fieldset>
              </form>

            </section>
            <footer class="modal-card-foot">
              <button id="formSubmit" class="button">Αποθήκευση</button>
              <button  id="formReset" class="button">Άκυρο</button>
            </footer>
          </div>
        </div>

    </div>



    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

        <script src="{{ asset('js/dataTables.bulma.min.js')}}"></script>

        <script type="text/javascript">
            var table = $('.yajra-datatable').DataTable({
                "language": {
                  "url": "{{ asset('js/Greek.lang.json')}}"
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('students.getStudents') }}",
                columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'id', name: 'id'},
                  {data: 'eponimo', name: 'eponimo'},
                  {data: 'onoma', name: 'onoma'},
                  {data: 'patronimo', name: 'patronimo'},
                  {data: 't1', name: 't1'},
                  {data: 't2', name: 't2'},
                  {data: 't3', name: 't3'},
                  {data: 't4', name: 't4'},
                  {data: 't5', name: 't5'},
                  {data: 'action', name: 'action'},
                ]
            });

          $('body').on('click', '.edit', function () {
            var am = this.id
            $.get("{{ route('students.edit') }}" + "/" + am , function (data) {
              $('#ajaxModel').addClass("is-active");
              $('#modalTitle').html("Επεξεργασία μαθητή");
              $('#am').val(data.id);
              $('#eponimo').val(data.eponimo);
              $('#onoma').val(data.onoma);
              $('#patronimo').val(data.patronimo);
              $('#t1').val(data.t1);
              $('#t2').val(data.t2);
              $('#t3').val(data.t3);
              $('#t4').val(data.t4);
              $('#t5').val(data.t5);
            })
          })

          $('body').on('click', '.del', function () {
            var am = this.id
            if(! confirm("Θέλετε σίγουρα να διαγράψετε τον μαθητή;")) return
            $.ajax({
                type: "DELETE",
                url: "{{ route('students.delete') }}"+'/'+ am,
                dataType: 'JSON',
                data:{
                    '_token': '{{ csrf_token() }}',
                },
                success: function (data) {
                    table.ajax.reload()
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
          })

          $('body').on('click', '#newStudent', function () {
            $('#ajaxModel').addClass("is-active");
          })
          $('body').on('click', '#closeModalStudent', function () {
            $('#studentsForm').trigger("reset")
            $('.help').html("")
            $('#ajaxModel').removeClass("is-active");
          })

          $('body').on('click', '#formSubmit', function () {

            if(! $.trim($('#am').val()) ){
                $('#amError').html("Συμπληρώστε τον Αρ. Μητρώου")
                $('#am').focus()
                $('#am').val('')
                return
              }else{
                $('#amError').html("")
              }
              if(! $.trim($('#eponimo').val()) ){
                  $('#eponimoError').html("Συμπληρώστε το Επώνυμο")
                  $('#eponimo').focus()
                  $('#eponimo').val('')
                  return
                }else{
                  $('#eponimoError').html("")
              }
              if(! $.trim($('#onoma').val()) ){
                  $('#onomaError').html("Συμπληρώστε το Όνομα")
                  $('#onoma').focus()
                  $('#onoma').val('')
                  return
                }else{
                  $('#onomaError').html("")
              }
              if(! $.trim($('#patronimo').val()) ){
                  $('#patronimoError').html("Συμπληρώστε το Πατρώνυμο")
                  $('#patronimo').focus()
                  $('#patronimo').val('')
                  return
                }else{
                  $('#patronimoError').html("")
                }


                $.ajax({
                  data: $('#studentsForm').serialize(),
                  url: "{{ route('students.store') }}",
                  type: "POST",
                  dataType: 'json',
                  success: function (data) {
                      $('#studentsForm').trigger("reset")
                      $('.help').html("")
                      $('#ajaxModel').removeClass("is-active")
                      table.ajax.reload()
                  },
                  error: function (data) {
                      console.log('Error:', data)
                      $('#showError').html(data.responseJSON.message)
                  }
                })



          })

          $('body').on('click', '#formReset', function () {
            $('#studentsForm').trigger("reset")
            $('.help').html("")
            $('#ajaxModel').removeClass("is-active")
          })

      </script>

@endsection
