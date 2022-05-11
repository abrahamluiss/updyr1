<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Models\Adviser;
use App\Models\Author;
use App\Models\Certificate;
use Illuminate\Http\Request;
use \Barryvdh\DomPDF\Facade\Pdf  as PDF;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name  = $request->input('data');
        $dni = $request->input('data');

        $certificates = Certificate::where('id', 'LIKE', '%' . $name . '%')
            ->orderByDesc('id')
            // ->orWhere('fatherLastName', 'LIKE', '%' . $fatherLastName . '%')
            ->paginate(3);
        // $certificates = Certificate::orderByDesc('id')->paginate(5);
        return view('certificate.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::get();
        $advisers = Adviser::get();

        return view('certificate.create',compact('authors', 'advisers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCertificateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authorId = $request->input('author');
        $chain1 = $authorId;
        $separator1 = "-";
        $separatedAuthor = explode($separator1, $chain1);

        $advisersId = $request->input('adviser');
        $chain = $advisersId;
        $separator = "-";
        $separatedAdviser = explode($separator, $chain);

        $certificate = new Certificate();
        $certificate->title = $request->input('title');
        $certificate->author_id = (int)$separatedAuthor[0];
        $certificate->adviser_id = (int)$separatedAdviser[0];
        $certificate->program = $request->input('program');
        $certificate->faculty = $request->input('faculty');
        $certificate->originality = $request->input('originality');
        $certificate->similitude = $request->input('similitude');
        $certificate->date = $request->input('date');
        $certificate->observation = $request->input('observation');
        $certificate->save();

        if ($certificate) {

            $notification = 'El certificado se ha registrado correctamente!';
        } else {
            $notification = 'Ocurrio un problema al registrar el certificado.';
        }
        return redirect('certificate')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function show(Certificate $certificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        $authors = Author::get();
        $advisers = Adviser::get();
        return view('certificate.edit', compact('certificate', 'authors', 'advisers'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCertificateRequest  $request
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certificate $certificate)
    {
        $authorId = $request->input('author');
        $chain1 = $authorId;
        $separator1 = "-";
        $separatedAuthor = explode($separator1, $chain1);

        $advisersId = $request->input('adviser');
        $chain = $advisersId;
        $separator = "-";
        $separatedAdviser = explode($separator, $chain);

        $certificate =Certificate::find($certificate->id);
        $certificate->title = $request->input('title');
        $certificate->author_id = (int)$separatedAuthor[0];
        $certificate->adviser_id = (int)$separatedAdviser[0];
        $certificate->program = $request->input('program');
        $certificate->faculty = $request->input('faculty');
        $certificate->originality = $request->input('originality');
        $certificate->similitude = $request->input('similitude');
        $certificate->date = $request->input('date');
        $certificate->observation = $request->input('observation');
        $certificate->update();

        if ($certificate) {

            $notification = 'El certificado se ha actualizado correctamente!';
        } else {
            $notification = 'Ocurrio un problema al registrar el certificado.';
        }
        return redirect('certificate')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificate $certificate)
    {
        $certificateTitle = $certificate->tile;
        $certificate->delete();

        $notification = "El certificado $certificateTitle se elimino correctamente.";
        return redirect('certificate')->with(compact('notification'));
    }
    public function reportCertificate(Request $request)
    {
        $certificate = Certificate::findOrFail($request->input('certificate'));
        view()->share(['certificate' => $certificate]);
        if($request->has('download')){
            PDF::setOptions(['dpi' => '150','defaultFont' => 'sans-serif']);
            $pdf = PDF::loadView('certificate.pdf');
            $pdf->setPaper('a4');
            return $pdf->stream('certificado.pdf');
        }
        return view('certificate.pdf');
    }
}
