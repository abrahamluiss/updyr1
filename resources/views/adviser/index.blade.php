@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">

        <div class="card shadow">
            <nav class="navbar navbar-light bg-light justify-content-between">
                <a class="navbar-brand">Asesores</a>
                <form class="form-inline" {{ route('adviser.index') }} method="get">
                    <input class="form-control mr-sm-2" type="search" name="data" placeholder="Busca nombre o dni"
                        aria-label="Search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
                </form>

                <a href="{{ route('adviser.create') }}" class="btn btn-sm btn-success">Nuevo</a>

            </nav>
            <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                  <label class="custom-file-label" for="inputGroupFile04">Escoger archivos excel</label>
                </div>
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Subir</button>
                </div>
              </div>
            <div class="card-body">
                @if (session('notification'))
                    <div class="alert alert-success" role="alert">
                        {{ session('notification') }}
                    </div>
                @endif
            </div>

            <div class="table-responsive">
                <!-- Specialities table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">
                                Nº
                            </th>
                            <th class="text-center">
                                Nombres
                            </th>
                            <th class="text-center">
                                Dni
                            </th>
                            <th class="text-center">
                                Facultad
                            </th>
                            <th class="text-center">
                                Orcid
                            </th>
                            <th class="text-center">
                                OPC
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($advisers as $adviser)
                            <tr>
                                <td class="text-center">
                                    {{ $adviser->id }}
                                </td>
                                <td class="text-center">

                                    {{ $adviser->full_name }}
                                </td>
                                <td class="text-center">

                                    {{ $adviser->faculty }}
                                </td>
                                <td class="text-center">

                                    {{ $adviser->email }}
                                </td>
                                <td class="text-center">

                                    {{ $adviser->orcid }}
                                </td>
                                <td class="text-center">

                                    <form action="{{ route('adviser.destroy', $adviser) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('adviser.edit', $adviser) }}" class="btn btn-sm btn-primary">Editar</a>
                                        {{-- <button type="submit" class="btn btn-sm btn-danger">Eliminar</button> --}}
                                        <input
                                        type="submit"
                                        value="Elminar"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Desea elimiar..?')"
                                    >

                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush