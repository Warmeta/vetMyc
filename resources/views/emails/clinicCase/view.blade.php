@component('mail::message')
# Clinic Case Nº: {{ $clinic->number_clinic_history }}

**Animal Ref :  ** {{ $clinic->ref_animal }}

**Specie:  **{{ $clinic->specie }}

**Breed:  ** {{ $clinic->breed }}

**Sex:  ** {{ $clinic->sex }}

**Owner:  ** {{ $clinic->owner }}

**Age:  ** {{ $clinic->age }}

**Clinic History:  **
{{ $clinic->clinic_history }}

**Sample:  **
{{ $clinic->sample }}

**Localization:  **
{{ $clinic->localization }}

**Bacterioscopy:  **
{{ $clinic->bacterioscopy }}

**Trichogram:  **
{{ $clinic->trichogram }}

**Culture:  **
{{ $clinic->culture }}

**Bacterial isolate:  **
{{ $clinic->bacterial_isolate }}

**Fungi isolate:  **
{{ $clinic->fungi_isolate }}

@component('mail::table')
<table id="dataTable" class="row table table-hover">
    <thead>
    <tr>
        <th></th>
        <th>Sensitive</th>
        <th>Intermediate</th>
        <th>Resistant</th>
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

**Comments:  **
{{ $clinic->comment }}

@component('mail::button', ['url' => 'vetmyc.dev:8000'])
vetMyc
@endcomponent

Thanks,<br>
{{ config('app.name') }}, ULPGC
@endcomponent