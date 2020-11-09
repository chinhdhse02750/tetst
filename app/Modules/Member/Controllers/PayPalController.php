<?php

namespace App\Modules\Member\Controllers;

use App\Helpers\Constants;
use App\Repositories\OfferRepository;
use App\Repositories\PaymentsRepository;
use App\Repositories\UserOfferRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Session;

class PayPalController extends Controller
{
    /**
     * @var ExpressCheckout
     */
    protected $provider;

    /**
     * @var OfferRepository
     */
    protected $offerRepository;

    /**
     * @var PaymentsRepository
     */
    protected $paymentsRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository,
        OfferRepository $offerRepository,
        PaymentsRepository $paymentsRepository
    ) {
        $this->userRepository = $userRepository;
        $this->offerRepository = $offerRepository;
        $this->paymentsRepository = $paymentsRepository;
        $this->provider = new ExpressCheckout();
    }

    /**
     * @return RedirectResponse|Redirector|void
     */
    public function getExpressCheckout()
    {
        try {
            $invoiceId = uniqid();
            $cart = $this->getCheckoutData($invoiceId);
            $response = $this->provider->setCurrency(Constants::CURRENCY)->setExpressCheckout($cart);

            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order"]);

            return abort(404);
        }
    }

    /**
     * Process payment on PayPal.
     *
     * @param Request $request
     * @return RedirectResponse|void
     */
    public function getExpressCheckoutSuccess(Request $request)
    {
        try {
            $token = $request->get('token');
            $PayerID = $request->get('PayerID');
            $invoiceId = uniqid();
            $cart = $this->getCheckoutData($invoiceId);
            // Verify Express Checkout Token
            $response = $this->provider->setCurrency(Constants::CURRENCY)->getExpressCheckoutDetails($token);

            if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
                $public_id = Session::has('public_id') ? Session::get('public_id') : null;
                $offer = $this->offerRepository->findByField('public_id', $public_id)->first();
                $this->offerRepository->update(
                    ['payment_link_token' => null, 'payment_link_expired' => null],
                    $offer->id
                );

                // Perform transaction on PayPal
                $payment_status = $this->provider->setCurrency(Constants::CURRENCY)
                    ->doExpressCheckoutPayment($cart, $token, $PayerID);
                $responsePayments = $this->getDataResponse($payment_status, $offer->id);
                $this->paymentsRepository->create($responsePayments);

                return redirect()->route('paypal.purchase-success');
            }//end if
        } catch (\Exception $e) {
            session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order"]);

            return abort(404);
        }//end try
    }

    /**
     * Set cart data for processing payment on PayPal.
     *
     * @param string $invoiceID
     * @return array
     */
    protected function getCheckoutData(string $invoiceID)
    {
        $id = Session::has('ids') ? Session::get('ids') : null;
        $members = $this->userRepository->findWhereIn('id', $id);
        $data = [];
        $data['items'] = [];
        foreach ($members as $key => $value) {
            $member = [
                'name' => $value->userProfile->name,
                'price' => (int)$value->userProfile->rank_amount,
                'qty' => 1
            ];
            $data['items'][] = $member;
        }
        $data['return_url'] = url('/paypal/ec-checkout-success');
        $data['invoice_id'] = $invoiceID;
        $data['invoice_description'] = "Payment for #{$invoiceID}";
        $data['cancel_url'] = url('/');

        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $data['total'] = $total;

        return $data;
    }

    /**
     * @return Factory|View
     */
    public function purchaseSuccess()
    {
        return view('paypal.success');
    }

    /**
     * @param array $data
     * @param int $id
     * @return array
     */
    public function getDataResponse(array $data, int $id)
    {
        return [
            'offer_id' => $id,
            'transaction_id' => $data['PAYMENTINFO_0_TRANSACTIONID'] ? $data['PAYMENTINFO_0_TRANSACTIONID'] : "",
            'transaction_type' => $data['PAYMENTINFO_0_TRANSACTIONTYPE'] ? $data['PAYMENTINFO_0_TRANSACTIONTYPE'] : "",
            'payment_type' => $data['PAYMENTINFO_0_PAYMENTTYPE'] ? $data['PAYMENTINFO_0_PAYMENTTYPE'] : "",
            'payment_amount' => $data['PAYMENTINFO_0_AMT'] ? $data['PAYMENTINFO_0_AMT'] : "",
            'payment_fee' => $data['PAYMENTINFO_0_FEEAMT'] ? $data['PAYMENTINFO_0_FEEAMT'] : "",
            'payment_tax' => $data['PAYMENTINFO_0_TAXAMT'] ? $data['PAYMENTINFO_0_TAXAMT'] : "",
            'currency_code' => $data['PAYMENTINFO_0_CURRENCYCODE'] ? $data['PAYMENTINFO_0_CURRENCYCODE'] : "",
            'exchange_rate' => $data['PAYMENTINFO_0_EXCHANGERATE'] ? $data['PAYMENTINFO_0_EXCHANGERATE'] : "",
            'payment_status' => $data['PAYMENTINFO_0_PAYMENTSTATUS'] ? $data['PAYMENTINFO_0_PAYMENTSTATUS'] : "",
            'pending_reason' => $data['PAYMENTINFO_0_PENDINGREASON'] ? $data['PAYMENTINFO_0_PENDINGREASON'] : "",
            'reason_code' => $data['PAYMENTINFO_0_REASONCODE'] ? $data['PAYMENTINFO_0_REASONCODE'] : "",
            'seller_paypal_account' =>
                $data['PAYMENTINFO_0_SELLERPAYPALACCOUNTID'] ? $data['PAYMENTINFO_0_SELLERPAYPALACCOUNTID'] : "",
            'seller_paypal_ack' => $data['PAYMENTINFO_0_ACK'] ? $data['PAYMENTINFO_0_ACK'] : "",
        ];
    }
}
