<?php

require 'includes/navbar.inc.php';
require 'includes/dbh.inc.php';

$alert = false;
$search = "";
if (isset($_GET['search'])) {
	$search = $_GET['search'];
	$alert = true;
}

$list_customer = array();
$sqlCustomer = "SELECT * FROM customers c
				INNER JOIN addresses a ON a.cust_id = c.cust_id
				INNER JOIN contactnumbers n ON n.cust_id = c.cust_id
				WHERE
				a.cust_id LIKE '%$search%' OR
				a.addr_postalcode LIKE '%$search%' OR
				a.addr_blockNstreetname LIKE '%$search%' OR
				a.addr_buildingNhousenumber LIKE '%$search%' OR
				a.addr_unitnumber LIKE '%$search%' OR
				c.cust_id LIKE '%$search%' OR
				c.cust_givenname LIKE '%$search%' OR
				c.cust_familyname LIKE '%$search%' OR
				c.cust_gender LIKE '%$search%' OR
				c.cust_email LIKE '%$search%' OR
				n.cust_contactnumber LIKE '%$search%'";
$resultCustomer = mysqli_query($link, $sqlCustomer);
while ($rowCustomer = mysqli_fetch_assoc($resultCustomer)) {
	$list_customer[] = $rowCustomer;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>CMS | Far East Organisation</title>
		<style>
			.table-row{
				cursor:pointer;
			}
			@media screen and (max-width: 768px) {
				.content-desktop {display: none;}
				.content-mobile {display: block;}
			}
			@media screen and (max-width: 576px) {
				.content-desktop {display: none;}
				.content-ssm {display: none;}
				.content-mobile {display: block;}
				
			}
		</style>
		<script>
			$(document).ready(function(){
				$(".table-row").click(function() {
					var customer = $(this).data("href");
					$.get("includes/customer.get.inc.php", {
						customer : customer
					}, function (data) {
						$('#viewCustomer_modaltitle').html(data.cust_familyname + ", " + data.cust_givenname);
						$('[name="viewCustomer_ID"]').html("#" + customer);
						$('[name="viewCustomer_givenname"]').html(data.cust_givenname);
						$('[name="viewCustomer_familyname"]').html(data.cust_familyname);
						if (data.cust_gender == "M") {
							$('[name="viewCustomer_gender"]').html('<i class="fas fa-user" style="color: lightblue;"></i> MALE');
						} else {
							$('[name="viewCustomer_gender"]').html('<i class="fas fa-user" style="color: lightpink;"></i> FEMALE');
						}
						$('[name="viewCustomer_contactnumber"]').html("<a href='tel: +65" + data.cust_contactnumber + "'>(+65) " + data.cust_contactnumber + "</a>");
						$('[name="viewCustomer_email"]').html("<a href='mailto: " + data.cust_email + "'>" + data.cust_email + "</a>");
						$('[name="viewCustomer_postalcode"]').html(data.addr_postalcode);
						$('[name="viewCustomer_blockNstreetname"]').html(data.addr_blockNstreetname);
						if (data.addr_buildingNhousenumber == "") {
							$('[name="viewCustomer_buildingNhousenumber"]').html("-");
						} else {
							$('[name="viewCustomer_buildingNhousenumber"]').html(data.addr_buildingNhousenumber);
						}
						$('[name="viewCustomer_unitnumber"]').html("#" + data.addr_unitnumber);							
						$("#viewCustomer_modal").modal('show');
					}, "json")
				});
				
				$(".btnEdit").click(function() {
					var customer = $(this).val();
					$.get("includes/customer.get.inc.php", {
						customer : customer
					}, function (data) {
						$('#editCustomer_modaltitle').html(data.cust_familyname + ", " + data.cust_givenname);
						$('[name="editCustomer_customer"]').val(customer);
						$('[name="editCustomer_ID"]').html("#" + customer);
						$('[name="editCustomer_givenname"]').val(data.cust_givenname);
						$('[name="editCustomer_familyname"]').val(data.cust_familyname);
						$('[name="editCustomer_gender"]').val(data.cust_gender);
						$('[name="editCustomer_contactnumber"]').val(data.cust_contactnumber);
						$('[name="editCustomer_email"]').val(data.cust_email);
						$('[name="editCustomer_postalcode"]').val(data.addr_postalcode);
						$('[name="editCustomer_blockNstreetname"]').val(data.addr_blockNstreetname);
						$('[name="editCustomer_buildingNhousenumber"]').val(data.addr_buildingNhousenumber);
						$('[name="editCustomer_unitnumber"]').val(data.addr_unitnumber);							
						$("#editCustomer_modal").modal('show');
					}, "json")
				});
				
				$(".btnDelete").click(function() {
					var customer = $(this).val();
					var cfrm = confirm("Do you want to delete?");
					if (cfrm) {
						$.post("includes/customer.delete.inc.php", {
						customer : customer
						}, function (data) {
							location.href = "<?php echo $this_url ?>";
							alert("Deleted");
						}, "json")
					}
				});
				
				$("#searchCust").keyup(function() {
					var value = $(this).val().toUpperCase();
					$("#tblCust #tblCust_body").filter(function() {
						$(this).toggle($(this).text().toUpperCase().indexOf(value) > -1)
					});
				});
				
				$("#searchCustAdv").click(function() {
					location.href = "<?php echo $this_url ?>?search=" + $("#searchCust").val();
				});
				
			});
		</script>
	</head>
	<body>
		<!-- Directory -->
		<div style="background-color: #BBBBBB; padding: 10px">
			<i class="fas fa-users"></i> Customer List
		</div>
		<!-- Function bar -->
		<div class="card">
			<div class="card-body" style="padding: 5px">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#newCustomer_modal"><i class="fas fa-user-plus"></i> Add New</button>
					</div>
					<input type="text" id="searchCust" class="form-control" style="font-family: FontAwesome;" placeholder="Filter/Search..." value="<?php echo $search ?>" />
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" id="searchCustAdv" type="button"><i class="fas fa-search"></i> Adv. Search</button>
					</div>
				</div>
			</div>
		</div>
		<div style="margin: 20px;">
			<?php if ($alert) { ?>
			<div class="alert alert-warning align-middle" role="alert">
	  			<i class="fas fa-filter"></i> Advance search: "<?php echo $search; ?>" <a class="btn btn-light" href="<?php echo $this_url; ?>">Remove filter</a>
			</div>
			<?php } ?>
			
			<?php if (mysqli_num_rows($resultCustomer) > 0 ) { ?>
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="tblCust">
					<thead class="thead-dark">
						<tr>
							<th class='content-ssm text-center align-middle'>ID</th>
							<th class='text-center align-middle'>Name</th>
							<th class='content-desktop text-center align-middle'>Contact Number</th>
							<th class='content-desktop text-center align-middle'>Email</th>
							<th class='text-center align-middle'>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php for ($i = 0; $i < count($list_customer); $i++) { ?>
						<tr id="tblCust_body">
							<td class='content-ssm table-row text-center align-middle' data-href="<?php echo $list_customer[$i]['cust_id']; ?>"><?php echo $list_customer[$i]['cust_id']; ?></td>
							<td class='table-row align-middle' data-href="<?php echo $list_customer[$i]['cust_id']; ?>">
								<?php if ($list_customer[$i]['cust_gender'] == "M") { ?>
								<i class="fas fa-user" style="color: lightblue;"></i>
								<?php } else { ?>
								<i class="fas fa-user" style="color: lightpink;"></i>
								<?php } ?>
								<?php echo $list_customer[$i]['cust_familyname'] . ", " . $list_customer[$i]['cust_givenname']; ?>
							</td>
							<td class='content-desktop table-row text-center align-middle' data-href="<?php echo $list_customer[$i]['cust_id']; ?>"><?php echo $list_customer[$i]['cust_contactnumber']; ?></td>
							<td class='content-desktop table-row align-middle' data-href="<?php echo $list_customer[$i]['cust_id']; ?>"><?php echo $list_customer[$i]['cust_email']; ?></td>
							<td class='text-center align-middle'>
								<button class="btn btn-warning btnEdit" value="<?php echo $list_customer[$i]['cust_id']; ?>"><i class="fas fa-pencil-alt"></i></button>
								<button class="btn btn-danger btnDelete" value="<?php echo $list_customer[$i]['cust_id']; ?>"><i class="fas fa-trash"></i></button>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<?php } else { echo  "No record found";} ?>
		</div>
	</body>
</html>

<?php require 'modal/customer.new.mdl.php' ?>
<?php require 'modal/customer.edit.mdl.php' ?>
<?php require 'modal/customer.view.mdl.php' ?>
