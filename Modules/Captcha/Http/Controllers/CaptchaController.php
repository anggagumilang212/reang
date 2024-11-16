<?php

namespace Modules\Captcha\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CaptchaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('captcha::index');
    }

    public function verify(Request $request)
    {
        $sliderPosition = $request->input('position');
        $expectedPosition = session('expected_position');

        // Toleransi posisi slider (dalam pixel)
        $tolerance = 5;

        if (abs($sliderPosition - $expectedPosition) <= $tolerance) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('captcha::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('captcha::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('captcha::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
