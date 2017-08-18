<?php
require('./inc/site.php');
require('./inc/db.php');
$site->top("Purchase a new course");
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>Purchase a new course</h3>
				</div>
			</div>            
			<div class='row'>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				Here you can find a list of courses available for purchase.
				</div>

				
			



				<?php
				$sql = "SELECT courses.name as CourseName, courses.description AS description, courses.price as price, courses.id as id, staff.name as StaffName FROM courses JOIN staff on courses.author = staff.id";
				$res = $mysqli->query($sql);
				$i =1;
				while($row = $res->fetch_assoc())
				{
					if($i == 3)
					{
						echo "<div class='row'>";
					}
					echo "<div class=\"col-xs-12 col-sm-4 col-md-4 col-lg-4\"><div class='row'><div class='course'><h1>" . $row['CourseName'] . "<span class='author'><i> - ".$row['StaffName']."</i></span></h1><br />".$row['description']."<div class='price'>&pound;".$row['price']."<br /><a  class='btn btn-primary' href='./purchase.php?cid=".$row['id']."'>Purchase Now</a></div></div></div></div>";
					if($i == 3)
					{
						echo "</div>";
						$i=1;
					}
				}

				?>
				</div>
		</div>
	</div>
</div>
        <!-- /page content -->

<?php
$site->foot();
?>