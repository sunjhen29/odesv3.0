	<div id="attributes">	
		<fieldset>
		<div class="property_attribute">
			<input name="land_area" class="small" type="text" value="<?php echo htmlentities($details['Land_Area']);?>" pattern="^\d*(\.\d{1,4}$)?"/>
			<select name="land_area_metric"><?php echo keypairs($land_metric_lkp,$details['Land_Area_Metric'],false,"M2"); ?></select>
			<label>Land Area</label>
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
				<label><input name="water_frontage" type="checkbox" value="Y" <?php if($details['Water_Frontage']){ echo "checked";}?>>Water Frontage</label>
			</div>
			<div class="tick">
				<label><input name="scenic_view" type="checkbox" value="Y" <?php if($details['Scenic_View']){ echo "checked";}?>>Scenic View</label>
			</div>
			<div class="tick">
				<label><input name="close_to_public" type="checkbox" value="Y" <?php if($details['Close_To_Public']){ echo "checked";}?>>Close To Public Transport</label>
			</div>
			<div class="tick">
				<label><input name="vendor_will_trade" type="checkbox" value="Y" <?php if($details['Vendor_Will_Trade']){ echo "checked";}?>>Vendor Will Trade</label>
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
				<label><input name="town_water" type="checkbox" value="Y" <?php if($details['Town_Water']){ echo "checked";}?>>Town Water Available</label>
			</div>
			<div class="tick">
				<label><input name="town_sewerage" type="checkbox" value="Y" <?php if($details['Town_Sewerage']){ echo "checked";}?>>Town Sewerage Available</label>
			</div>
			<div class="tick">
				<label><input name="curb_chanelling" type="checkbox" value="Y" <?php if($details['Curb_Chanelling']){ echo "checked";}?>>Curb Channeling On Frontage</label>
			</div>
			<div class="tick">
				<label><input name="all_weather_access" type="checkbox" value="Y" <?php if($details['All_Weather_Access']){ echo "checked";}?>>All Weather Access To Land</label>
			</div>
			<div class="tick">
				<label><input name="land_subject" type="checkbox" value="Y" <?php if($details['Land_Subject']){ echo "checked";}?>>Land Subject To Flooding</label>
			</div>
			<div class="tick">
				<label><input name="phone_service" type="checkbox" value="Y" <?php if($details['Phone_Service']){ echo "checked";}?>>Phone Service Available</label>
			</div>
			<div class="tick">
				<label><input name="land_can_be" type="checkbox" value="Y" <?php if($details['Land_Can_Be']){ echo "checked";}?>>Land Can Be Subdivided</label>
			</div>
			<div class="tick">
				<label><input name="trees_on_land" type="checkbox" value="Y" <?php if($details['Trees_On_Land']){ echo "checked";}?>>Trees On Land</label>
			</div>
		</fieldset>
	</div>
