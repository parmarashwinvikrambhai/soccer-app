<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class TeamController extends Controller
{
    public function safe(){
        return response()->json([
            'status' => true,
            'message' => 'you are Authenticated'
        ]);
    }

    public function unauthResponse(){
        return response()->json([
            'status' => false,
            'message' => 'you are unauthanticated please login again'
        ]);
    }
    /**
     * Validate the data and Store it
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'logo'    => 'required|image|mimes:jpg,png,jpeg|max:2014',
        ]);
        $data = Teams::create($request->all(),[
            'logo' => $request->file('logo')->store('public/image'),
        ]);
        return response($data, Response::HTTP_CREATED);
    }
    /**
     * fetching all the data
     */
    public function index()
    {
        $teamData =  Teams::all();
        return response()->json([
            'message'    => 'Data Fetched Successfully.....',
            'status'     => true,
            'data'       => $teamData
        ]);
    }
    /**
     * Find the particular Record based on Their id
     */
    public function show($id)
    {
        $teams =  Teams::find($id);
       if(is_null($teams))
       {
        return response()->json([
            'status'     => false,
            'message'    => 'Not Exist.....'
        ]);
       }
        return Teams::find($id);
    }
    /**
     * we have to destroy the record
     */
    public function destroy($id)
    {
        $teams =  Teams::find($id);
        if(is_null($teams))
        {
              return response()->json([
                'status'     => false,
                'message'    => 'Not Exist.....'
            ]);
        }
        else
        {
            $teams = Teams::destroy($id);
            return response()->json([
                'status'     => true,
                'message'    => 'Record Deleted successfully.....'
            ]);
         }
    }
    /**
     * update the record based on their id
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'    => 'required',
            'logo'    => 'required|image|mimes:jpg,png,jpeg|max:2014',
           ]);
        $player = Teams::find($id);
        $player->update([
            'name' =>$request->input('name'),
            'logo' => $request->file('logo')->store('public/image')
        ]);
         return response()->json([
            'status'     => true,
            'message'    => 'Record Update successfully......'
            'student'    => $player,
        ]);
    }
}
