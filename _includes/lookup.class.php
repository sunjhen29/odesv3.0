<?php
//Version v1.2

//L1.1 State
 $state_lkp = array('NZ'=>'NZ');
 $state_lkp_au = array('ACT'=>'ACT','NSW'=>'NSW','QLD'=>'QLD','SA'=>'SA','TAS'=>'TAS','VIC'=>'VIC','NT'=>'NT','WA'=>'WA');
 $state_lkp_au_inv = array('ACT'=>'ACT','NSW'=>'NSW','QLD'=>'QLD','SA'=>'SA','TAS'=>'TAS','VIC'=>'VIC','NT'=>'NT','WA'=>'WA','NZ'=>'NZ');
 $state_lkp_pubstate_inv = array('ACT'=>'ACT','NSW'=>'NSW','QLD'=>'QLD','VIC'=>'VIC','WA'=>'WA','SA'=>'SA','NT'=>'NT','TAS'=>'TAS');
 $all_state = array('NZ'=>'NZ','ACT'=>'ACT','NSW'=>'NSW','QLD'=>'QLD','SA'=>'SA','TAS'=>'TAS','VIC'=>'VIC','NT'=>'NT','WA'=>'WA');

//L1.2 ation_Name
//this lookup is database driven

//L1.3 Property Type  NEW ZEALAND
 $property_type_lkp = array('CO'=>'COMMERCIAL',
						'FA'=>'FARM / RURAL / HOME AND INCOME',
						'HO'=>'HOUSE / LIFESTYLE DWELLING',
						'UN'=>'UNIT / APARTMENT',
						'UN,10'=>'UNIT - TOWNHOUSE / VILLA',
						'LA'=>'SECTION / LIFESTYLE SECTION',
						'RV'=>'RETIREMENT VILLAGE');
 $commercial_lkp = array('CO'=>'COMMERCIAL');
 $farm_lkp = array('FA'=>'FARM / RURAL / HOME AND INCOME');
 $unit_lkp = array('UN'=>'UNIT / APARTMENT','UN,10'=>'UNIT - TOWNHOUSE / VILLA');
 $house_lkp = array('HO'=>'HOUSE / LIFESTYLE DWELLING');
 $land_lkp = array('LA'=>'SECTION / LIFESTYLE SECTION');
 $retirement_village_lkp = array('RV'=>'RETIREMENT VILLAGE');

 //AUSTRALIAN
 $property_type_inv = array('CO'=>'COMMERCIAL',
							'BU'=>'BUSINESS',
							'FA'=>'FARM /RURAL',
							'FL'=>'FLATS',
							'HO'=>'HOUSE',
							'LA'=>'LAND',
							'UN'=>'UNIT',
							'HO,85'=>'DUPLEX',
							'HO,90'=>'TERRACE');
 $property_type_lkp_au = array(	'HO'=>'HOUSE',
								'HO,10'=>'HOUSE - ONE STOREY / LOWSET',
								'HO,20'=>'HOUSE - TWO STOREY / HIGHSET',
								'HO,50'=>'HOUSE - MULTI STOREY',
								'HO,60'=>'HOUSE - ACREAGE',
								'HO,70'=>'HOUSE - DUAL OCCUPANCY',
								'HO,80'=>'HOUSE - SEMI DETACHED',
								'HO,85'=>'HOUSE - DUPLEX',
								'HO,90'=>'HOUSE - TERRACE',
								'UN'=>'UNIT',
								'UN,10'=>'UNIT - TOWNHOUSE / VILLA',
								'UN,20'=>'UNIT - LOWRISE',
								'UN,30'=>'UNIT - HIGHRISE',
								'UN,40'=>'UNIT - PENTHOUSE',
								'UN,50'=>'UNIT - TRIPLEX',
								'UN,60'=>'UNIT - QUADRAPLEX',
								'UN,70'=>'UNIT - STUDIO',
								'CO'=>'COMMERCIAL',
								'CO,30'=>'COMMERCIAL - RETAIL BUILDING',
								'CO,50'=>'COMMERCIAL - OFFICE BUILDING',
								'CO,70'=>'COMMERCIAL - INDUSTRIAL BUILDING',
								'LA'=>'LAND',
								'LA,10'=>'LAND - RESIDENTIAL HOUSE',
								'LA,20'=>'LAND - RESIDENTIAL ACREAGE',
								'LA,30'=>'LAND - RURAL ACREAGE',
								'LA,50'=>'LAND - RESIDENTIAL DEVELOPMENT',
								'LA,60'=>'LAND - OFFICE / RETAIL',
								'LA,65'=>'LAND - INDUSTRIAL',
								'LA,70'=>'LAND - PARKS / RESERVES',
								'LA,85'=>'LAND - GOVERNMENT',
								'FA'=>'FARM / RURAL');
