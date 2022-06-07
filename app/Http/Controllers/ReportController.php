<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session_start();

        $report = new Report();
        $report->img_id = $request->img_id;
        $report->owner_id = $request->owner_id;
        $report->reason = $request->report;
        $report->reporter_id = Auth::user()->id;
        $report->save();

        $_SESSION["report"] = "Imagen reportada satisfactoriamente";
        if (isset($request->name)) {
            return redirect()->route('gallery', $request->name);
        }
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->back();
    }

    public function reports()
    {
        $reports = Report::paginate(5);
        $images = Image::all();
        $users = User::where(['role' => 0, 'enabled' => 1])->get();
        return view('admin/adminReports', compact('reports', 'images', 'users'));
    }
}
