<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use App\Models\Transactions;
use App\Models\TransactionsItem;
use App\Models\Equipments;
use DataTables;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;


class OrderListController extends Controller
{
    public function index()
    {
        $monitor = Equipments::forDropdown('Monitor');
        $keyboard = Equipments::forDropdown('Keyboard');
        $mouse = Equipments::forDropdown('Mouse');

        return view('order_list.index', compact('monitor', 'keyboard', 'mouse'));
    }

    public function show()
    {
        $query = Transactions::whereNull('deleted_at')
            ->whereUser_id(Auth()->user()->id)
            ->select('code', 'transaction_date', 'status', 'total_price')
            ->orderBy('id', 'DESC')
            ->get()
            ->map(function($q) {
                $q->total_price = number_format($q->total_price, 2);
                return $q;
            });

        return DataTables::of($query)
            ->addIndexColumn()
            ->toJson();
    }

    private function checkEquipmentType($user_id, $type)
    {
        return Transactions::where('user_id', $user_id)
            ->whereHas('getItems.getEquipment', function ($q) use ($type) {
                $q->where('type', $type);
            })
            ->count();
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $date_time = Carbon::now();
            $user_id = Auth::id();
            $data = $request->except('equipment_monitor', '_token');
            // Find item
            if (!empty($request->equipment_keyboard)) {
                $find_Keyboard = $this->checkEquipmentType($user_id, 'Keyboard');

                if ($find_Keyboard > 0) {
                    $response = [
                        'status' => false,
                        'data' => 'have_item',
                        'message' => 'มี Keyboard อยู่'
                    ];

                    return response()->json($response);
                }
            }

            if (!empty($request->equipment_mouse)) {
                $find_Mouse = $this->checkEquipmentType($user_id, 'Mouse');

                if ($find_Mouse > 0) {
                    $response = [
                        'status' => false,
                        'data' => 'have_item',
                        'message' => 'มี Mouse อยู่'
                    ];

                    return response()->json($response);
                }
            }

            // create transaction
            $date_time = date('Y-m-d H:i:s');

            $transaction = Transactions::create([
                'code' => Str::uuid(),
                'user_id' => Auth()->user()->id,
                'transaction_date' => date('Y-m-d'),
                'created_by' => Auth()->user()->id,
                'updated_by' => Auth()->user()->id,
                'created_at' => $date_time,
                'updated_at' => $date_time,
                'other' => $request->other
            ]);

            $transactionId = $transaction->id;

            $total = 0;
            $createTransactionItem = function ($equipmentId) use ($transactionId, $date_time, $user_id, &$total) {
                if ($equipmentId) {
                    $price = Equipments::getPrice($equipmentId);
                    TransactionsItem::create([
                        'code' => Str::uuid(),
                        'transactions_id' => $transactionId,
                        'equipments_id' => $equipmentId,
                        'transaction_date' => Carbon::today(),
                        'price' => $price,
                        'created_by' => $user_id,
                        'updated_by' => $user_id,
                        'created_at' => $date_time,
                        'updated_at' => $date_time,
                    ]);

                    $total += $price;
                }
            };

            // create item monitor
            if (!empty($request->equipment_monitor)) {
                foreach ($request->equipment_monitor as $item) {
                    $createTransactionItem($item);
                }
            }

            // create item Mouse
            $createTransactionItem($request->equipment_mouse);

            // create item Keyboard
            $createTransactionItem($request->equipment_keyboard);

            // update total price
            $transaction->update([
                'total_price' => $total
            ]);

            DB::commit();

            $response = [
                'status' => true,
                'data' => null
            ];
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status' => false,
                'data' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function view_detail(Request $request)
    {
        try {
            $transaction = Transactions::whereCode($request->code)
                ->select('id', 'other')
                ->first();

            $query = TransactionsItem::whereTransactions_id($transaction->id)
                ->select('transactions_item.price', 'transactions_item.equipments_id')
                ->with('getEquipment:id,name,type')
                ->get();

            $response = [
                'status' => true,
                'data' => $query,
                'other' => @$transaction->other
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
