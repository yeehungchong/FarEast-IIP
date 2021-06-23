<div class="modal fade bd-example-modal-lg" id="newCustomer_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Customer Informations</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="includes/customer.new.inc.php" method="POST">
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-md-5">
							<label for="newCustomer_givenname" class="col-form-label">Given Name</label>
							<input type="text" class="form-control" name="newCustomer_givenname" style="text-transform: uppercase;" required />
						</div>
						<div class="form-group col-md-4">
							<label for="newCustomer_familyname " class="col-form-label">Family Name</label>
							<input type="text" class="form-control" name="newCustomer_familyname" style="text-transform: uppercase;" required />
						</div>
						<div class="form-group col-md-3">
							<label for="newCustomer_gender " class="col-form-label">Gender</label>
							<select name="newCustomer_gender" class="form-control" required >
								<option value="" selected></option>
								<option value="M">MALE</option>
								<option value="F">FEMALE</option>
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="newCustomer_contactnumber" class="col-form-label">Contact Number</label>
							<input type="number" class="form-control" name="newCustomer_contactnumber" required />
						</div>
						<div class="form-group col-md-6">
							<label for="newCustomer_email" class="col-form-label">Email</label>
							<input type="email" class="form-control" name="newCustomer_email" style="text-transform: uppercase;" required />
						</div>
					</div>
					<hr>
					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="newCustomer_postalcode" class="col-form-label">Postal Code</label>
							<input type="number" class="form-control" name="newCustomer_postalcode" required />
						</div>
						<div class="form-group col-md-8">
							<label for="newCustomer_blockNstreetname" class="col-form-label">Block/Street Name</label>
							<input type="text" class="form-control" name="newCustomer_blockNstreetname" style="text-transform: uppercase;" required />
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-8">
							<label for="newCustomer_buildingNhousenumber" class="col-form-label">Building/House Number</label>
							<input type="text" class="form-control" name="newCustomer_buildingNhousenumber" style="text-transform: uppercase;" placeholder="If applicable" />
						</div>
						<div class="form-group col-md-4">
							<label for="newCustomer_unitnumber" class="col-form-label">Unit Number</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">#</span>
								</div>
								<input type="text" class="form-control" name="newCustomer_unitnumber" style="text-transform: uppercase;" required />
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="submit_newCustomer" class="btn btn-primary">Create customer</button>
				</div>
			</form>
		</div>
	</div>
</div>
