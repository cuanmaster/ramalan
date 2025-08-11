<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'reference', 'service', 'data', 'email', 'amount', 'status',
        'payment_url', 'payment_qr_string', 'payment_qr_url', 'tripay_ref'
    ];
    protected $useTimestamps = true;

    public function findByReference(string $reference): ?array
    {
        return $this->where('reference', $reference)->first();
    }

    public function updateByReference(string $reference, array $data): bool
    {
        return (bool) $this->where('reference', $reference)->set($data)->update();
    }
}