<?php 
    require '../private/display.php';
    require '../Databases/Database.php';
    require '../private/libraries.php';
    require '../private/session.php';

    if (!$session -> is_loged_in()) {
        header('Location:register.php');
    }
    
    $UserID = $session -> getSessionData();
    
   

 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>GMS - User Complains</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!----======== CSS ======== -->
    <link rel="stylesheet" href="../Docs/css/dashboard.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>

/* Style the sidenav links and the dropdown button */
 a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 18px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* On mouse-over */
 a:hover, .dropdown-btn:hover {
  color: #0E4BF1;
}


/* Add an active class to the active dropdown button */
.active {
  background-color: #0E4BF1;
  color: white;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: none;
  padding-left: 8px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
  color: #818181;
}


</style>
        
    </head>
    <body>
         <nav>
            <div class="logo-name">
                <div class="logo-image">
                    <img src="../Docs/img/logo.png" alt="">
                </div>
    
                <span class="logo_name">GMS</span>
            </div>
    
            <div class="menu-items">
            <ul class="nav-links sub-menu">
                    <li><a href="admin.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                    <button class="dropdown-btn">Create Admin 
                    <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="addAdmin.php">Add Admin</a>
                        <a href="manageAdmin.php">Manage Admin</a>
                    </div>
                    <button class="dropdown-btn">Create Driver 
                    <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="addDriver.php">Add Driver</a>
                        <a href="manageDriver.php">Manage Driver</a>
                    </div>
                    <li><a href="manageUser.php">
                        <i class='bx bxs-bell-ring' style='color:#969696'></i>
                        <span class="link-name">Manage User</span>
                    </a></li>
                    <li><a href="newComplain.php">
                        <i class='bx bxs-bell-ring' style='color:#969696'></i>
                        <span class="link-name">Complain</span>
                    </a></li>
                    <li><a href="driverResponse.php">
                        <i class='bx bx-repost' style='color:#969696'  ></i>
                         <span class="link-name">Driver response</span>
                        </a></li>
                    <li><a href="search.php">
                        <i class='bx bx-search-alt-2' style='color:#969696' ></i>
                        <span class="link-name">Search</span>
                    </a></li>
                    <li><a href="report.php">
                        <i class='bx bxs-report' style='color:#969696' ></i>
                        <span class="link-name">Report</span>
                    </a></li>
                </ul>
                
                <ul class="logout-mode">
                    <li><a href="../logout.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>
    
                    <li class="mode">
                        <a href="#">
                            <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
    
                    <div class="mode-toggle">
                      <span class="switch"></span>
                    </div>
                </li>
                </ul>
            </div>
        </nav>
    
        <section class="dashboard">
            <div class="top">
                <i class="uil uil-bars sidebar-toggle"></i>
            </div>
    
            <div class="dash-content" id="dashboard">
            <main class="table">
        <section class="table__header">
            <h1>All Users Complains</h1>
            <div class="input-group">
                <input type="search" class="search-input" placeholder="Search Complain..." data-table="customers-list">
                <img src="../Docs/img/search.png" alt="">
            </div>
            <div class="export__file">
            </div>
        </section>
        <section class="table__body">

            <?php
            echo Librarie::getSearchList($UserID);
            ?>

        </section>
        <center><div class="no-results-msg" style="display: none;">No matched data found.</div></center>
             </div>
</main>
    
               
        </section>
       <script src="../Docs/js/dashboard.js"></script>
        
       <script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

(function(document) {
  'use strict';

  var TableFilter = (function(myArray) {
    var search_input;

    function _onInputSearch(e) {
      search_input = e.target;
      var tables = document.getElementsByClassName(search_input.getAttribute('data-table'));
      var noResultsMsg = document.querySelector('.no-results-msg'); // Get the element to display no results message
      var hasResults = false; // Variable to track if any results are found

      myArray.forEach.call(tables, function(table) {
        var rows = table.tBodies[0].rows;
        myArray.forEach.call(rows, function(row) {
          var text_content = row.textContent.toLowerCase();
          var search_val = search_input.value.toLowerCase();
          row.style.display = text_content.indexOf(search_val) > -1 ? '' : 'none';

          // Check if any results are found
          if (row.style.display !== 'none') {
            hasResults = true;
          }
        });
      });

      // Show or hide the no results message
      if (noResultsMsg) {
        noResultsMsg.style.display = hasResults ? 'none' : 'block';
      }
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('search-input');
        myArray.forEach.call(inputs, function(input) {
          input.oninput = _onInputSearch;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      TableFilter.init();
    }
  });
})(document);

</script>
    </body>
</html>