$commercial_lkp_au = array(		'CO'=>'COMMERCIAL',
								'CO,30'=>'COMMERCIAL - RETAIL BUILDING',
								'CO,50'=>'COMMERCIAL - OFFICE BUILDING',
								'CO,70'=>'COMMERCIAL - INDUSTRIAL BUILDING');		
$house_lkp_au = array(			'HO'=>'HOUSE',
								'HO,10'=>'HOUSE - ONE STOREY / LOWSET',
								'HO,20'=>'HOUSE - TWO STOREY / HIGHSET',
								'HO,50'=>'HOUSE - MULTI STOREY',
								'HO,60'=>'HOUSE - ACREAGE',
								'HO,70'=>'HOUSE - DUAL OCCUPANCY',
								'HO,80'=>'HOUSE - SEMI DETACHED',
								'HO,85'=>'HOUSE - DUPLEX',
								'HO,90'=>'HOUSE - TERRACE');		
$unit_lkp_au = array(			'UN'=>'UNIT',
								'UN,10'=>'UNIT - TOWNHOUSE / VILLA',
								'UN,20'=>'UNIT - LOWRISE',
								'UN,30'=>'UNIT - HIGHRISE',
								'UN,40'=>'UNIT - PENTHOUSE',
								'UN,50'=>'UNIT - TRIPLEX',
								'UN,60'=>'UNIT - QUADRAPLEX',
								'UN,70'=>'UNIT - STUDIO');	
$land_lkp_au = array(			'LA'=>'LAND',
								'LA,10'=>'LAND - RESIDENTIAL HOUSE',
								'LA,20'=>'LAND - RESIDENTIAL ACREAGE',
								'LA,30'=>'LAND - RURAL ACREAGE',
								'LA,50'=>'LAND - RESIDENTIAL DEVELOPMENT',
								'LA,60'=>'LAND - LAND - OFFICE / RETAIL',
								'LA,65'=>'LAND - INDUSTRIAL',
								'LA,70'=>'LAND - PARKS / RESERVES',
								'LA,85'=>'LAND - GOVERNMENT');		
$farm_lkp_au = array('FA'=>'FARM / RURAL');								
 
 
 //L1.4 Listing Type
 $listing_type_lkp = array('A'=>'AUCTION',
						'E'=>'ENQUIRIES OVER',
						'M'=>'MORTGAGEE SALE',
						'MA'=>'MORTGAGEE AUCTION',
						'N'=>'NEGOTIATION',
						'P'=>'PRICE ON APPLICATION',
						'S'=>'NORMAL SALE',
						'T'=>'TENDER',
						'O'=>'OTHER');
						
 $listing_type_lkp_au = array('A'=>'AUCTION',
						'M'=>'MORTGAGEE SALE',
						'MA'=>'MORTGAGEE AUCTION',
						'S'=>'NORMAL SALE',
						'T'=>'TENDER',
						'O'=>'OTHER');								

//L1.5 Construction Type
 $construction_type_lkp = array('BRICK'=>'BRICK',
						'TIMBER'=>'TIMBER',
						'RENDERED'=>'RENDERED',
						'STONE'=>'STONE');

//L1.6 Materials in Roof
 $roof_materials_lkp = array('TILED'=>'TILED',
						'GALVANIZED IRON'=>'GALVANIZED IRON',
						'COLOUR BOND'=>'COLOUR BOND');
			
//L1.7 Type of Scenic View
 $scenic_type_lkp = array('CITY'=>'CITY',
						'LAKE'=>'LAKE',
						'MOUNTAIN'=>'MOUNTAIN',
						'OCEAN'=>'OCEAN',
						'RIVER'=>'RIVER',
						'SCENIC'=>'SCENIC');
						
