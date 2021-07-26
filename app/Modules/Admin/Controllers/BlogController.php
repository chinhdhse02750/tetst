<?php

namespace App\Modules\Admin\Controllers;

use App\Helpers\Constants;
use App\Repositories\ContactRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\BalanceRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class BlogController extends Controller
{
    /**
     * @var ContactRepository
     */
    protected $contactRepository;

    /**
     * ContactController constructor.
     * @param ContactRepository $contactRepository
     */
    public function __construct(
        ContactRepository $contactRepository
    ) {
        $this->contactRepository = $contactRepository;
    }

    /**
     *
     * @return Response
     */
    public function index()
    {
        $contacts = $this->contactRepository
            ->getContactPaginated(Constants::DEFAULT_PER_PAGE, Constants::USER_ORDER_BY, Constants::USER_SORT);

        return response()->view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $contactOption = config('contact');
        $contact = $this->contactRepository->find($id);

        return response()->view('contacts.edit', compact('contact', 'contactOption'));
    }

    /**
     * Update status contact.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidatorException
     */
    public function update(Request $request, int $id)
    {
        try {
            $status = $request->only('status');
            $this->contactRepository->update($status, $id);

            Session::flash('success_msg', trans('alerts.general.success.updated'));

            return redirect()->route('contact.index');
        } catch (Exception $e) {
            Log::error('[ERROR_CATEGORY_CREATE]: ' . $e->getMessage());

            return redirect()
                ->route('contact.index')
                ->withErrors($e->getMessage());
        }//end try
    }
}
