<div id="dimmer-{{ $project_id }}" class="panel widget center bgimage" style="margin-bottom:0;overflow:hidden;background-image:url('{{ $image }}');">
    <div class="dimmer">
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
    @if (Voyager::can('read_projects'))
    <div class="panel-content">
        <a href="/project-manager/{{$project_id}}">
          <div class="col-xs-8 col-xs-offset-2"><h4>{{ $project_name }}</h4>
          <p>{{ $project_type }}</p></div>
        </a>
      </div>
    @endif
</div>
