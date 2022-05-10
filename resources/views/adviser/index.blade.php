@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">

        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">{{ __("Autores") }}</h3>
                    </div>
                    <div class="col text-right">
                        <a href="{{ route('author.create') }}" class="btn btn-sm btn-success">Nuevo</a>
                        {{-- <a href="{{ route('generate-pdf',['download'=>'pdf']) }}" class="btn btn-sm btn-success"> <i class="ni ni-cloud-download-95"></i></a> --}}
                    </div>


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
                            <td>
                                {{ $adviser->id }}
                            </td>
                            <td>
                                {{ $adviser->full_name }}
                            </td>
                            <td>
                                {{ $adviser->faculty }}
                            </td>
                            <td>
                                {{ $adviser->email }}
                            </td>
                            <td>
                                {{ $adviser->orcid }}
                            </td>
                            <td>
                                <div class="dropdown">

                                    <a href="#" type="button"
                                        class="btn btn-primary">Editar</a>
                                        <a href="#" type="button"
                                        class="btn btn-danger">Eliminar</a>

                                </div>

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
