<div id="dimmer-{{ $project_id }}" class="panel widget center bgimage" style="margin-bottom:0;overflow:hidden;background-image:url('{{ $image }}');">
    <div class="dimmer"></div>
    <div class="panel-content">
        <a href="/project-manager/{{$project_id}}"><i id="folder-icon" class='icon voyager-folder'></i></a>
        <div id="RUD">
            <a href="/project-manager/{{$project_id}}"><i class='icon voyager-eye'></i></a>
            <a href="/project-manager/{{$project_id}}/edit"><i class='icon voyager-pen'></i></a>
            <a title="Delete" class="delete-project" data-id="{{ $project_id }}" id="delete-{{ $project_id }}" data-route="./delete/" data-token="{{ csrf_token() }}">
                <i class='icon voyager-x'></i>
            </a>
        </div>
        <h4>{{ $project_name }}</h4>
        <p>{{ $project_type }}</p>
    </div>
</div>