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

        $subcategories = [
            // Income
            'Salary' => ['Monthly Salary', 'Bonus', 'Overtime', 'Incentives', 'Reimbursements'],
            'Freelance' => ['Project Work', 'Consulting', 'Contract Jobs', 'One-time Gigs', 'Remote Jobs'],
            'Investments' => ['Dividends', 'Interest Income', 'Capital Gains', 'Rental Income', 'Royalty'],

            // Expense
            'Food & Dining' => ['Groceries', 'Restaurants', 'Snacks & Drinks', 'Home Delivery', 'Coffee Shops'],
            'Transport' => ['Fuel', 'Taxi', 'Public Transport', 'Tolls & Parking', 'Vehicle Repairs'],
            'Entertainment' => ['Movies', 'Subscriptions', 'Events', 'Games', 'Streaming Services'],
            'Utilities' => ['Electricity', 'Water', 'Internet', 'Mobile Bill', 'Gas Bill'],
            'Shopping' => ['Clothes', 'Electronics', 'Accessories', 'Gifts', 'Home Essentials'],

            // Investment
            'Mutual Funds' => ['Equity Funds', 'Debt Funds', 'Hybrid Funds', 'ELSS', 'Index Funds'],
            'SIP' => ['Monthly SIP', 'Quarterly SIP', 'Equity SIP', 'Debt SIP', 'Thematic SIP'],
            'LIC' => ['Term Insurance', 'Endowment Plan', 'Jeevan Anand', 'Money Back', 'Pension Plan'],
            'Stocks' => ['Blue Chip', 'Mid Cap', 'Small Cap', 'IPOs', 'ETFs'],

            // Debt
            'Loan EMI' => ['Car Loan', 'Personal Loan', 'Education Loan', 'Wallet Loan', 'Home Loan'],
            'Credit Card Bill' => ['HDFC Card', 'SBI Card', 'ICICI Card', 'Axis Bank Card', 'Other Credit Card'],
        ];

        foreach ($categories as $item) {
            $parent = Category::updateOrCreate(
                ['name' => $item['name'], 'parent_id' => null],
                ['type' => $item['type'], 'icon' => null]
            );

            if (isset($subcategories[$item['name']])) {
                foreach ($subcategories[$item['name']] as $child) {
                    Category::updateOrCreate(
                        ['name' => $child, 'parent_id' => $parent->id],
                        ['type' => $item['type'], 'icon' => null]
                    );
                }
            }
        }

    }
}
