<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
use App\Models\DiciplinesClasse;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ClasseResource;
use App\Http\Resources\DiciplineClasseResource;
use App\Http\Resources\DisciplineClasseResource;
use App\Models\Inscription;
use App\Models\Note;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
         ]);
        return new DiciplineClasseResource($disciplineClasse);
    }

    public function show(Classe $class)
    {
        return $class;
    }

    public function coef(Classe $classe)
    {
        // return Classe::all();
        return new ClasseResource($classe);
    }
    public function insertNote(Request $request)
    {
        $idClasse=$request->classes;
        $idDiscipline=$request->disciplines;
        $idEvals=$request->evals;
        $eleves=$request->data;
        // return $eleves;
        $idDisciplineClasse=DB::table('diciplines_classes')
            ->where('classe_id',$idClasse)
            ->where('discipline_id',$idDiscipline)
            ->where('evaluation_id',$idEvals)
            ->select('id','noteMax')
            ->get();
        $notes=[];
        // return $idDisciplineClasse[0]->noteMax;
        if (count($idDisciplineClasse) !=0) {

            foreach ($eleves as $eleve) {
               
                $note = Note::where('inscription_id', $eleve['idEleve'])
                    ->where('diciplines_classe_id', $idDisciplineClasse[0]->id)
                    ->where('semestre_id', 1)
                    ->first();

                if ($note) {
                    // return 'success';
                    $validate = $request->validate([
                        'note' => 'bail|required|min:0|max:'.$idDisciplineClasse[0]->noteMax,
                    ]);
                    $note->note = $eleve['note'];
                    $note->save();
                }
                else{
                    return $eleve['note'];
                    $validate = $request->validate([
                        'note' => 'bail|required|min:0|max:'.$idDisciplineClasse[0]->noteMax,
                    ]);
                    $eleve= Note::firstOrCreate([
                        'inscription_id'=>$eleve['idEleve'],
                        'diciplines_classe_id'=> $idDisciplineClasse[0]->id,
                        'note'=>$eleve['note'],
                        'semestre_id'=>1
                    ]);
                }

                array_push($notes, $eleve);
            }
            return $notes;
        }
        else {
            echo "L'enregistrement n'a pas été trouvé.";
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classe $classe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        //
    }
}
