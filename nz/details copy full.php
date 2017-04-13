	<div id="attributes">	
		<fieldset>
		<div class="property_attribute">
			<input name="bedrooms" class="small" type="text" value="<?php echo htmlentities($details['Bedrooms']);?>"/>
			<label>Bedroom</label>
		</div>
		
		<div class="property_attribute">
			<input name="m2_total_floor" class="small" type="text" value="<?php echo htmlentities($details['M2_Total_Floor']);?>"/>
			<label>M2 Total Floor Area</label>
		</div>
		
		<div class="property_attribute">
			<input name="ensuites" class="small" type="text" value="<?php echo htmlentities($details['Ensuites']);?>"/>
			<label>Ensuites</label>
		</div>
		
		<div class="property_attribute">
			<input name="land_area" class="small" type="text" value="<?php echo htmlentities($details['Land_Area']);?>"/>
			<select name="land_area_metric"><?php echo keypairs($land_metric_lkp,$details['Land_Area_Metric'],false,"M2"); ?></select>
			<label>Land Area</label>
		</div>
		
		<div class="property_attribute">
			<input name="toilets" class="small" type="text" value="<?php echo htmlentities($details['Toilets']);?>"/>
			<label>Toilets</label>
		</div>
		
		<div class="property_attribute">
			<input name="dining_rooms" class="small" type="text" value="<?php echo htmlentities($details['Dining_Rooms']);?>"/>
			<label>Dining Rooms</label>
		</div>
		
		<div class="property_attribute">
			<input name="lounge_dining" class="small" type="text" value="<?php echo htmlentities($details['Lounge_Dining']);?>"/>
			<label>Lounge/Dining Combined</label>
		</div>
		
		<div class="property_attribute">
			<input name="other_rooms" class="small" type="text" value="<?php echo htmlentities($details['Other_Rooms']);?>"/>
			<label>Other Rooms</label>
		</div>
		
		<div class="property_attribute">
			<input name="lockup_garages" class="small" type="text" value="<?php echo htmlentities($details['Lockup_Garages']);?>"/>
			<label>Lock-up Garage</label>
		</div>
		
		<div class="property_attribute">
			<input name="year_built" class="small" type="text" value="<?php echo htmlentities($details['Year_Built']);?>"/>
			<label>Year Built</label>
		</div>
		
		<div class="property_attribute">
			<input name="floor_level" class="small" type="text" value="<?php echo htmlentities($details['Floor_Level']);?>"/>
			<label>Floor Level</label>
		</div>
		
		<div class="property_attribute">
			<input name="no_of_floor" class="small" type="text" value="<?php echo htmlentities($details['No_Of_Floor']);?>"/>
			<label>No. Of Floor Level Inside</label>
		</div>
		
		<div class="property_attribute">
			<input name="bathrooms" class="small" type="text" value="<?php echo htmlentities($details['Bathrooms']);?>"/>
			<label>Bathrooms</label>
		</div>
		
		<div class="property_attribute">
			<input name="lounge_rooms" class="small" type="text" value="<?php echo htmlentities($details['Lounge_Rooms']);?>"/>
			<label>Lounge Rooms</label>
		</div>
		
		<div class="property_attribute">
			<input name="no_of_study" class="small" type="text" value="<?php echo htmlentities($details['No_Of_Study']);?>"/>
			<label>No. of Study Rooms</label>
		</div>
		
		<div class="property_attribute">
			<input name="no_of_tennis" class="small" type="text" value="<?php echo htmlentities($details['No_Of_Tennis']);?>"/>
			<label>No. of Tennis Court</label>
		</div>
		
		<div class="property_attribute">
			<input name="family_rumpus" class="small" type="text" value="<?php echo htmlentities($details['Family_Rumpus']);?>"/>
			<label>Family / Rumpus Rumpus</label>
		</div>
		
		<div class="property_attribute">
			<input name="car_spaces" class="small" type="text" value="<?php echo htmlentities($details['Car_Spaces']);?>"/>
			<label>Car Spaces</label>
		</div>
		
		<div class="property_attribute">
			<input name="year_building" class="small" type="text" value="<?php echo htmlentities($details['Year_Building']);?>"/>
			<label>Year Building Refurbished</label>
		</div>
		
		<div class="property_attribute">
			<input name="total_floors" class="small" type="text" value="<?php echo htmlentities($details['Total_Floors']);?>"/>
			<label>Total Floors In Building</label>
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
				<label><input name="water_frontage" type="checkbox" value="Y" <?php if($details['Water_Frontage']){ echo "checked";}?>>Water Frontage</label>
			</div>
			<div class="tick">
				<label><input name="scenic_view" type="checkbox" value="Y" <?php if($details['Scenic_View']){ echo "checked";}?>>Scenic View</label>
			</div>
			<div class="tick">
				<label><input name="air_conditioned" type="checkbox" value="Y" <?php if($details['Air_Conditioned']){ echo "checked";}?>>Air Conditioned</label>
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
				<label><input name="close_to_public" type="checkbox" value="Y" <?php if($details['Close_To_Public']){ echo "checked";}?>>Close To Public Transport</label>
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
				<label><input name="fireplace" type="checkbox" value="Y" <?php if($details['Fireplace']){ echo "checked";}?>>Fireplace</label>
			</div>
			<div class="tick">
				<label><input name="polished_floors" type="checkbox" value="Y" <?php if($details['Polished_Floors']){ echo "checked";}?>>Polished Floors</label>
			</div>
			<div class="tick">
				<label><input name="swimming_pool" type="checkbox" value="Y" <?php if($details['Swimming_Pool']){ echo "checked";}?>>Swimming Pool</label>
			</div>
			<div class="tick">
				<label><input name="renovated" type="checkbox" value="Y" <?php if($details['Renovated']){ echo "checked";}?>>Renovated</label>
			</div>
			<div class="tick">
				<label><input name="double_storey" type="checkbox" value="Y" <?php if($details['Double_Storey']){ echo "checked";}?>>Double Storey</label>
			</div>
			<div class="tick">
				<label><input name="ducted_heating" type="checkbox" value="Y" <?php if($details['Ducted_Heating']){ echo "checked";}?>>Ducted Heating</label>
			</div>
			<div class="tick">
				<label><input name="granny_flat" type="checkbox" value="Y" <?php if($details['Granny_Flat']){ echo "checked";}?>>Granny Flat / Self Contained</label>
			</div>
			<div class="tick">
				<label><input name="selling_off" type="checkbox" value="Y" <?php if($details['Selling_Off']){ echo "checked";}?>>Selling Off The Plan</label>
			</div>
			<div class="tick">
				<label><input name="boat_ramp" type="checkbox" value="Y" <?php if($details['Boat_Ramp']){ echo "checked";}?>>Boat, Ramp / Mooring / Space</label>
			</div>
			<div class="tick">
				<label><input name="ducted_vaccuum" type="checkbox" value="Y" <?php if($details['Ducted_Vaccuum']){ echo "checked";}?>>Ducted Vaccuum</label>
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
</div> 