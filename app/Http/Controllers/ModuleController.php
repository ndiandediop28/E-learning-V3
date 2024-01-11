<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Domaine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function index(){
      //  $module=DB::table('modules')->join('domaines','domaines.id','=','modules.domaine_id')->get();
      $module=Module::all();
        return view('module.index',compact('module'));
    }
    public function create(){
        $domaine=Domaine::all();

        return view('module.create',compact('domaine'));
    }

    public function store(Request $request){
        $request->validate([
            'nomModule'=>'required',
            'description'=>'required',
            'imgModule'=>'required',
            'domaine'=>'required',

        ]);
        $module=new Module();
        $module->nomModule=$request->nomModule;
        $module->description=$request->description;
        $module->domaine_id=$request->domaine;
        if($request->hasFile('imgModule')){
            $file=$request->file('imgModule');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('images/',$filename);
            $module->image=$filename;
        }

        $module->save();
        return redirect()->route('module.index');
    }

    public function addcours($id){
        $module=Module::find($id);
        return view('module.addcours',compact('module'));
    }
    public function update($id){
        $domaine=Domaine::all();
        $module=Module::find($id);
        return view('module.update',compact('module','domaine'));
    }
    public function edit(Request $request){
        $request->validate([
            'nomModule'=>'required',
            'description'=>'required',
            'domaine'=>'required',
        ]);
        $module=Module::find($request->id);
        $module->nomModule=$request->nomModule;
        $module->description=$request->description;
        $module->domaine_id=$request->domaine;
        if($request->hasFile('imgModule')){
            $file=$request->file('imgModule');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('images/',$filename);
            $module->image=$filename;
        }else{
            $module->image=$module->image;
        }
        $module->save();
        return redirect()->route('module.index');
    }
    public function delete($id){
        $module=Module::find($id);
        $module->delete();
        return redirect()->route('module.index');
    }

    public function show(Module $module)
{
    // ... (autres logiques)

    return view('modules.show', compact('module', 'moduleProgress'));
}


public function updateProgress()
{
    $moduleId = $request->input('module_id');
    $coursId = $request->input('cours_id');

    return response()->json(['message' => 'Progression mise à jour avec succès']);
}
}
