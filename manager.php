<div class="subheader-search-card">
  <form action="newenrollment.php" method="POST" class="subheader-search-form">
    <div class="subheader-search-group">
      <label for="txtsearch" class="subheader-search-label"><i class="fas fa-id-card"></i> Student ID Number:</label>
      <div class="subheader-input-wrap">
        <input type="text" id="txtsearch" name="txtsearch" class="form-control" placeholder="Enter Student ID / Search...">
        <button type="submit" name="search" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
      </div>
    </div>
    <div class="subheader-date-badge">
      <i class="far fa-clock"></i> <?php $created = strftime("%Y-%m-%d %H:%M:%S", time()); echo date_toText($created); ?>
    </div>
  </form>
</div>