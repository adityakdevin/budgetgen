# BudgetGen Development Guidelines

This document provides essential information for developers working on the BudgetGen project. It includes
build/configuration instructions, testing information, and additional development details specific to this project.

## Build/Configuration Instructions

### Prerequisites

- PHP 8.3+ (8.4 recommended)
- Composer 2.x
- MySQL 8.x (or MariaDB ≥10.6)
- Node 20 or Bun 1.1 (for asset builds)

### Installation Steps

1. **Clone the repository**:
   ```bash
   git clone https://github.com/adityakdevin/budgetgen.git
   cd budgetgen
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install --optimize-autoloader
   ```

3. **Set up environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**:
   Edit the `.env` file to set your database connection details:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=budgetgen
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations and seeders**:
   ```bash
   php artisan migrate --seed
   ```

6. **Build frontend assets**:
   Using Bun (recommended):
   ```bash
   bun install
   bun run dev  # For development
   # OR
   bun run build  # For production
   ```

   Using npm (alternative):
   ```bash
   npm install
   npm run dev  # For development
   # OR
   npm run build  # For production
   ```

7. **Start the development server**:
   ```bash
   php artisan serve
   ```

## Testing Information

### Testing Configuration

The project uses PHPUnit for testing with the following configuration:

- Tests are separated into Feature and Unit tests
- SQLite in-memory database is used for testing
- Environment variables are set in `phpunit.xml`

### Running Tests

1. **Run all tests**:
   ```bash
   php artisan test
   ```

2. **Run specific test suites**:
   ```bash
   php artisan test --testsuite=Unit
   php artisan test --testsuite=Feature
   ```

3. **Run a specific test file**:
   ```bash
   php artisan test tests/Unit/CategoryTest.php
   ```

4. **Run a specific test method**:
   ```bash
   php artisan test --filter=test_category_can_be_created
   ```

### Creating New Tests

1. **Unit Tests**:
    - Create test files in the `tests/Unit` directory
    - Extend `PHPUnit\Framework\TestCase` for pure unit tests
    - Extend `Tests\TestCase` for tests that need Laravel functionality
    - Use `RefreshDatabase` trait if database access is required

   Example:
   ```php
   <?php
   
   namespace Tests\Unit;
   
   use App\Models\Category;
   use Illuminate\Foundation\Testing\RefreshDatabase;
   use Tests\TestCase;
   
   class CategoryTest extends TestCase
   {
       use RefreshDatabase;
       
       public function test_category_can_be_created(): void
       {
           $category = Category::create([
               'name' => 'Test Category',
               'type' => 'expense',
           ]);
           
           $this->assertEquals('Test Category', $category->name);
       }
   }
   ```

2. **Feature Tests**:
    - Create test files in the `tests/Feature` directory
    - Extend `Tests\TestCase`
    - Use `RefreshDatabase` trait if database modifications are made

   Example:
   ```php
   <?php
   
   namespace Tests\Feature;
   
   use App\Models\User;
   use Illuminate\Foundation\Testing\RefreshDatabase;
   use Tests\TestCase;
   
   class ExampleFeatureTest extends TestCase
   {
       use RefreshDatabase;
       
       public function test_user_can_view_dashboard(): void
       {
           $user = User::factory()->create();
           
           $response = $this->actingAs($user)->get('/dashboard');
           
           $response->assertStatus(200);
       }
   }
   ```

## Additional Development Information

### Code Style

- The project follows PSR-12 coding standards
- Laravel naming conventions are used throughout the project
- Use type hints and return types for all methods

### Multi-Tenancy

- The application implements multi-tenancy using a global `HasUserScope` trait
- All models that should be scoped to the authenticated user should use this trait
- Always ensure new models that contain user-specific data implement this trait

### Money Handling

- Money values are stored as integers (cents) in the database
- The `HasMoney` trait and `MoneyCast` are used to handle money values
- Always use these tools when dealing with monetary values to ensure consistency

### Relationships

- Follow Laravel's relationship naming conventions
- Use type hints for relationship methods (e.g., `public function categories(): HasMany`)
- Document relationships in PHPDoc comments

### Testing Best Practices

- Write tests for all new features and bug fixes
- Use factories for creating test data
- Mock external services in tests
- Use database transactions to speed up tests when possible

### Debugging

- Use Laravel's built-in debugging tools:
  ```php
  // Dump and continue
  dump($variable);
  
  // Dump and die
  dd($variable);
  
  // Dump, die, and debug
  ddd($variable);
  ```

- For more advanced debugging, the project includes Laravel Debugbar
