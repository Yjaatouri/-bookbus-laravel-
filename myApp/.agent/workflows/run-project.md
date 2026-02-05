---
description: How to run the BookBus Laravel application
---

To run this project locally, follow these steps:

1. **Install Dependencies** (if not already done):
```bash
composer install
npm install
```

2. **Environment Setup**:
Ensure your `.env` file exists and has the correct database credentials.

3. **Start the Development Environment**:
// turbo
```bash
composer dev
```
This command will simultaneously start:
- The PHP development server (`artisan serve`)
- The Vite development server (`npm run dev`)
- Background workers and logs

4. **Access the App**:
Open [http://localhost:8000](http://localhost:8000) in your browser.
