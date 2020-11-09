<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <div class="section-description">
                        {{ __('offers.label.owned_point_des', ['point' => Auth::user()->total_amount_label]) }}
                    </div>
                </h5>
            </div>
            <div class="modal-body">
                <div class="form-check form-check-inline">
                    <input type="hidden" class="form-check-input" id="materialInline1" name="payment_method" value="0">
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio"
                           class="form-check-input"
                           data-waschecked="false"
                           id="materialInline2"
                           name="payment_method"
                           value="1"
                           @if(!empty($dataRequestOffer['payment_method'])
                            && (int)$dataRequestOffer['payment_method'] === \App\Helpers\Constants::BANK_TRANSFER) checked @endif>
                    <label class=" section-description form-check-label mr-3" for="materialInline2">@lang('offers.label.bank_transfer')</label>

                    <input type="radio"
                           class="form-check-input"
                           id="materialInline3"
                           name="payment_method"
                           value="2"
                           @if(!empty($dataRequestOffer['payment_method'])
                           && (int)$dataRequestOffer['payment_method'] === \App\Helpers\Constants::PAY_PAL) checked @endif>
                    <label class="section-description form-check-label" for="materialInline3">@lang('offers.label.paypal')</label>
                </div>
                <div class="message-paypal d-none">@lang('offers.label.offer_des')</div>
            </div>
            <div class="modal-footer"  style="display: block">
                <div class="d-flex float-left">
                    <button type="button"
                            id="button-payment"
                            class="btn btn-outline-secondary w-100px btn-outline-secondary section-fontsize">
                        @lang('offers.label.next')</button>
                </div>
            </div>
        </div>
    </div>
</div>
