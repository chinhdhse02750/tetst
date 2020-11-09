<?php

namespace App\Modules\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use PHPUnit\Exception;

class OfferController extends Controller
{
    use ResponseTrait;


    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * OfferController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function add(int $id)
    {
        try {
            $member = $this->userRepository->find($id);
            if (!$member->request_setting) {
                return $this->error('[ERROR_ADD_OFFER] ');
            }

            $memberOffer = Session::get('member_offer');
            if (empty($memberOffer)) {
                session::put('member_offer', [$id]);
            } elseif (!in_array($id, $memberOffer)) {
                session::push('member_offer', $id);
            }

            return $this->success(Session::get('member_offer'));
        } catch (Exception $e) {
            return $this->error('[ERROR_ADD_OFFER]: ' . $e->getMessage());
        }//end try
    }

    /**
     * @param int $id
     * @return Factory|JsonResponse|View
     */
    public function destroy(int $id)
    {
        try {
            $memberOffer = Session::get('member_offer');
            Session::pull('member_offer');
            $indexMemberOffer = array_search($id, $memberOffer);
            if ($indexMemberOffer === 0 || $indexMemberOffer) {
                unset($memberOffer[$indexMemberOffer]);
            }
            $memberOffer = array_values($memberOffer);

            if (count($memberOffer) > 0) {
                Session::put('member_offer', $memberOffer);
            } else {
                Session::forget(['member_offer', 'dataRequestOffer', 'data_setting']);
            }

            return $this->success($memberOffer);
        } catch (Exception $e) {
            return $this->error('[ERROR_DELETE_OFFER]: ' . $e->getMessage());
        }//end try
    }
}
