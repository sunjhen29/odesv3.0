<?php 
	require_once("../_includes/initialize.php");
	//if(!$session->is_logged_in()){
		//redirect_to("../logout.php"); //if not redirect to login page
	//} else {
		//if(!$session->state || !$session->publication_name || !$session->publication_date || !$session->job_number || !$session->batch_id){
		//redirect_to("default.php"); //if not redirect to login page
		//}
	//}
	//$session->log_action("ENTRY");
	//$session->log_start();
?>
<?php layout_template('header.php'); ?>
<!-- script and css style goes here -->
<script>
$(document).ready(function() {
	$("#suburb").change(function(){
		$.getJSON("getSuburb.php",{suburb: $(this).val(), ajax: 'true'}, function(j){
		console.log(j);
		var results = '';
				results = '<table id="search_results"  class="TFtable" >';
				results += '<tr><th>State</th>';
				results += '<th>Suburb</th>';
				results += '<th>Post Code</th></tr>';
					for (var i = 0; i < j.length; i++) {
						results += '<tr>'
							results += '<td>' + j[i].State + '</td>';
							results += '<td>' + j[i].Suburb + '</td>';
							results += '<td>' + j[i].Post_Code + '</td>';
						results += '</tr>'
					}
				results += '</table>';
			$("#results").html(results);
		});
	});
	
});
</script>
<style>
    .suburb{
		width:350px;
		height:35px;
		font-family: Tahoma, Geneva sans-serif;
		font-size:14px;
		border: 1px solid blue;
		text-transform:none;
		font-weight: normal;
		padding: 10px;
		
	
	}
	.suburb:focus{
		background: white;
		border-shadow: green;
	}
	 .content{
		 width:35px;
		 margin:0 auto;
	 }
    table {
		
         width: 35%;
         border-collapse:collapse;
	}
	.TFtable  tr:nth-child(odd) {
		background: #b8d1f3;
		text-align: center;
	}
	.TFtable  tr:nth-child(even){
		background:#dae5f4;
		text-align: center;
	}
	td{
		padding:7px; border:#4e95f4 1px solid;
		
	}
	table tr:hover
    {
        background-color:blue;
    }
	th {
		   
        height: 25px;
	    text-align:center;
		border: 10px ;
     }
	 #results{
		margin-top: 20px;
		text-align: center;
		border-style: solid;
		border-color: #0000ff;
		
	
		}
	 }
	div {
    border-width:5px;	
    border-style:inset;
    }
</style>
</head>
<body>
<div id="wrap">
<div id="header" style="height: 20px;">
		<span class="entryheader">Search Suburb</span>
		<tr onMouseover="this.bgColor='#EEEEEE'"onMouseout="this.bgColor='#FFFFFF'"></tr>
		
</div><!-- end of header -->



<div id="content">
	<div id="search">
		<input class="suburb" name="suburb" id="suburb" type="text" value="" pattern="[aA-zZ'0-9- ]{1,50}" required placeholder="Enter Suburb" />
	</div>
	<div id="results">
	</div>
</div> <!-- end of content -->
<?php layout_template('footer.php'); ?>