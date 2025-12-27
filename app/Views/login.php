<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Expense Tracker</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    /* White + Red Theme (revised) */
    :root{
      --bg:#f7f7fb;
      --panel:#ffffff;
      --panel2:#fbfbfd;
      --border:rgba(0,0,0,.08);
      --text:#111827;
      --muted:rgba(17,24,39,.60);

      --red-700:#be123c;
      --red-600:#e11d48;
      --red-500:#f43f5e;

      --shadow: 0 18px 50px rgba(0,0,0,.10);
    }

    body{
      min-height: 100vh;
      background:
        radial-gradient(900px 500px at 18% 12%, rgba(244,63,94,.18), transparent 60%),
        radial-gradient(900px 500px at 82% 88%, rgba(225,29,72,.12), transparent 60%),
        var(--bg) !important;
      color: var(--text) !important;
      display:flex;
      align-items:center;
      justify-content:center;
      padding: 24px 12px;
    }

    .wrap{
      width: 980px;
      max-width: 1100px;
    }

    .shell{
      display:grid;
      grid-template-columns: 1.15fr .85fr;
      gap: 18px;
      align-items: stretch;
    }

    @media (max-width: 991.98px){
      .shell{ grid-template-columns: 1fr; }
    }

    /* Left hero */
    .hero{
      position: relative;
      border-radius: 18px;
      overflow:hidden;
      border: 1px solid rgba(244,63,94,.22);
      background:
        radial-gradient(900px 420px at 20% 20%, rgba(244,63,94,.18), transparent 55%),
        linear-gradient(180deg, rgba(255,255,255,.92), rgba(255,255,255,.80));
      box-shadow: var(--shadow);
      padding: 26px 24px;
      min-height: 420px;
    }

    .brand{
      display:flex;
      align-items:center;
      gap: 12px;
      margin-bottom: 18px;
    }

    .brand .mark{
      width: 46px; height: 46px;
      display:grid; place-items:center;
      border-radius: 14px;
      background: linear-gradient(135deg, var(--red-600), var(--red-500));
      color: #fff;
      box-shadow: 0 14px 26px rgba(225,29,72,.18);
    }

    .brand .title{
      font-weight: 900;
      letter-spacing: .2px;
      margin: 0;
      line-height: 1.05;
    }

    .brand .sub{
      color: var(--muted);
      font-size: .92rem;
      margin-top: 2px;
    }

    .hero h2{
      font-weight: 900;
      letter-spacing: .2px;
      margin: 6px 0 8px;
      font-size: clamp(1.4rem, 2.2vw, 2rem);
    }

    .hero p{
      color: rgba(17,24,39,.70);
      margin: 0 0 18px;
      max-width: 42ch;
    }

    .feature{
      display:flex;
      gap: 12px;
      align-items:flex-start;
      padding: 12px 12px;
      border-radius: 14px;
      border: 1px solid rgba(0,0,0,.06);
      background: rgba(255,255,255,.72);
      margin-bottom: 10px;
    }

    .feature i{
      color: var(--red-600);
      font-size: 1.1rem;
      margin-top: 2px;
    }

    .feature b{ display:block; }
    .feature span{ color: rgba(17,24,39,.65); font-size: .92rem; }

    .hero .note{
      position:absolute;
      bottom: 16px;
      left: 18px;
      right: 18px;
      display:flex;
      gap: 10px;
      align-items:center;
      padding: 10px 12px;
      border-radius: 14px;
      border: 1px solid rgba(244,63,94,.20);
      background: rgba(255,255,255,.70);
      color: rgba(17,24,39,.70);
      font-size: .92rem;
    }

    .hero .note i{ color: var(--red-600); }

    /* Right login card */
    .card-wrap{
      position: relative;
    }

    .card-wrap::before{
      content:"";
      position:absolute;
      inset:-2px;
      border-radius: 18px;
      background: linear-gradient(135deg, rgba(244,63,94,.55), rgba(225,29,72,.18), rgba(0,0,0,.04));
      filter: blur(12px);
      opacity:.45;
      z-index:0;
    }

    .card{
      position: relative;
      z-index: 1;
      background: var(--panel) !important;
      border: 1px solid rgba(244,63,94,.26) !important;
      border-radius: 18px !important;
      box-shadow: var(--shadow);
      overflow:hidden;
    }

    .card::after{
      content:"";
      position:absolute;
      inset:0;
      background:
        radial-gradient(800px 240px at 30% -20%, rgba(244,63,94,.10), transparent 60%),
        radial-gradient(600px 240px at 110% 30%, rgba(225,29,72,.08), transparent 55%);
      pointer-events:none;
    }

    .card-body{
      position: relative;
      z-index: 2;
      padding: 1.75rem !important;
    }

    .login-title{
      font-weight: 900;
      letter-spacing: .2px;
      margin: 0;
    }

    .login-sub{
      color: var(--muted);
      font-size: .92rem;
      margin-top: 4px;
      margin-bottom: 1.1rem;
    }

    label{
      color: rgba(17,24,39,.78) !important;
      font-size: .9rem;
      font-weight: 800;
    }

    .form-control{
      background: #fff !important;
      border: 1px solid rgba(0,0,0,.12) !important;
      color: var(--text) !important;
      border-radius: 12px !important;
      padding: .72rem .95rem !important;
    }

    .form-control::placeholder{
      color: rgba(17,24,39,.45);
    }

    .form-control:focus{
      background: #fff !important;
      border-color: rgba(244,63,94,.85) !important;
      box-shadow: 0 0 0 .22rem rgba(244,63,94,.18) !important;
      outline: 0 !important;
    }

    .btn-danger{
      background: linear-gradient(135deg, var(--red-600), var(--red-500)) !important;
      border: 1px solid rgba(0,0,0,.06) !important;
      color: #ffffff !important;
      font-weight: 900;
      border-radius: 12px !important;
      padding: .78rem 1rem !important;
      box-shadow: 0 14px 28px rgba(225,29,72,.18);
      transition: transform .12s ease, box-shadow .12s ease, filter .12s ease;
    }

    .btn-danger:hover{
      transform: translateY(-1px);
      box-shadow: 0 16px 34px rgba(225,29,72,.22);
      filter: brightness(1.01);
    }

    .hint{
      margin-top: 10px;
      color: rgba(17,24,39,.55);
      font-size: .86rem;
      text-align:center;
    }

    .alert{
      border-radius: 12px !important;
      border: 1px solid rgba(0,0,0,.08) !important;
      background: rgba(255,255,255,.92) !important;
      color: var(--text) !important;
      padding: .8rem .9rem !important;
    }

    .alert-danger{ border-left: 4px solid var(--red-600) !important; }
    .alert-success{ border-left: 4px solid rgba(34,197,94,.75) !important; }
  </style>
