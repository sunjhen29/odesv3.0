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
			<input name="dining_rooms" class="small" type="text" value="<?php echo htmlentities($details['Dining_Rooms']);?>" pattern="[1-9]{1}"/>
			<label>Dining Rooms</label>
		</div>
		<div class="property_attribute">
			<input name="land_area" class="small" type="text" value="<?php echo htmlentities($details['Land_Area']);?>" pattern="^\d*(\.\d{1,4}$)?"/>
			<select name="land_area_metric"><?php echo keypairs($land_metric_lkp,$details['Land_Area_Metric'],false,"M2"); ?></select>
			<label>Land Area</label>
		</div>
		<div class="property_attribute">
			<input name="year_built" class="small" type="text" value="<?php echo htmlentities($details['Year_Built']);?>" pattern="[0-9]{4}"/>
			<label>Year Built</label>
		</div>
		<div class="property_attribute">
			<input name="other_rooms" class="small" type="text" value="<?php echo htmlentities($details['Other_Rooms']);?>" pattern="[0-9]{1,2}"/>
			<label>Other Rooms</label>
		</div>	
		</fieldset>
	</div><!-- end of attributes -->
	<div id="tickboxes">
		<fieldset>
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
				<label><input name="all_weather_access" type="checkbox" value="Y" <?php if($details['All_Weather_Access']){ echo "checked";}?>>All Weather Access To Land</label>
			</div>
		</fieldset>
	</div>
