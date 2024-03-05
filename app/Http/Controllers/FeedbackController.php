<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedback = Feedback::all();
        return view('backend.pages.feedback.index',compact('feedback'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $feedback = new Feedback();
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->feedback = $request->comment;
        $feedback->slag = Str::slug($request->name) . Str::random(8);
        $feedback->save();
        return back()->with('success','feedback Sent Sucessfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function deletefeedback($feedback_id)
    {
        $feedback = Feedback::where('id',$feedback_id)->first();
        $feedback->delete();
        return back()->with('status', 'feedback has been successfully delete!');
    }

    public function showfeedback($id)
    {
        $data = Feedback::find($id);
        return view('backend.pages.feedback.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $feedback = Feedback::find($id);
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->message = $request->feedback;
        $feedback->save();
        return redirect()->route('admin.feedback.index')->with('status','feedback Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\feedback  $feedback
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\feedback  $feedback
     * @return \Illuminate\Http\Response
     */

    // update Status
    public function feedbackstatus($id){
        $feedback = Feedback::findorfail($id);
        if($feedback != null){
            if($feedback->status == 'active'){
                $feedback->status = 'inactive';
            }else{
                $feedback->status = 'active';
            }
            $feedback->save();
            return back()->with('success','Status Updated Succesfully !');
        }else{
            return back()->with('error','Sorry feedback Didnot Found.');
        }
    }
}
