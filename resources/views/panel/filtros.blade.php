@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-primary fw-bold">Grupos</h1>
    <div>
        <form action="{{ route('panel.filtros') }}" method="GET" class="d-inline">
            <label for="perPage" class="me-2">Mostrar:</label>
            <select name="perPage" id="perPage" class="form-select d-inline w-auto" onchange="this.form.submit()">
                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
            </select>
        </form>
    </div>
</div>

        <!-- Pestañas para Grupos y Subgrupos -->
        <ul class="nav nav-tabs" id="filtrosTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="grupos-tab" data-bs-toggle="tab" data-bs-target="#grupos" type="button" role="tab" aria-controls="grupos" aria-selected="true">
                    Grupos
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="subgrupos-tab" data-bs-toggle="tab" data-bs-target="#subgrupos" type="button" role="tab" aria-controls="subgrupos" aria-selected="false">
                    Subgrupos
                </button>
            </li>
        </ul>

        <!-- Contenido de las pestañas -->
        <div class="tab-content" id="filtrosTabsContent">
            <!-- Pestaña de Grupos -->
            <div class="tab-pane fade show active" id="grupos" role="tabpanel" aria-labelledby="grupos-tab">
                @include('panel.filtros.grupos', ['grupos' => $grupos])
            </div>

            <!-- Pestaña de Subgrupos -->
            <div class="tab-pane fade" id="subgrupos" role="tabpanel" aria-labelledby="subgrupos-tab">
                @include('panel.filtros.subgrupos', ['subgrupos' => $subgrupos])
            </div>
        </div>
    </div>
@endsection