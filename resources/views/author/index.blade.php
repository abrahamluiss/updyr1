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
                                Nº Boucher
                            </th>
                            <th class="text-center">
                                Monto Pagado
                            </th>
                            <th class="text-center">
                                Programa
                            </th>
                            <th class="text-center">
                                OPC
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $author)
                        <tr>
                            <td class="text-center">
                                {{ $author->id }}
                            </td>
                            <td class="text-center">
                                {{ $author->full_name }}
                            </td>
                            <td class="text-center">
                                {{ $author->dni }}
                            </td>
                            <td class="text-center">
                                {{ $author->n_boucher }}
                            </td>
                            <td class="text-center">
                                {{ $author->amount_paid }}
                            </td>
                            <td class="text-center">
                                {{ $author->program }}
                            </td>
                            <td class="text-center">
                                <div class="dropdown">

                                    <form action="{{ route('author.destroy', $author) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('author.edit', $author) }}"
                                            class="btn btn-sm btn-primary">Editar</a>
                                        {{-- <button type="submit" class="btn btn-sm btn-danger">Eliminar</button> --}}
                                        <input type="submit" value="Elminar"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('¡SI ELIMINA UN AUTOR ELIMINARA LOS CERTIFICADOS ASOCIADOS A ESTE!')">

                                    </form>

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
