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
                    <input type="hidden" name="activeTab" value="{{ $activeTab }}">
                </form>
            </div>
        </div>

        <!-- Pestañas para Grupos y Subgrupos -->
        <ul class="nav nav-tabs" id="filtrosTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $activeTab == 'grupos' ? 'active' : '' }}"
                   href="{{ route('panel.filtros', ['activeTab' => 'grupos', 'perPage' => $perPage]) }}">
                    Grupos
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $activeTab == 'subgrupos' ? 'active' : '' }}"
                   href="{{ route('panel.filtros', ['activeTab' => 'subgrupos', 'perPage' => $perPage]) }}">
                    Subgrupos
                </a>
            </li>
        </ul>

        <!-- Contenido de las pestañas -->
        <div class="tab-content" id="filtrosTabsContent">
            <!-- Pestaña de Grupos -->
            <div class="tab-pane fade {{ $activeTab == 'grupos' ? 'show active' : '' }}"
                 id="grupos" role="tabpanel" aria-labelledby="grupos-tab">
                @include('panel.filtros.grupos', ['grupos' => $grupos, 'activeTab' => $activeTab, 'perPage' => $perPage])
            </div>

            <!-- Pestaña de Subgrupos -->
            <div class="tab-pane fade {{ $activeTab == 'subgrupos' ? 'show active' : '' }}"
                 id="subgrupos" role="tabpanel" aria-labelledby="subgrupos-tab">
                @include('panel.filtros.subgrupos', ['subgrupos' => $subgrupos, 'activeTab' => $activeTab, 'perPage' => $perPage])
            </div>
        </div>
    </div>
@endsection
