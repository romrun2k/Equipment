<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionsItem;

class Transactions extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $guarded = ['id'];

    public function getItems() {
        return $this->hasMany(TransactionsItem::class, 'transactions_id');
    }

}
