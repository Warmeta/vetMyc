@php
$count = count($projects);

$classes = [
    'col-xs-12',
    'col-sm-'.($count >= 2 ? '6' : '12'),
];
$class = implode(' ', $classes);
$prefix = "<div class='{$class}'>";
$surfix = '</div>';
@endphp
@if (!empty($projects))
<div class="row">
    @foreach($projects as $project)
        @php
        $image = $project->image;
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
