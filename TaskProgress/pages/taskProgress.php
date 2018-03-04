<?php
header('Content-type: application/javascript');
require_api( 'bug_api.php' );
//---------------------SETTINGS---------------------------- 
$CHILD_TYPE = 2;
$MIN_RESOLVEDSTATUS = 80;
//---------------------------------------------------------

$progress = 0;
$showProgress = false;
if( isset ($_GET["taskid"])){
	$taskID = intval( $_GET["taskid"]);
	$multiProjectRelation = false;
	$allRelatedTasks = relationship_get_all( $taskID, $multiProjectRelation );
	$childs = 0;
	$doneChilds = 0;
	foreach ($allRelatedTasks as $index => $relationship) 
	{
		if( $relationship->src_bug_id == $taskID && $relationship->type == $CHILD_TYPE)
		{
			$showProgress = true;
			$childs++;
			$targetBug = $relationship->dest_bug_id;
			if( bug_exists( $targetBug ) 
				&&
                access_has_bug_level( config_get( 'view_bug_threshold', null, null, $relationship->dest_project_id ), $targetBug ) )			
			{
				$bugStatus = bug_get_field( $targetBug, 'status' );
				if($bugStatus >= $MIN_RESOLVEDSTATUS)
					$doneChilds++;
			}
		}
	}
	//Get number of resolved childs
	if($childs > 0)
		$progress = round(($doneChilds / $childs)*100);
}
?>

$( document ).ready(function() {
   if(<?php echo $showProgress ? "true" : "false"; ?>)   
	$('#relationships .table-responsive').before(generateProgressBar());
});

function generateProgressBar(){
	var html ='<div class="col-md-12 col-xs-12" style="margin-top:15px;">';
	html+='<div class="progress progress-striped" data-percent="<?php echo $progress ?>%"><div style="width:<?php echo $progress ?>%;" class="progress-bar progress-bar-success"></div></div>'; 
	html +="</div>";
	html +='<div class="clearfix"></div>';
	return html;
}