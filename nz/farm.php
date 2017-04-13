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
			<input name="land_area" class="small" type="text" value="<?php echo htmlentities($details['Land_Area']);?>" pattern="^\d*(\.\d{1,4}$)?"/>
			<select name="land_area_metric"><?php echo keypairs($land_metric_lkp,$details['Land_Area_Metric'],false,"M2"); ?></select>
			<label>Land Area</label>
		</div>
		<div class="property_attribute">
			<input name="car_spaces" class="small" type="text" value="<?php echo htmlentities($details['Car_Spaces']);?>" pattern="[0-9]{1,2}"/>
			<label>Car Spaces</label>
		</div>
		<div class="property_attribute">
			<input name="toilets" class="small" type="text" value="<?php echo htmlentities($details['Toilets']);?>" pattern="[0-9]{1}"/>
			<label>Toilets</label>
		</div>		
		<div class="property_attribute">
			<input name="dining_rooms" class="small" type="text" value="<?php echo htmlentities($details['Dining_Rooms']);?>" pattern="[0-9]{1}"/>
			<label>Dining Rooms</label>
		</div>
		<div class="property_attribute">
			<input name="other_rooms" class="small" type="text" value="<?php echo htmlentities($details['Other_Rooms']);?>" pattern="[0-9]{1,2}"/>
			<label>Other Rooms</label>
		</div>	
		<div class="property_attribute">
			<input name="year_built" class="small" type="text" value="<?php echo htmlentities($details['Year_Built']);?>" pattern="[0-9]{4}"/>
			<label>Year Built</label>
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
				<label><input name="close_to_public" type="checkbox" value="Y" <?php if($details['Close_To_Public']){ echo "checked";}?>>Close To Public Transport</label>
			</div>
			<div class="tick">
				<label><input name="lift_installed" type="checkbox" value="Y" <?php if($details['Lift_Installed']){ echo "checked";}?>>Lift Installed</label>
			</div>
			<div class="tick">
				<label><input name="access_security" type="checkbox" value="Y" <?php if($details['Access_Security']){ echo "checked";}?>>Access Security Installed</label>
			</div>
			<div class="tick">
				<label><input name="vendor_will_trade" type="checkbox" value="Y" <?php if($details['Vendor_Will_Trade']){ echo "checked";}?>>Vendor Will Trade</label>
			</div>
			<div class="tick">
				<label><input name="permanent_water" type="checkbox" value="Y" <?php if($details['Permanent_Water']){ echo "checked";}?>>Permanent Water</label>
			</div>
			<div class="tick">
				<label><input name="mains_electricity" type="checkbox" value="Y" <?php if($details['Mains_Electricity']){ echo "checked";}?>>Mains Electricity Available</label>
			</div>
			<div class="tick">
				<label><input name="river_frontage" type="checkbox" value="Y" <?php if($details['River_Frontage']){ echo "checked";}?>>River Frontage</label>
			</div>
			<div class="tick">
				<label><input name="coast_frontage" type="checkbox" value="Y" <?php if($details['Coast_Frontage']){ echo "checked";}?>>Coast Frontage</label>
			</div>
			<div class="tick">
				<label><input name="canal_frontage" type="checkbox" value="Y" <?php if($details['Canal_Frontage']){ echo "checked";}?>>Canal Frontage</label>
			</div>
			<div class="tick">
				<label><input name="lake_frontage" type="checkbox" value="Y" <?php if($details['Lake_Frontage']){ echo "checked";}?>>Lake Frontage</label>
			</div>
			<div class="tick">
				<label><input name="sealed_roads" type="checkbox" value="Y" <?php if($details['Sealed_Roads']){ echo "checked";}?>>Sealed Roads To Property</label>
			</div>
			<div class="tick">
				<label><input name="open_plan" type="checkbox" value="Y" <?php if($details['Open_Plan']){ echo "checked";}?>>Open Plan</label>
			</div>
			<div class="tick">
				<label><input name="swimming_pool" type="checkbox" value="Y" <?php if($details['Swimming_Pool']){ echo "checked";}?>>Swimming Pool</label>
			</div>
			<div class="tick">
				<label><input name="town_water" type="checkbox" value="Y" <?php if($details['Town_Water']){ echo "checked";}?>>Town Water Available</label>
			</div>
			<div class="tick">
				<label><input name="town_sewerage" type="checkbox" value="Y" <?php if($details['Town_Sewerage']){ echo "checked";}?>>Town Sewerage Available</label>
			</div>
			<div class="tick">
				<label><input name="all_weather_access" type="checkbox" value="Y" <?php if($details['All_Weather_Access']){ echo "checked";}?>>All Weather Access To Land</label>
			</div>
		</fieldset>
	</div>
