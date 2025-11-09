<?php
  include 'conexao.php';
  $id = $_GET['id'];
  $result = $conn->query("SELECT * FROM filmes WHERE id = $id");
  $filme = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $filme['titulo']; ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/../../css/video.css">
  <link rel="stylesheet" href="../../css/nav.css">  
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary p-0 m-0 d-flex justify-content-between">
      <?php include 'navbar.php'; ?>
    </nav>
  <div class="container">
    <h1><?php echo $filme['titulo']; ?></h1>
    
    <div class="video-wrapper">
      <div class="video-container">
        <div id="loading-screen">
          <div class="loading-spinner"></div>
          <div id="loading-text">Carregando vídeo...</div>
          <div id="loading-percent">0%</div>
          <div id="loading-bar">
            <div id="loading-progress"></div>
          </div>
        </div>

        <video id="video" preload="auto">
          <source src="../videos/<?php echo $filme['arquivo']; ?>" type="video/mp4">
          Seu navegador não suporta vídeos em HTML5.
        </video>

        <div class="controls">
          <button id="playPause" title="Play/Pause">⏵</button>
          <div class="progress-container">
            <div class="progress-bar"></div>
          </div>
          <div class="time" id="timeDisplay">00:00 / 00:00</div>
          <button id="fullscreen" title="Tela Cheia">⛶</button>
        </div>
      </div>
    </div>

    <div class="extra-controls">
      <div class="control-group">
        <label>🔊 Volume</label>
        <input type="range" id="volumeControl" min="0" max="1" step="0.01" value="1">
      </div>

      <div class="control-group">
        <label>☀️ Brilho</label>
        <input type="range" id="brightnessControl" min="0.5" max="1.5" step="0.01" value="1">
      </div>

      <div class="control-group">
        <button class="download-btn" onclick="baixarVideo()">
          ⬇️ Baixar Vídeo
        </button>
      </div>
    </div>

    <div class="description">
      <?php echo $filme['descricao']; ?>
    </div>
  </div>


  <script>
    const video = document.getElementById('video');
    const playPause = document.getElementById('playPause');
    const progressBar = document.querySelector('.progress-bar');
    const progressContainer = document.querySelector('.progress-container');
    const timeDisplay = document.getElementById('timeDisplay');
    const fullscreenBtn = document.getElementById('fullscreen');
    const volumeControl = document.getElementById('volumeControl');
    const brightnessControl = document.getElementById('brightnessControl');
    const loadingScreen = document.getElementById('loading-screen');
    const loadingPercent = document.getElementById('loading-percent');
    const loadingProgress = document.getElementById('loading-progress');

    let fakePercent = 0;
    let videoReady = false;

    // Carregamento fake inicial
    let fakeLoading = setInterval(() => {
      if (fakePercent < 85 && !videoReady) {
        fakePercent += Math.random() * 2;
        updateLoading(fakePercent);
      }
    }, 200);

    // Atualiza carregamento real
    video.addEventListener('progress', () => {
      if (video.buffered.length > 0) {
        const buffered = video.buffered.end(0);
        const percent = Math.min((buffered / video.duration) * 100, 100);
        if (percent > fakePercent) {
          updateLoading(percent);
        }
      }
    });

    // Quando o vídeo estiver pronto para reproduzir
    video.addEventListener('canplaythrough', () => {
      clearInterval(fakeLoading);
      videoReady = true;
      updateLoading(100);
      
      setTimeout(() => {
        loadingScreen.style.opacity = '0';
        setTimeout(() => {
          loadingScreen.style.display = 'none';
          // INICIA O VÍDEO AUTOMATICAMENTE
          video.play().then(() => {
            playPause.textContent = '⏸';
          }).catch(err => {
            console.log('Autoplay bloqueado pelo navegador:', err);
          });
        }, 500);
      }, 300);
    });

    function updateLoading(percent) {
      percent = Math.min(100, percent);
      fakePercent = percent;
      loadingPercent.textContent = `${Math.round(percent)}%`;
      loadingProgress.style.width = `${percent}%`;
    }

    // Play/Pause
    playPause.addEventListener('click', () => {
      if (video.paused) {
        video.play();
        playPause.textContent = '⏸';
      } else {
        video.pause();
        playPause.textContent = '⏵';
      }
    });

    // Play/Pause ao clicar no vídeo
    video.addEventListener('click', () => {
      if (video.paused) {
        video.play();
        playPause.textContent = '⏸';
      } else {
        video.pause();
        playPause.textContent = '⏵';
      }
    });

    // Atualiza tempo e barra
    video.addEventListener('timeupdate', () => {
      const percent = (video.currentTime / video.duration) * 100;
      progressBar.style.width = percent + '%';
      timeDisplay.textContent = formatTime(video.currentTime) + ' / ' + formatTime(video.duration);
    });

    // Clicar na barra de progresso
    progressContainer.addEventListener('click', (e) => {
      const rect = progressContainer.getBoundingClientRect();
      const clickX = e.clientX - rect.left;
      const percent = clickX / rect.width;
      video.currentTime = percent * video.duration;
    });

    function formatTime(seconds) {
      if (isNaN(seconds)) return '00:00';
      const minutes = Math.floor(seconds / 60);
      const secs = Math.floor(seconds % 60);
      return `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }

    // Volume e brilho
    volumeControl.addEventListener('input', () => {
      video.volume = volumeControl.value;
    });

    brightnessControl.addEventListener('input', () => {
      video.style.filter = `brightness(${brightnessControl.value})`;
    });

    // Tela cheia
    fullscreenBtn.addEventListener('click', () => {
      if (!document.fullscreenElement) {
        video.parentElement.requestFullscreen();
      } else {
        document.exitFullscreen();
      }
    });

    // Teclas de atalho
    document.addEventListener('keydown', (e) => {
      if (e.code === 'Space') {
        e.preventDefault();
        playPause.click();
      } else if (e.code === 'ArrowLeft') {
        video.currentTime -= 5;
      } else if (e.code === 'ArrowRight') {
        video.currentTime += 5;
      } else if (e.code === 'KeyF') {
        fullscreenBtn.click();
      }
    });

    // Baixar vídeo
    function baixarVideo() {
      const a = document.createElement('a');
      a.href = '../videos/<?php echo $filme['arquivo']; ?>';
      a.download = '<?php echo $filme['titulo']; ?>.mp4';
      a.click();
    }
  </script>

  <script type="module" src="../../js/importar.js"></script>
  <script src="../../js/moveicon.js"></script>
  <script src="https://cdn.lordicon.com/lordicon.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>