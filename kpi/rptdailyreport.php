<?php
///admin page
require_once("../_includes/initialize.php");
if(isset($_GET['day']) && isset($_GET['ev'])){
    $job_numbers = KPI::per_job_number($_GET['day'],$_GET['ev']);
} else {
    $job_numbers = KPI::per_job_number(0 ,"E");
}
?>
<?php layout_template('header.php'); ?>
<!-- script and css style goes here -->
<style>
    label{
        width: 125px;
        display: inline-block;
    }
    .left{
        text-align: left;
    }
    .right{
        text-align: right;
    }
    .center{
        text-align: center;
    }
</style>
</head>
<body>
<div id="wrap">
    <div id="header">
        <h1>CCC Data Management Services Inc.</h1>
        <span class="login"><?php echo date('F j, Y')." "; ?></span><br><br>
		<span class="login">Welcome, <?php echo $session->name." [".$session->operator_id."]"; ?>
            <a href="../logout.php">Logout</a></span><br>
    </div><!-- end of header -->
    <div id="content">
        <span><a href="default.php" />Reports</a>/<a href="rptrecsperhour.php">Records per Hour</a></span>
        <h2>Records Per Hour Report</h2>
        <br>
        <form method="get" action="rptjobnumber.php">
            <fieldset>
                <label>Julian Date</label>
                <input type="text" name="day" value="<?php echo isset($_GET['day']) ? $_GET['day'] : ""; ?>" /><br>
                <label>E/V</label>
                <input type="text" name="ev" value="<?php echo isset($_GET['ev']) ? $_GET['ev'] : ""; ?>" /><br>
                <input type="submit" value="Submit" />
            </fieldset>
        </form>
        <br>
        <table>
            <tr>
                <th>Job Number</th>
                <th>Total Records</th>
                <th>Total Hours</th>
                <th>Records Per Hour</th>
            </tr>
            <?php foreach($job_numbers as $job_number){ ?>
                <tr>
                    <td class="left"><?php echo htmlentities($job_number['job_number']);?></td>
                    <td class="right"><?php echo htmlentities($job_number['records']);?></td>
                    <td class="right"><?php echo htmlentities($job_number['hours']);?></td>
                    <td class="right"><?php echo htmlentities($job_number['recs_hour']);?></td>
                </tr>
            <?php } ?>
        </table>

    </div>
    <?php layout_template('footer.php'); ?>
