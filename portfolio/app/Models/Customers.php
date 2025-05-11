<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Customer.php
class Customers extends Model
{
    protected $fillable = [
        'user_id', // Liên kết với bảng users
        'company_name',
        'tax_code',
        'business_type',
        'industry',
        'website',
        'status', // active, inactive
        'notes',
        'source', // Nguồn khách hàng: website, referral, etc.
    ];

    // Relationship với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship với Order
    public function orders()
    {
        return $this->hasMany(Orders::class);
    }

    // Relationship với Invoice
    public function invoices()
    {
        return $this->hasMany(Invoices::class);
    }

    // Relationship với Product (dịch vụ của khách hàng)
    public function services()
    {
        return $this->hasMany(Products::class, 'customer_id');
    }

    // Truy cập các thuộc tính của User thông qua Customer
    public function getNameAttribute()
    {
        return $this->user->name;
    }

    public function getEmailAttribute()
    {
        return $this->user->email;
    }

    public function getPhoneAttribute()
    {
        return $this->user->phone;
    }

    public function getAddressAttribute()
    {
        return $this->user->address;
    }
}
