<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipments;
use DataTables;
use Illuminate\Support\Str;
use Auth;

class EquipmentController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Equipments::select('code', 'name', 'price', 'type')
                ->orderBy('id', 'DESC')
                ->get()
                ->map(function ($q) {
                    $q->price = number_format($q->price, 2);
                    return $q;
                });

            return DataTables::of($query)
                ->addIndexColumn()
                ->toJson();
        }

        return view('equipments.index');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token', 'hd_code');
        $data['created_by'] = Auth()->user()->id;
        $data['updated_by'] = Auth()->user()->id;
        $data['code'] = Str::uuid();

        Equipments::create($data);

        $response = [
            'status' => true,
            'data' => null
        ];

        return response()->json($response);
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', 'hd_code');
        $data['updated_by'] = Auth()->user()->id;
        $data['updated_at'] = Date('Y-m-d H:i:s');

        Equipments::whereCode($request->hd_code)
            ->update(
                $data
            );

        $response = [
            'status' => true,
            'data' => null
        ];

        return response()->json($response);
    }

    public function edit(Request $request)
    {

        $query = Equipments::whereCode($request->quipment)
            ->select('code', 'name', 'price', 'type')
            ->first();

        $response = [
            'status' => true,
            'data' => $query
        ];

        return response()->json($response);
    }

    public function destroy(Request $request)
    {
        // soft delte
        $equipment = Equipments::whereCode($request->quipment)
            ->first();

        if ($equipment) {
            $equipment->deleted_by = Auth::id();
            $equipment->save();
            $equipment->delete();

            $response = [
                'status' => true,
                'data' => null
            ];
        } else {
            $response = [
                'status' => false,
                'data' => null
            ];
        }

        return response()->json($response);
    }

}
