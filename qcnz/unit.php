	<div id="attributes">	
		<fieldset>
		<div class="property_attribute">
			<input name="bedrooms" class="small" type="text" value="<?php echo htmlentities($details['Bedrooms']);?>" pattern="[0-9-]{1,5}"/>
			<label>Bedrooms</label>
		</div>
		<div class="property_attribute">
			<input name="bathrooms" class="small" type="text" value="<?php echo htmlentities($details['Bathrooms']);?>" pattern="[0-9]{1,3}"/>
			<label>Bathrooms</label>
		</div>
		<div class="property_attribute">
			<input name="lockup_garages" class="small" type="text" value="<?php echo htmlentities($details['Lockup_Garages']);?>" pattern="[0-9]{1}"/>
			<label>Lock-up Garage</label>
		</div>
		<div class="property_attribute">
			<input name="floor_level" class="small" type="text" value="<?php echo htmlentities($details['Floor_Level']);?>" pattern="[0-9]{1,2}"/>
			<label>Floor Level</label>
		</div>
		<div class="property_attribute">
			<input name="car_spaces" class="small" type="text" value="<?php echo htmlentities($details['Car_Spaces']);?>" pattern="[0-9]{1,2}"/>
			<label>Car Spaces</label>
		</div>
		<div class="property_attribute">
			<input name="m2_total_floor" class="small" type="text" value="<?php echo htmlentities($details['M2_Total_Floor']);?>" pattern="^\d*(\.\d{1,2}$)?"/>
			<label>M2 Total Floor Area</label>
		</div>
		<div class="property_attribute">
			<input name="lounge_rooms" class="small" type="text" value="<?php echo htmlentities($details['Lounge_Rooms']);?>" pattern="[0-9]{1,2}"/>
			<label>Lounge Rooms</label>
		</div>
		<div class="property_attribute">
			<input name="dining_rooms" class="small" type="text" value="<?php echo htmlentities($details['Dining_Rooms']);?>" pattern="[0-9]{1}"/>
			<label>Dining Rooms</label>
		</div>
		<div class="property_attribute">
			<input name="no_of_study" class="small" type="text" value="<?php echo htmlentities($details['No_Of_Study']);?>" pattern="[0-9]{1}"/>
			<label>No. of Study Rooms</label>
		</div>
		<div class="property_attribute">
			<input name="family_rumpus" class="small" type="text" value="<?php echo htmlentities($details['Family_Rumpus']);?>" pattern="[0-9]{1,2}"/>
			<label>Family / Rumpus Rumpus</label>
		</div>
		<div class="property_attribute">
			<input name="toilets" class="small" type="text" value="<?php echo htmlentities($details['Toilets']);?>" pattern="[0-9]{1}"/>
			<label>Toilets</label>
		</div>
		<div class="property_attribute">
			<input name="ensuites" class="small" type="text" value="<?php echo htmlentities($details['Ensuites']);?>" pattern="[0-9]{1}"/>
			<label>Ensuites</label>
		</div>
		<div class="property_attribute">
			<input name="lounge_dining" class="small" type="text" value="<?php echo htmlentities($details['Lounge_Dining']);?>" pattern="[0-9]{1}"/>
			<label>Lounge/Dining Combined</label>
		</div>		
		<div class="property_attribute">
			<input name="other_rooms" class="small" type="text" value="<?php echo htmlentities($details['Other_Rooms']);?>" pattern="[0-9]{1,2}"/>
			<label>Other Rooms</label>
		</div>
		<div class="property_attribute">
			<input name="total_floors" class="small" type="text" value="<?php echo htmlentities($details['Total_Floors']);?>" pattern="[0-9]{1,2}"/>
			<label>Total Floors In Building</label>
		</div>
		<div class="property_attribute">
			<input name="no_of_floor" class="small" type="text" value="<?php echo htmlentities($details['No_Of_Floor']);?>" pattern="[0-9]{1,2}"/>
			<label>No. Of Floor Level Inside</label>
		</div>		
		<div class="property_attribute">
			<input name="year_built" class="small" type="text" value="<?php echo htmlentities($details['Year_Built']);?>" pattern="[0-9]{4}"/>
			<label>Year Built</label>
		</div>		
		<div class="property_attribute">
			<select name="construction_type"><?php echo keypairs($construction_type_lkp,$details['Construction_Type'],true,"M2"); ?></select>
			<label>Construction Type</label>
		</div>
		<div class="property_attribute">
			<select name="materials_in_roof"><?php echo keypairs($roof_materials_lkp,$details['Materials_In_Roof'],true,"M2"); ?></select>
			<label>Materials In Roof</label>
		</div>
		<div class="property_attribute">
			<select name="type_of_scenic"><?php echo keypairs($scenic_type_lkp,$details['Type_Of_Scenic'],true,""); ?></select>
			<label>Type Of Scenic View</label>
		</div>
		</fieldset>
	</div><!-- end of attributes -->
	<div id="tickboxes">
		<fieldset>
			<div class="tick">
				<label><input name="air_conditioned" type="checkbox" value="Y" <?php if($details['Air_Conditioned']){ echo "checked";}?>>Air Conditioned</label>
			</div>
			<div class="tick">
				<label><input name="scenic_view" type="checkbox" value="Y" <?php if($details['Scenic_View']){ echo "checked";}?>>Scenic View</label>
			</div>
			<div class="tick">
				<label><input name="swimming_pool" type="checkbox" value="Y" <?php if($details['Swimming_Pool']){ echo "checked";}?>>Swimming Pool</label>
			</div>
			<div class="tick">
				<label><input name="close_to_public" type="checkbox" value="Y" <?php if($details['Close_To_Public']){ echo "checked";}?>>Close To Public Transport</label>
			</div>
			<div class="tick">
				<label><input name="polished_floors" type="checkbox" value="Y" <?php if($details['Polished_Floors']){ echo "checked";}?>>Polished Floors</label>
			</div>			
			<div class="tick">
				<label><input name="water_frontage" type="checkbox" value="Y" <?php if($details['Water_Frontage']){ echo "checked";}?>>Water Frontage</label>
			</div>
			<div class="tick">
				<label><input name="ducted_vaccuum" type="checkbox" value="Y" <?php if($details['Ducted_Vaccuum']){ echo "checked";}?>>Ducted Vaccuum</label>
			</div>
			<div class="tick">
				<label><input name="heritage_other" type="checkbox" value="Y" <?php if($details['Heritage_Other']){ echo "checked";}?>>Heritage / Other Classification</label>
			</div>
			<div class="tick">
				<label><input name="lift_installed" type="checkbox" value="Y" <?php if($details['Lift_Installed']){ echo "checked";}?>>Lift Installed</label>
			</div>
			<div class="tick">
				<label><input name="access_security" type="checkbox" value="Y" <?php if($details['Access_Security']){ echo "checked";}?>>Access Security Installed</label>
			</div>
			<div class="tick">
				<label><input name="river_frontage" type="checkbox" value="Y" <?php if($details['River_Frontage']){ echo "checked";}?>>River Frontage</label>
			</div>
			<div class="tick">
				<label><input name="fireplace" type="checkbox" value="Y" <?php if($details['Fireplace']){ echo "checked";}?>>Fireplace</label>
			</div>
			<div class="tick">
				<label><input name="canal_frontage" type="checkbox" value="Y" <?php if($details['Canal_Frontage']){ echo "checked";}?>>Canal Frontage</label>
			</div>		
			<div class="tick">
				<label><input name="vendor_will_trade" type="checkbox" value="Y" <?php if($details['Vendor_Will_Trade']){ echo "checked";}?>>Vendor Will Trade</label>
			</div>
			<div class="tick">
				<label><input name="renovated" type="checkbox" value="Y" <?php if($details['Renovated']){ echo "checked";}?>>Renovated</label>
			</div>
			<div class="tick">
				<label><input name="coast_frontage" type="checkbox" value="Y" <?php if($details['Coast_Frontage']){ echo "checked";}?>>Coast Frontage</label>
			</div>
			<div class="tick">
				<label><input name="double_storey" type="checkbox" value="Y" <?php if($details['Double_Storey']){ echo "checked";}?>>Double Storey</label>
			</div>
			<div class="tick">
				<label><input name="selling_off" type="checkbox" value="Y" <?php if($details['Selling_Off']){ echo "checked";}?>>Selling Off The Plan</label>
			</div>
			<div class="tick">
				<label><input name="open_plan" type="checkbox" value="Y" <?php if($details['Open_Plan']){ echo "checked";}?>>Open Plan</label>
			</div>
			<div class="tick">
				<label><input name="lake_frontage" type="checkbox" value="Y" <?php if($details['Lake_Frontage']){ echo "checked";}?>>Lake Frontage</label>
			</div>			
			<div class="tick">
				<label><input name="ducted_heating" type="checkbox" value="Y" <?php if($details['Ducted_Heating']){ echo "checked";}?>>Ducted Heating</label>
			</div>
		</fieldset>
	</div>
