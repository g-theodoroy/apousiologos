<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Tmima;
use DataTables;

class StudentsController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('web');
      $this->middleware('admin');
  }

  public function index()
  {
      return view('students');
  }

  public function getStudents()
  {
    $students = Student::orderby('eponimo')->orderby('onoma')->orderby('patronimo')->with('tmimata')->get();
    $arrStudents = array();
    foreach($students as $stu){
      $arrStudents[] = [
        'id' => $stu->id,
        'eponimo' => $stu->eponimo,
        'onoma' => $stu->onoma,
        'patronimo' => $stu->patronimo,
        'tmimata' => $stu->tmimata[0] ? $stu->tmimata[0]->where('student_id', $stu->id)->orderByRaw('LENGTH(tmima)')->orderby('tmima')->pluck('tmima')->toArray() : []
      ];
    }

    $newStudents = array();
    foreach($arrStudents as $stu){
          $newStudents[]=[
            'id' => $stu['id'],
            'eponimo' => $stu['eponimo'],
            'onoma' => $stu['onoma'],
            'patronimo' => $stu['patronimo'],
            't1' => isset($stu['tmimata'][0])?$stu['tmimata'][0]:"",
            't2' => isset($stu['tmimata'][1])?$stu['tmimata'][1]:"",
            't3' => isset($stu['tmimata'][2])?$stu['tmimata'][2]:"",
            't4' => isset($stu['tmimata'][3])?$stu['tmimata'][3]:"",
            't5' => isset($stu['tmimata'][4])?$stu['tmimata'][4]:""
          ];
      }

    return DataTables::of($newStudents)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="button is-small edit" id="' . $row['id'] . '">
                      <span class="icon">
                        <i class="fa fa-pencil"></i>
                        </span>
                    </a>
                    &nbsp;
                    <a href="javascript:void(0)" class="button is-small del" id="' . $row['id'] . '">
                      <span class="icon">
                        <i class="fa fa-trash"></i>
                      </span>
                    </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
  }

  public function store(Request $request)
  {
      $student = Student::updateOrCreate(['id' => $request->am],
              ['eponimo' => $request->eponimo,
              'onoma' => $request->onoma,
              'patronimo' => $request->patronimo
            ]);
      Tmima::where('student_id', $student->id)->delete();

      foreach ($request->tmima as $tmima){
        if($tmima){
        Tmima::updateOrCreate(['student_id' => $student->id, 'tmima'=> $tmima ],[
          'student_id' => $student->id,
          'tmima' => $tmima,
        ]);
      }

      }
      return response()->json(['success'=>'Student saved successfully.']);
  }

  public function edit($am){
    $students = Student::where('id', $am)->with('tmimata')->get();
    $arrStudents = array();
    foreach($students as $stu){
      $arrStudents[] = [
        'id' => $stu->id,
        'eponimo' => $stu->eponimo,
        'onoma' => $stu->onoma,
        'patronimo' => $stu->patronimo,
        'tmimata' => $stu->tmimata[0] ? $stu->tmimata[0]->where('student_id', $stu->id)->orderByRaw('LENGTH(tmima)')->orderby('tmima')->pluck('tmima')->toArray() : []
      ];
    }

    $newStudents = array();
    foreach($arrStudents as $stu){
          $newStudents[]=[
            'id' => $stu['id'],
            'eponimo' => $stu['eponimo'],
            'onoma' => $stu['onoma'],
            'patronimo' => $stu['patronimo'],
            't1' => isset($stu['tmimata'][0])?$stu['tmimata'][0]:"",
            't2' => isset($stu['tmimata'][1])?$stu['tmimata'][1]:"",
            't3' => isset($stu['tmimata'][2])?$stu['tmimata'][2]:"",
            't4' => isset($stu['tmimata'][3])?$stu['tmimata'][3]:"",
            't5' => isset($stu['tmimata'][4])?$stu['tmimata'][4]:""
          ];
      }
    return response()->json($newStudents[0]);
  }

  public function delete($am){
    Student::where('id', $am)->delete();
    Tmima::where('student_id', $am)->delete();
    return response()->json(['success'=>'Student deleted successfully.']);
  }


}
