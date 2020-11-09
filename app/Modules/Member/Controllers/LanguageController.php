<?php

namespace App\Modules\Member\Controllers;

use Illuminate\Http\RedirectResponse;

/**
 * Class LanguageController.
 */
class LanguageController extends Controller
{
    /**
     * @param String $locale
     * @return RedirectResponse
     */
    public function swap(String $locale)
    {
        if (array_key_exists($locale, config('locale.languages'))) {
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
