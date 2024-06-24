<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipments extends Model
{
    use HasFactory;
    protected $table = 'equipments';
    protected $guarded = ['id'];

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
