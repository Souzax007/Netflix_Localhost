      <div class="container-fluid bg-secondary-custom">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <canvas id="canvas" width="50" height="50"></canvas>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mx-auto " style="gap: 20px;">

            <li class="nav-item">
              <a class="nav-link active d-flex gap-2 " aria-current="page" href="/index.php">
                <lord-icon
                  id="iconHome"
                  src="/json/icon/wired-gradient-63-home-hover-3d-roll.json"
                  trigger="hover"
                  style="width:25px;height:25px">
                </lord-icon>
                Home
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link active d-flex gap-2" href="/php/includes/filme.php">
                 <lord-icon
                  id="iconMovie"
                  src="/json/icon/wired-gradient-62-film-hover-play.json"
                  trigger="hover"
                  style="width:25px;height:25px">
                </lord-icon>
                Filmes</a>
            </li>
      
            <li class="nav-item">
              <a class="nav-link  d-flex align-items-center" href="#">
                  <lord-icon
                  id="iconLista"
                  src="/json/icon/wired-gradient-112-book-hover-closed.json"
                  trigger="hover"
                  style="width:25px;height:25px">
                </lord-icon>
                Biblioteca</a>
            </li>
          </ul>

          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarProfileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://i.pinimg.com/736x/54/d2/d1/54d2d12fbdb303a1c72dca011bb39c58.jpg" alt="Perfil" class="navbar-profile-img me-2">
                <span>Marcos</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarProfileDropdown">
                <li><a class="dropdown-item" href="/php/gerenciamento/gerenciar_midias.php">gerenciar filme</a></li>
                <li><a class="dropdown-item" href="/php/gerenciamento/enviar_filme.php">Enviar filme</a></li>
                <li><hr class="dropdown-divider"></li>
                <!--<li><a class="dropdown-item text-danger" href="#">Sair</a></li>-->
              </ul>
            </li>
          </ul>
        </div>
      </div>