<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model
{
    protected $table      = 'expenses';
    protected $primaryKey = 'id';

    // If you have created_at/updated_at columns in your table, set this to true
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = [
        'user_id',
        'category',
        'description',
        'amount',
        'expense_date',
    ];

    // Create
    public function createExpense(array $data)
    {
        return $this->insert($data);
    }

    // Read (single)
    public function getExpense($id)
    {
        return $this->find($id);
    }

    // Read (by user)
    public function getExpensesByUser($userId, $limit = 10, $offset = 0)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('expense_date', 'DESC')
                    ->findAll($limit, $offset);
    }

    // Update
    public function updateExpense($id, array $data)
    {
        return $this->update($id, $data);
    }

    // Delete
    public function deleteExpense($id)
    {
        return $this->delete($id);
    }
}
