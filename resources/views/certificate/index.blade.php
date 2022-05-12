@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

    <div class="container-fluid mt--7">

        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">{{ __("Certificados") }}</h3>
                    </div>
                    <form class="form-inline" {{ route('certificate.index') }} method="get">
                        <input class="form-control mr-sm-2" type="search" name="data" placeholder="Busca por codigo"
                            aria-label="Search">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                    <div class="col text-right">
                        <a href="{{ route('certificate.create') }}" class="btn btn-sm btn-success">Nuevo</a>
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
                            <th scope="col">Nº</th>
                            <th scope="col">Title</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Asesor</th>
                            <th scope="col">Programa</th>
                            <th scope="col">Facultad</th>
                            <th scope="col">Originalidad</th>
                            <th scope="col">Similitud</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Observación</th>
                            <th scope="col">OPC</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($certificates as $certificate)
                        <tr>
                            <td class="text-center">
                                {{ $certificate->id }}
                            </td>
                            <td class="text-center">
                                {{ $certificate->title }}
                            </td>
                            <td class="text-center">
                                {{ $certificate->authors->full_name }}
                            </td>
                            <td class="text-center">
                                {{ $certificate->advisers->full_name }}

                            </td>
                            <td class="text-center">
                                {{ $certificate->program }}
                            </td>
                            <td class="text-center">
                                {{ $certificate->faculty }}
                            </td>
                            <td class="text-center">
                                {{ $certificate->originality }}
                            </td>
                            <td class="text-center">
                                {{ $certificate->similitude }}
                            </td>
                            <td class="text-center">
                                {{ $certificate->date }}
                            </td>
                            <td class="text-center">
                                {{ str_pad($certificate->id,4,'0', STR_PAD_LEFT ) }}-{{ now()->year }}
                            </td>
                            <td class="text-center">
                               @if ($certificate->observation == NULL)
                                -
                                @else
                                {{ $certificate->observation }}
                               @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <form action="{{ route('certificate.destroy', $certificate) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('certificate.edit', $certificate) }}" class="btn btn-sm btn-primary">Editar</a>
                                        {{-- <button type="submit" class="btn btn-sm btn-danger">Eliminar</button> --}}
                                        <input
                                        type="submit"
                                        value="Elminar"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Desea elimiar..?')"
                                    >

                                    </form>

                                    <a href="{{ route('certificate.report', ['download' => 'pdf','certificate' => $certificate]) }}"  class="btn btn-sm btn-primary">
                                        <i class="ni ni-cloud-download-95"></i>

                                    </a>
                                </div>

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-body">
                    {{ $certificates->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
