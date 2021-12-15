@props(['disabled' => false])

<select style="appearance:auto" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md
    form-input shadow-sm
    border-gray-400 focus:border-indigo-400 focus:ring border border-opacity-90
    focus:ring-primary-100 focus:ring-opacity-50']) !!}>
    {{$slot}}
</select>