</head>

<body>

  <div class="wrap">
    <div class="shell">

      <!-- Left: Expense Tracker intro -->
      <section class="hero">
        <div class="brand">
          <div class="mark"><i class="bi bi-cash-coin"></i></div>
          <div>
            <h1 class="title">Expense Tracker</h1>
            <div class="sub">Track spending. Stay on budget.</div>
          </div>
        </div>

        <h2>Welcome back </h2>
        <p>Log in to manage your expenses, view analytics, and keep your spending organized.</p>

        <div class="feature">
          <i class="bi bi-receipt"></i>
          <div>
            <b>Fast expense logging</b>
            <span>Add, edit, and delete expenses quickly.</span>
          </div>
        </div>

        <div class="feature">
          <i class="bi bi-graph-up-arrow"></i>
          <div>
            <b>Analytics & totals</b>
            <span>See totals per category and track recent spending.</span>
          </div>
        </div>

        <div class="feature">
          <i class="bi bi-shield-check"></i>
          <div>
            <b>Private & secure</b>
            <span>Your data stays in your account.</span>
          </div>
        </div>

        <div class="note">
          <i class="bi bi-lightning-charge-fill"></i>
          Tip: Use <b>Analytics</b> to see your total expenses and top category.
        </div>
      </section>

      <!-- Right: Login card -->
      <section class="card-wrap">
        <div class="card">
          <div class="card-body">
            <div class="text-center mb-3">
              <h3 class="login-title">Login</h3>
              <div class="login-sub">Access your Expense Tracker account</div>
            </div>

            <?php if(session()->getFlashdata('error')): ?>
              <div class="alert alert-danger mb-3">
                <?= session()->getFlashdata('error') ?>
              </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('success')): ?>
              <div class="alert alert-success mb-3">
                <?= session()->getFlashdata('success') ?>
              </div>
            <?php endif; ?>

            <?php if (isset($_GET['logout']) && $_GET['logout'] == '1'): ?>
              <script>
                window.alert("Successfully Logged Out");
              </script>
            <?php endif; ?>

            <?php if(isset($validation) && $validation->hasError('username')): ?>
              <div class="alert alert-danger mb-3">
                <?= $validation->getError('username') ?>
              </div>
            <?php endif; ?>
            <?php if(isset($validation) && $validation->hasError('password')): ?>
              <div class="alert alert-danger mb-3">
                <?= $validation->getError('password') ?>
              </div>
            <?php endif; ?>

            <form action="<?= base_url('/login') ?>" method="post" autocomplete="on">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input
                  type="text"
                  name="username"
                  id="username"
                  class="form-control"
                  placeholder="Enter your username"
                  required
                >
              </div>

              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input
                  type="password"
                  name="password"
                  id="password"
                  class="form-control"
                  placeholder="Enter your password"
                  required
                >
              </div>

              <button type="submit" class="btn btn-danger w-100">
                <i class="bi bi-box-arrow-in-right me-1"></i> Sign in
              </button>

              <div class="hint">
                Trouble logging in? Double-check your username and password.
              </div>
            </form>
          </div>
        </div>
      </section>

    </div>
  </div>

</body>
</html>
