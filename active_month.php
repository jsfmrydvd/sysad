<nav id="sidebar" class="sidebar-wrapper">
  <div class="sidebar-content">
    <div class="sidebar-brand">
      <a href="#">Sysad</a>
      <div id="close-sidebar">
        <i class="fas fa-times"></i>
      </div>
    </div>
    <!-- sidebar-header  -->
    <!-- <div class="sidebar-search">
      <div>
       <form action="index.php" method="post">
        <div class="input-group">
          <input type="text" class="form-control search-menu" name="search" type="search" placeholder="Search..."autofocus>

          <div class="input-group-append">
            <span class="input-group-text" style="padding: 0;border: none;">
              <button class="btn" type="submit" name="button"><i class="fa fa-search" aria-hidden="true"></i></button>
            </span>
          </div>
        </div>
      </form>
      </div>
    </div> -->
    <!-- sidebar-search  -->
    <div class="sidebar-menu">
      <ul>
        <li class="header-menu">
          <span>General</span>
        </li>
        <li class="sidebar active" >
          <a href="index.php">
            <i class="fa fa-tachometer-alt" ></i>
            <span >Dashboard</span>
            <!-- <span class="badge badge-pill badge-warning">New</span> -->
          </a>
        </li>
        <li class="sidebar-dropdown active">
          <a href="#">
            <i class="fa fa-chart-line" id="dashboard_icon"></i>
            <span id="dashboard">Tables</span>
          </a>
          <div class="sidebar-submenu" style="display:block;">
            <ul>
              <li>
                <a href="totalSalesPerMonth.php" id="hover_sales">Sales per month</a>
              </li>
              <li>
                <a href="totalSales.php">Sales</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
