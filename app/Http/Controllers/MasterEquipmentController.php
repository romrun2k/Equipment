<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipments;
use DataTables;
use Illuminate\Support\Str;

class MasterEquipmentController extends Controller
{
    public function index() {
        return view('master_equipment.index');
    }

    public function show() {
        $query = Equipments::whereNull('deleted_at')
            ->select('code', 'name', 'price', 'type')
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

    public function store(Request $request) {
        try {
            $data = $request->except('_token', 'hd_code');
            $data['created_by'] = Auth()->user()->id;
            $data['updated_by'] = Auth()->user()->id;
            $data['code'] = Str::uuid();

            Equipments::create($data);

            $response = [
                'status' => true,
                'data' => null
            ];

        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function update(Request $request) {
        try {
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

        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => $e->getMessage()
            ];
        }

        return response()->json($response);

    }

    public function editData(Request $request) {
        try {

            $query = Equipments::whereCode($request->code)
                ->select('code', 'name', 'price', 'type')
                ->first();

            $response = [
                'status' => true,
                'data' => $query
            ];
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function f_delete(Request $request) {
        try {

            $query = Equipments::whereCode($request->code)
                ->update([
                    'deleted_at' => Date('Y-m-d H:i:s'),
                    'deleted_by' => Auth()->user()->id
                ]);

            $response = [
                'status' => true,
                'data' => null
            ];
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }

}
