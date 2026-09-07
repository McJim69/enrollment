<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (defined('MENU_RENDERED')) {
    return;
}
define('MENU_RENDERED', true);

$account_type = $_SESSION['ACCOUNT_TYPE'] ?? '';
$is_logged_in = !empty($_SESSION['ACCOUNT_ID']) || !empty($_SESSION['ACCOUNT_USERNAME']);
$brand_href = $is_logged_in ? 'home.php' : 'login.php';
?>
<!-- UNIFIED MENU (ROLE-BASED) -->
<div id="menu" class="navbar navbar-fixed-top enroll-navbar" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <div class="navbar-header-actions">
        <button type="button" class="btn-theme-toggle nav-header-theme-btn" onclick="toggleEnrollTheme()" title="Toggle Theme"><i class="fas fa-moon"></i></button>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <a class="navbar-brand" href="<?php echo $brand_href; ?>">
        <img src="img/logo.png" alt="WPH Logo">
        <div class="brand-text-wrapper">
          <span class="brand-main">West Prime Horizon</span>
          <span class="brand-sub">Enrollment System</span>
        </div>
      </a>
    </div>

    <div class="collapse navbar-collapse">
      <?php if (!$is_logged_in): ?>
        <!-- Guest / Unauthenticated Navigation -->
        <ul class="nav navbar-nav navbar-right">
          <li><a id="home" href="login.php"><i class="fas fa-sign-in-alt"></i> Sign In</a></li>                      
          <li><a id="signup" href="signup.php"><i class="fas fa-user-plus"></i> Register Account</a></li>
          <li class="nav-theme-item">
            <button type="button" class="btn-theme-toggle" onclick="toggleEnrollTheme()" title="Toggle Theme"><i class="fas fa-moon"></i></button>
          </li>
        </ul>

      <?php elseif ($account_type === 'Student'): ?>
        <!-- Student Navigation -->
        <ul class="nav navbar-nav">
          <li><a id="home" href="home.php"><i class="fas fa-home"></i> Home</a></li>
          <?php
            $user_email = $_SESSION['ACCOUNT_USERNAME'] ?? '';
            $stud_email = '';
            if (isset($conn) && !empty($user_email)) {
                $qry = $conn->query("SELECT EMAIL FROM tblstudent WHERE EMAIL='" . $conn->real_escape_string($user_email) . "'");
                if ($qry && $rs = $qry->fetch_assoc()) {
                    $stud_email = $rs["EMAIL"] ?? '';
                }
            }
            if (!empty($user_email) && $user_email !== $stud_email) {
                echo "<li><a id='enroll' href='studentNew.php'><i class='fas fa-user-edit'></i> New Enrollment</a></li>";
                echo "<li><a id='account' href='userAccount.php'><i class='fas fa-user-circle'></i> Profile Account</a></li>";
            } else {
                echo "<li><a id='account' href='userAccount.php'><i class='fas fa-user-circle'></i> Profile Account</a></li>";
                echo "<li><a id='info' href='studentView.php'><i class='fas fa-graduation-cap'></i> Enrollment Info</a></li>";
            }
          ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="logout.php" class="nav-logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
          <li class="nav-theme-item">
            <button type="button" class="btn-theme-toggle" onclick="toggleEnrollTheme()" title="Toggle Theme"><i class="fas fa-moon"></i></button>
          </li>
        </ul>

      <?php else: ?>
        <!-- Staff Navigation (Admin / Registrar / Encoder) -->
        <ul class="nav navbar-nav">
          <li><a id="home" href="home.php"><i class="fas fa-home"></i> Home</a></li>
          
          <li class="dropdown">
            <a id="entry" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-list"></i> Directories <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="studentList.php"><i class="fas fa-user-graduate"></i> Student Directory</a></li>
              <li><a href="subjectList.php"><i class="fas fa-book"></i> Subject Catalog</a></li>
              <li><a href="courseFilter.php"><i class="fas fa-layer-group"></i> Course Programs</a></li>
              <li><a href="listofdept.php"><i class="fas fa-building"></i> Department List</a></li>
              <li><a href="facultyFilter.php"><i class="fas fa-chalkboard-teacher"></i> Faculty Directory</a></li>
            </ul>  
          </li>

          <li class="dropdown">
            <a id="enroll" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user-plus"></i> Enrollment <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="newenrollment.php"><i class="fas fa-calendar-check"></i> Registration & Reservation</a></li>
              <li><a href="Student_advicesubject.php"><i class="fas fa-clipboard-list"></i> Subject Advising</a></li>
            </ul>  
          </li>

          <li class="dropdown">
            <a id="class" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-chalkboard"></i> Classes <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="listofclass.php"><i class="fas fa-tasks"></i> Class Rosters</a></li>
              <li><a href="newenrollment.php"><i class="fas fa-plus-circle"></i> New Enrollment</a></li>                            
            </ul>  				
          </li>

          <?php if ($account_type === 'Registrar'): ?>
            <li class="dropdown">
              <a id="settings" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-cog"></i> Settings <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="pagunavailable.php"><i class="fas fa-file-alt"></i> Reports</a></li>
                <li><a href="backup.php"><i class="fas fa-database"></i> Database Backup</a></li>
              </ul>  
            </li>
          <?php elseif ($account_type !== 'Encoder'): ?>
            <!-- Administrator / System Staff -->
            <li class="dropdown">
              <a id="settings" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-cog"></i> Settings <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="listofuser.php"><i class="fas fa-users-cog"></i> User Management</a></li>
                <li><a href="backup.php"><i class="fas fa-database"></i> Database Backup</a></li>
              </ul>  
            </li>
          <?php endif; ?>

        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="logout.php" class="nav-logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
          <li class="nav-theme-item">
            <button type="button" class="btn-theme-toggle" onclick="toggleEnrollTheme()" title="Toggle Theme"><i class="fas fa-moon"></i></button>
          </li>
        </ul>
      <?php endif; ?>
    </div><!-- /.nav-collapse -->
  </div><!-- /.container -->
</div><!-- /.navbar -->
