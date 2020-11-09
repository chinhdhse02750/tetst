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
                                @lang('contacts.label.contact_edit')
                            </h4>
                        </div>
                    </div><!--row-->

                    <form id="contact-form" action="{{ route('contact.update', $contact->id) }}"
                          method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="login-form" value="true">
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group row flex-group">
                                <div class="col-md-12">
                                    <div class="mt-4 mb-4">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="contact-id"
                                                       class="col-md-2 form-control-label">@lang('labels.general.id')</label>
                                                <div class="col-md-5">
                                                    <input type="text" id="contact-id"
                                                           class="form-control"
                                                           value="{{ $contact->id }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="title"
                                                       class="col-md-2 form-control-label">@lang('contacts.label.title')</label>
                                                <div class="col-md-5">
                                                    <input type="text" id="title"
                                                           class="form-control"
                                                           value="{{ $contact->title }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="content"
                                                       class="col-md-2 form-control-label">@lang('contacts.label.content')</label>
                                                <div class="col-md-5">
                                                    <textarea id="content" name="content" rows="5" cols="55" disabled>  {{ $contact->content }}
                                                    </textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label"
                                                       for="status">@lang('contacts.label.status')
                                                </label>
                                                <div class="col-md-2">
                                                    <select class="custom-select" name="status" id="status">
                                                        @foreach($contactOption['status'][App::getLocale()] as $key => $value)
                                                            @if ($contact->status == $key)
                                                                <option value="{{ $key }}"
                                                                        selected> {{ $value }}</option>
                                                            @else
                                                                <option value="{{ $key }}"> {{ $value }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div><!--col-->
                                            </div><!--form-group-->

                                        </div>
                                    </div> <!-- /form -->
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-center">
                                    <input type="submit" class="btn btn-primary mr-1 btn-action"
                                           id="change-login" value="@lang('labels.general.update')"/>
                                    <a href="{{ route('contact.index') }}"
                                       class="btn btn-danger btn-action">@lang('labels.general.cancel')</a>
                                </div>
                            </div> <!--row-->
                        </div>
                    </form>
                </div><!--card-body-->

            </div>
        </div>
    </div>

@endsection
@section('pagespecificscripts')
    {!! script(('assets/admin/js/fixScrollHeader.js')) !!}
@stop


