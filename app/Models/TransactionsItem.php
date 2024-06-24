<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipments;

class TransactionsItem extends Model
{
    use HasFactory;
    protected $table = 'transactions_item';
    protected $guarded = ['id'];

    public function getEquipment() {
        return $this->belongsTo(Equipments::class, 'equipments_id');
    }
}
