<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Teams;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class PlayerController extends Controller
{
    /**
     * Validate the data and Store it
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'photo'         => 'required|image|mimes:jpg,png,jpeg|max:2014',
            'team_id'       => 'required',
        ]);
        $data = Player::create($request->all(),[
            'photo' => $request->file('photo')->store('public/image'),
        ]);
        return response($data, Response::HTTP_CREATED);
    }
    /**
     * fetching all the data
     */
    public function index()
    {
        $playerData =  Player::all();
        return response()->json([
            'status'     => true,
             'message'    => 'Data Fetched Successfully.....',
            'data'       => $playerData
        ]);
        
    }
    /**
     * Find the particular Record based on Their id
     */
    public function show($id)
    {
        $player =  Player::find($id);
       if(is_null($player))
       {
        return response()->json([
            'status'     => false,
            'message'    => 'Not Exist.....'
        ]);
       }
        return Player::find($id);
    }
    /**
     * we have to destroy the record
     */
    public function destroy($id)
    {
        $player =  Player::find($id);
        if(is_null($player))
        {
            return response()->json([
                'status'     =>  true,
                'message'    => 'Not Exist.....',
            ]);
        }
        else
        {
            $player = Player::destroy($id);
            return response()->json([
                'status'     => true,
                'message'    => 'Deleted Successfully.....'
            ]);
         }
    }
    /**
     * update the record based on their id
     */
    public function update(Request $request,$id)
    {
        $player = Player::find($id);
        $player->update($request->all());
        return $player;
    }
    /**
     * we have just fetch the all record using join and we can compare id from team and player table
     */
    public function getTeamName()
    {
        $data = Player::join('teams', 'teams.id', '=', 'player.team_id')
              		->get(['player.id','player.team_id','player.first_name', 'player.last_name', 'teams.name']);
        return response()->json([
            'status'     => true,
            'Data'       => $data
        ]);
    }

    // public function getData()
    // {
    //     $user = Teams::with(['players'])->find(2);
    //    dd($user->toArray()) ;
    // }

}
