@extends('layouts.admin')
@section('content')
    @include('includes.alerts.messages')
    <div id="pills-tabContent" class="tab-content reset-tab-content">
        <div class="tab-pane fade show active" id="pills-female" role="tabpanel" aria-labelledby="pills-female-tab">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <h4 class="card-title mb-0">
                                @lang('contacts.label.contact_list')
                            </h4>
                        </div>
                    </div><!--row-->

                    <div class="row mt-4">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.general.id')</th>
                                        <th>@lang('users.label.email')</th>
                                        <th>@lang('contacts.label.title')</th>
                                        <th>@lang('contacts.label.content')</th>
                                        <th>@lang('contacts.label.status')</th>
                                        <th>@lang('point.label.date_time')</th>
                                        @can('edit_contact')
                                        <th></th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($contacts))
                                        @foreach($contacts as $contact)
                                            <tr>
                                                <td>{{ $contact->id }}</td>
                                                <td>{{ !empty($contact->user) ? $contact->user->email : '' }}</td>
                                                <td>{{  $contact->title }}</td>
                                                <td>{{  $contact->content }}</td>
                                                <td>{{  $contact->name_status }}</td>
                                                <td>{{  $contact->created_at }}</td>
                                                @can('edit_contact')
                                                <td><a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-success mb-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </td>
                                                @endcan
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div><!--col-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-7">
                            <div class="float-left">
                                @if(!empty($contacts))
                                    {{ __('labels.general.total_number', ['total_number' => $contacts->total()]) }}
                                @endif
                            </div>
                        </div><!--col-->

                        <div class="col-5">
                            <div class="float-right">
                                {!! $contacts->render() !!}
                            </div>
                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

            </div>
        </div>
    </div>

@endsection
@section('pagespecificscripts')
    {!! script(('assets/admin/js/fixScrollHeader.js')) !!}
@stop


