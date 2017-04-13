	<div id="attributes">	
		<fieldset>
		<div class="property_attribute">
			<input name="bedrooms" class="small" type="text" value="<?php echo htmlentities($details['Bedrooms']);?>" pattern="[0-9-]{1,5}"/>
			<label>Bedrooms</label>
		</div>
		<div class="property_attribute">
			<input name="bathrooms" class="small" type="text" value="<?php echo htmlentities($details['Bathrooms']);?>" pattern="[0-9]{1,2}"/>
			<label>Bathrooms</label>
		</div>
		<div class="property_attribute">
			<input name="car_spaces" class="small" type="text" value="<?php echo htmlentities($details['Car_Spaces']);?>" pattern="[0-9]{1,2}"/>
			<label>Car Spaces</label>
		</div>
		<div class="property_attribute">
			<input name="land_area" class="small" type="text" value="<?php echo htmlentities($details['Land_Area']);?>" pattern="^\d*(\.\d{1,4}$)?"/>
			<select name="land_area_metric"><?php echo keypairs($land_metric_lkp,$details['Land_Area_Metric'],false,"M2"); ?></select>
			<label>Land Area</label>
		</div>
		<div class="property_attribute">
			<input name="floor_level" class="small" type="text" value="<?php echo htmlentities($details['Floor_Level']);?>" pattern="[0-9]{1,2}"/>
			<label>Floor Level</label>
		</div>
		<div class="property_attribute">
			<input name="m2_total_floor" class="small" type="text" value="<?php echo htmlentities($details['M2_Total_Floor']);?>" pattern="^\d*(\.\d{1,2}$)?"/>
			<label>M2 Total Floor Area</label>
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
			<input name="year_building" class="small" type="text" value="<?php echo htmlentities($details['Year_Building']);?>" pattern="[0-9]{4}"/>
			<label>Year Building Refurbished</label>
		</div>
		</fieldset>
	</div><!-- end of attributes -->
	<div id="tickboxes">
		<fieldset>
			<div class="tick">
				<label><input name="air_conditioned" type="checkbox" value="Y" <?php if($details['Air_Conditioned']){ echo "checked";}?>>Air Conditioned</label>
			</div>
			<div class="tick">
				<label><input name="close_to_public" type="checkbox" value="Y" <?php if($details['Close_To_Public']){ echo "checked";}?>>Close To Public Transport</label>
			</div>
			<div class="tick">
				<label><input name="water_frontage" type="checkbox" value="Y" <?php if($details['Water_Frontage']){ echo "checked";}?>>Water Frontage</label>
			</div>
			<div class="tick">
				<label><input name="vendor_will_trade" type="checkbox" value="Y" <?php if($details['Vendor_Will_Trade']){ echo "checked";}?>>Vendor Will Trade</label>
			</div>
			<div class="tick">
				<label><input name="scenic_view" type="checkbox" value="Y" <?php if($details['Scenic_View']){ echo "checked";}?>>Scenic View</label>
			</div>
			<div class="tick">
				<label><input name="river_frontage" type="checkbox" value="Y" <?php if($details['River_Frontage']){ echo "checked";}?>>River Frontage</label>
			</div>
			<div class="tick">
				<label><input name="heritage_other" type="checkbox" value="Y" <?php if($details['Heritage_Other']){ echo "checked";}?>>Heritage / Other Classification</label>
			</div>
			<div class="tick">
				<label><input name="coast_frontage" type="checkbox" value="Y" <?php if($details['Coast_Frontage']){ echo "checked";}?>>Coast Frontage</label>
			</div>
			<div class="tick">
				<label><input name="lift_installed" type="checkbox" value="Y" <?php if($details['Lift_Installed']){ echo "checked";}?>>Lift Installed</label>
			</div>
			<div class="tick">
				<label><input name="canal_frontage" type="checkbox" value="Y" <?php if($details['Canal_Frontage']){ echo "checked";}?>>Canal Frontage</label>
			</div>			
			<div class="tick">
				<label><input name="access_security" type="checkbox" value="Y" <?php if($details['Access_Security']){ echo "checked";}?>>Access Security Installed</label>
			</div>
			<div class="tick">
				<label><input name="lake_frontage" type="checkbox" value="Y" <?php if($details['Lake_Frontage']){ echo "checked";}?>>Lake Frontage</label>
			</div>
		</fieldset>
	</div>
