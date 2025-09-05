# BudgetGen – Smart Finance Manager

> **The open‑source personal finance platform built with Laravel & FilamentPHP**

BudgetGen helps individuals stay on top of their money by unifying income, expenses, credit cards, loans, investments
and goals into one elegant dashboard. Built with modern Laravel 12 and FilamentPHP 4 for a powerful admin interface.

---

## ✨ Key Features

| Module                     | Highlights                                                                                                       |
|----------------------------|------------------------------------------------------------------------------------------------------------------|
| **Transactions**           | Unified table stores income, expenses, investments & debts; category / sub‑category tagging, notes & date labels |
| **Recurring Payments**     | Handles EMIs, subscriptions, rent & any repeating charge with schedule tracking                                  |
| **Credit Card Management** | Track card limits, dues, EMI payments with relationship-based due tracking                                       |
| **Loan Tracking**          | Monitor loan principals, interest rates, EMI progress and payment schedules                                      |
| **Goals & Contributions**  | Set savings targets with detailed contribution tracking and progress monitoring                                  |
| **Investments**            | SIP, lump sum, stocks tracking with tax sections, risk levels, and goal linking                                  |
| **Insurance Management**   | LIC, health, term, motor insurance tracking with premium schedules                                               |
| **Tax Planning**           | Tax-saving plan management with deduction tracking                                                               |
| **Monthly Budgets**        | Category-wise budget allocation and tracking                                                                     |
| **Multi‑Tenancy**          | Global `HasUserScope` trait restricts every query to the authenticated user                                      |
| **Admin Interface**        | Full-featured FilamentPHP 4 admin panel with advanced table management                                           |

_For detailed task tracking see [docs/tasks.md](docs/tasks.md)._

---

## 🛠️ Tech Stack

| Component          | Technology                       | Version |
|--------------------|----------------------------------|---------|
| **Backend**        | Laravel Framework                | 12.28.1 |
| **Admin UI**       | FilamentPHP                      | 4.0.7   |
| **Frontend**       | Livewire + Alpine.js + Tailwind  | 3.6.4   |
| **Database**       | SQLite                           | –       |
| **PHP**            | PHP                              | 8.4.12  |
| **Testing**        | Pest                             | 3.8.4   |
| **Code Quality**   | Laravel Pint + Larastan + Rector | Latest  |
| **Performance**    | Laravel Octane                   | 2.12.1  |
| **Authentication** | Laravel Sanctum                  | 4.2.0   |
| **Build Tools**    | Vite + Tailwind CSS              | 4.1.8   |

---

## 📂 Project Structure

```text
app/
├─ Admin/                # FilamentPHP Resources and Pages
│  └─ Resources/         # Admin CRUD interfaces for all models
├─ Casts/                # Custom Eloquent casts (MoneyCast)
├─ Enums/                # Type-safe enumerations
├─ Http/Controllers/     # Web controllers
├─ Models/               # Eloquent models with relationships
│  └─ Scopes/            # Global query scopes
├─ Providers/            # Service providers including FilamentPHP
└─ Traits/               # Reusable model traits (HasUserScope, HasMoneyCasts)
database/
├─ factories/            # Model factories for testing
├─ migrations/           # Database schema definitions
└─ seeders/              # Sample data seeders
tests/
├─ Feature/              # Integration tests
└─ Unit/                 # Unit tests
```

### Database Schema

The application uses a comprehensive database schema with 17+ tables managing:

- **Core Financial Data**: Users, Transactions, Categories
- **Credit Management**: Credit Cards, Credit Card Dues
- **Loan Management**: Loans with EMI tracking
- **Investment Tracking**: Investments with goal linking
- **Planning Tools**: Goals, Goal Contributions, Monthly Budgets
- **Insurance & Tax**: Insurance policies, Tax Saving Plans
- **Automation**: Recurring Payments with Schedules

---

## 🚀 Getting Started

### 1. Prerequisites

| Requirement | Version                                   |
|-------------|-------------------------------------------|
| PHP         | **8.3+** (8.4 recommended)                |
| Composer    | 2.x                                       |
| MySQL       | 8.x (or MariaDB ≥10.6)                    |
| Node / Bun  | Node 20 **or** Bun 1.1 (for asset builds) |

