<?php

namespace App\Controllers;

use App\Models\ExpenseModel;
use CodeIgniter\Controller;

class ExpenseController extends Controller
{
    // Show all expenses (simple list)
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/')->with('error', 'Please login first.');
        }

        $expenseModel = new ExpenseModel();
        $userId = (int) session()->get('user_id');

        $data['expenses'] = $expenseModel
            ->where('user_id', $userId)
            ->orderBy('expense_date', 'DESC')
            ->findAll();

        return view('expense_view', $data);
    }
    public function analytics()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/')->with('error', 'Please login first.');
        }

        $expenseModel = new ExpenseModel();
        $userId = (int) session()->get('user_id');

        // Get filter parameters
        $from = $this->request->getGet('from');
        $to = $this->request->getGet('to');
        $category = $this->request->getGet('category');

        // Start building query
        $builder = $expenseModel->where('user_id', $userId);

        // Apply filters
        if ($from) {
            $builder->where('expense_date >=', $from);
        }
        if ($to) {
            $builder->where('expense_date <=', $to);
        }
        if ($category) {
            $builder->where('category', $category);
        }

        // Get all expenses for calculations
        $expenses = $builder->orderBy('expense_date', 'DESC')->findAll();

        // Calculate totals
        $totalSpent = 0;
        $categoryTotals = [];
        foreach ($expenses as $expense) {
            $amount = (float)$expense['amount'];
            $totalSpent += $amount;

            $cat = $expense['category'];
            if (!isset($categoryTotals[$cat])) {
                $categoryTotals[$cat] = 0;
            }
            $categoryTotals[$cat] += $amount;
        }

        // Sort categories by total (highest first)
        arsort($categoryTotals);

        // Format category totals for view
        $categoryTotalsFormatted = [];
        foreach ($categoryTotals as $cat => $total) {
            $categoryTotalsFormatted[] = [
                'category' => $cat,
                'total' => $total
            ];
        }

        // Get top category
        $topCategory = 'N/A';
        $topCategoryAmount = 0;
        if (!empty($categoryTotalsFormatted)) {
            $topCategory = $categoryTotalsFormatted[0]['category'];
            $topCategoryAmount = $categoryTotalsFormatted[0]['total'];
        }

        // Get this month's spending
        $currentMonth = date('Y-m');
        $monthSpent = 0;
        foreach ($expenses as $expense) {
            if (substr($expense['expense_date'], 0, 7) === $currentMonth) {
                $monthSpent += (float)$expense['amount'];
            }
        }

        // Get all unique categories for filter dropdown
        $allCategories = $expenseModel
            ->select('category')
            ->where('user_id', $userId)
            ->groupBy('category')
            ->findColumn('category');

        // Recent expenses (limit 10)
        $recentExpenses = array_slice($expenses, 0, 10);

        // Prepare data for view
        $data = [
            'expenses' => $expenses,
            'totalSpent' => $totalSpent,
            'totalCount' => count($expenses),
            'categoryTotals' => $categoryTotalsFormatted,
            'topCategory' => $topCategory,
            'topCategoryAmount' => $topCategoryAmount,
            'monthSpent' => $monthSpent,
            'monthLabel' => date('F Y'),
            'recentExpenses' => $recentExpenses,
            'categories' => $allCategories,
            'from' => $from,
            'to' => $to,
            'selectedCategory' => $category,
        ];

        return view('analytics', $data);
    }


    // Show add expense form
    public function add()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/')->with('error', 'Please login first.');
        }

        return view('add_expense');
    }
   
    // Store expense (CREATE)
    public function store()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/')->with('error', 'Please login first.');
        }

        $expenseModel = new ExpenseModel();

        $data = [
            'user_id'      => (int) session()->get('user_id'),
            'category'     => $this->request->getPost('category'),
            'description'  => $this->request->getPost('description'),
            'amount'       => $this->request->getPost('amount'),
            'expense_date' => $this->request->getPost('expense_date'),
        ];

        $expenseModel->insert($data);

        session()->setFlashdata('message', 'Expense added successfully!');
        return redirect()->to('/expenses');
    }

    // Show edit form
    public function edit($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/')->with('error', 'Please login first.');
        }

        $expenseModel = new ExpenseModel();
        $userId = (int) session()->get('user_id');

        $expense = $expenseModel->find($id);

        // simple ownership check
        if (!$expense || (int)$expense['user_id'] !== $userId) {
            return redirect()->to('/expenses')->with('error', 'Expense not found.');
        }

        return view('edit_expense', ['expense' => $expense]);
    }

    // Update expense (UPDATE)
    public function update($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/')->with('error', 'Please login first.');
        }

        $expenseModel = new ExpenseModel();
        $userId = (int) session()->get('user_id');

        $expense = $expenseModel->find($id);
        if (!$expense || (int)$expense['user_id'] !== $userId) {
            return redirect()->to('/expenses')->with('error', 'Expense not found.');
        }

        $data = [
            'category'     => $this->request->getPost('category'),
            'description'  => $this->request->getPost('description'),
            'amount'       => $this->request->getPost('amount'),
            'expense_date' => $this->request->getPost('expense_date'),
        ];

        $expenseModel->update($id, $data);

        session()->setFlashdata('message', 'Expense updated successfully!');
        return redirect()->to('/expenses');
    }

    // Delete expense (DELETE)
    public function delete($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/')->with('error', 'Please login first.');
        }

        $expenseModel = new ExpenseModel();
        $userId = (int) session()->get('user_id');

        $expense = $expenseModel->find($id);
        if (!$expense || (int)$expense['user_id'] !== $userId) {
            return redirect()->to('/expenses')->with('error', 'Expense not found.');
        }

        $expenseModel->delete($id);

        session()->setFlashdata('message', 'Expense deleted successfully!');
        return redirect()->to('/expenses');
    }
}
