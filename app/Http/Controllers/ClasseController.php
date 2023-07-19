<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Discipline;
use App\Models\Inscription;
use Illuminate\Http\Request;
use App\Traits\JoinQueryParams;
use App\Models\DiciplinesClasse;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\NoteResource;
use App\Http\Resources\ClasseResource;
use App\Http\Resources\InscriptionResource;
use App\Http\Resources\DiciplineClasseResource;
use App\Http\Resources\DisciplineClasseResource;

class ClasseController extends Controller
{
    use JoinQueryParams;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classe= new Classe();
        // $relations=get_class_methods($classe);
      
        $this->test($classe , $request, ['disciplinesClasse','inscriptions','participants','eleves','notes','niveau']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function notesClasse(Classe $class)
    {
        // return NoteResource::collection(Note::all());
        // return new ClasseResource($class);
        return new ClasseResource($class);

    }
    public function notesEleve(Classe $class, Request $request)
    {
         // Récupérer l'inscription de l'élève dans la classe
        $inscription = $class->inscriptions()->where('eleve_id', $request->elefe)->first();
        // return $inscription;
        if (!$inscription) {
            // Gérer le cas où l'élève n'est pas inscrit dans la classe
            return response()->json(['message' => "Cet élève n'est pas inscrit dans cette classe"], 404);
        }

        // Retourner les informations de l'élève et de la classe
        return response()->json([
            'classe' => $class->libelle,
            'inscription' => new InscriptionResource($inscription),
        ]);
    }
    public function noteDisciplineClasse($classe, $discipline)
    {
        // dd($discipline, $classe);

         $disciplineClasse=DiciplinesClasse::where([
            'classe_id' => $classe,
            'discipline_id' => $discipline
        ])->get()->pluck('id');

        $notes=Note::whereIn('diciplines_classe_id',$disciplineClasse)->get();

        $notes = collect($notes);

        $groupes = $notes->groupBy('inscription_id');
            return $groupes;

        //     $tableauNotes = $groupes->map(function ($groupe) {
        //     // $eleve=Inscription::where(['id'=>$groupe->keys()]);
        //     return $groupe->keys();
        //     })->toArray();
        // return $tableauNotes;
        $notesEleves=[];
        $class= Classe::where('id',$classe)->first();
    //    return $class;
        $disciplines=Discipline::where('id',$discipline)->first();
        foreach ($groupes as $key=>$value) {
            // return $groupes[$key];
            $eleve=Inscription::where(['id'=>$key])->first();
            // return $disciplines;
            $noteEleves= [
                'eleve' =>new InscriptionResource($eleve ),
                'notes' =>NoteResource::collection($value),
            ];
                
        // array_push($noteEleves, $notesEleves);
        $notesEleves[]=$noteEleves;
       }
       return  [
        'classe'=>$class->libelle,
        'discipline'=>$disciplines->libelle,
        'eleves'=>$notesEleves,

       ];
    }

    /**
     * Display the specified resource.
     */
    public function eleves(Classe $classe)
    {
        // return $classe->id;
        return  DB::table('eleves')
        ->join('inscriptions', 'eleves.id', '=', 'inscriptions.eleve_id')
        ->where('inscriptions.classe_id', '=', $classe->id)
        ->select('eleves.*')
        ->get();
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function insertDisciplineClasse(Request $request, Classe $classe)
    {
        // dd($classe->id);
       $disciplineClasse= DiciplinesClasse::firstOrCreate([
            "noteMax" => $request->noteMax,
            "classe_id"=>$classe->id,
            "discipline_id"=> $request->discipline_id,
            "evaluation_id"=>$request->evaluation_id,
            "annee_scolaire_id"=>1,
            "semestre_id"=>1
         ]);
        // $disciplineClasse->load("disciplinesClasse");
        return new DiciplineClasseResource($disciplineClasse);
    }

    public function show(Classe $class)
    {
        return new ClasseResource($class);
    }

    public function coef(Classe $classe)
    {
        return new ClasseResource($classe);

    }
    public function insertNote(Request $request, $idClasse, $idDiscipline, $idEvals, $eleves)
    {
        $idDisciplineClasse=DB::table('diciplines_classes')
            ->where(['classe_id',$idClasse,'discipline_id'=>$idDiscipline,'evaluation_id'=>$idEvals])
            ->select('id','noteMax')
            ->get();

        $notes=[];
        $invalidNotes=[];
       
        if (count($idDisciplineClasse) !=0) {

            foreach ($eleves as $eleve) {
                $classe_id=DB::table('inscriptions')
                ->where('id', $eleve['idEleve'])
                ->select('classe_id')
                ->get();
                // return $classe_id;
                if (count($classe_id)!=0 && $classe_id['0']->classe_id ==$idClasse) {
                    if($eleve['note']<0  || $eleve['note']> $idDisciplineClasse[0]->noteMax){
                        $invalidNotes[]=$eleve;
            
                    }
                    else{
                        $notes[]= [
                            'note'=>$eleve['note'],
                            'diciplines_classe_id'=> $idDisciplineClasse[0]->id,
                            'inscription_id'=>$eleve['idEleve'],
                            'semestre_id'=>1
                        ];
                    }
                }
                else{
                      echo "Cet éleve n'est pas dans cette classe";
                }
            }
            foreach ($notes as $note) {
                if (! Note::where(['inscription_id'=>$note['inscription_id'],'diciplines_classe_id'=>$note['diciplines_classe_id']]))
                {
                    Note::insert($notes);
                    echo "Notes insérés !";
                }
                else {
                    echo "Cet éleve a déja une note dans cette dicipline et dans cet evaluation";
                }
            }
            
            return $invalidNotes;
        }
        else {
            echo "L'enregistrement n'a pas été trouvé.";
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $classe, $discipline, $eval, $eleve)
    {
        $disciplineClasse=DiciplinesClasse::where([
            'classe_id'=>$classe,
            'discipline_id'=>$discipline,
            'evaluation_id'=>$eval
        ])->pluck('id');
        
        Note::where(['inscription_id'=>$eleve,'diciplines_classe_id'=>$disciplineClasse[0]])->first()
            ->update(['note'=>$request->note]);
            echo 'la note a été modififié avec succés !';
                   
   }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        //
    }
}
