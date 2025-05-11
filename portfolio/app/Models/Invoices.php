<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_number',
        'order_id',
        'customer_id',
        'status', // draft, sent, paid, overdue, cancelled
        'subtotal',
        'tax_amount',
        'discount_amount',
        'total_amount',
        'due_date',
        'notes',
        'created_by', // user_id của người tạo
    ];

    // Relationship với Customer
    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    // Relationship với Order
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    // Relationship với User (người tạo)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relationship với InvoiceItem
    public function items()
    {
        return $this->hasMany(Invoice_items::class);
    }

    // Relationship với Payment
    public function payments()
    {
        return $this->hasMany(Payments::class);
    }
}
