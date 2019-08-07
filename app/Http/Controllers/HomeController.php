<?php

namespace App\Http\Controllers;
use App\Zagon;
use App\Ovechki;
use App\History;
use App\ZagonsOvechki;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Datatables;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function index(Request $request)
    {
         $zagons_ovechki=ZagonsOvechki::all()->toArray();
         $data = [];
         $tempIsRandom = $request->session()->get("isRandom");

        if($tempIsRandom == true)
        {
            $data=[];
            foreach ($zagons_ovechki as $key=>$value){
                $data[$value['zagon_id']][]=$value['ovechki_id'];
            }
        }
        else
        {
            DB::table('ovechki')->truncate();
            DB::table('history')->truncate();
            for ($i = 1; $i <= 10; $i++) {
                DB::table('ovechki')->insert([
                    'name' => 'Овечки ' . $i
                ]);
            }
            DB::table('zagons_ovechki')->truncate();
            $zagons = Zagon::all()->toArray();
            $ovechki=Ovechki::inRandomOrder()->get()->toArray();
            foreach ($ovechki as $key=>$value){
                if($key>=4)
                {
                    $k = array_rand($zagons);
                    $insert[$key]['zagon_id'] = $k+1;
                    $insert[$key]['ovechki_id'] = $value['id'];
                    $data[$k+1][]=$value['id'];
                }else{
                    $insert[$key]['zagon_id'] = $key+1;
                    $insert[$key]['ovechki_id'] = $value['id'];
                    $data[$key+1][]=$value['id'];
                }
            }
            ZagonsOvechki::insert($insert);
            History::insert($insert);
            $request->session()->put('isRandom', true);
        }

        return view('index',compact("data"));
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();

            $ovechka=new Ovechki();
            $ovechka->name='Овечка';
            $ovechka->save();

            $zagon_ovechka=new ZagonsOvechki();
            $zagon_ovechka->ovechki_id=$ovechka->id;
            $zagon_ovechka->zagon_id=$request->zagon_id;
            $zagon_ovechka->save();

            $hisotry=new History();
            $hisotry->name='Add';
            $hisotry->zagon_id=$request->zagon_id;
            $hisotry->ovechki_id=$ovechka->id;
            $hisotry->save();

            $response = array(
                'status' => 'success',
                'ovechka_id' => $ovechka->id,
                'message'=>"успех"
            );
            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            $response = array(
                'status' => 'error',
                'ovechka_id' => null,
                'message' =>$e->getMessage()
            );
        }

        return response()->json($response);
    }

    public function remove(Request $request)
    {
        $zagon_id=$request->zagon_id;
        $ovechka_id=$request->ovechka_id;

        try {
            DB::beginTransaction();

            $hisotry=new History;
            $hisotry->name='Delete';
            $hisotry->zagon_id=$zagon_id;
            $hisotry->ovechki_id=$ovechka_id;
            $hisotry->save();

            Ovechki::where('id',$ovechka_id)->delete();
            ZagonsOvechki::where('ovechki_id',$ovechka_id)->delete();

            $response = array(
                'status' => 'success',
                'message' =>'Успех'
            );

            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            $response = array(
                'status' => 'error',
                'message' =>$e->getMessage()
            );
        }

        return response()->json($response);
    }
    public function history(Request $request)
    {
        if ($request->ajax()) {
            $history = History::select('id','name','zagon_id','ovechki_id', 'created_at');
            return Datatables::of($history)->make(true);
        }
        return view('history');
    }

    public function add_by_command(Request $request)
    {
        try {
                DB::beginTransaction();
                $ovechka=new Ovechki();
                $ovechka->name='Овечка';
                $ovechka->save();

                $zagon_ovechka=new ZagonsOvechki();
                $zagon_ovechka->ovechki_id=$ovechka->id;
                $zagon_ovechka->zagon_id=$request->zagonid;
                $zagon_ovechka->save();

                $hisotry=new History();
                $hisotry->name='Add By Command';
                $hisotry->zagon_id=$request->zagonid;
                $hisotry->ovechki_id=$ovechka->id;
                $hisotry->save();

            DB::commit();

            $response = array(
                'status' => 'success',
                'ovechki' => $ovechka->id,
                'message'=>"успех"
            );

        } catch (\Exception $e) {

            DB::rollback();
            $response = array(
                'status' => 'error',
                'ovechki' => null,
                'message' =>$e->getMessage()
            );
        }

        return response()->json($response);
    }

    public function move(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('zagons_ovechki')
                ->where('zagon_id', $request->max_zagon_number)
                ->where('ovechki_id', $request->ovechka_id)
                ->delete();

            $zagon_ovechka=new ZagonsOvechki();
            $zagon_ovechka->ovechki_id=$request->ovechka_id;
            $zagon_ovechka->zagon_id=$request->min_zagon_number;
            $zagon_ovechka->save();

            $hisotry=new History();
            $hisotry->name='Move';
            $hisotry->zagon_id=$request->min_zagon_number;
            $hisotry->ovechki_id=$request->ovechka_id;
            $hisotry->save();

            $response = array(
                'status' => 'success',
                'message'=>"успех"
            );
            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            $response = array(
                'status' => 'error',
                'message' =>$e->getMessage()
            );
        }

        return response()->json($response);
    }

    public function remove_by_command(Request $request)
    {
        $zagonid=$request->zagonid;
        $ovechkaid=$request->ovechkaid;

        try {
            DB::beginTransaction();

            $hisotry=new History;
            $hisotry->name='Delete';
            $hisotry->zagon_id=$zagonid;
            $hisotry->ovechki_id=$ovechkaid;
            $hisotry->save();

            Ovechki::where('id',$ovechkaid)->delete();
            ZagonsOvechki::where('ovechki_id',$ovechkaid)
                          ->where('zagon_id', $zagonid)
                         ->delete();

            $response = array(
                'status' => 'success',
                'message' =>'Успех'
            );

            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            $response = array(
                'status' => 'error',
                'message' =>$e->getMessage()
            );
        }

        return response()->json($response);
    }

    public function move_by_command(Request $request)
    {
        $zagonid=$request->zagonid;
        $ovechkaid=$request->ovechkaid;
        $moved_zagonid=$request->moved_zagonid;
        try {
            DB::beginTransaction();

            DB::table('zagons_ovechki')
                ->where('zagon_id', $zagonid)
                ->where('ovechki_id', $ovechkaid)
                ->delete();

            $zagon_ovechka=new ZagonsOvechki();
            $zagon_ovechka->ovechki_id=$ovechkaid;
            $zagon_ovechka->zagon_id=$moved_zagonid;
            $zagon_ovechka->save();

            $hisotry=new History();
            $hisotry->name='Move';
            $hisotry->zagon_id=$moved_zagonid;
            $hisotry->ovechki_id=$ovechkaid;
            $hisotry->save();

            $response = array(
                'status' => 'success',
                'message'=>"успех"
            );
            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            $response = array(
                'status' => 'error',
                'message' =>$e->getMessage()
            );
        }

        return response()->json($response);
    }



}
