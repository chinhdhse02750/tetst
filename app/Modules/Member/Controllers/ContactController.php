<?php

namespace App\Modules\Member\Controllers;

use App\Repositories\ContactRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ContactController extends Controller
{
    use ResponseTrait;
    /**
     * @var ContactRepository
     */
    protected $contactRepository;

    /**
     * BalanceController constructor.
     *
     * @param ContactRepository $contactRepository
     */
    public function __construct(
        ContactRepository $contactRepository
    ) {
        $this->middleware('auth')->except('logout');
        $this->contactRepository = $contactRepository;
    }

    /**
     * @return Factory|View|void
     */
    public function create()
    {
        try {
            $selectOption = config('contact');

            return view('contact.contact', compact('selectOption'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $dataContact = $request->except('_token');
            $data = $this->contactRepository->create($dataContact);

            return $this->success($data->toArray());
        } catch (\Exception $e) {
            return $this->error('[ERROR_STORE_FAVORITE]: ' . $e->getMessage());
        }
    }
}
