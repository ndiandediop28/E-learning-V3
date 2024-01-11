<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Models\Module;
use Illuminate\Http\Request;

class CourController extends Controller
{
    public function index(){
        $cour=Cour::all();

        return view('cours.index',compact('cour'));
    }

    public function create(){
        $module=Module::all();
        return view('cours.create',compact('module'));
    }

    public function store(Request $request){
        $request->validate([
            'nomCours'=>'required',
            'ressource'=>'required',
            'description'=>'required',
            'imgCours'=>'required',
            'module_id'=>'required',
        ]);
        $cour=new Cour();
        $cour->nomCours=$request->nomCours;
        $cour->description=$request->description;
        $cour->module_id=$request->module_id;
        $cour->ressource=$request->ressource;
        if($request->hasFile('imgCours')){
            $file=$request->file('imgCours');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('images/cours/',$filename);
            $cour->image=$filename;
        }

        $cour->save();
        return redirect()->route('cours.index');
    }
    public function update($id){
        $cour=Cour::find($id);
        $module=Module::all();
        return view('cours.update',compact('cour','module'));
    }
    public function edit(Request $request){
        $request->validate([
            'nomCours'=>'required',
            'ressource'=>'required',
            'description'=>'required',
            'module_id'=>'required',
        ]);

        $cour=Cour::find($request->id);
        $cour->nomCours=$request->nomCours;
        $cour->description=$request->description;
        $cour->module_id=$request->module_id;
        $cour->ressource=$request->ressource;
        if($request->hasFile('imgCours')){
            $file=$request->file('imgCours');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('images/cours/',$filename);
            $cour->image=$filename;
        }else{
            $cour->image=$cour->image;
        }
        $cour->save();
        return redirect()->route('cours.index');

    }
    public function delete($id){
        $cour=Cour::find($id);
        $cour->delete();
        return redirect()->route('cours.index');
    }

    // progression
    public function markCompleted(Cours $cours)
{
    $user = auth()->user();

    // Mettez à jour la progression de l'utilisateur pour le cours
    $progression = Progression::updateOrCreate(
        ['user_id' => $user->id, 'cours_id' => $cours->id],
        ['percentage' => 100]
    );

    // Déclenchez l'événement de cours terminé
    event(new CoursCompleted($user, $cours));

    return redirect()->back();
}
}
