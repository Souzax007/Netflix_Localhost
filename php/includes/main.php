     <div class="catalogo" style="display: flex; flex-wrap: wrap; gap: 20px;">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="filme">
          <a href="/php/includes/video.php?id=<?php echo $row['id']; ?>">
            <img src="/php/img_capas/<?php echo $row['thumbnail']; ?>" alt="<?php echo $row['titulo']; ?>" width="200" height="300">
            <h3><?php echo $row['titulo']; ?></h3>
          </a>
        </div>
      <?php endwhile; ?>
    </div>