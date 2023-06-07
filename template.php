<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="template.css">
    <script src="todf.js"></script>
    <title class="pageTitle"></title>
  </head>
  <body>
    <div class="container-fluid p-0">
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">TODF</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mx-2" href="#" role="button" data-bs-toggle="dropdown">
                  Forum
                </a>
                <ul class="dropdown-menu" id="forumDropdown">
                  <!-- BEGIN: STRUCTURE FOR MENU AND SUBMENU----------------------->
                  <!-- <li class="withSubcategory dropdown">
                    <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Category 2</a>
                    <ul class="dropdown-menu submenu">
                      <li><a class="dropdown-item" href="#">Subcategory 21</a></li>
                      <li><a class="dropdown-item" href="#">Subcategory 22</a></li>
                      <li><a class="dropdown-item" href="#">Subcategory 23</a></li>
                      <li><a class="dropdown-item" href="#">Subcategory 24</a></li>
                      <li><a class="dropdown-item" href="#">Other subcategory</a></li>
                    </ul> 
                  </li> -->
                  <!-- OTHER CATEGORY WITH NO SUBCATEGORY-->
                  <!-- <li><a class="dropdown-item other" href="questionsList.php?categoryID=Category OTHER">Other category</a></li> -->
                  <!-- END: STRUCTURE FOR MENU AND SUBMENU----------------------->
                </ul><!-- <ul class="dropdown-menu"> -->
              </li><!-- <li class="nav-item dropdown"> -->
              <li class="nav-item">
                <a class="nav-link mx-2" href="contact.php">Contact</a>
              </li>
              <li class="nav-item" id="login">
                <a class="nav-link mx-2" href="memberLogin.php">Log in</a>
              </li>
              <li class="nav-item" id="register">
                <a class="nav-link mx-2" href="register.php">Register</a>
              </li>              
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success bg-success text-light" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      <main class="p-2">
        <?php include($pageContent); ?>
      </main>
      <footer class="bg-primary p-2 d-flex flex-column justify-content-end align-items-center">
        <p class="text-light text-center mb-0">Copyright &copy; <span id="currentYear"></span> Digital Aus Solutions Pty Ltd. All rights reserved.</p>
        <a href="privacyPolicy.php" class="text-decoration-none text-light fs-6" target="_blank">Privacy Policy</a>
      </footer>
    </div><!--<div class="container-fluid"> -->

    <!-- Option 1: Bootstrap Bundle with Popper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <script type="text/javascript">
      //BEGIN: DO NOT MODIFY THIS PART AND ALL THE FUNCTIONS CALLED IN THIS PART
      document.querySelector("#currentYear").textContent = getCurrentYear();

      //All 'withSubcategory' classes becomes dropend in screens wider than mobile phones
      const MOBILE_PHONE_WIDTH_PORTRAIT = "(max-width: 768px)";
      const isScreenWidthMobilePhonePortrait = window.matchMedia(MOBILE_PHONE_WIDTH_PORTRAIT);
      const forumDropDownMenu = document.querySelector("#forumDropdown");
      const serverFileForCategoryAndSubcat = "Processes/processGetAllCategoriesAndSubcategories.php";
      const thisNavbarNav = document.querySelector(".navbar-nav");
      const thisNavbar = document.querySelector("#navbarSupportedContent");
      let arrayCategoriesAndSubCategories = "";      

      //Enable submenus as these are not supported in this version of Bootstrap.    
      enableSubmenu(document.querySelectorAll('.dropdown-toggle')
                   ,document.querySelectorAll(".submenu")
                   );
      ajaxGetDataFromServer(serverFileForCategoryAndSubcat, function(arrayCategoriesAndSubCategories){
         for(let index = 0; index < arrayCategoriesAndSubCategories.length; index++)
         {
           for(category in arrayCategoriesAndSubCategories[index])
           {
              forumDropDownMenu.appendChild(createForumDropdown(category      
                        , arrayCategoriesAndSubCategories[index][category] //subcategories
                        ));
           }
         }
          //call listener function at runtime
          selectBetweenDropDownAndDropEnd(isScreenWidthMobilePhonePortrait);

          //Select between dropdown or dropend in category menu depending on the screen width
          isScreenWidthMobilePhonePortrait.addListener(selectBetweenDropDownAndDropEnd);
      });//ajaxGetDataFromServer   
      //END:DO NOT MODIFY THIS PART AND ALL THE FUNCTIONS CALLED IN THIS PART

      <?php
         if(isset($_SESSION['USERNAME']))
         {
           $member_ID = $_SESSION['MEMBER_ID'];
           $member_Image = $_SESSION['MEMBER_IMAGE'];
           echo "thisNavbarNav.insertBefore(createMenuItem('My Answers', 'nav-link mx-2', 'answersList.php?MemberID=$member_ID'), thisNavbarNav.childNodes[0]);";
           echo "thisNavbarNav.insertBefore(createMenuItem('My Questions', 'nav-link mx-2', 'questionsList.php?MemberID=$member_ID'), thisNavbarNav.childNodes[0]);";
           echo "document.querySelector('#login').style.display='none';";
           echo "document.querySelector('#register').style.display='none';";
           echo "thisNavbar.appendChild(createLoggedInUserDropdown('$member_Image', $member_ID));";
         }
      ?>
    </script>
  </body>
</html>