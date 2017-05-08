@php
$count = count($projects);

$classes = [
    'col-xs-12',
    'col-sm-'.($count >= 2 ? '6' : '12'),
    'col-md-'.($count >= 3 ? '4' : ($count >= 2 ? '6' : '12')),
];
$class = implode(' ', $classes);
$prefix = "<div class='{$class}'>";
$surfix = '</div>';
@endphp
@if (!empty($projects))
<div class="clearfix container-fluid row">
    @foreach($projects as $project)
        @php
        $image =  URL::to('/').'/storage/'.$project->image;
        $project_name = $project->project_name;
        $project_type = $project->project_type;
        $project_id = $project->id;
        @endphp
        {!! $prefix !!}
            @include('projectManager.dimmer')
        {!! $surfix !!}
    @endforeach
</div>
@endif