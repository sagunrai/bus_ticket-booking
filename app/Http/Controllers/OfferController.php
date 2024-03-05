<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::latest()->paginate(15);
        return view('backend.pages.offers.index',compact('offers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,webp,gif|max:2048',
            'text' => 'required',
        ]);

        $file = $request->file('image');
        $title =  'offer-' . now()->format('ymdhis') . Str::random(2) . $file->getClientOriginalExtension();
        $path = 'upload/offers/';
        $file->move($path, $title);
        Offer::create([
            'image' => $path . '/' . $title,
            'text' => $request->text,
        ]);
        return back()->with('success','Offer Stored Successfully!');
    }

    public function destroy($id)
    {
        $offer = Offer::findorfail($id);
        $offer->delete();
        return back()->with('success','Deleted Successfully!');
    }
}