//L1.8 Adsize
 $ad_size_lkp = array(	'CLASSIFIEDS'=>'CLASSIFIEDS',
						'SMALL'=>'SMALL',
						'1/8 PAGE'=>'1/8 PAGE',
						'1/4 PAGE'=>'1/4 PAGE',
						'1/3 PAGE'=>'1/3 PAGE',
						'1/2 PAGE'=>'1/2 PAGE',
						'3/4 PAGE'=>'3/4 PAGE',
						'FULL PAGE'=>'FULL PAGE',
						'DOUBLE PAGE'=>'DOUBLE PAGE');
						
//L1.9 Ad Photo Type
 $photo_type_lkp = array('COLOUR'=>'COLOUR',
						'B & W'=>'B & W',
						'NO PHOTO'=>'NO PHOTO');

//L1.10 Ad Photo Count
 $photo_count_lkp = array('SINGLE'=>'SINGLE',
						'MULTIPLE'=>'MULTIPLE',
						'NOT APPLICABLE'=>'NOT APPLICABLE');						
						
//L1.11 Ad SECTION
 $section_lkp = array('FRONT'=>'FRONT',
						'MIDDLE'=>'MIDDLE',
						'BACK'=>'BACK',
						'CLASSIFIEDS'=>'CLASSIFIEDS');
						
//L1.12 Ad Exclusive Agent
 $exclusive_agent_lkp = array('YES'=>'YES',
						'NO'=>'NO',
						'UNKNOWN'=>'UNKNOWN');
						
//L1.13 Rental Period
 $rental_period_lkp = array('W'=>'WEEKLY',
						'F'=>'FORNIGHTLY',
						'M'=>'MONTHLY',
						'A'=>'ANNUALLY');

//L1.14 Land Area Metric
 $land_metric_lkp = array('M2'=>'M2',
						'ACRES'=>'ACRES',
						'HECTARES'=>'HECTARES',
						'PERCHES'=>'PERCHES');

//Street Direction
$street_direction_lkp = array('NORTH'=>'NORTH',
							'EAST'=>'EAST',
							'WEST'=>'WEST',
							'SOUTH'=>'SOUTH');		

//Sale RENT
$salerent_lkp = array('SALE'=>'SALE','RENT'=>'RENT');							
			
