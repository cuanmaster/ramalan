<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['key', 'value'];
    protected $useTimestamps = true;

    public function get(string $key, $default = null)
    {
        $row = $this->where('key', $key)->first();
        return $row ? $row['value'] : $default;
    }

    public function set(string $key, $value): void
    {
        $row = $this->where('key', $key)->first();
        if ($row) {
            $this->update($row['id'], ['value' => $value]);
        } else {
            $this->insert(['key' => $key, 'value' => $value]);
        }
    }
}