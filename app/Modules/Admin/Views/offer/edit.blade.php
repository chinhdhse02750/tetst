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
                                @lang('offers.label.edit')
                            </h4>
                        </div>
                    </div><!--row-->

                    <form id="contact-form" action="{{ route('offers.update', $offer->id) }}"
                          method="POST">
                        {{ csrf_field() }}
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
                                                           value="{{ $offer->id }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label"
                                                       for="status">@lang('offers.label.payment_method')
                                                </label>
                                                <div class="col-md-2">
                                                    @foreach($settingMember['payment_method'][App::getLocale()] as $key => $value)
                                                        @if($key === (int)$offer->payment_method)
                                                            <input type="text"
                                                                   class="form-control"
                                                                   value="{{ $value }}" disabled>
                                                        @endif
                                                    @endforeach
                                                </div><!--col-->
                                            </div><!--form-group-->
                                            @if((int)$offer->payment_method === \App\Helpers\Constants::PAY_PAL &&
                                             (int)$offer->status !== \App\Helpers\Constants::APPROVE)
                                                <div class="form-group row">
                                                    <label for="title"
                                                           class="col-md-2 form-control-label">@lang('offers.label.payment_link')</label>
                                                    <div class="col-md-5">
                                                        <a href="{{ $offer->payment_link }}" id="paypal-link-area" name="payment_link">
                                                            {{ $offer->payment_link }}
                                                        </a>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <button type="button" class="btn btn-secondary"
                                                                id="generate-payment-link">@lang('offers.label.generate_link')
                                                        </button>

                                                        <button type="button" class="btn btn-secondary"
                                                                id="coppy-payment-link">@lang('offers.label.copy_link')
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label"
                                                       for="status">@lang('contacts.label.status')
                                                </label>
                                                <div class="col-md-2">
                                                    <select class="custom-select" name="status" id="status">
                                                        @foreach($settingMember['offer_status'][App::getLocale()] as $key => $value)
                                                            @if ($offer->status == $key)
                                                                <option value="{{ $key }}"
                                                                        selected> {{ $value }}</option>
                                                            @else
                                                                <option value="{{ $key }}"> {{ $value }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div><!--col-->
                                            </div><!--form-group-->


                                            @if((int)$offer->payment_method !== \App\Helpers\Constants::POINT)
                                                <div class="form-group row">
                                                    <label for="title"
                                                           class="col-md-2 form-control-label">@lang('offers.label.reject_message')</label>
                                                    <div class="col-md-5">
                                                  <textarea class="form-control" name="reject_message"
                                                            id="reject-message"
                                                            @if ((int)$offer->status !== \App\Helpers\Constants::REJECT) disabled @endif>{{ $offer->reject_message }}</textarea>
                                                    </div>
                                                </div>

                                                <input type="hidden" id="public_id"
                                                       value= {{ $offer->public_id }}>
                                                <input type="hidden" id="id"
                                                       value= {{ $offer->id }}>
                                                <input type="hidden" id="id-offer"
                                                       value= {!! json_encode($userOfferIds) !!}>
                                                <input type="hidden" id="url-gen-payment-link"
                                                       value="{{ route('offers.link-paypal') }}">

                                            @endif
                                            <input type="hidden" name="reject_message" id="reject-message-hidden" disabled>
                                        </div>
                                    </div> <!-- /form -->
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-center">
                                    <input type="submit" class="btn btn-primary mr-1 btn-action"
                                           id="change-login" value="@lang('labels.general.update')"/>
                                    <a href="{{ route('offers.index') }}"
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
    {!! script(('assets/admin/js/editOffer.js')) !!}
@stop
