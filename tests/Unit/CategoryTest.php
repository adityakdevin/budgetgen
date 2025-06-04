<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Enums\CategoryType;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a category can be created with the correct attributes.
     */
    public function test_category_can_be_created(): void
    {
        $category = Category::create([
            'name' => 'Test Category',
            'type' => CategoryType::EXPENSE,
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
            'type' => CategoryType::EXPENSE,
        ]);

        $this->assertEquals('Test Category', $category->name);
        $this->assertEquals(CategoryType::EXPENSE, $category->type);
    }

    /**
     * Test that a category can have a parent category.
     */
    public function test_category_can_have_parent(): void
    {
        $parentCategory = Category::create([
            'name' => 'Parent Category',
            'type' => CategoryType::EXPENSE,
        ]);

        $childCategory = Category::create([
            'name' => 'Child Category',
            'type' => CategoryType::EXPENSE,
            'parent_id' => $parentCategory->id,
        ]);

        $this->assertEquals($parentCategory->id, $childCategory->parent->id);
        $this->assertCount(1, $parentCategory->children);
        $this->assertEquals($childCategory->id, $parentCategory->children->first()->id);
    }
}
