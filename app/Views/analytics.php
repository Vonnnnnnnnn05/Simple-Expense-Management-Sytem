<!-- app/Views/analytics.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Analytics</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    :root{
      /* ✅ White + Red Theme */
      --bg:#f7f7fb;
      --panel:#ffffff;
      --panel2:#fafafa;
      --border:rgba(0,0,0,.08);
      --text:#121212;
      --muted:rgba(18,18,18,.65);

      --red-700:#be123c;
      --red-600:#e11d48;
      --red-500:#f43f5e;
      --red-400:#fb7185;

      --sidebar-w: 270px;
      --shadow: 0 18px 50px rgba(0,0,0,.10);
    }

    body{
      background:
        radial-gradient(900px 500px at 20% 10%, rgba(244,63,94,.16), transparent 60%),
        radial-gradient(900px 500px at 80% 90%, rgba(225,29,72,.10), transparent 60%),
        var(--bg) !important;
      color: var(--text) !important;
    }

    /* Sidebar */
    .sidebar{
      position: fixed;
      top: 0; left: 0;
      height: 100vh;
      width: var(--sidebar-w);
      background: linear-gradient(180deg, rgba(255,255,255,.98), rgba(255,255,255,.92));
      border-right: 1px solid rgba(244,63,94,.22);
      padding: 18px 16px;
      z-index: 1030;
      display:flex;
      flex-direction:column;
      gap: 14px;
      box-shadow: 0 18px 45px rgba(0,0,0,.10);
    }

    .sidebar-brand{
      display:flex;
      align-items:center;
      gap:10px;
      padding: 12px 12px;
      border-radius: 14px;
      border: 1px solid rgba(244,63,94,.25);
      background:
        radial-gradient(700px 240px at 20% -20%, rgba(244,63,94,.16), transparent 60%),
        rgba(255,255,255,.85);
    }
    .sidebar-brand .icon{
      width: 42px; height: 42px;
      display:grid; place-items:center;
      border-radius: 12px;
      background: linear-gradient(135deg, rgba(244,63,94,.95), rgba(225,29,72,.55));
      color: #ffffff;
      font-weight: 900;
      box-shadow: 0 12px 26px rgba(225,29,72,.16);
    }
    .sidebar-brand .title{ font-weight: 900; letter-spacing: .2px; line-height: 1.05; color: var(--text); }
    .sidebar-brand .subtitle{ font-size: .82rem; color: var(--muted); margin-top: 2px; }

    .sidebar-nav{ margin-top: 4px; display:flex; flex-direction:column; gap: 8px; }

    .sidebar-link{
      display:flex;
      align-items:center;
      gap:10px;
      padding: 10px 12px;
      border-radius: 12px;
      text-decoration:none;
      color: rgba(18,18,18,.92);
      border: 1px solid transparent;
      background: rgba(0,0,0,.02);
      transition: transform .12s ease, background .12s ease, border-color .12s ease;
      font-weight: 700;
    }
    .sidebar-link i{ color: rgba(244,63,94,.95); }
    .sidebar-link:hover{
      transform: translateY(-1px);
      background: rgba(244,63,94,.10);
      border-color: rgba(244,63,94,.22);
      color: var(--text);
    }
    .sidebar-link.active{
      background: rgba(244,63,94,.14);
      border-color: rgba(244,63,94,.30);
      font-weight: 900;
      color: var(--text);
    }

    .sidebar-spacer{ flex: 1; }

    .logout-link{
      display:flex;
      align-items:center;
      justify-content:center;
      gap:10px;
      padding: 10px 12px;
      border-radius: 12px;
      text-decoration:none;
      font-weight: 900;
      color: var(--text);
      border: 1px solid rgba(244,63,94,.25);
      background: rgba(244,63,94,.08);
      transition: transform .12s ease, box-shadow .12s ease, background .12s ease;
    }
    .logout-link:hover{
      transform: translateY(-1px);
      background: rgba(244,63,94,.12);
      box-shadow: 0 16px 30px rgba(225,29,72,.14);
    }

    /* Content */
    .content{
      margin-left: var(--sidebar-w);
      padding: 18px 18px 32px;
      min-height: 100vh;
    }

    /* Mobile */
    .sidebar-toggle{
      display:none;
      position: fixed;
      top: 14px;
      left: 14px;
      z-index: 1040;
      border-radius: 12px !important;
      border: 1px solid rgba(244,63,94,.25) !important;
      background: linear-gradient(135deg, rgba(244,63,94,.95), rgba(225,29,72,.55)) !important;
      color: #ffffff !important;
      font-weight: 900 !important;
      box-shadow: 0 12px 26px rgba(225,29,72,.16);
    }
    @media (max-width: 991.98px){
      :root{ --sidebar-w: 280px; }
      .sidebar{ transform: translateX(-105%); transition: transform .18s ease; }
      .sidebar.show{ transform: translateX(0); }
      .content{ margin-left: 0; padding-top: 64px; }
      .sidebar-toggle{ display:inline-flex; }
    }

    /* Surfaces */
    .surface{
      background: linear-gradient(180deg, rgba(255,255,255,.98), rgba(255,255,255,.92));
      border: 1px solid rgba(0,0,0,.08);
      border-radius: 16px;
      box-shadow: var(--shadow);
      overflow:hidden;
    }
    .surface-header{ padding: 16px 16px 0; }

    .h-title{ font-weight: 900; letter-spacing: .2px; margin: 0; color: var(--text); }
    .h-sub{ color: var(--muted); font-size: .92rem; }

    .pill{
      display:inline-flex;
      align-items:center;
      gap:6px;
      padding: 6px 10px;
      border-radius: 999px;
      border: 1px solid rgba(0,0,0,.08);
      background: rgba(0,0,0,.03);
      color: rgba(18,18,18,.70);
      font-size: .84rem;
      font-weight: 800;
    }

    .mini-btn{
      border-radius: 12px !important;
      font-weight: 900 !important;
      border: 1px solid rgba(0,0,0,.10) !important;
      background: rgba(0,0,0,.03) !important;
      color: var(--text) !important;
    }
    .mini-btn:hover{
      background: rgba(244,63,94,.10) !important;
      border-color: rgba(244,63,94,.22) !important;
    }

    .btn-red{
      background: linear-gradient(135deg, var(--red-600), var(--red-500)) !important;
      border: 1px solid rgba(0,0,0,.06) !important;
      color: #ffffff !important;
      font-weight: 900 !important;
      border-radius: 12px !important;
      box-shadow: 0 14px 28px rgba(225,29,72,.16);
      transition: transform .12s ease, box-shadow .12s ease, filter .12s ease;
    }
    .btn-red:hover{
      transform: translateY(-1px);
      box-shadow: 0 16px 34px rgba(225,29,72,.20);
      filter: brightness(1.01);
    }

    /* Form controls */
    .form-control, .form-select{
      background: rgba(255,255,255,.98) !important;
      border: 1px solid rgba(0,0,0,.10) !important;
      color: var(--text) !important;
      border-radius: 12px !important;
      padding: .70rem .95rem !important;
    }
    .form-control:focus, .form-select:focus{
      background: rgba(255,255,255,1) !important;
      border-color: rgba(244,63,94,.65) !important;
      box-shadow: 0 0 0 .22rem rgba(244,63,94,.18) !important;
      outline: 0 !important;
    }

    /* Table */
    .table{ margin: 0 !important; color: var(--text) !important; }
    .table thead th{
      background: rgba(244,63,94,.10) !important;
      color: var(--text) !important;
      border-bottom: 1px solid rgba(0,0,0,.08) !important;
      padding: 14px 12px;
      font-weight: 900;
      letter-spacing: .2px;
    }
    .table td{
      border-color: rgba(0,0,0,.06) !important;
      padding: 14px 12px;
      vertical-align: middle;
      background: transparent !important;
      color: var(--text) !important;
    }
    .table-hover tbody tr:hover{
      background: rgba(244,63,94,.06) !important;
    }

    .alert{
      border-radius: 12px !important;
      border: 1px solid rgba(0,0,0,.08) !important;
      background: rgba(255,255,255,.92) !important;
      color: var(--text) !important;
      padding: .8rem .9rem !important;
    }
    .alert-danger{ border-left: 4px solid var(--red-600) !important; }

    /* Currency badge */
    .rate-badge{
      display:inline-flex;
      align-items:center;
      gap:8px;
      padding: 8px 10px;
      border-radius: 12px;
      border: 1px solid rgba(0,0,0,.08);
      background: rgba(0,0,0,.03);
      color: rgba(18,18,18,.70);
      font-weight: 900;
      font-size: .86rem;
    }
    .rate-dot{
      width:10px; height:10px;
      border-radius: 999px;
      background: rgba(244,63,94,.95);
      box-shadow: 0 0 0 6px rgba(244,63,94,.14);
    }

    /* Grand total row style */
    .grand-row td{
      background: rgba(244,63,94,.08) !important;
      font-weight: 900 !important;
      border-top: 1px solid rgba(0,0,0,.10) !important;
    }
  </style>
