<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transactions;
use DataTables;


class EmployeeController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = User::whereNull('deleted_at')
                ->whereRole('user')
                ->select('code', 'name', 'email', 'id')
                ->with('getTransactions:id,total_price,user_id')
                ->orderBy('id', 'DESC')
                ->get();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('total_price', function($q){
                    $price = 0;

                    if ($q->getTransactions) {
                        $price = number_format($q->getTransactions->sum('total_price'), 2);
                    }

                    return $price;
                })
                ->toJson();
        }
        return view('employees.index');
    }

    public function show(Request $request)
    {
        try {
            $user = User::whereCode($request->employee)
                ->select('id')
                ->first();

            $transactions = Transactions::whereUser_id($user->id)
                ->select('transaction_date', 'code', 'total_price', 'id', 'other')
                ->with(['getItems' => function($query) {
                    $query->select('transactions_id', 'price', 'equipments_id')
                          ->with('getEquipment:id,name');
                }])
                ->orderBy('id', 'desc')
                ->get()
                ->map(function($transaction) {
                    $transaction->total_price = number_format($transaction->total_price, 2);
                    return $transaction;
                });

            $response = [
                'status' => true,
                'data' => $transactions
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
