<?php

namespace Modules\Larnr\Http\Controllers;

use App\Models\PartnerEnquery;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Larnr\Emails\PartnerEnquery as EmailsPartnerEnquery;

class PartnerController extends Controller
{
    public function __construct()
    {
        \Debugbar::disable();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('larnr::partners.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('larnr::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $partner = PartnerEnquery::updateOrCreate(
            ['email' => $req->email],
            [
                'name' => $req->name,
                'mobile' => $req->mobile,
                'email' => $req->email,
                'subject' => $req->subject,
                'message' => $req->message,
            ]
        );
        Mail::to('imshibaji@gmail.com')->send(new EmailsPartnerEnquery($partner));
        $req->session()->flash('status', 'Thank you for contacting with us.');

        return back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('larnr::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('larnr::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
