# BudgetGen – Smart Finance Manager

> **The open‑source personal finance platform built with Laravel & Flutter**

BudgetGen helps individuals stay on top of their money by unifying income, expenses, credit cards, loans, investments
and goals into one elegant dashboard.  
This repository contains the **web application (Laravel)** – a solid foundation for the upcoming Flutter mobile app.

---

## ✨ Key Features (Web MVP)

| Module                      | Highlights                                                                                                       |
|-----------------------------|------------------------------------------------------------------------------------------------------------------|
| **Transactions**            | Unified table stores income, expenses, investments & debts; category / sub‑category tagging, notes & date labels |
| **Recurring Payments**      | Handles EMIs, subscriptions, rent & any repeating charge; reminder scheduler built on Laravel Scheduler          |
| **Credit & Loan Tracker**   | Track card limits, dues, loan principals, interest, and EMI progress                                             |
| **Goals & Net Worth**       | Set savings targets, track assets vs. liabilities and view dynamic net‑worth widgets                             |
| **Investments & Insurance** | SIPs, lump sum, stocks, LIC, health, term, motor & tax‑saving planner                                            |
| **Multi‑Tenancy**           | Global `HasUserScope` trait restricts every query to the authenticated user                                      |
| **Notifications (Planned)** | Email / push reminders for due dates, budget alerts & goal milestones                                            |

_For the complete roadmap see [Roadmap](#-roadmap)._

---

## 🛠️ Tech Stack

| Layer             | Web (this repo)                                                         | Mobile (future)             |
|-------------------|-------------------------------------------------------------------------|-----------------------------|
| **Backend**       | Laravel 12 & FilamentPHP 3 (PHP 8.3)                                    | –                           |
| **Database**      | Sqlite 8.x                                                              | SQLite via `sqflite`        |
| **Frontend**      | Blade, Alpine.js, Livewire Tailwind                                     | Flutter (Material 3)        |
| **State Mgmt**    | –                                                                       | Riverpod / `setState`       |
| **Charts**        | [`consoletvs/charts`](https://github.com/ConsoleTVs/Charts) *(planned)* | `fl_chart` *(planned)*      |
| **Auth**          | Laravel Auth (session)                                                  | Biometric + PIN *(planned)* |
| **Notifications** | Laravel Scheduler & mail                                                | Local + push *(planned)*    |

---

## 📂 Project Structure (Laravel)

```text
app/
│  ├─ Models\            # Eloquent models (Transaction, Category, Loan, …)
│  ├─ Traits\            # HasMoney, HasUserScope, …
│  ├─ Http/Controllers\
│  ├─ Admin/  # Admin UI components
│  └─ Casts/             # MoneyCast, etc.
├─ database/
│  ├─ migrations/
│  ├─ seeders/
│  └─ factories/
├─ resources/views/      # Blade templates
├─ routes/
│  ├─ web.php
│  └─ api.php
└─ tests/
```

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

### 3. Testing

#### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test suites
php artisan test --testsuite=Unit
php artisan test --testsuite=Feature

# Run a specific test file
php artisan test tests/Unit/CategoryTest.php

# Run a specific test method
php artisan test --filter=test_category_can_be_created
```

#### Testing Configuration

The project uses PHPUnit for testing with the following configuration:

- Tests are separated into Feature and Unit tests
- SQLite in-memory database is used for testing
- Environment variables are set in `phpunit.xml`

#### Creating New Tests

1. **Unit Tests**:
    - Create test files in the `tests/Unit` directory
    - Extend `PHPUnit\Framework\TestCase` for pure unit tests
    - Extend `Tests\TestCase` for tests that need Laravel functionality
    - Use `RefreshDatabase` trait if database access is required

2. **Feature Tests**:
    - Create test files in the `tests/Feature` directory
    - Extend `Tests\TestCase`
    - Use `RefreshDatabase` trait if database modifications are made

### 4. Environment Variables

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
