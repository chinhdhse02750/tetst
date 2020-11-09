<div role="group">
    @if($user->deleted_at === null)
        <a href="{{ route('member.edit', ['id'=>$user['id'], 'type_user'=> $user->type_name]) }}"
           class="btn btn-success mb-1"><i class="fas fa-pencil-alt"></i></a>
    @endif
    @can('leave_user')
        {!! $user->button_leave_member !!}
    @endcan
    @if($user->deleted_at === null)
        <a href="{{ route('member.point-send', ['id'=>$user['id'], 'type_user'=> $user->type_name]) }}"
           class="btn btn-warning mb-1"
           data-toggle="tooltip" data-placement="top" title="@lang('users.label.point_award')"> P </a>
    @endif
</div>
