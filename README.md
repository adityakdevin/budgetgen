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
| **Backend**       | Laravel 11 (PHP 8.3)                                                    | –                           |
| **Database**      | MySQL 8.x                                                               | SQLite via `sqflite`        |
| **Frontend**      | Blade, Alpine.js                                                        | Flutter (Material 3)        |
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
│  ├─ Livewire/ & Filament/  # Admin UI components
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
| npm / pnpm  | optional – **Bun is preferred**           |

### 2. Installation

```bash
# 1. Clone & enter
git clone https://github.com/adityakdevin/budgetgen.git
cd budgetgen

# 2. Install PHP deps
composer install --optimize-autoloader --no-dev

# 3. Copy env & generate key
cp .env.example .env
php artisan key:generate

# 4. Configure database
#   Edit DB_* vars in .env (MySQL)
#   or set SQLITE_PATH for quick local setup

# 5. Run migrations & seeders
php artisan migrate --seed

# 6. Build front‑end assets (Bun)
bun install
bun run dev        # or: bun run build --prod

# 7. Serve
php artisan serve  # http://127.0.0.1:8000
```

### 3. Running Tests

```bash
php artisan test   # Unit + Feature tests
bun run test       # JS tests (if any)
```

### 4. Environment Variables

Refer to **`.env.example`** for the full list. Key settings:

```dotenv
APP_NAME="BudgetGen"
APP_ENV=local
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=budgetgen
DB_USERNAME=root
DB_PASSWORD=

# Mail (for reminders)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

---

## 🗺️ Roadmap

### Phase 1 – Web MVP (Laravel + Blade)

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

_See the [GitHub Projects board](https://github.com/your-org/budgetgen/projects) for detailed tasks._

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
- **Discussions:** [GitHub Discussions](https://github.com/your-org/budgetgen/discussions)
- **Twitter:** [@adityakdevin](https://twitter.com/adityakdevin)

> *"Track smarter, save faster, live better." – BudgetGen*
