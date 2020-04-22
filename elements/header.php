<?php 
	include 'meta.php';
	include '../actions/process.php';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <h3>Library System</h3>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../pages/books.php">Books</a>
      </li>
    <?php   if($_SESSION['type'] == 'admin') : ?>
      <li class="nav-item">
        <a class="nav-link" href="../pages/lessees.php">Lessees</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_report_rented.php">Rented</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_report_returned.php">Returned</a>
      </li>
      <?php else: ?>
      <li class="nav-item">
        <a class="nav-link" href="user_rented.php">Rented</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user_returned.php">Returned</a>
      </li>
     <?php endif; ?>
    </ul>
  </div>
  <a href="../actions/logout.php" class="btn btn-light">Logout</a>
</nav>