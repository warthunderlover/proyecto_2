<div {{--esto hace que los valores que estan dentro del array sean predeterminados, permitiendome cambiarlos en cualquier parte del codigo haciendo solo un <x-card class="valor"/>--}}{{$attributes->merge(['class'=> 'bg-gray-50 border border-gray-200 rounded p-6'])}}>

    {{$slot}}

</div>