//added lookups
 $street_extension_lkp = array ('STREET'=>'STREET',
							'ROAD'=>'ROAD',
							'AVENUE'=>'AVENUE',
							'CHASE'=>'CHASE',
							'CIRCUIT'=>'CIRCUIT',
							'CLOSE'=>'CLOSE',
							'COURT'=>'COURT',
							'CRESCENT'=>'CRESCENT',
							'DRIVE'=>'DRIVE',
							'ESPLANADE'=>'ESPLANADE',
							'GROVE'=>'GROVE',
							'LANE'=>'LANE',
							'PLACE'=>'PLACE',
							'RISE'=>'RISE',
							'TERRACE'=>'TERRACE',
							'VISTA'=>'VISTA',
							'WAY'=>'WAY',
							'ALLEY'=>'ALLEY',
							'APPROACH'=>'APPROACH',
							'ARCADE'=>'ARCADE',
							'BEND'=>'BEND',
							'BOULEVARD'=>'BOULEVARD',
							'BOULEVARDE'=>'BOULEVARDE',
							'BOWL'=>'BOWL',
							'BRACE'=>'BRACE',
							'BRAE'=>'BRAE',
							'BREAK'=>'BREAK',
							'BROADWAY'=>'BROADWAY',
							'BROOK'=>'BROOK',
							'BROW'=>'BROW',
							'BYPASS'=>'BYPASS',
							'CIRCLE'=>'CIRCLE',
							'CIRCUS'=>'CIRCUS',
							'COMMON'=>'COMMON',
							'CONCOURSE'=>'CONCOURSE',
							'COPSE'=>'COPSE',
							'CORNER'=>'CORNER',
							'CORSO'=>'CORSO',
							'COURSE'=>'COURSE',
							'COURTYARD'=>'COURTYARD',
							'COVE'=>'COVE',
							'CREST'=>'CREST',
							'CROSS'=>'CROSS',
							'CROSSING'=>'CROSSING',
							'CURVE'=>'CURVE',
							'DALE'=>'DALE',
							'DIP'=>'DIP',
							'DOWN'=>'DOWN',
							'DOWNS'=>'DOWNS',
							'DRIVEWAY'=>'DRIVEWAY',
							'EDGE'=>'EDGE',
							'ELBOW'=>'ELBOW',
							'END'=>'END',
							'ENTRANCE'=>'ENTRANCE',
							'EXPRESS'=>'EXPRESSWAY',
							'EXTENSION'=>'EXTENSION',
							'FAIRWAY'=>'FAIRWAY',
							'FOLLOW'=>'FOLLOW',
							'FORMATION'=>'FORMATION',
							'FREEWAY'=>'FREEWAY',
							'FRONTAGE'=>'FRONTAGE',
							'GAP'=>'GAP',
							'GARDEN'=>'GARDEN',
							'GARDENS'=>'GARDENS',
							'GATE'=>'GATE',
							'GATES'=>'GATES',
							'GATEWAY'=>'GATEWAY',
							'GLADE'=>'GLADE',
							'GLEN'=>'GLEN',
							'GRANGE'=>'GRANGE',
							'GREEN'=>'GREEN',
							'GROVET'=>'GROVET',
							'HAVEN'=>'HAVEN',
							'HEATH'=>'HEATH',
							'HEIGHTS'=>'HEIGHTS',
							'HIGHWAY'=>'HIGHWAY',
							'HILL'=>'HILL',
							'INTERCHANGE'=>'INTERCHANGE',
							'ISLAND'=>'ISLAND',
							'JUNCTON'=>'JUNCTION',
							'KEY'=>'KEY',
							'LINK'=>'LINK',
							'LOOKOUT'=>'LOOKOUT',
							'LOOP'=>'LOOP',
							'LOWER'=>'LOWER',
							'MALL'=>'MALL',
							'MEAD'=>'MEAD',
							'MEANDER'=>'MEANDER',
							'MEWS'=>'MEWS',
							'MOTORWAY'=>'MOTORWAY',
							'NOOK'=>'NOOK',
							'OUTLOOK'=>'OUTLOOK',
							'PARADE'=>'PARADE',
							'PARK'=>'PARK',
							'PARKWAY'=>'PARKWAY',
							'PASS'=>'PASS',
							'PATH'=>'PATH',
							'PATHWAY'=>'PATHWAY',
							'PIER'=>'PIER',
							'PLAZA'=>'PLAZA',
							'POCKET'=>'POCKET',
							'POINT'=>'POINT',
							'PORT'=>'PORT',
							'PROMENADE'=>'PROMENADE',
							'QUADRANT'=>'QUADRANT',
							'QUAY'=>'QUAY',
							'QUAYS'=>'QUAYS',
							'RAMBLE'=>'RAMBLE',
							'REACH'=>'REACH',
							'RESERVE'=>'RESERVE',
							'REST'=>'REST',
							'RETREAT'=>'RETREAT',
							'RETUR'=>'RETURN',
							'RIDGE'=>'RIDGE',
							'ROADWAY'=>'ROADWAY',
							'ROTARY'=>'ROTARY',
							'ROUND'=>'ROUND',
							'ROUTE'=>'ROUTE',
							'ROW'=>'ROW',
							'SERVICEWAY'=>'SERVICEWAY',
							'SIDING'=>'SIDING',
							'SLOPE'=>'SLOPE',
							'SPUR'=>'SPUR',
							'SQUARE'=>'SQUARE',
							'STEPS'=>'STEPS',
							'STRAND'=>'STRAND',
							'SUBWAY'=>'SUBWAY',
							'TARN'=>'TARN',
							'THROUGHWAY'=>'THROUGHWAY',
							'TOLLWAY'=>'TOLLWAY',
							'TOP'=>'TOP',
							'TOR'=>'TOR',
							'TRACK'=>'TRACK',
							'TRAIL'=>'TRAIL',
							'TURN'=>'TURN',
							'UNDERPASS'=>'UNDERPASS',
							'VALE'=>'VALE',
							'VALLEY'=>'VALLEY',
							'VIEW'=>'VIEW',
							'WALK'=>'WALK',
							'WALKWAY'=>'WALKWAY',
							'WYND'=>'WYND',
							'YARD'=>'YARD');
							
$upload_error = array(
					UPLOAD_ERR_OK 			=> "No errors.",
					UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
					UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
					UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
					UPLOAD_ERR_NO_FILE 		=> "No file.",
					UPLOAD_ERR_NO_TMP_DIR 	=> "No temporary directory.",
					UPLOAD_ERR_CANT_WRITE 	=> "Can't write to disk.",
					UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
					);
				
?>