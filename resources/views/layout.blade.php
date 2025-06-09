@php use App\Models\User; @endphp
<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Application Pharmacie</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

 <style>
    :root {
      --color-bg-light: #f5f7fa;
      --color-bg-dark: #121212;
      --color-sidebar-light: #2c3e50;
      --color-sidebar-dark: #1a237e;
      --color-text-light: #34495e;
      --color-text-dark: #eceff1;
      --color-header-light: #2980b9;
      --color-header-dark: #0d47a1;
      --color-link-hover-light: #3498db;
      --color-link-hover-dark: #1565c0;
      --color-logout-light: #e74c3c;
      --color-logout-dark: #c62828;
      --shadow-light: rgba(0,0,0,0.1);
      --shadow-dark: rgba(0,0,0,0.5);
    }
    html[data-theme='light'] {
      --color-bg: var(--color-bg-light);
      --color-sidebar-bg: var(--color-sidebar-light);
      --color-text: var(--color-text-light);
      --color-header-bg: var(--color-header-light);
      --color-link-hover: var(--color-link-hover-light);
      --color-logout: var(--color-logout-light);
      --shadow: var(--shadow-light);
    }
    html[data-theme='dark'] {
      --color-bg: var(--color-bg-dark);
      --color-sidebar-bg: var(--color-sidebar-dark);
      --color-text: var(--color-text-dark);
      --color-header-bg: var(--color-header-dark);
      --color-link-hover: var(--color-link-hover-dark);
      --color-logout: var(--color-logout-dark);
      --shadow: var(--shadow-dark);
    }
    * {
      box-sizing: border-box;
      transition: background-color 0.3s ease, color 0.3s ease;
    }
    body {
      margin: 0;
      min-height: 100vh;
      display: flex;
      background-color: var(--color-bg);
      color: var(--color-text);
      font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-size: 0.95rem;
      line-height: 1.5;
    }
    .sidebar {
      width: 240px;
      background-color: var(--color-sidebar-bg);
      color: white;
      padding: 25px 20px;
      display: flex;
      flex-direction: column;
      box-shadow: 2px 0 8px var(--shadow);
      position: fixed;
      top: 0; bottom: 0; left: 0;
      overflow-y: auto;
      z-index: 1000;
    }
    .sidebar h4 {
      margin-bottom: 1.5rem;
      font-weight: 600;
      text-align: center;
      letter-spacing: 1px;
      font-size: 1.2rem;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 10px 12px;
      font-weight: 500;
      border-radius: 5px;
      margin-bottom: 6px;
      font-size: 0.95rem;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      transition: all 0.2s ease;
    }
    .sidebar a:hover,
    .sidebar a:focus {
      background-color: var(--color-link-hover);
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      outline: none;
    }
    .content {
      margin-left: 240px;
      padding: 20px 30px;
      flex: 1;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .header {
      background-color: var(--color-header-bg);
      color: white;
      padding: 15px 30px;
      border-radius: 8px;
      box-shadow: 0 3px 10px var(--shadow);
      font-weight: 600;
      font-size: 1.8rem;
      margin-bottom: 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
      height: 3.5rem;
    }
    .header-actions {
      display: flex;
      gap: 10px;
      align-items: center;
    }
    .scrolling-text-container {
      overflow: hidden;
      white-space: nowrap;
      flex-grow: 1;
      position: relative;
      height: 3.5rem;
      display: flex;
      align-items: center;
    }
    .scrolling-text {
      display: inline-block;
      white-space: nowrap;
      position: absolute;
      left: 0;
      transform: translateX(100%);
      line-height: 3.5rem;
      font-weight: 600;
      font-size: 1.8rem;
      will-change: transform;
      animation: scrollText 10s linear 3 forwards;
    }
    .scrolling-text.centered {
      position: relative;
      left: 0;
      transform: none !important;
      text-align: center;
      animation: none !important;
    }
    @keyframes scrollText {
      0% {
        transform: translateX(100%);
      }
      90% {
        transform: translateX(-100%);
      }
      100% {
        transform: translateX(-100%);
      }
    }
    .btn-action {
      cursor: pointer;
      background: transparent;
      border: 2px solid white;
      border-radius: 30px;
      width: 40px;
      height: 40px;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      font-size: 1.1rem;
      transition: all 0.2s ease;
    }
    .btn-action:hover,
    .btn-action:focus {
      background-color: white;
      outline: none;
    }
    .btn-theme:hover,
    .btn-theme:focus {
      color: var(--color-header-bg);
    }
    .btn-logout {
      background-color: var(--color-logout);
      border: none;
      padding: 8px 15px;
      border-radius: 30px;
      color: white;
      font-weight: 500;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 5px;
      transition: all 0.2s ease;
    }
    .btn-logout:hover,
    .btn-logout:focus {
      background-color: var(--color-logout);
      opacity: 0.9;
      outline: none;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    @media (max-width: 768px) {
      .sidebar {
        width: 200px;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
      }
      .sidebar.show {
        transform: translateX(0);
      }
      .content {
        margin-left: 0;
        padding: 15px;
      }
      .header {
        height: 3rem;
        font-size: 1.4rem;
        padding: 10px 20px;
      }
      .scrolling-text-container {
        height: 3rem;
      }
      .scrolling-text {
        line-height: 3rem;
        font-size: 1.4rem;
      }
      .btn-action {
        width: 36px;
        height: 36px;
        font-size: 1rem;
      }
      .btn-logout {
        padding: 6px 12px;
        font-size: 0.8rem;
      }
    }
  </style>
</head>
<body>

  <div class="sidebar" id="sidebar" role="navigation" aria-label="Menu principal">
    <h4>Menu</h4>
    @include('admin.dashboard')
    <a href="{{ url('/produits') }}" class="menu-link">Produits</a>
    <a href="{{ url('/profil') }}" class="menu-link">Mon Profil</a>
    <a href="{{ url('/commandes') }}" class="menu-link">Commandes</a>
    <a href="{{ route('commande.historique') }}" class="menu-link">Historique et Suivi des Commandes</a>

    <form method="POST" action="{{ route('auth.logout') }}">
      @csrf
      <button type="submit">Déconnexion <i class="fa-solid fa-right-from-bracket ms-1"></i></button>
    </form>
  </div>

  <div class="content">
    <header class="header" role="banner" aria-label="Bannière principale">
      <div class="scrolling-text-container" aria-live="polite" aria-atomic="true" aria-relevant="all" aria-label="Texte défilant du nom de l'application">
        <span id="scrollingText" class="scrolling-text" aria-hidden="true">
          Bienvenue sur notre plateforme Pharmacie, simplifiez la commande de vos produits en quelques clics. <span class="pharmacy-icon"><i class="fa-solid fa-prescription-bottle-medical"></i></span>
        </span>
      </div>
      <button id="themeToggle" class="btn-toggle-theme" aria-label="Changer le thème">
        <i class="fa-solid fa-moon"></i>
      </button>

      <form method="POST" action="{{ route('auth.logout') }}">
          @csrf
          <button type="submit" class="btn-logout">
            <i class="fa-solid fa-right-from-bracket"></i>
          </button>
        </form>
    </header>

    <main role="main" tabindex="-1">
      @yield('content')
    </main>
  </div>

  <script>
    (() => {
      const text = document.getElementById('scrollingText');
      const container = text.parentElement;
      const maxCount = 3;
      const animationDuration = 10000;
      let count = 0;
      let animationRunning = false;
      let animationStarted = false;

      function animateScroll() {
        if (animationRunning) return;
        animationRunning = true;
        
        // Calculer la distance à parcourir
        const containerWidth = container.offsetWidth;
        const textWidth = text.offsetWidth;
        const distance = containerWidth + textWidth;
        
        text.style.transition = 'none';
        text.style.transform = `translateX(${containerWidth}px)`;
        text.classList.remove('centered');
        
        void text.offsetWidth;

        text.style.transition = `transform ${animationDuration}ms linear`;
        text.style.transform = `translateX(-${textWidth}px)`;

        const handleTransitionEnd = () => {
          count++;
          if (count < maxCount) {
            setTimeout(() => {
              text.style.transition = 'none';
              text.style.transform = `translateX(${containerWidth}px)`;
              void text.offsetWidth;
              text.style.transition = `transform ${animationDuration}ms linear`;
              text.style.transform = `translateX(-${textWidth}px)`;
            }, 100);
          } else {
            // Arrêter au centre
            text.style.transition = 'transform 0.5s ease-out';
            text.style.transform = 'translateX(0)';
            text.classList.add('centered');
            container.setAttribute('aria-live', 'off');
            text.removeEventListener('transitionend', handleTransitionEnd);
            animationRunning = false;
          }
        };

        text.addEventListener('transitionend', handleTransitionEnd);
      }

      window.addEventListener('load', () => {
        if (!animationStarted) {
          animateScroll();
          animationStarted = true;
        }
      });

      window.addEventListener('resize', () => {
        if (text.classList.contains('centered')) {
          count = maxCount; 
        } else {
          count = 0;
          animateScroll();
        }
      });

      const themeToggle = document.getElementById('themeToggle');
      function setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        themeToggle.innerHTML = theme === 'dark'
          ? '<i class="fa-solid fa-sun"></i>'
          : '<i class="fa-solid fa-moon"></i>';
      }
      themeToggle.addEventListener('click', () => {
        const current = document.documentElement.getAttribute('data-theme') || 'light';
        setTheme(current === 'light' ? 'dark' : 'light');
      });
      
      const savedTheme = localStorage.getItem('theme') || 'light';
      setTheme(savedTheme);
    })();
  </script>
</body>
</html>