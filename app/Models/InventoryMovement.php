<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** A stock change on an inventory item: positive for stock added, negative for stock used. */
class InventoryMovement extends Model
{
    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'item_id');
    }
}
