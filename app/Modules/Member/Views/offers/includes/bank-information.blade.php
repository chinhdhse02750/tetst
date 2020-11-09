<div class="modal fade" id="bankInformation" tabindex="-1" role="dialog" aria-labelledby="bankModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered bankInformation" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <div class="section-description">
                        @lang('banks.label.bank_des')
                    </div>
                </h5>
            </div>
            <div class="modal-body">
                <div class="box-bank-content">
                    <div class="form-check-block">
                        <label class="form-check-label" for="materialInline3">@lang('banks.label.name') : </label>
                        <label class="form-check-label" for="materialInline3">{{ !empty($bank->name) ? $bank->name : '' }}</label>
                    </div>
                    <div class="form-check-block">
                        <label class="form-check-label" for="materialInline3">@lang('banks.label.account_number')
                            : </label>
                        <label class="form-check-label" for="materialInline3">{{ !empty($bank->account_number) ? $bank->account_number : '' }}</label>
                    </div>
                    <div class="form-check-block">
                        <label class="form-check-label" for="materialInline3">@lang('banks.label.account_name')
                            : </label>
                        <label class="form-check-label" for="materialInline3">{{ !empty($bank->account_name) ? $bank->account_name : '' }}</label>
                    </div>
                    </br>
                    <div class="form-check-block">
                        <label class="form-check-label" for="materialInline3">@lang('banks.label.receipt_name')
                            : </label>
                        <label class="form-check-label" for="materialInline3">{{ !empty($bank->receipt_name) ? $bank->receipt_name : '' }}</label>
                    </div>
                </div>
                <div class="box-bank-des mt-3">
                    @lang('banks.label.bank_des_v1')
                </div>
            </div>
            <div class="modal-footer" style="display: block">
                <div class="d-flex">
                    <button type="button"
                            class="btn btn-outline-secondary  w-100px btn-outline-secondary section-fontsize"
                            data-dismiss="modal">
                        @lang('offers.label.close')</button>
                </div>
            </div>
        </div>
    </div>
</div>
