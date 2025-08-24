<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Enums\CategoryType;
use App\Models\Category;
use App\Models\Goal;
use App\Models\Loan;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class BugFixTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that Category model relationships work correctly.
     */
    public function test_category_relationships_return_correct_types(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::create([
            'name' => 'Parent Category',
            'type' => CategoryType::EXPENSE,
        ]);

        // Test that relationships return the correct types
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $category->children());
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $category->transactions());
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $category->parent());
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $category->user());
    }

    /**
     * Test that Loan model handles money fields correctly.
     */
    public function test_loan_money_fields_exclude_interest_rate(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $loan = new Loan();
        $moneyFields = $loan->moneyFields();

        // Interest rate should not be in money fields since it's a percentage
        $this->assertNotContains('interest_rate', $moneyFields);
        $this->assertContains('principal_amount', $moneyFields);
        $this->assertContains('emi_amount', $moneyFields);
    }

    /**
     * Test that Category model has user scope for multi-tenancy.
     */
    public function test_category_has_user_scope(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Create category as user1
        $this->actingAs($user1);
        $category1 = Category::create([
            'name' => 'User 1 Category',
            'type' => CategoryType::EXPENSE,
        ]);

        // Create category as user2
        $this->actingAs($user2);
        $category2 = Category::create([
            'name' => 'User 2 Category',
            'type' => CategoryType::EXPENSE,
        ]);

        // Each user should only see their own categories
        $this->actingAs($user1);
        $user1Categories = Category::all();
        $this->assertCount(1, $user1Categories);
        $this->assertEquals($category1->id, $user1Categories->first()->id);

        $this->actingAs($user2);
        $user2Categories = Category::all();
        $this->assertCount(1, $user2Categories);
        $this->assertEquals($category2->id, $user2Categories->first()->id);
    }

    /**
     * Test that Transaction subcategory relationship works correctly.
     */
    public function test_transaction_subcategory_relationship(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $parentCategory = Category::create([
            'name' => 'Parent Category',
            'type' => CategoryType::EXPENSE,
        ]);

        $subcategory = Category::create([
            'name' => 'Sub Category',
            'type' => CategoryType::EXPENSE,
            'parent_id' => $parentCategory->id,
        ]);

        $transaction = Transaction::create([
            'category_id' => $parentCategory->id,
            'subcategory_id' => $subcategory->id,
            'type' => \App\Enums\TransactionType::EXPENSE,
            'amount' => 100.00,
            'transaction_date' => now(),
            'counterparty' => 'Test Vendor',
            'payment_mode' => \App\Enums\PaymentMode::CASH,
        ]);

        // Test that subcategory relationship works
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $transaction->subcategory());
        $this->assertEquals($subcategory->id, $transaction->subcategory->id);
    }

    /**
     * Test that Goal progress calculation handles edge cases correctly.
     */
    public function test_goal_progress_calculation(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Test zero target amount
        $goal1 = Goal::create([
            'name' => 'Zero Target Goal',
            'type' => \App\Enums\GoalType::SHORT_TERM,
            'target_amount' => 0,
            'saved_amount' => 50.00,
            'target_date' => now()->addYear(),
            'priority' => \App\Enums\Priority::MEDIUM,
            'status' => \App\Enums\Status::ACTIVE,
        ]);

        $this->assertEquals(0.0, $goal1->progress);

        // Test normal progress calculation
        $goal2 = Goal::create([
            'name' => 'Normal Goal',
            'type' => \App\Enums\GoalType::SHORT_TERM,
            'target_amount' => 1000.00,
            'saved_amount' => 250.00,
            'target_date' => now()->addYear(),
            'priority' => \App\Enums\Priority::MEDIUM,
            'status' => \App\Enums\Status::ACTIVE,
        ]);

        $this->assertEquals(25.0, $goal2->progress);

        // Test progress capped at 100%
        $goal3 = Goal::create([
            'name' => 'Over Target Goal',
            'type' => \App\Enums\GoalType::SHORT_TERM,
            'target_amount' => 1000.00,
            'saved_amount' => 1500.00,
            'target_date' => now()->addYear(),
            'priority' => \App\Enums\Priority::MEDIUM,
            'status' => \App\Enums\Status::ACTIVE,
        ]);

        $this->assertEquals(100.0, $goal3->progress);
    }
}