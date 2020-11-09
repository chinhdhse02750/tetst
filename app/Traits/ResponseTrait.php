<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * Response success.
     *
     * @param array $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function success(array $data, string $message = 'SUCCESS', int $code = 0)
    {
        return response()->json(
            [
                'status' => true,
                'data'   => $data,
                'error'  => [
                    'code'    => $code,
                    'message' => $message,
                ],
            ]
        );
    }

    /**
     * Response error.
     *
     * @param string|array $message
     * @param int $status
     * @return JsonResponse
     */
    protected function error($message, $status = 400)
    {
        $decode = is_string($message) ? json_decode($message) : '';
        if ($decode) {
            $message = $decode;
        }

        return response()->json(
            [
                'status' => false,
                'data'   => null,
                'error'  => [
                    'code'    => $status,
                    'message' => $message,
                ],
            ],
            200
        );
    }

    /**
     * Response not found.
     *
     * @return JsonResponse
     */
    protected function notFound()
    {
        return $this->error('RESOURCE_NOT_FOUND', 404);
    }

    /**
     * Response not found web.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function notFoundWeb()
    {
        return view('errors.404');
    }

    /**
     * Response not authorize.
     *
     * @return JsonResponse
     */
    protected function notAuthorize()
    {
        return $this->error('NOT_AUTHORIZE_FOR_THIS_URI', 401);
    }
}
