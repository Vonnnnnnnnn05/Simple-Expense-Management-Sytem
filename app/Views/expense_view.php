<!-- app/Views/expense_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Expenses</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    :root{
      /* ✅ White + Red Theme (matches your white-red login) */
      --bg:#f7f7fb;
      --panel:#ffffff;
      --panel2:#fafafa;
      --border:rgba(0,0,0,.08);
      --text:#121212;
      --muted:rgba(18,18,18,.65);

      --red-700:#be123c;
      --red-600:#e11d48;
      --red-500:#f43f5e;

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

    .sidebar-brand .title{
      font-weight: 900;
      letter-spacing: .2px;
      line-height: 1.05;
      color: var(--text);
    }
    .sidebar-brand .subtitle{
      font-size: .82rem;
      color: var(--muted);
      margin-top: 2px;
    }

    .sidebar-nav{
      margin-top: 4px;
      display:flex;
      flex-direction:column;
      gap: 8px;
    }

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

    /* Mobile sidebar */
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

    /* Cards + table */
    .surface{
      background: linear-gradient(180deg, rgba(255,255,255,.98), rgba(255,255,255,.92));
      border: 1px solid rgba(0,0,0,.08);
      border-radius: 16px;
      box-shadow: var(--shadow);
      overflow:hidden;
    }

    .surface-header{ padding: 16px 16px 0; }

    .h-title{
      font-weight: 900;
      letter-spacing: .2px;
      margin: 0;
      color: var(--text);
    }
    .h-sub{ color: var(--muted); font-size: .92rem; }

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

    /* ✅ Table text colors fixed for white theme */
    .table{
      margin: 0 !important;
      color: var(--text) !important;
    }
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
      color: var(--text) !important; /* ✅ changed from white to dark */
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
    .alert-success{ border-left: 4px solid rgba(34,197,94,.85) !important; }
    .alert-danger{ border-left: 4px solid var(--red-600) !important; }

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
  </style>
</head>

<body>

  <!-- Mobile toggle -->
  <button class="btn sidebar-toggle" type="button" id="sidebarToggle">
    <i class="bi bi-list"></i>
  </button>

  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <div class="icon"><i class="bi bi-cash-coin"></i></div>
      <div>
        <div class="title">Expense Tracker</div>
        <div class="subtitle">Manage your spending</div>
      </div>
    </div>

    <nav class="sidebar-nav">
      <a class="sidebar-link active" href="<?= base_url('/expenses') ?>">
        <i class="bi bi-receipt"></i>
        <span>Expenses</span>
      </a>

      <a class="sidebar-link" href="<?= base_url('/expenses/add') ?>">
        <i class="bi bi-plus-circle"></i>
        <span>Add Expense</span>
      </a>

      <a class="sidebar-link" href="<?= base_url('/analytics') ?>">
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

  <!-- Main content -->
  <main class="content">
    <div class="container">

      <div class="d-flex align-items-end justify-content-between flex-wrap gap-3 mb-3">
        <div>
          <h2 class="h-title mb-1">Expenses</h2>
          <div class="h-sub">Track your daily spending records.</div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <span class="pill">
            <i class="bi bi-list-check"></i>
            Total: <?= isset($expenses) && is_array($expenses) ? count($expenses) : 0 ?>
          </span>
          <a href="<?= base_url('/expenses/add') ?>" class="btn btn-red">
            <i class="bi bi-plus-circle me-1"></i> Add Expense
          </a>
        </div>
      </div>

      <!-- Flash Messages -->
      <?php if (session()->has('message')): ?>
        <div class="alert alert-success mb-3">
          <i class="bi bi-check-circle me-2"></i>
          <?= session('message') ?>
        </div>
      <?php endif; ?>

      <?php if (session()->has('error')): ?>
        <div class="alert alert-danger mb-3">
          <i class="bi bi-exclamation-triangle me-2"></i>
          <?= session('error') ?>
        </div>
      <?php endif; ?>

      <div class="surface">
        <div class="surface-header">
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 pb-3">
            <div class="pill">
              <i class="bi bi-info-circle"></i>
              Latest first (sorted by date)
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead>
              <tr>
                <th>Date</th>
                <th>Category</th>
                <th>Description</th>
                <th class="text-end">Amount</th>
                <th class="text-center" style="width: 220px;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($expenses) && is_array($expenses)): ?>
                <?php foreach ($expenses as $e): ?>
                  <tr>
                    <td><?= esc($e['expense_date'] ?? '') ?></td>
                    <td><?= esc($e['category'] ?? '') ?></td>
                    <td class="text-wrap"><?= esc($e['description'] ?? '') ?></td>
                    <td class="text-end fw-bold"><?= number_format((float)($e['amount'] ?? 0), 2) ?></td>
                    <td class="text-center">
                      <a href="<?= base_url('/expenses/edit/' . ($e['id'] ?? 0)) ?>" class="btn mini-btn btn-sm">
                        <i class="bi bi-pencil"></i> Edit
                      </a>
                      <a href="<?= base_url('/expenses/delete/' . ($e['id'] ?? 0)) ?>"
                         class="btn mini-btn btn-sm"
                         onclick="return confirm('Delete this expense?');">
                        <i class="bi bi-trash"></i> Delete
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" class="text-center" style="color: var(--muted); padding: 26px 12px;">
                    No expenses found.
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
