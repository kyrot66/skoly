@extends('layouts.app')

@section('content')

    {{-- Title --}}
    <div class="row">
        <div class="col-md">
            <h2>Upravit město</h2>
        </div>
        <div class="col-md">
            <a class="btn btn-secondary float-right" href="{{ route('mesto.index') }}" title="Zpět">
                 {{ __('Zpět')}}
            </a>
        </div>
    </div><br>

    {{-- Error --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Se zadanými informacemi něco není v pořádku.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Edit form --}}
    <form action="{{ route('mesto.update', $mesto->id)}}" method="post">
        @csrf
        @method('put')

        {{-- nazev --}}
        <div class="form-group row">
            <label for="nazev" class="col-md-4 col-form-label text-md-right">{{ __('Název města') }}</label>
            <div class="col-md-6">
                <input type="text" name="nazev" id="nazev" class="form-control" placeholder="{{ $mesto->nazev }}" value="{{ $mesto->nazev }}">
            </div>
        </div>

        {{-- submit --}}
        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-2">
                <button type="submit" class="btn btn-secondary form-control"> {{ __('Upravit') }}</button>
            </div>
        </div>

    </form>

@endsection