</head>

<body>

  <button class="btn sidebar-toggle" type="button" id="sidebarToggle">
    <i class="bi bi-list"></i>
  </button>

  <aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <div class="icon"><i class="bi bi-cash-coin"></i></div>
      <div>
        <div class="title">Expense Tracker</div>
        <div class="subtitle">Manage your spending</div>
      </div>
    </div>

    <nav class="sidebar-nav">
      <a class="sidebar-link" href="<?= base_url('/expenses') ?>">
        <i class="bi bi-receipt"></i>
        <span>Expenses</span>
      </a>

      <a class="sidebar-link" href="<?= base_url('/expenses/add') ?>">
        <i class="bi bi-plus-circle"></i>
        <span>Add Expense</span>
      </a>

      <a class="sidebar-link active" href="<?= base_url('/analytics') ?>">
        <i class="bi bi-graph-up-arrow"></i>
        <span>Analytics</span>
      </a>
    </nav>

    <div class="sidebar-spacer"></div>

    <a href="<?= base_url('/logout') ?>"
       class="logout-link"
       onclick="return confirm('Are you sure you want to logout?');">
      <i class="bi bi-box-arrow-right"></i>
      <span>Logout</span>
    </a>
  </aside>

  <main class="content">
    <div class="container">

      <?php
        // ---------- Currency dropdown (10 currencies) ----------
        $currencyList = [
          'PHP' => 'Philippine Peso (PHP)',
          'USD' => 'US Dollar (USD)',
          'EUR' => 'Euro (EUR)',
          'JPY' => 'Japanese Yen (JPY)',
          'GBP' => 'British Pound (GBP)',
          'AUD' => 'Australian Dollar (AUD)',
          'CAD' => 'Canadian Dollar (CAD)',
          'SGD' => 'Singapore Dollar (SGD)',
          'HKD' => 'Hong Kong Dollar (HKD)',
          'AED' => 'UAE Dirham (AED)',
        ];

        $selectedCurrency = strtoupper((string)($_GET['currency'] ?? ($currency ?? 'PHP')));
        if (!array_key_exists($selectedCurrency, $currencyList)) $selectedCurrency = 'PHP';

        $baseCurrency = 'PHP';

        $symbols = [
          'PHP'=>'₱','USD'=>'$','EUR'=>'€','JPY'=>'¥','GBP'=>'£',
          'AUD'=>'A$','CAD'=>'C$','SGD'=>'S$','HKD'=>'HK$','AED'=>'د.إ'
        ];

        // ---------- Currency Convert API ----------
        $rate = 1.0;
        $rateOk = true;
        if ($selectedCurrency !== $baseCurrency) {
          // Use a more reliable API endpoint
          $apiUrl = 'https://api.exchangerate-api.com/v4/latest/' . urlencode($baseCurrency);

          $json = @file_get_contents($apiUrl);
          if ($json !== false) {
            $data = json_decode($json, true);
            if (isset($data['rates'][$selectedCurrency]) && is_numeric($data['rates'][$selectedCurrency])) {
              $rate = (float)$data['rates'][$selectedCurrency];
            } else {
              $rateOk = false;
              $rate = 1.0;
            }
          } else {
            $rateOk = false;
            $rate = 1.0;
          }
        }

        $curSym = $symbols[$selectedCurrency] ?? '';
        $fmt = function($amountPhp) use ($rate, $curSym) {
          $val = (float)$amountPhp * (float)$rate;
          return $curSym . ' ' . number_format($val, 2);
        };

        // ✅ SUM TOTAL EXPENSE (safe)
        $totalSpentCalc = 0.0;
        if (isset($totalSpent) && is_numeric($totalSpent)) {
          $totalSpentCalc = (float)$totalSpent;
        } elseif (!empty($categoryTotals) && is_array($categoryTotals)) {
          foreach ($categoryTotals as $row) $totalSpentCalc += (float)($row['total'] ?? 0);
        } elseif (!empty($recentExpenses) && is_array($recentExpenses)) {
          foreach ($recentExpenses as $e) $totalSpentCalc += (float)($e['amount'] ?? 0);
        }

        $categoryGrand = 0.0;
        if (!empty($categoryTotals) && is_array($categoryTotals)) {
          foreach ($categoryTotals as $row) $categoryGrand += (float)($row['total'] ?? 0);
        }

        $recentGrand = 0.0;
        if (!empty($recentExpenses) && is_array($recentExpenses)) {
          foreach ($recentExpenses as $e) $recentGrand += (float)($e['amount'] ?? 0);
        }
      ?>

      <div class="d-flex align-items-end justify-content-between flex-wrap gap-3 mb-3">
        <div>
          <h2 class="h-title mb-1">Analytics</h2>
          <div class="h-sub">Summary of your expenses (totals, categories, and recent spending).</div>
        </div>

        <!-- Filters + Currency -->
        <form class="d-flex align-items-center gap-2 flex-wrap" method="get" action="<?= base_url('/analytics') ?>">
          <span class="pill"><i class="bi bi-funnel"></i> Filters</span>

          <input type="date" name="from" class="form-control" value="<?= esc($from ?? '') ?>" />
          <input type="date" name="to" class="form-control" value="<?= esc($to ?? '') ?>" />

          <select name="category" class="form-select">
            <option value="">All Categories</option>
            <?php
              $cats = $categories ?? [];
              $selectedCat = $selectedCategory ?? '';
              if (is_array($cats)):
                foreach ($cats as $c):
                  $val = (string)$c;
            ?>
              <option value="<?= esc($val) ?>" <?= ($selectedCat === $val) ? 'selected' : '' ?>>
                <?= esc($val) ?>
              </option>
            <?php endforeach; endif; ?>
          </select>

          <select name="currency" class="form-select" style="min-width: 210px;">
            <?php foreach ($currencyList as $code => $label): ?>
              <option value="<?= esc($code) ?>" <?= ($selectedCurrency === $code) ? 'selected' : '' ?>>
                <?= esc($label) ?>
              </option>
            <?php endforeach; ?>
          </select>

          <button class="btn btn-red" type="submit">
            <i class="bi bi-search me-1"></i> Apply
          </button>

          <a class="btn mini-btn" href="<?= base_url('/analytics') ?>">
            <i class="bi bi-x-circle me-1"></i> Clear
          </a>
        </form>
      </div>

      <!-- Badges -->
      <div class="d-flex justify-content-end mb-3 gap-2 flex-wrap">
        <div class="rate-badge">
          <span class="rate-dot"></span>
          <span>
            <?= esc($baseCurrency) ?> → <?= esc($selectedCurrency) ?> :
            <strong><?= $rateOk ? number_format((float)$rate, 6) : 'API Error (base)' ?></strong>
          </span>
        </div>

        <div class="rate-badge">
          <i class="bi bi-calculator"></i>
          <span>Total Expense: <strong><?= $fmt($totalSpentCalc) ?></strong></span>
        </div>
      </div>

      <?php if (session()->has('error')): ?>
        <div class="alert alert-danger mb-3">
          <i class="bi bi-exclamation-triangle me-2"></i>
          <?= session('error') ?>
        </div>
      <?php endif; ?>

      <!-- Top summary cards -->
      <div class="row g-3 mb-3">
        <div class="col-12 col-md-4">
          <div class="surface p-3">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <div class="pill"><i class="bi bi-cash-stack"></i> Total Spent</div>
                <div class="mt-2" style="font-weight: 900; font-size: 1.6rem;">
                  <?= $fmt($totalSpentCalc) ?>
                </div>
                <div class="h-sub mt-1">
                  Records: <?= (int)($totalCount ?? 0) ?>
                </div>
              </div>
              <div class="icon" style="width:50px;height:50px;border-radius:16px;">
                <i class="bi bi-graph-up"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="surface p-3">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <div class="pill"><i class="bi bi-calendar-event"></i> This Month</div>
                <div class="mt-2" style="font-weight: 900; font-size: 1.6rem;">
                  <?= $fmt($monthSpent ?? 0) ?>
                </div>
                <div class="h-sub mt-1">
                  <?= esc($monthLabel ?? 'Current month') ?>
                </div>
              </div>
              <div class="icon" style="width:50px;height:50px;border-radius:16px;">
                <i class="bi bi-calendar3"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="surface p-3">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <div class="pill"><i class="bi bi-tags"></i> Top Category</div>
                <div class="mt-2" style="font-weight: 900; font-size: 1.25rem;">
                  <?= esc($topCategory ?? 'N/A') ?>
                </div>
                <div class="h-sub mt-1">
                  <?= $fmt($topCategoryAmount ?? 0) ?>
                </div>
              </div>
              <div class="icon" style="width:50px;height:50px;border-radius:16px;">
                <i class="bi bi-award"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Category totals table -->
      <div class="surface mb-3">
        <div class="surface-header">
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 pb-3">
            <div class="pill"><i class="bi bi-pie-chart"></i> Category Totals</div>
            <div class="pill"><i class="bi bi-sort-down"></i> Highest first</div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead>
              <tr>
                <th>Category</th>
                <th class="text-end">Total Amount (<?= esc($selectedCurrency) ?>)</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($categoryTotals) && is_array($categoryTotals)): ?>
                <?php foreach ($categoryTotals as $row): ?>
                  <tr>
                    <td><?= esc($row['category'] ?? '') ?></td>
                    <td class="text-end fw-bold"><?= $fmt($row['total'] ?? 0) ?></td>
                  </tr>
                <?php endforeach; ?>

                <tr class="grand-row">
                  <td>GRAND TOTAL</td>
                  <td class="text-end"><?= $fmt($categoryGrand) ?></td>
                </tr>

              <?php else: ?>
                <tr>
                  <td colspan="2" class="text-center" style="color: var(--muted); padding: 26px 12px;">
                    No data to display.
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Recent expenses table -->
      <div class="surface">
        <div class="surface-header">
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 pb-3">
            <div class="pill"><i class="bi bi-clock-history"></i> Recent Expenses</div>
            <a href="<?= base_url('/expenses') ?>" class="btn mini-btn">
              <i class="bi bi-list-ul me-1"></i> View All
            </a>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead>
              <tr>
                <th>Date</th>
                <th>Category</th>
                <th>Description</th>
                <th class="text-end">Amount (<?= esc($selectedCurrency) ?>)</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($recentExpenses) && is_array($recentExpenses)): ?>
                <?php foreach ($recentExpenses as $e): ?>
                  <tr>
                    <td><?= esc($e['expense_date'] ?? '') ?></td>
                    <td><?= esc($e['category'] ?? '') ?></td>
                    <td class="text-wrap"><?= esc($e['description'] ?? '') ?></td>
                    <td class="text-end fw-bold"><?= $fmt($e['amount'] ?? 0) ?></td>
                  </tr>
                <?php endforeach; ?>

                <tr class="grand-row">
                  <td colspan="3">RECENT TOTAL</td>
                  <td class="text-end"><?= $fmt($recentGrand) ?></td>
                </tr>

              <?php else: ?>
                <tr>
                  <td colspan="4" class="text-center" style="color: var(--muted); padding: 26px 12px;">
                    No recent expenses found.
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const sidebar = document.getElementById('sidebar');
      const toggle = document.getElementById('sidebarToggle');
      if (toggle) toggle.addEventListener('click', () => sidebar.classList.toggle('show'));
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
