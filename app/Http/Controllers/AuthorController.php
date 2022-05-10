<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use \Barryvdh\DomPDF\Facade\Pdf  as PDF;
use Carbon\Carbon;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::orderByDesc('id')->paginate(5);
        return view('author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAuthorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules =[
            'dni' => 'required|min:3',
        ];

        $this->validate($request, $rules);
        $author = new Author();
        $author->dni = $request->input('dni');
        $author->full_name = $request->input('fullName');
        $author->n_boucher = $request->input('n_boucher');
        $author->amount_paid = $request->input('amount_paid');
        $author->program = $request->input('program');
        $author->save();

        $notification = 'Author registrado correctamente';
        return redirect('author')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {

        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuthorRequest  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $authorTitle = $author->tile;
        $author->delete();

        $notification = "El autor $authorTitle se elimino correctamente.";
        return redirect('author')->with(compact('notification'));
    }
    public function report(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $authors = Author::whereBetween('created_at',
        [
            $startDate.$this->ceroTime(),
            $endDate.$this->midNightTime()
        ])->get();
             view()->share('authors', $authors);
                    if($request->has('download')){
                        PDF::setOptions(['dpi' => '150','defaultFont' => 'sans-serif']);
                        $pdf = PDF::loadView('author.pdf');
                        $pdf->setPaper('a4', 'landscape');
                        return $pdf->download('autores.pdf');
                    }
                    return view('author.pdf');
    }
    private function convertCarbon($date){
        $carbonDateTime = new Carbon($date);
        $carbonDateTime->format('Y-m-d');
        return $carbonDateTime;
    }
    private function ceroTime(){
        return " 00:00:00";
    }
    private function midNightTime(){
        return " 23:59:59";
    }
}
