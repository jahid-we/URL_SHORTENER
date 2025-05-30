<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UrlShortenerController extends Controller
{
    // Home Page Functionality Start ****************************
    public function home(Request $request): view
    {
        return view('pages.home');
    }
    // Home Page Functionality End ****************************

    // URL SHortening Functionality Start ****************************
    public function createShortUrl(Request $request)
    {
        try {
            $request->validate([
                'original_url' => 'required|url',
            ]);

            $shortCode = $this->generateShortCode();

            $shortUrl = ShortUrl::updateOrCreate(
                ['original_url' => $request->original_url],
                ['short_url' => $shortCode]
            );

            return redirect()->back()->with([
                'success' => true,
                'original_url' => $shortUrl->original_url,
                'short_url' => url('/'.$shortCode),
            ]);

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    // URL SHortening Functionality End ****************************

    // Helper Functionality For Random URL Start **********************************
    private function generateShortCode()
    {
        do {
            $random = Str::random(6);
            $timestamp = now()->timestamp;
            $hash = md5($timestamp.$random);
            $shortCode = substr($hash, 0, 6);
        } while (ShortUrl::where('short_url', $shortCode)->exists());

        return $shortCode;
    }
    // Helper Functionality For Random URL End ************************************

    // URL Redirection Functionality Start **************************
    public function redirectToOriginalUrl(Request $request)
    {
        try {
            $shortUrl = ShortUrl::where('short_url', $request->short_url)->firstOrFail();

            return redirect($shortUrl->original_url);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    // URL Redirection Functionality End ****************************
}
