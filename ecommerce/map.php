<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css">

<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		                <ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                </ol>
		                <div class="carousel-inner">
		                  <div class="item active">
		                    <img src="images/leaf3.png" alt="First slide" style="height: 400px; width: 600px;">
		                  </div>
		                  <div class="item">
		                    <img src="images/leaf2.png" alt="Second slide" style="height: 400px; width: 600px;">
		                  </div>
		                  <div class="item">
		                    <img src="images/leaf.png" alt="Third slide" style="height: 400px; width: 600px;">
		                  </div>
		                </div>
		                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a>
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                  <span class="fa fa-angle-right"></span>
		                </a>
		            </div>
					<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h2 class="text-center">Map</h2>
			<p class="text-center">


<div id="map" style="height: 400px;"></div>

Special thanks to the company <a href="https://download.code-projects.org/details/618a5237-a957-4c69-ba6d-dbfb8a420ab9" target="_blank">code-projects.org</a>
	and also to the company<a href="https://www.experte.com/logo-maker#/creator" target="_blank">experte</a> for the logo
</p>
<p class="text-center">
    This is a project where the intention is to embed the Leaflet map into the system created by @code-projects.org.
    <a href="https://leafletjs.com/" target="_blank">Leaflet Map</a> is an open-source mapping tool used to create mapping applications or locators, depending on your preference.
</p>
<p class="text-center">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque fugit, enim et quasi sequi provident architecto commodi expedita aspernatur quibusdam perspiciatis magni nihil? Eaque rem odio dolorem, est magni quae.
</p>

        </div>
    </div>
</div>
	       		
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>

<script>
  // Initialize the map
  
  var map = L.map('map').setView([12.8797, 121.7740], 5.3); // Centered on the Philippines with a zoom level of 6

  // Add a tile layer (you can use any tile provider you prefer)
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  // Fetch data from your PHP script and add markers
  <?php
  
    $conn = $pdo->open();
    try {
      $stmt = $conn->prepare("SELECT *
      FROM products p
      INNER JOIN category c ON p.category_id = c.id;
      ");
      $stmt->execute();
      foreach ($stmt as $row) {
        // Determine the appropriate Font Awesome icon based on the category_id
        $faIcon = "";
        switch ($row['category_id']) {
          case 1:
            $faIcon = "fa-laptop";
            break;
          case 2:
            $faIcon = "fa-desktop";
            break;
          case 3:
            $faIcon = "fa-tablet";
            break;
          case 4:
            $faIcon = "fa-mobile";
            break;
          default:
            $faIcon = "fa-question"; // Use a default icon if the category_id doesn't match any predefined cases
        }
        
        
        // Create the marker with the Font Awesome icon in the popup
        echo "L.marker([" . $row['latitude'] . ", " . $row['longitude'] . "])
          .addTo(map)
          .bindPopup('<a href=\"category.php?category=" . $row['cat_slug'] . "\"><i class=\"fa " . $faIcon . "\"></i> " . $row['name'] . "</a> - " . $row['category_id'] . "');\n";
          
      }
    } catch (PDOException $e) {
      echo "console.error('There is some problem in connection: " . $e->getMessage() . "');\n";
    }
    $pdo->close();
  ?>
</script>
