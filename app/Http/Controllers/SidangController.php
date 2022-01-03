<?php

namespace App\Http\Controllers;

use App\Models\Revisi;
use App\Models\Sidang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Js;
use Yajra\Datatables\Datatables;

class SidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sidang::with('pengaju')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<button class="edit btn btn-success btn-sm" data-id="'.$row->id.'" onclick="editFunc('.$row->id.')">Edit</button><button onclick="deleteFunc('.$row->id.')" class="edit ms-2 btn btn-danger btn-sm">Hapus</button><button onclick="showFunc('.$row->id.')" class="edit ms-2 btn btn-warning btn-sm">Validasi</button><a target="_blank" href="/sidang/'.$row->id.'/download" class="btn btn-sm ms-2 btn-info">Download</a>';
    
                            return $btn;
                    })
                    ->editColumn('pengaju', function($sidang) {
                        return $sidang;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $dosens = User::where('roles', 'dosen')->get();
        $paas = User::where('roles', 'paa')->get();
        
        return view('sidang.index', compact('paas', 'dosens'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->file('file')) {
            $data['file'] = $request->file('file')->store('file', 'public');
        }
        $sidang = Sidang::create($data);

        $id = $sidang->id;

        if (strlen($id) == 1) {
            Sidang::find($id)->update([
                'kode_sidang' => 'TA/00'.$id.'/2022'
            ]);
        }else if(strlen($id) == 2){
            Sidang::find($id)->update([
                'kode_sidang' => 'TA/0'.$id.'/2022'
            ]);
        }else{
            Sidang::find($id)->update([
                'kode_sidang' => 'TA/'.$id.'/2022'
            ]);
        }

        return response()->json([
            'status' => true
        ]);
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

    public function download($id)
    {
        $file = Sidang::find($id)->file;

        return response()->download(storage_path('app/public/'.$file));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sidang = Sidang::find($id);

        return response()->json([
            'sidang' => $sidang
        ]);
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
        $data = $request->all();

        if ($request->file('file')) {
            $data['file'] = $request->file('file')->store('file', 'public');
        }
        $sidang = Sidang::find($id)->update($data);

        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sidang::find($id)->delete();
        return response()->json([
            'status' => true
        ]);
    }

    public function validasi(Request $request, $id)
    {
        Sidang::find($id)->update([
            'status' => $request->status
        ]);

        if ($request->status == 'revisi') {
            Revisi::create([
                'sidang_id' => $id,
                'komentar' => $request->komentar
            ]);
        }

        return response()->json([
            'status' => true
        ]);
    }
}
