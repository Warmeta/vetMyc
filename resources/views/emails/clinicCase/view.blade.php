@component('mail::message')
# Nº de Caso: {{ $clinic->number_clinic_history }}

**Referencia del animal :  ** {{ $clinic->ref_animal }}

**Especie:  **{{ $clinic->specie }}

**Raza:  ** {{ $clinic->breed }}

**Sexo:  ** {{ $clinic->sex }}

**Propiedad:  ** {{ $clinic->owner }}

**Edad:  ** {{ $clinic->age }}

**Historial Clínico:  **
{{ $clinic->clinic_history }}

**Muestra:  **
{{ $clinic->sample }}

**Localización:  **
{{ $clinic->localization }}

**Bacterioscopia:  **
{{ $clinic->bacterioscopy }}

**Tricograma:  **
{{ $clinic->trichogram }}

**Cultivo:  **
{{ $clinic->culture }}

**Aislamiento bacteriano:  **
{{ $clinic->bacterial_isolate }}

**Aislamiento fúngico:  **
{{ $clinic->fungi_isolate }}

@component('mail::table')
<table id="dataTable" class="row table table-hover">
    <thead>
    <tr>
        <th></th>
        <th>Sensible</th>
        <th>Intermedio</th>
        <th>Resistente</th>
    </tr>
    </thead>
    <tbody>

    @foreach($clinicantibiotics as $antibiotic)
        @if(($antibiotic->resistant != null) || ($antibiotic->intermediate != null) || ($antibiotic->sensitive != null))
            <tr>
                <td>
                    <div class="readmore">{{ $antibiotic->antibiotic_name }}</div>
                </td>
                @if($antibiotic->sensitive != null)
                    <td style="text-align: center;">
                        <!-- sensitive -->
                        X
                    </td>
                @else
                    <td>
                        <!-- sensitive -->
                    </td>
                @endif
                @if($antibiotic->intermediate != null)
                    <td style="text-align: center;">
                        <!-- intermediate -->
                        X
                    </td>
                @else
                    <td>
                        <!-- intermediate -->
                    </td>
                @endif
                @if($antibiotic->resistant != null)
                    <td style="text-align: center;">
                        <!-- resistant -->
                        X
                    </td>
                @else
                    <td>
                        <!-- resistant -->
                    </td>
                @endif
            </tr>
        @endif
    @endforeach

    </tbody>
</table>
@endcomponent

**Comentarios:  **
{{ $clinic->comment }}

@component('mail::button', ['url' => 'vetmyc.herokuapp.com'])
vetMyc
@endcomponent

Thanks,<br>
{{ config('app.name') }}, ULPGC
@endcomponent
