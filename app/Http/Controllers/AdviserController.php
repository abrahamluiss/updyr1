<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdviserRequest;
use App\Http\Requests\UpdateAdviserRequest;
use App\Imports\AdvisersImport;
use App\Models\Adviser;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdviserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $advisers = Adviser::orderByDesc('id')->paginate(5);
        $name  = $request->input('data');
        $dni = $request->input('data');

        $advisers = Adviser::where('full_name', 'LIKE', '%' . $name . '%')
            ->orderByDesc('id')
            ->orWhere('dni', 'LIKE', '%' . $dni . '%')
            // ->orWhere('fatherLastName', 'LIKE', '%' . $fatherLastName . '%')
            ->paginate(10);
        return view('adviser.index', compact('advisers'));
    }
    public function importAdviser(Request $request)
    {

        $file = $request->file('file');
        // dd($file);
        Excel::import(new AdvisersImport, $file);
        $notification = 'Archivo importado correctamente';
        return redirect('adviser')->with(compact('notification'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adviser.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdviserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =[
            'dni' => 'required|min:3',
        ];

        $this->validate($request, $rules);
        $adviser = new Adviser();
        $adviser->dni = $request->input('dni');
        $adviser->full_name = $request->input('fullName');
        $adviser->faculty = $request->input('faculty');
        $adviser->email = $request->input('email');
        $adviser->orcid = $request->input('orcid');
        $adviser->save();

        $notification = 'Asesor registrado correctamente';
        return redirect('adviser')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adviser  $adviser
     * @return \Illuminate\Http\Response
     */
    public function show(Adviser $adviser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adviser  $adviser
     * @return \Illuminate\Http\Response
     */
    public function edit(Adviser $adviser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdviserRequest  $request
     * @param  \App\Models\Adviser  $adviser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdviserRequest $request, Adviser $adviser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adviser  $adviser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adviser $adviser)
    {
        $adviserTitle = $adviser->tile;
        $adviser->delete();

        $notification = "El asesor $adviserTitle se elimino correctamente.";
        return redirect('adviser')->with(compact('notification'));
    }
}
