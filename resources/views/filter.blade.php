@extends('layouts.app')

{{-- Body --}}
@section('content')

    {{-- Filter form --}}
    <form action="{{ route('index.filter') }}" method="get">
        <div class="row">
            <div class="col-md">
                <select name="skola" id="skola" class="form-control">
                    <option value="{{ __('*') }}">Školy</option>
                    @foreach ($skola as $s)
                        <option value="{{ $s->id }}" @if (request()->skola == $s->id) selected @endif>{{ $s->nazev }}</option>
                    @endforeach
                </select><br>
            </div>

            <div class="col-md">
                <select name="obor" id="obor" class="form-control">
                    <option value="{{ __('*') }}">Obor</option>
                    @foreach ($obor as $o)
                        <option value="{{ $o->id }}"  @if (request()->obor == $o->id) selected @endif>{{ $o->nazev }}</option>
                    @endforeach
                </select><br>
            </div>

            <div class="col-md">
                <select name="rok" id="rok" class="form-control">
                    <option value="{{ __('*') }}">Rok</option>
                    @foreach ($roky as $r)
                        <option value="{{ $r->rok }}"  @if (request()->rok == $r->rok) selected @endif>{{ $r->rok }}</option>
                    @endforeach
                </select><br>
            </div>

            <div class="col-md">
                <button type="submit" class="btn btn-secondary form-control">Filtrovat</button><br><br>
            </div>
        </div>
    </form>

    @if(!$pocet->isEmpty()) {{-- Has records --}}
        {{-- Table --}}
        <table class="table table-hover table-responsive-lg" style="text-align: center;">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle">Škola</th>
                    <th class="align-middle">Obor</th>
                    <th class="align-middle">Rok</th>
                    <th class="align-middle">Přijatých</th>
                </tr>
            </thead>
            @foreach ($pocet as $p)
                <tbody>
                    <tr>
                        <td class="align-middle">{{ $p->skola()->first()->nazev }}</td>
                        <td class="align-middle">{{ $p->obor()->first()->nazev }}</td>
                        <td class="align-middle">{{ $p->rok }}</td>
                        <td class="align-middle">{{ $p->pocet }}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>

        {{-- Pagination links --}}
        {{ $pocet->appends($_GET)->links('pagination::bootstrap-4') }}
    @else {{-- No records --}}
        <div class="alert alert-warning" style="text-align: center;">
            <h4>Žádné výsledky</h4>
        </div>
    @endif

    <div class="card">
        <p class="card-body" id="mapid"></p>
    </div><br>

@endsection

@section('styles')
    <style>
        #mapid {
            width: 100%;
            height: 400px;
            margin:0;
            padding:0;
            border: 1px solid gray;
            border-radius: 8px;
        }
    </style>
@endsection

@push('scripts')
    <script>
        var map = L.map('mapid').setView([49.2, 17.5], 8);
        map.invalidateSize();

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    </script>
    @foreach($search ?? App\Models\Skola::all() as $s)
        <script>
            var marker = L.marker([{{ $s->getAttribute('geo-lat') }}, {{ $s->getAttribute('geo-long') }}]).addTo(map);
            marker.bindPopup(`<b>{{ $s->nazev }}</b><br> {{ $s->mesto()->first()->nazev }}`).closePopup();
        </script>
    @endforeach
@endpush
