@extends('layouts.app')
@section('content')
    <div class="header bg-gradient-primary pb-6 pt-5 pt-md-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Crear</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="/home"><i class="fas fa-home"></i></a></li>
                                {{-- <li class="breadcrumb-item"><a href="#">Pac</a></li> --}}
                                <li class="breadcrumb-item active" aria-current="page"><a
                                        href="{{ route('author.index') }}">Autores</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Crear</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ route('adviser.index') }}" class="btn btn-sm btn-neutral">Atras</a>
                        {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->

        <!-- Page content -->
        <div class="container-fluid mt--6">



            <div class="card shadow">

                {{-- form --}}
                <div class="card-body">
                    <form method="post" action="{{ route('author.store') }}">
                        @method('POST')
                        @csrf

                        <div class="form-group">
                            <label for="dni">DNI</label>
                            <input type="text" class="form-control" id="dni" aria-describedby="dni" name="dni"
                                autocomplete="off" placeholder="DNI" class="form-control-plaintext" required value="{{ old('dni') }}">
                        </div>

                        <div class="form-group">
                            <label for="fullName">Nombre Completo</label>
                            <input type="text" class="form-control" id="fullName" aria-describedby="fullName"
                                name="fullName" autocomplete="off" placeholder="Autor" class="form-control-plaintext"
                                value="{{ old('fullName') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="n_boucher">N?? Boucher</label>
                            <input type="text" class="form-control" id="n_boucher" aria-describedby="n_boucher"
                            name="n_boucher" autocomplete="off" placeholder="N?? Boucher"
                            class="form-control-plaintext" value="{{ old('n_boucher') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="amount_paid">Monto Pagado</label>
                            <input type="text" class="form-control" id="amount_paid" aria-describedby="amount_paid"
                            name="amount_paid" autocomplete="off" placeholder="Monto Pagado"
                            class="form-control-plaintext"required>
                        </div>

                        <div class="form-group">
                            <label for="program" >Programa</label>
                                <select class="form-control" name="program" >
                                    <option value="Bachiller">Bachiller</option>
                                    <option value="Titulo">Titulo</option>
                                    <option value="Segunda Especialidad">Segunda Especialidad</option>
                                    <option value="Complementaci??n Academica">Complementaci??n Academica</option>
                                    <option value="Maestria">Maestria</option>
                                    <option value="Doctorado">Doctorado</option>
                                </select>

                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>

            </div>


        </div>
    </div>



    </div>
@endsection
@push('js')
<script>
$('#amount_paid').keypress(function (tecla) {

    if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
        return false;
    }else {
             var len   = $('#amount_paid').val().length;
             var index = $('#amount_paid').val().indexOf('.');

             if (index > 0 && tecla.charCode == 46) {
                 return false;
             }

             if (index > 0) {
                 var CharAfterdot = (len + 1) - index;
                 if (CharAfterdot > 3) {
                     return false;
                 }
             }
    }

    return true;
});
</script>
@endpush
