<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Student;
use App\Tmima;
use App\Program;
use App\Config;
use App\Anathesi;
use App\Apousie;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($selectedTmima = 0, $date = null )
    {
      // αρχικοποιώ την ημέρα αν δεν έχει έρθει με το url
      if(! $date) $date = Carbon::now()->format("Ymd");

      // Αν έχει υποβληθεί η φόρμα
      if(request()->method() == 'POST'){

        // παίρνω την ημέρα και αλλάζω το format της ημνιας από ηη/μμ/εε σε εεεεμμηη
        $date = Carbon::createFromFormat("!d/m/y", request()->date)->format("Ymd");

        // παίρνω τα στοιχεία των απουσιών (συμβολοσειρά 7 αριθμών 0 ή 1 πχ '1111100')
        $data = request()->except(['_token', 'date']);

        // όπου έχει στοιχεία
        foreach($data as $key => $value){

          // αν δεν είναι κενό ενημερώνω αν υπάρχει ΑΜ+ημνια ή πρόσθέτω
          if($value){
            Apousie::updateOrCreate(['student_id' => substr($key,2), 'date' => $date ],[
              'apousies' => $value,
              ]);
          }else{

            // αν κενό διαγράφω αν υπάρχει ΑΜ+ημνια
            Apousie::where('student_id', substr($key,2))->where('date', $date)->delete();
          }
        }
      }// τέλος Αν έχει υποβληθεί η φόρμα

      // παίρνω τα τμηματα του χρήστη
      // ταξινόμηση με το μήκος του ονόματος + αλφαβητικά
      $anatheseis = Auth::user()->anatheseis()->orderByRaw('LENGTH(tmima)')->orderby('tmima')->get();

      // αν είναι Διαχειριστής τα παίρνω όλα από μια φορά
      if( Auth::user()->role_description() == "Διαχειριστής"){
        $anatheseis = Anathesi::orderByRaw('LENGTH(tmima)')->orderby('tmima')->distinct()->get('tmima');
      }

      // αν το τμήμα που δόθηκε στο url δεν αντιστοιχεί στον χρήστη επιστρέφω πίσω
      if ($selectedTmima && ! $anatheseis->where('tmima',$selectedTmima)->count()) return back();

      // βάζω σε πίνακα [ΑΜ]=απουσίες για την ημέρα
      $apousiesForDate = Apousie::where('date', $date)->pluck('apousies', 'student_id')->toArray();

      if($selectedTmima){
        // βάζω σε ένα πίνακα τους ΑΜ των μαθητών που ανήκουν στο επιλεγμένο τμήμα
        $student_ids = Tmima::where('tmima', $selectedTmima)->pluck('student_id')->toArray();

        // παίρνω τα στοιχεία των μαθητών ταξινομημένα κσι φιλτράρω μόνο τους ΑΜ που έχει το τμήμα
        $students = Student::orderby('eponimo')->orderby('onoma')->orderby('patronimo')->with('tmimata')->get()->only($student_ids);

    }else{ // δεν είναι επιλεγμένο τμήμα = όλοι όσοι έχουν απουσίες
        // βρίσκω τους μαθητές που έχουν απουσίες την συγκεκριμμένη ημέρα
        $students = Student::whereHas('apousies', function ($query) use ($date) {
          $query->where('date', '=', $date);
        })->orderby('eponimo')->orderby('onoma')->orderby('patronimo')->with('tmimata')->get();
    }

      $arrStudents = array();
      foreach($students as $stuApFoD){
        $arrStudents[] = [
          'id' => $stuApFoD->id,
          'eponimo' => $stuApFoD->eponimo,
          'onoma' => $stuApFoD->onoma,
          'patronimo' => $stuApFoD->patronimo,
          'tmima' => $stuApFoD->tmimata[0]->where('student_id', $stuApFoD->id)->orderByRaw('LENGTH(tmima)')->orderby('tmima')->first('tmima')->tmima,
          'tmimata' => $stuApFoD->tmimata[0]->where('student_id', $stuApFoD->id)->orderByRaw('LENGTH(tmima)')->orderby('tmima')->pluck('tmima')->implode(', '),
          'apousies' => $apousiesForDate[$stuApFoD->id]
        ];
      }
      usort($arrStudents, function($a, $b) {
      return $a['tmimata'] <=> $b['tmimata'] ?:
             $a['eponimo'] <=> $b['eponimo'] ?:
             $a['onoma'] <=> $b['onoma'] ?:
             strnatcasecmp($a['patronimo'], $b['patronimo']);
           });
/*
           $uniqueTmimata = array_unique(array_column($arrStudents, 'tmima'));
           $arrTaxeis = array();
           foreach ($uniqueTmimata as $tmi){
             $arrTaxeis[]= mb_substr(preg_replace('/\d/', '', $tmi),0,1);
           }
            $uniqueTaxeis = array_values(array_unique($arrTaxeis));
           dd($uniqueTaxeis);
*/
      //διαβάζω ρυθμίσεις από τον πίνακα configs
      $program = new Program;
      // οι ώρες του προγράμματος
      $totalHours = $program->get_num_of_hours();
      // η ζώνη ώρας
      $timeZone = Config::getConfigValueOf('timeZone');
      // βρίσκω την ενεργή ώρα για πέρασμα απουσιών
      $activeHour = $program->get_active_hour(Carbon::Now($timeZone)->format("Hi"));
      // αν θέλουμε τις ώρες ξεκλείδωτες ή είμαστε Διαχειριστής
      if(Config::getConfigValueOf('hoursUnlocked') || Auth::user()->role_description() == "Διαχειριστής") $hoursUnlocked = 1;
      // επιτρέπεται στους να ξεκλειδώσουν τις ώρες;
      $letTeachersUnlockHours = Config::getConfigValueOf('letTeachersUnlockHours');
      // να φαίνονται ή όχι οι επόμενες ώρες
      $showFutureHours = Config::getConfigValueOf('showFutureHours');
      // παίρνω την ημέρα και αλλάζω το format της ημνιας από εεεεμμηη σε ηη/μμ/εε
      $date = Carbon::createFromFormat("!Ymd", $date)->format("d/m/y");

      return view('home' ,compact( 'date', 'anatheseis', 'selectedTmima', 'totalHours', 'activeHour', 'hoursUnlocked', 'letTeachersUnlockHours', 'showFutureHours', 'arrStudents'));
    }


}
