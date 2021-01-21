@extends('layouts.app')

@section('content')

    {{-- Title --}}
    <div class="row">
        <div class="col-md">
            <h2> {{ __('Přijatí uchazeči') }}</h2>
        </div>
        <div class="col-md">
            <a class="btn btn-success float-right" href="{{ route('pocet.create') }}" title="Vytvořit">
                 {{ __('Vytvořit')}}
            </a>
        </div>
    </div><br>

    {{-- Success (create, update, destroy) --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success" style="text-align: center;">
            <h4>{{ $message }}</h4>
        </div>
    @endif

    {{-- Table --}}
    <table class="table table-hover table-responsive-lg" style="text-align: center;">
        <thead class="thead-light">
            <tr>
                <th class="align-middle">#</th>
                <th class="align-middle">Škola</th>
                <th class="align-middle">Obor</th>
                <th class="align-middle">Rok</th>
                <th class="align-middle">Přijatých</th>
                <th></th>
            </tr>
        </thead>
        @foreach ($pocet as $p)
            <tbody>
                <tr>
                    <td class="align-middle">{{ $p->id }}</td>
                    <td class="align-middle">{{ $p->skola()->first()->nazev }}</td>
                    <td class="align-middle">{{ $p->obor()->first()->nazev }}</td>
                    <td class="align-middle">{{ $p->rok }}</td>
                    <td class="align-middle">{{ $p->pocet }}</td>
                    <td class="align-middle">
                        <form action="{{ route('pocet.destroy', $p->id) }}" method="post">
                            <a href="{{ route('pocet.edit', $p->id) }}" title="Upravit záznam">
                                Upravit
                            </a>

                            @csrf
                            @method('delete')

                            <button type="submit" title="Smazat záznam" style="border: none; background-color:transparent;">
                                Smazat
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>

    {{-- Pagination links --}}
    {{ $pocet->links('pagination::bootstrap-4') }}
@endsection
