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
                            <th class="text-center">OPC</th>
                            <th class="text-center">Nº</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Autor</th>
                            <th class="text-center">Asesor</th>
                            <th class="text-center">Programa</th>
                            <th class="text-center">Facultad</th>
                            <th class="text-center">Originalidad</th>
                            <th class="text-center">Similitud</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Codigo</th>
                            <th class="text-center">Observación</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php

                        {{ $i=1; }}
                    @endphp
                    @while ($i<=count($certificates))
                        @foreach ($certificates as $certificate)
                        <tr>
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

                                    <a href="{{ route('certificate.report', ['download' => 'pdf','certificate' => $certificate]) }}" target="_blank" class="btn btn-sm btn-primary" title="Descargar">
                                        <i class="ni ni-cloud-download-95"></i>

                                    </a>
                                </div>

                            </td>
                            <td class="text-center">
                                {{ $i++ }}
                            </td>

                            <td class="text-center" title="{{ $certificate->title }}">
                                {{ Str::limit( $certificate->title, 10, $end = '...') }}

                            </td>
                            <td class="text-center" title="{{ $certificate->authors->full_name }}">
                                {{ Str::limit( $certificate->authors->full_name, 10, $end = '...') }}

                                @if ($certificate->authorSecond == NULL)

                                @else
                                <br> y  {{ Str::limit( $certificate->authorSecond->full_name, 10, $end = '...') }}
                                @endif
                            </td>
                            <td class="text-center" title="{{ $certificate->advisers->full_name }}">
                                {{ Str::limit( $certificate->advisers->full_name, 10, $end = '...') }}

                            </td>
                            <td class="text-center">
                                {{ $certificate->program }}
                            </td>
                            <td class="text-center" title="{{ $certificate->faculty }}">
                                {{ Str::limit( $certificate->faculty, 10, $end = '...') }}
                            </td>
                            <td class="text-center">
                                {{ $certificate->originality }}%
                            </td>
                            <td class="text-center">
                                {{ $certificate->similitude }}%
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

                        </tr>
                        @endforeach
                    @endwhile
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
