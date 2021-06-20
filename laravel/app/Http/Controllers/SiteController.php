<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Site;
//use Mail;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::all('id', 'nom_enseigne', 'adresse_site', 'nom_responsable', 'fonction_responsable', 'email_responsable', 'tel_site', 'date_creation', 'status');
        return response()->json( $sites );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function nouveau(Request $request){
        $validate = Validator::make($request->all(), [
            'nom_enseigne'    => 'required|nom_enseigne|unique:sites',
            'adresse_site' => 'required',
            'nom_responsable' => 'required',
           'fonction_responsable' => 'required',
            'email_responsable' => 'required',
            'tel_site' => 'required',
        ]);        
        if ($validate->fails()){
            return response()->json([
                'status' => 'error',
                'errors' => $validate->errors()
            ], 422);
        }        
        $site = new Site();
        $site->nom_enseigne = $request->input('nom_enseigne');
        $site->adresse_site = $request->input('adresse_site');
        $site->nom_responsable = $request->input('nom_responsable');
        $site->fonction_responsable = $request->input('fonction_responsable');
        $site->email_responsable = $request->input('email_responsable');
        $site->tel_site = $request->input('tel_site');
        $site->status = 'Active';
        $site->save();       
        return response()->json(['status' => 'success'], 200);
    } 

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'nom_enseigne'    => 'required|nom_enseigne|unique:sites',
    //         'adresse_site' => 'required',
    //         'nom_responsable' => 'required',
    //        'fonction_responsable' => 'required',
    //         'email_responsable' => 'required',
    //         'tel_site' => 'required',
    //     ]);
    //     $site = new Site();
    //     $site->nom_enseigne = $request->input('nom_enseigne');
    //     $site->adresse_site = $request->input('adresse_site');
    //     $site->nom_responsable = $request->input('nom_responsable');
    //     $site->fonction_responsable = $request->input('fonction_responsable');
    //     $site->email_responsable = $request->input('email_responsable');
    //     $site->tel_site = $request->input('tel_site');
    //     $site->save();
    //     return response()->json( ['status' => 'success'] );
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json( [ 'site' => Site::find($id) ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json( [ 'site' => Site::find($id) ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([  
            'name'    => 'required|min:1|max:64',
            'subject' => 'required|min:1|max:128',
            'content' => 'required|min:1',
        ]);

        $site = Site::find($id);
        $site->name = $request->input('name');
        $site->subject = $request->input('subject');
        $site->content = $request->input('content');
        $site->save();
        return response()->json( ['status' => 'success'] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $site = Site::find($id);
        if($site){
            $site->delete();
        }
        return response()->json( ['status' => 'success'] );
    }

    // public function prepareSend($id){
    //     return response()->json( [ 'site' => Site::find($id) ] );
    // }

    // public function send($id, Request $request){
    //     $validatedData = $request->validate([
    //         'email'    => 'required|email',
    //     ]);
    //     $site = Site::find($id);
    //     Mail::send([], [], function ($message) use ($request, $site)
    //     {
    //         $message->to($request->input('email'));
    //         $message->subject($site->subject);
    //         $message->setBody($site->content,'text/html');
    //     });
    //     return response()->json( ['status' => 'success'] );
    // }
}
