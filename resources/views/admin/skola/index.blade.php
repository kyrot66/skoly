@extends('layouts.app')

@section('content')

    {{-- Title --}}
    <div class="row">
        <div class="col-md">
            <h2> {{ __('Školy') }}</h2>
        </div>
        <div class="col-md">
            <a class="btn btn-success float-right" href="{{ route('skola.create') }}" title="Vytvořit">
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
                <th class="align-middle">Název školy</th>
                <th class="align-middle">Město</th>
                <th class="align-middle">Lat</th>
                <th class="align-middle">Long</th>
                <th></th>
            </tr>
        </thead>
        @foreach ($skola as $s)
        <tbody>
            <tr>
                <td class="align-middle">{{ $s->id }}</td>
                <td class="align-middle">{{ $s->nazev }}</td>
                <td class="align-middle">{{ $s->mesto()->first()->nazev }}</td>
                <td class="align-middle">{{ $s->getAttribute('geo-lat') }}</td>
                <td class="align-middle">{{ $s->getAttribute('geo-long') }}</td>
                <td class="align-middle">
                    <form action="{{ route('skola.destroy', $s->id) }}" method="post">
                        <a href="{{ route('skola.edit', $s->id) }}" title="Upravit záznam">
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
    {{ $skola->links('pagination::bootstrap-4') }}
@endsection
