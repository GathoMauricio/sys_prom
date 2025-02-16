Se ha generado un proceso de {{ $proceso->tipo }}
<br>
Empleado: {{ $proceso->empleado->nombre }} {{ $proceso->empleado->apaterno }} {{ $proceso->empleado->amaterno }}
<br>
RFC: Empleado: {{ $proceso->empleado->rfc }}
<br>
Dirección: {{ $proceso->empleado->estado }} {{ $proceso->empleado->delegacion }}
{{ $proceso->empleado->cp }} {{ $proceso->empleado->reforma }} {{ $proceso->empleado->calle_numero }}
<br><br>
<a href="{{ route('seguimiento_empleado', base64_encode($proceso->empleado->rfc)) }}" target="_BLANK">
    IR AL SEGUIMIENTO
</a>
