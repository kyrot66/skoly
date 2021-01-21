@extends('layouts.app')

@section('content')

    {{-- Title --}}
    <div class="row">
        <div class="col">
            <h2> {{ __('Města') }}</h2>
        </div>
        <div class="col">
            <a class="btn btn-success float-right" href="{{ route('mesto.create') }}" title="Vytvořit">
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
    <table class="table table-hover table-responsive-sm" style="text-align: center;">
        <thead class="thead-light">
            <tr>
                <th class="align-middle">#</th>
                <th class="align-middle">Název města</th>
                <th></th>
            </tr>
        </thead>
        @foreach ($mesto as $m)
        <tbody>
            <tr>
                <td class="align-middle">{{ $m->id }}</td>
                <td class="align-middle">{{ $m->nazev }}</td>
                <td class="align-middle">
                    <form action="{{ route('mesto.destroy', $m->id) }}" method="post">
                        <a href="{{ route('mesto.edit', $m->id) }}" title="Upravit záznam">
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
    {{ $mesto->links('pagination::bootstrap-4') }}
@endsection
