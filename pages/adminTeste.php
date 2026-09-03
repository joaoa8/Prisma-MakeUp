<?php
// ==========================================
// SIMULAÇÃO DE CONEXÃO E RECEPÇÃO DE DADOS
// ==========================================

// ── TRATAMENTO DO FORMULÁRIO (POST) ──
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_product') {
    $name = $_POST['name'] ?? '';
    $cat = $_POST['cat'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $desc = $_POST['desc'] ?? '';
    $hypo = isset($_POST['hypo']) ? 1 : 0;
    
    $form_success = true; 
}

// ── DADOS VAZIOS (Aguardando Banco de Dados) ──
$produtos = []; 
$pedidos = [];
$usuarios = [];
$tutoriais = [];
$atividades = [];
$vendas_semana = [];

// KPIs reestruturados
$kpis = [
    ['icon'=>'dollar-sign', 'val'=>'R$ 0,00', 'label'=>'Receita (mês)'],
    ['icon'=>'shopping-bag', 'val'=>'0', 'label'=>'Pedidos (mês)'],
    ['icon'=>'users', 'val'=>'0', 'label'=>'Usuárias ativas'],
    ['icon'=>'play-circle', 'val'=>'0', 'label'=>'Cursos vendidos']
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Admin — Prisma Makeup</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons"></script>
<link rel="stylesheet" href="styles/styleIndex.css">
<link rel="stylesheet" href="styles/styleGeral.css">
<style>
@font-face {
    font-family: 'Bainsley'; 
    src: url('../assets/bainsley/Bainsley_Roman.otf') format('opentype');
    font-weight: normal;
    font-style: normal;
}
@font-face {
    font-family: 'Bainsley'; 
    src: url('../assets/bainsley/Bainsley_Bold.otf') format('opentype');
    font-weight: bold;
    font-style: normal;
}
@font-face {
    font-family: 'Bainsley'; 
    src: url('../assets/bainsley/Bainsley_Italic.otf') format('opentype');
    font-weight: normal;
    font-style: italic;
}
@font-face {
    font-family: 'Bainsley'; 
    src: url('../assets/bainsley/Bainsley_Bold_Italic.otf') format('opentype');
    font-weight: bold;
    font-style: italic;
}

:root {
    --primary: #F4D6F8;
    --secundary: #F8F3D6;
    --tertiary: #D5F8F2;
    --primary2: #DE97F2;
    --secundary2: #F2DE97;
    --tertiary2: #63d0d9;
    --text-dark: #3f214f;
    --bg-page: #fffef7;
    --surface: #ffffff;
    --border: rgba(222, 151, 242, 0.25);
    --success: #276749;
    --error: #9b2c2c;
    --radius-sm: 8px;
    --radius-md: 14px;
}

body { 
    background-color: var(--bg-page); 
    font-family: 'Bainsley', sans-serif;
    color: var(--text-dark);
}

/* ── LAYOUT DO ADMIN COM HEADER E FOOTER ── */
.admin-wrapper {
    display: flex;
    min-height: 75vh;
    margin: 40px auto;
    max-width: 1350px;
    background: var(--surface);
    border-radius: var(--radius-md);
    box-shadow: 0 15px 40px rgba(222, 151, 242, 0.15);
    border: 1px solid var(--border);
    overflow: hidden;
}

/* ── SIDEBAR HARMONIZADA COM A PALETA DO SITE ── */
.sidebar {
    width: 280px;
    background: linear-gradient(180deg, rgba(244, 214, 248, 0.35) 0%, rgba(213, 248, 242, 0.25) 100%);
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    color: var(--text-dark);
    border-right: 1px solid var(--border);
}
.sidebar-logo {
    padding: 32px 28px 24px;
}
.sidebar-logo a {
    font-family: 'Playfair Display', serif, 'Bainsley';
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--text-dark);
    text-decoration: none;
    letter-spacing: 0.03em;
}
.sidebar-logo span { color: #5a2678; font-style: italic; }

.sidebar-user {
    padding: 0 28px 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    border-bottom: 1px solid var(--border);
    margin-bottom: 24px;
}
.user-avatar {
    width: 40px; height: 40px;
    border-radius: 50%;
    background: var(--primary);
    display: flex; align-items: center; justify-content: center;
    color: var(--text-dark);
    border: 1px solid var(--border);
}
.user-avatar i { width: 18px; height: 18px; }
.user-info { overflow: hidden; }
.user-name { font-size: 0.95rem; font-weight: 700; color: var(--text-dark); margin: 0; }
.user-role { font-size: 0.75rem; color: #7a688a; letter-spacing: 0.02em; margin: 0; }

.sidebar-nav { flex: 1; padding: 0 16px; overflow-y: auto; }
.nav-section { margin-bottom: 28px; }
.nav-section-label {
    font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em;
    color: #7a688a; padding: 0 12px; margin-bottom: 10px; font-weight: 700;
}
.nav-item {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 16px; border-radius: var(--radius-sm);
    cursor: pointer; transition: all 0.3s ease;
    color: var(--text-dark); font-size: 0.95rem;
    border: none; background: transparent; width: 100%; text-align: left;
    font-family: inherit;
    font-weight: 500;
}
.nav-item i { width: 18px; height: 18px; stroke-width: 1.5; color: #5a2678; }
.nav-item:hover { color: #3f214f; background: rgba(222, 151, 242, 0.25); transform: translateX(4px); }
.nav-item.active { background: var(--primary2); color: #3f214f; font-weight: 700; box-shadow: 0 4px 15px rgba(222, 151, 242, 0.35); border-radius: var(--radius-sm); }
.nav-item .nav-badge {
    margin-left: auto; background: var(--tertiary2); color: #1a0a2e;
    font-size: 0.7rem; padding: 2px 8px; border-radius: 20px; font-weight: 700;
}

.sidebar-footer { padding: 20px 28px; border-top: 1px solid var(--border); }
.logout-btn {
    display: flex; align-items: center; gap: 10px; font-size: 0.85rem;
    color: var(--text-dark); cursor: pointer; background: none; border: none;
    font-family: inherit; transition: color 0.2s; font-weight: 600;
}
.logout-btn i { width: 16px; height: 16px; stroke-width: 1.5; color: #9b2c2c; }
.logout-btn:hover { color: #9b2c2c; }

/* ── MAIN AREA ── */
.main { flex: 1; display: flex; flex-direction: column; background: var(--surface); }

/* TOPBAR */
.topbar {
    height: 80px; background: rgba(255, 255, 255, 0.9); border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between; padding: 0 40px; flex-shrink: 0;
    backdrop-filter: blur(10px);
}
.page-title { font-size: 1.8rem; font-weight: 800; color: var(--text-dark); margin: 0; }
.breadcrumb { font-size: 0.85rem; color: #7a688a; letter-spacing: 0.02em; margin: 0; }
.topbar-right { display: flex; align-items: center; gap: 20px; }
.topbar-date { font-size: 0.9rem; color: #7a688a; }
.topbar-btn {
    width: 40px; height: 40px; border-radius: 50%; background: var(--bg-page); border: 1px solid var(--border);
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    transition: all 0.2s; color: var(--text-dark); position: relative;
}
.topbar-btn i { width: 18px; height: 18px; stroke-width: 1.5; }
.topbar-btn:hover { background: var(--primary2); color: #fff; }
.notif-dot {
    position: absolute; top: 8px; right: 8px; width: 8px; height: 8px;
    border-radius: 50%; background: var(--tertiary2);
}

/* CONTENT */
.content { flex: 1; padding: 36px 40px; overflow-y: auto; }

/* PANELS */
.panel { display: none; animation: fadeIn 0.3s ease; }
.panel.active { display: block; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

/* CARDS E COMPONENTES */
.card-admin {
    background: var(--surface); border-radius: var(--radius-sm); padding: 28px;
    border: 1px solid var(--border); box-shadow: 0 10px 30px rgba(222, 151, 242, 0.08);
}
.card-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
.card-title { font-size: 1.1rem; font-weight: 700; color: var(--text-dark); }
.card-action { font-size: 0.85rem; color: #5a2678; cursor: pointer; background: none; border: none; font-family: inherit; font-weight: 600; }
.card-action:hover { text-decoration: underline; }

/* KPIS */
.kpi-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 24px; }
.kpi {
    background: rgba(255, 255, 255, 0.9); border-radius: var(--radius-sm); padding: 24px;
    border: 1px solid var(--border); display: flex; flex-direction: column; gap: 12px;
    box-shadow: 0 10px 25px rgba(222, 151, 242, 0.06);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.kpi:hover { transform: translateY(-4px); box-shadow: 0 15px 35px rgba(222, 151, 242, 0.2); }
.kpi-icon {
    width: 44px; height: 44px; border-radius: var(--radius-sm);
    background: var(--primary); display: flex; align-items: center; justify-content: center;
    color: #3f214f; border: 1px solid var(--border);
}
.kpi-val { font-size: 2rem; font-weight: 800; line-height: 1; color: var(--text-dark); }
.kpi-label { font-size: 0.8rem; color: #7a688a; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; }

.dash-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 24px; }
.mini-chart { height: 140px; display: flex; align-items: center; justify-content: center; color: #7a688a; font-size: 0.9rem; border: 2px dashed var(--border); border-radius: var(--radius-sm); background: var(--bg-page); }

/* TABELAS E FERRAMENTAS */
.table-toolbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 20px; flex-wrap: wrap; }
.search-box { position: relative; }
.search-box input {
    padding: 12px 16px 12px 42px; border: 1px solid var(--border); border-radius: var(--radius-sm);
    font-family: inherit; font-size: 0.95rem; background: var(--surface); width: 280px; outline: none; transition: border 0.2s;
}
.search-box input:focus { border-color: var(--primary2); box-shadow: 0 0 0 3px rgba(222, 151, 242, 0.25); }
.search-box i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; color: #7a688a; }

.btn-primary-custom {
    background: #5a2678; color: #fff; border: none; padding: 12px 24px; border-radius: var(--radius-sm);
    font-size: 0.95rem; font-weight: 700; cursor: pointer; font-family: inherit;
    display: flex; align-items: center; gap: 8px; transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(90, 38, 120, 0.3);
}
.btn-primary-custom:hover { background: #451b5c; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(90, 38, 120, 0.4); }
.btn-primary-custom i { width: 18px; height: 18px; }

.data-table { width: 100%; border-collapse: collapse; }
.data-table th {
    font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em; color: #7a688a;
    padding: 16px; text-align: left; border-bottom: 2px solid var(--border); font-weight: 700; background: rgba(244, 214, 248, 0.15);
}
.data-table td { padding: 16px; font-size: 0.95rem; border-bottom: 1px solid var(--border); vertical-align: middle; color: var(--text-dark); }
.data-table tr:last-child td { border-bottom: none; }
.data-table tr:hover td { background: rgba(244, 214, 248, 0.1); }

.action-btns { display: flex; gap: 8px; }
.action-btn {
    width: 36px; height: 36px; border-radius: var(--radius-sm); border: 1px solid var(--border);
    background: var(--surface); cursor: pointer; color: var(--text-dark);
    display: flex; align-items: center; justify-content: center; transition: all 0.2s;
}
.action-btn i { width: 16px; height: 16px; stroke-width: 2; }
.action-btn:hover { border-color: var(--primary2); color: #5a2678; background: var(--primary); }
.action-btn.del:hover { border-color: var(--error); color: var(--error); background: rgba(155, 44, 44, 0.1); }

/* MODAL */
.modal-overlay {
    display: none; position: fixed; inset: 0; z-index: 999; background: rgba(26, 10, 46, 0.5);
    backdrop-filter: blur(5px); align-items: center; justify-content: center; padding: 24px;
}
.modal-overlay.open { display: flex; }
.modal-box {
    background: var(--surface); border-radius: var(--radius-md); padding: 40px; width: 100%; max-width: 560px;
    box-shadow: 0 20px 50px rgba(26, 10, 46, 0.2); position: relative; max-height: 90vh; overflow-y: auto;
    border: 1px solid var(--border);
}
.modal-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; }
.modal-head h3 { font-size: 1.8rem; font-weight: 800; color: var(--text-dark); margin: 0; }
.modal-close {
    width: 36px; height: 36px; border-radius: 50%; background: transparent; border: 1px solid var(--border);
    cursor: pointer; display: flex; align-items: center; justify-content: center; color: #7a688a; transition: all 0.2s;
}
.modal-close i { width: 18px; height: 18px; }
.modal-close:hover { background: var(--primary); color: var(--text-dark); }

.field-group { margin-bottom: 20px; }
.field-label {
    display: block; font-size: 0.85rem; font-weight: 700; letter-spacing: 0.03em;
    color: var(--text-dark); margin-bottom: 8px;
}
.field-input {
    width: 100%; padding: 12px 16px; border: 1px solid var(--border); border-radius: var(--radius-sm);
    font-family: inherit; font-size: 0.95rem; color: var(--text-dark); background: var(--surface);
    outline: none; transition: border-color 0.2s, box-shadow 0.2s;
}
.field-input:focus { border-color: var(--primary2); box-shadow: 0 0 0 3px rgba(222, 151, 242, 0.25); }
.field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

.modal-actions { display: flex; gap: 12px; margin-top: 32px; }
.btn-outline {
    flex: 1; padding: 12px; background: transparent; color: var(--text-dark); border: 1px solid var(--border);
    border-radius: var(--radius-sm); font-family: inherit; font-size: 0.90rem; font-weight: 700; cursor: pointer; transition: background 0.2s;
}
.btn-outline:hover { background: var(--primary); }

/* TOAST */
.toast-wrap { position: fixed; bottom: 30px; right: 30px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; }
.toast {
    background: var(--surface); color: var(--text-dark); padding: 16px 20px; border-radius: var(--radius-sm);
    font-size: 0.9rem; font-weight: 700; display: flex; align-items: center; gap: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1); border-left: 5px solid var(--text-dark); animation: toastIn 0.3s ease;
    border: 1px solid var(--border);
}
.toast i { width: 18px; height: 18px; }
.toast.ok { border-left-color: var(--success); }
.toast.err { border-left-color: var(--error); }
.toast.removing { animation: toastOut 0.3s ease forwards; }
@keyframes toastIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
@keyframes toastOut { to { opacity: 0; transform: translateX(20px); } }

@media (max-width: 992px) {
    .admin-wrapper { flex-direction: column; margin: 20px 10px; }
    .sidebar { width: 100%; height: auto; }
    .kpi-grid { grid-template-columns: repeat(2, 1fr); }
    .dash-grid { grid-template-columns: 1fr; }
}
</style>
</head>
<body>

<?php include 'components/header.php'; ?>

<div class="admin-wrapper">
  <!-- SIDEBAR HARMONIZADA -->
  <aside class="sidebar">
    <div class="sidebar-logo">
      <a href="#">Prisma <span>Makeup</span></a>
    </div>
    <div class="sidebar-user">
      <div class="user-avatar"><i data-feather="user"></i></div>
      <div class="user-info">
        <p class="user-name">Admin</p>
        <p class="user-role">Painel de Gestão</p>
      </div>
    </div>
    <nav class="sidebar-nav">
      <div class="nav-section">
        <p class="nav-section-label">Visão Geral</p>
        <button class="nav-item active" onclick="goTo('dashboard',this)"><i data-feather="grid"></i> Dashboard</button>
      </div>
      <div class="nav-section">
        <p class="nav-section-label">Comércio</p>
        <button class="nav-item" onclick="goTo('produtos',this)"><i data-feather="box"></i> Produtos</button>
        <button class="nav-item" onclick="goTo('pedidos',this)"><i data-feather="shopping-cart"></i> Pedidos <span class="nav-badge" id="pendingBadge">0</span></button>
      </div>
      <div class="nav-section">
        <p class="nav-section-label">Plataforma</p>
        <button class="nav-item" onclick="goTo('cursos',this)"><i data-feather="play-circle"></i> Tutoriais</button>
        <button class="nav-item" onclick="goTo('usuarios',this)"><i data-feather="users"></i> Usuárias</button>
      </div>
    </nav>
    <div class="sidebar-footer">
      <button class="logout-btn" onclick="logout()"><i data-feather="log-out"></i> Encerrar sessão</button>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main">
    <div class="topbar">
      <div class="topbar-left">
        <p class="page-title" id="pageTitle">Dashboard</p>
        <p class="breadcrumb" id="pageBreadcrumb">Admin / Visão geral</p>
      </div>
      <div class="topbar-right">
        <span class="topbar-date" id="topbarDate"></span>
        <button class="topbar-btn" onclick="showToast('bell', 'Nenhuma notificação no momento', '')">
          <i data-feather="bell"></i><span class="notif-dot"></span>
        </button>
      </div>
    </div>

    <div class="content">
      <!-- DASHBOARD -->
      <div class="panel active" id="panel-dashboard">
        <div class="kpi-grid">
          <?php foreach($kpis as $k): ?>
          <div class="kpi">
            <div class="kpi-icon"><i data-feather="<?= $k['icon'] ?>"></i></div>
            <div>
              <div class="kpi-val"><?= $k['val'] ?></div>
              <div class="kpi-label"><?= $k['label'] ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="dash-grid">
          <div class="card-admin">
            <div class="card-head">
              <span class="card-title">Vendas da Semana</span>
              <button class="card-action">Análise completa</button>
            </div>
            <div class="mini-chart">
               Sem dados suficientes para gerar o gráfico.
            </div>
          </div>
          <div class="card-admin">
            <div class="card-head">
              <span class="card-title">Atividade Recente</span>
            </div>
            <div style="font-size: 0.9rem; color: #7a688a;">
               O log de atividades está vazio.
            </div>
          </div>
        </div>
      </div>

      <!-- PRODUTOS -->
      <div class="panel" id="panel-produtos">
        <div class="table-toolbar">
          <div class="search-box">
            <i data-feather="search"></i>
            <input type="text" id="prodSearch" placeholder="Pesquisar produto…" oninput="filterTable('prodTable',this.value)"/>
          </div>
          <button class="btn-primary-custom" onclick="openProdModal()"><i data-feather="plus"></i> Novo Produto</button>
        </div>
        <div class="card-admin" style="padding:0; overflow:hidden;">
          <table class="data-table" id="prodTable">
            <thead><tr>
              <th>Identificação</th><th>Categoria</th><th>Preço</th><th>Estoque</th><th>Ações</th>
            </tr></thead>
            <tbody id="prodBody">
              <?php if(empty($produtos)): ?>
                  <tr><td colspan="5" style="text-align:center; color:#7a688a; padding: 30px;">Nenhum produto cadastrado na base.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- PEDIDOS -->
      <div class="panel" id="panel-pedidos">
        <div class="table-toolbar">
          <div class="search-box">
            <i data-feather="search"></i>
            <input type="text" id="orderSearch" placeholder="Buscar ID ou cliente…" oninput="filterTable('orderTable',this.value)"/>
          </div>
        </div>
        <div class="card-admin" style="padding:0; overflow:hidden;">
          <table class="data-table" id="orderTable">
            <thead><tr><th>Nº Pedido</th><th>Cliente</th><th>Total</th><th>Status</th><th>Ações</th></tr></thead>
            <tbody id="orderBody">
              <?php if(empty($pedidos)): ?>
                  <tr><td colspan="5" style="text-align:center; color:#7a688a; padding: 30px;">Não há registros de pedidos.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- USUÁRIAS -->
      <div class="panel" id="panel-usuarios">
        <div class="table-toolbar">
          <div class="search-box">
            <i data-feather="search"></i>
            <input type="text" id="userSearch" placeholder="Procurar usuária…" oninput="filterTable('userTable',this.value)"/>
          </div>
        </div>
        <div class="card-admin" style="padding:0; overflow:hidden;">
          <table class="data-table" id="userTable">
            <thead><tr><th>Nome</th><th>E-mail</th><th>Tipo de Conta</th><th>Ações</th></tr></thead>
            <tbody id="userBody">
              <?php if(empty($usuarios)): ?>
                  <tr><td colspan="4" style="text-align:center; color:#7a688a; padding: 30px;">Nenhuma conta de cliente registrada.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- TUTORIAIS -->
      <div class="panel" id="panel-cursos">
        <div class="table-toolbar">
          <button class="btn-primary-custom" onclick="showToast('info', 'Upload de vídeos em manutenção.', '')"><i data-feather="upload-cloud"></i> Adicionar Mídia</button>
        </div>
        <div style="color:#7a688a; font-size: 0.9rem; padding: 20px 0;">
           A biblioteca de tutoriais está vazia no momento.
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'components/footer.php'; ?>

<!-- MODAL NOVO PRODUTO -->
<div class="modal-overlay" id="prodModal">
  <div class="modal-box">
    <div class="modal-head">
      <h3 id="prodModalTitle">Cadastro de Produto</h3>
      <button class="modal-close" onclick="closeProdModal()"><i data-feather="x"></i></button>
    </div>
    
    <form method="POST" action="">
      <input type="hidden" name="action" value="add_product">
      
      <div class="field-group">
        <label class="field-label">Nome do produto</label>
        <input class="field-input" name="name" placeholder="Ex: Base Líquida Efeito Matte" required/>
      </div>
      
      <div class="field-group">
        <label class="field-label">Categoria</label>
        <select class="field-input" name="cat">
          <option value="pele">Pele (Bases, Corretivos)</option>
          <option value="olhos">Olhos (Sombras, Máscaras)</option>
          <option value="labios">Lábios (Batons, Gloss)</option>
          <option value="skincare">Skincare e Preparação</option>
        </select>
      </div>
      
      <div class="field-row">
        <div class="field-group">
          <label class="field-label">Preço Varejo (R$)</label>
          <input class="field-input" name="price" type="number" step="0.01" placeholder="0.00" required/>
        </div>
        <div class="field-group">
          <label class="field-label">Quantidade Inicial</label>
          <input class="field-input" name="stock" type="number" placeholder="0" required/>
        </div>
      </div>
      
      <div class="field-group">
        <label class="field-label">Descrição Breve</label>
        <textarea class="field-input" name="desc" rows="3" style="resize:vertical;" placeholder="Características principais do produto…"></textarea>
      </div>
      
      <div class="field-group" style="display:flex;align-items:center;gap:10px;">
        <input type="checkbox" name="hypo" id="fm-hypo" style="width:18px;height:18px;accent-color:#5a2678;" checked/>
        <label for="fm-hypo" style="font-size:0.9rem; font-weight:700;">Classificação Hipoalergênica</label>
      </div>
      
      <div class="modal-actions">
        <button type="button" class="btn-outline" onclick="closeProdModal()">Cancelar</button>
        <button type="submit" class="btn-primary-custom" style="flex:1; justify-content:center;">Finalizar Cadastro</button>
      </div>
    </form>
  </div>
</div>

<div class="toast-wrap" id="toastWrap"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="scripts/scriptGeral.js"></script>
<script>
feather.replace();

document.getElementById('topbarDate').textContent = new Date().toLocaleDateString('pt-BR', {weekday:'long', day:'numeric', month:'long'});

function goTo(panel, btn){
  document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(b => b.classList.remove('active'));
  document.getElementById('panel-'+panel).classList.add('active');
  if(btn) btn.classList.add('active');
  
  const titles = {dashboard:'Visão Geral', produtos:'Inventário de Produtos', pedidos:'Gestão de Pedidos', usuarios:'Base de Clientes', cursos:'Central de Mídia'};
  const breadcrumbs = {dashboard:'Admin / Visão Geral', produtos:'Admin / Comércio / Produtos', pedidos:'Admin / Comércio / Pedidos', usuarios:'Admin / Base de Clientes', cursos:'Admin / Plataforma / Tutoriais'};
  
  document.getElementById('pageTitle').textContent = titles[panel] || panel;
  document.getElementById('pageBreadcrumb').textContent = breadcrumbs[panel] || '';
}

function openProdModal(){ document.getElementById('prodModal').classList.add('open'); }
function closeProdModal(){ document.getElementById('prodModal').classList.remove('open'); }
document.getElementById('prodModal').addEventListener('click', function(e){ if(e.target === this) closeProdModal(); });

function filterTable(tableId, term){
  const rows = document.querySelectorAll(`#${tableId} tbody tr`);
  rows.forEach(r => {
    r.style.display = r.textContent.toLowerCase().includes(term.toLowerCase()) ? '' : 'none';
  });
}

function showToast(iconName, msg, cls){
  const wrap = document.getElementById('toastWrap');
  const t = document.createElement('div');
  t.className = `toast ${cls}`;
  t.innerHTML = `<i data-feather="${iconName}"></i> <span>${msg}</span>`;
  wrap.appendChild(t);
  feather.replace();
  
  setTimeout(() => {
    t.classList.add('removing');
    setTimeout(() => t.remove(), 300);
  }, 3500);
}

function logout(){ window.location.href='login.php'; }

<?php if(isset($form_success) && $form_success): ?>
    showToast('check-circle', 'Produto registrado com sucesso.', 'ok');
<?php endif; ?>
</script>
</body>
</html>