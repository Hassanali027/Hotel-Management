<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class InventoryItem extends Model
{
    protected $guarded = [];

    public function movements()
    {
        return $this->hasMany(InventoryMovement::class, 'item_id');
    }

    /** Change stock by $delta (negative = used), log the movement and refresh availability. Returns the applied change. */
    public function adjust(int $delta, string $reason, ?string $reference = null)
    {
        $stock = max(0, $this->quantity_stock + $delta);
        $applied = $stock - $this->quantity_stock;
        $this->update([
            'quantity_stock' => $stock,
            'availability'   => $stock <= 0 ? 'out' : ($stock < $this->quantity_reorder ? 'low' : 'available'),
        ]);
        if ($applied !== 0) {
            $this->movements()->create(['change' => $applied, 'reason' => $reason, 'reference' => $reference]);
        }
        return $applied;
    }
}
