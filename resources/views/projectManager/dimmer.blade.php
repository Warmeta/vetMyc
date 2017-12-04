<div id="dimmer-{{ $project_id }}" class="panel widget center bgimage" style="margin-bottom:0;overflow:hidden;background-image:url('{{ $image }}');">
    <div class="dimmer">
      @if (Voyager::can('read_projects'))
      <div class="col-xs-3 pull-left"><a href="/project-manager/{{$project_id}}"><i id="folder-icon" class='icon voyager-folder'></i></a></div>
      @endif
      <div id="RUD" class="col-xs-3 pull-right">
        @if (Voyager::can('edit_projects'))
        <a href="/project-manager/{{$project_id}}/edit"><i class='icon voyager-pen'></i></a>
        @endif
        @if (Voyager::can('delete_projects'))
        <a title="Delete" class="delete-project" data-id="{{ $project_id }}" id="delete-{{ $project_id }}" data-route="./project-manager/delete/" data-token="{{ csrf_token() }}">
          <i class='icon voyager-x'></i>
        </a>
        @endif
      </div>
    </div>
    <div class="panel-content">
        <div class="col-xs-8 col-xs-offset-2"><h4>{{ $project_name }}</h4>
        <p>{{ $project_type }}</p></div>
    </div>
</div>
