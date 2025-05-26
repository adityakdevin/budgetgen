<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Income
            ['name' => 'Salary', 'type' => 'income'],
            ['name' => 'Freelance', 'type' => 'income'],
            ['name' => 'Investments', 'type' => 'income'],

            // Expense
            ['name' => 'Food & Dining', 'type' => 'expense'],
            ['name' => 'Transport', 'type' => 'expense'],
            ['name' => 'Entertainment', 'type' => 'expense'],
            ['name' => 'Utilities', 'type' => 'expense'],
            ['name' => 'Shopping', 'type' => 'expense'],

            // Investment
            ['name' => 'Mutual Funds', 'type' => 'investment'],
            ['name' => 'SIP', 'type' => 'investment'],
            ['name' => 'LIC', 'type' => 'investment'],
            ['name' => 'Stocks', 'type' => 'investment'],

            // Debt
            ['name' => 'Loan EMI', 'type' => 'debt'],
            ['name' => 'Credit Card Bill', 'type' => 'debt'],
        ];
        foreach ($categories as $category) {
            Category::createOrFirst($category);
        }

    }
}
