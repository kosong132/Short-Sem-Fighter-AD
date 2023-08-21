<html>
<head></head>
<body>
<div class='menu-container'>
            <div class='menu'>
              <div class ='left_menu'>
                  <div class="logo">
                    <img src="img/headerImage/image (1).png" style="height: 50px; width: 50px; text-align: center">
                  </div>  
                  <div class="header1"> 
                    <div class="header"><a data-active="home" href="homepage.php">HOME</a></div> 
                    <div class="header"><a data-active="service" href="servicespage.php">SERVICE</a></div> 
                    <div class="header"><a data-active="order" href="orderhistory.php">ORDER</a></div> 
                  </div> 
              </div>
                <div class="login">
                    <img src="img/headerImage/image.png" style="text-align: center; padding: 15px 0;">
        <button class="logout" onclick="document.getElementById('id03').style.display='block'">LOGOUT</button>
                </div>          
            </div>
        </div><div id="id03" class="modal">

          <form class="modal-content animate" action="check_login.php" method="post">
            <div class="imgcontainer">
              <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>
            
            <div class = "logoutText">
              <p>Are you sure you want to logout?</p>
            </div>
        
            <div class="logoutContainer">
                <div class="logoutButton">
                  <button type="submit" id="logoutButton" name="logout">Logout</button>
                  <button type="button"	id="cancelButton" onclick="document.getElementById('id03').style.display='none'">Cancel</button>
              </div>
            </div>
        
          </form>
        </div>
      </div>
  </div>
</div>
</body>
</html>