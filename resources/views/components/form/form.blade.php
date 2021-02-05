@props(['action', 'class', 'method', 'files'])
<form 
    method="{{ strtoupper($method) !== 'GET' ? 'POST' : 'GET' }}" 
    action="{{ $action }}" 
    class="{{ $class ?? '' }}" 
    {{ ($files ?? false) ? "enctype=multipart/form-data" : null }} 
    {{ $attributes }}
>
    @csrf
    @method($method ?? 'POST')

    {{ $slot }}
</form>