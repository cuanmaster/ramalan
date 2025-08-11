<?php

namespace App\Models;

use CodeIgniter\Model;

class ResultModel extends Model
{
    protected $table = 'results';
    protected $primaryKey = 'id';
    protected $allowedFields = ['reference', 'content'];
    protected $useTimestamps = true;

    public function findByReference(string $reference): ?array
    {
        return $this->where('reference', $reference)->first();
    }
}