### 2. Installation

```bash
# 1. Clone & enter
git clone https://github.com/adityakdevin/budgetgen.git
cd budgetgen

# 2. Install PHP deps
composer install --optimize-autoloader

# 3. Copy env & generate key
cp .env.example .env
php artisan key:generate

# 4. Configure database
#   Edit the .env file to set your database connection details:
DB_CONNECTION=sqlite
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=budgetgen
#DB_USERNAME=your_username
#DB_PASSWORD=your_password

# 5. Run migrations & seeders
php artisan migrate --seed

# 6. Build front‑end assets
# Using Bun (recommended):
bun install
bun run dev        # For development
# OR
bun run build      # For production

# Using npm (alternative):
npm install
npm run dev        # For development
# OR
npm run build      # For production

# 7. Serve
php artisan serve  # http://127.0.0.1:8000
```

### 3. Development Commands

The project includes helpful Composer scripts for development:

```bash
# Development server with concurrency (recommended)
composer run dev          # Starts: server, queue, logs, vite

# Code quality
composer run lint         # Run Laravel Pint formatter
composer run refactor     # Run Rector refactoring
composer run test         # Run tests + lint + refactor checks

# Testing
php artisan test          # Run all tests (Pest framework)
php artisan test --filter=CategoryTest  # Run specific tests
php artisan test tests/Unit/             # Run unit tests only
php artisan test tests/Feature/          # Run feature tests only
```

### 4. Testing Framework

The project uses **Pest PHP** (not PHPUnit) for a more expressive testing experience:

```php
// Example Pest test
it('can create a category', function () {
    $category = Category::factory()->create();
    
    expect($category)->toBeInstanceOf(Category::class)
        ->and($category->name)->not->toBeEmpty();
});
```

- Tests use SQLite in-memory database
- Database is refreshed between tests
- Feature tests cover FilamentPHP resources
- Unit tests focus on model logic and relationships

### 5. Environment Variables

Refer to **`.env.example`** for the full list. Key settings:

```dotenv
APP_NAME="BudgetGen"
APP_ENV=local
APP_URL=http://localhost

# Database
DB_CONNECTION=sqlite
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=budgetgen
#DB_USERNAME=root
#DB_PASSWORD=

# Mail (for reminders)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

---

## 💻 Development Guidelines

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

---

## 🗺️ Roadmap

### Phase 1 – Web MVP (Laravel + FilamentPHP)

- [x] Core transaction engine
- [x] Category & sub‑category seeder
- [x] Recurring payments overhaul
- [ ] Dashboard charts & budget alerts
- [ ] Email reminders + queue workers

### Phase 2 – Mobile App (Flutter)

- [ ] Offline‑first SQLite sync
- [ ] Biometric & PIN auth
- [ ] Push notifications

### Phase 3 – Extensions

- [ ] Open Banking / account aggregation
- [ ] AI spend insights & forecasts

_See the [GitHub Projects board](https://github.com/adityakdevin/budgetgen/projects) for detailed tasks._

---

## 🤝 Contributing

1. **Fork** the repo & create your branch:

   ```bash
   git checkout -b feature/awesome
   ```

2. **Commit** your changes:

   ```bash
   git commit -m "feat: add awesome feature"
   ```

3. **Push** to the branch:

   ```bash
   git push origin feature/awesome
   ```

4. **Open a Pull Request** – please follow the [Conventional Commits](https://www.conventionalcommits.org/) spec & *
   *PSR‑12** code style.

We ❤️ issues & PRs that improve docs, fix bugs or add tests!

---

## 📝 License

Distributed under the **MIT License**. See `LICENSE` for more information.

---

## 📇 Contact & Community

- **Project Lead:** [Aditya Kumar](mailto:contact@adityadev.in)
- **Discussions:** [GitHub Discussions](https://github.com/adiyakdevin/budgetgen/discussions)
- **Twitter:** [@adityakdevin](https://twitter.com/adityakdevin)

> *"Track smarter, save faster, live better." – BudgetGen*
