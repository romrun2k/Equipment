<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Equipments extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'equipments';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public static function forDropdown($type) {
        $query = Equipments::select('name', 'id')
            ->when($type, function($q) use ($type) {
                $q->whereType($type);
            })
            ->whereNull('deleted_at')
            ->get();

        $List = $query->pluck('name', 'id');
        $List = $List->prepend('ไม่ระบุ', '');

        return $List;
    }

    public static function getPrice($id) {
        $query = Equipments::whereId($id)
            ->select('price')
            ->first();

        return $query->price;
    }

}
