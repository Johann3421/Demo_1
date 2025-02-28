{{-- resources/views/partials/search.blade.php --}}
<form action="{{ route('search') }}" method="GET" class="search-form">
    <input type="text" name="query" placeholder="Buscar productos..." class="search-input" required>
    <button type="submit" class="search-button">Buscar</button>
</form>