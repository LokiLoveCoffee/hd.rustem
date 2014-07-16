<?php
session_start();
include("../functions.inc.php");
$CONF['title_header']=lang('NEW_title')." - ".$CONF['name_of_firm'];
if (validate_user($_SESSION['helpdesk_user_id'], $_SESSION['code'])) {
if ($_SESSION['helpdesk_user_id']) {
   include("head.inc.php");
   include("navbar.inc.php");
   
  

?>

<div class="container" id="form_add">
<input type="hidden" id="main_last_new_ticket" value="<?=get_last_ticket_new($_SESSION['helpdesk_user_id']);?>">


<div class="row" style="padding-bottom:20px;">

    <div class="col-md-8"> <center><h3><i class="fa fa-tag"></i> <?=lang('NEW_title');?></h3></center></div>


</div>

<div class="row" style="padding-bottom:20px;">



<div class="col-md-1"></div>
<div class="col-md-7" id="div_new">
<?php
if (isset($_GET['ok'])) {
    if (isset($_GET['h'])) {$h=$_GET['h'];}

    ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><i class="fa fa-check"></i> <?=lang('NEW_ok');?></strong> <?=lang('NEW_ok_1');?> <a class="alert-link" href="<?=$CONF['hostname']?>ticket?<?=$h;?>"><?=lang('NEW_ok_2');?></a> <?=lang('NEW_ok_3');?>.
    </div>
<?php

}
?>
<div class="panel panel-success" style="padding:20px;">
<div class="panel-body">

<form class="form-horizontal" id="main_form" novalidate="" action="" method="post">


<div class="control-group">
    <div class="controls">
        <div class="form-group" id="for_fio">

            <label for="fio" class="col-sm-2 control-label" data-toggle="tooltip" data-placement="top" title="<?=lang('NEW_from_desc');?>"><small><?=lang('NEW_from');?>: </small></label>

            <div class="col-sm-10">


                <input  type="text" name="fio" class="form-control input-sm" id="fio" placeholder="<?=lang('NEW_fio');?>" autofocus data-toggle="popover" data-trigger="manual" data-html="true" data-placement="right" data-content="<small><?=lang('NEW_fio_desc');?></small>">



            </div>



        </div></div>

    <hr>
    <div class="form-group" id="for_to" data-toggle="popover" data-html="true" data-trigger="manual" data-placement="right" data-content="<small>Вкажіть відділ призначення або працівника</small>">
        <label for="to" class="col-md-2 control-label" data-toggle="tooltip" data-placement="top" title="<?=lang('NEW_to_desc');?>"><small><?=lang('NEW_to');?>: </small></label>
        <div class="col-md-6">
            <select data-placeholder="<?=lang('NEW_to_unit');?>" class="chosen-select form-control" id="to" name="unit_id">
                <option value="0"></option>
                <?php
                        /*$qstring = "SELECT name as label, id as value FROM deps where id !='0' ;";
                        $result = mysql_query($qstring);//query the database for entries containing the 
                        while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
                        */
                        
        $stmt = $dbConnection->prepare('SELECT name as label, id as value FROM deps where id !=:n');
		$stmt->execute(array(':n'=>'0'));
		$res1 = $stmt->fetchAll();                 
        foreach($res1 as $row) { 
                        
                        
//echo($row['label']);
                            $row['label']=$row['label'];
                            $row['value']=(int)$row['value'];


                            ?>

                            <option value="<?=$row['value']?>"><?=$row['label']?></option>

                        <?php


                        }

                        ?>

            </select>
        </div>




        <div class="col-md-4" style="" id="dsd" data-toggle="popover" data-html="true" data-trigger="manual" data-placement="right" data-content="<small><?=lang('NEW_to_unit_desc');?></small>">

            <select data-placeholder="<?=lang('NEW_to_user');?>" class="chosen-select form-control input-sm" id="users_do" name="unit_id">
                <option value="0"></option>
                <?php
                
                
               /* $qstring = "SELECT fio as label, id as value FROM users where status='1' and login !='system' order by fio ASC;";
                $result = mysql_query($qstring);//query the database for entries containing the term
				while ($row = mysql_fetch_array($result,MYSQL_ASSOC)){
				*/
                
        $stmt = $dbConnection->prepare('SELECT fio as label, id as value FROM users where status=:n and login !=:system order by fio ASC');
		$stmt->execute(array(':n'=>'1',':system'=>'system'));
		$res1 = $stmt->fetchAll();                 
        foreach($res1 as $row) {
                
                
                
                
                
                
                
//echo($row['label']);
                    $row['label']=$row['label'];
                    $row['value']=(int)$row['value'];


                    ?>

                    <option value="<?=$row['value']?>"><?=$row['label']?></option>

                <?php


                }

                ?>

            </select>


        </div>

    </div>




</div>




<div class="control-group" id="for_prio">
    <div class="controls">
        <div class="form-group">
            <label for="" class="col-sm-2 control-label"><small><?=lang('NEW_prio');?>: </small></label>
            <div class="col-sm-10" style=" padding-top: 5px; ">

                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-xs" id="prio_low"><i id="lprio_low" class=""></i><?=lang('NEW_prio_low');?></button>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info btn-xs active" id="prio_normal"><i id="lprio_norm" class="fa fa-check"></i> <?=lang('NEW_prio_norm');?></button>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="<?=lang('NEW_prio_high_desc');?>" id="prio_high"><i id="lprio_high" class=""></i><?=lang('NEW_prio_high');?></button>
                    </div>
                </div>
            </div></div></div></div>
<?php
/*





*/


if ($CONF['fix_subj'] == false) {
?>

<div class="control-group" id="for_subj">
    	<div class="controls">
          <div class="form-group">
    <label for="subj" class="col-sm-2 control-label"><small><?=lang('NEW_subj');?>: </small></label>
    <div class="col-sm-10">
      <input type="text" class="form-control input-sm" name="subj" id="subj" placeholder="<?=lang('NEW_subj');?>" data-toggle="popover" data-html="true" data-trigger="manual" data-placement="right" data-content="<small><?=lang('NEW_subj_msg');?></small>">
    </div>
  </div></div></div>
<?php } 
	else if ($CONF['fix_subj'] == true) {
?>



<div class="control-group" id="for_subj" data-toggle="popover" data-html="true" data-trigger="manual" data-placement="right" data-content="<small><?=lang('NEW_subj_msg');?></small>">
    <div class="controls">
        <div class="form-group">
            <label for="subj" class="col-sm-2 control-label"><small><?=lang('NEW_subj');?>: </small></label>
            <div class="col-sm-10" style="">
                <select data-placeholder="<?=lang('NEW_subj_det');?>" class="chosen-select form-control input-sm" id="subj" name="subj">
                    <option value="0"></option>
                    <?php
                    /*$qstring = "SELECT name FROM subj order by name COLLATE utf8_unicode_ci ASC";
                    $result = mysql_query($qstring);//query the database for entries containing the term
					while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
					*/
					
					
		$stmt = $dbConnection->prepare('SELECT name FROM subj order by name COLLATE utf8_unicode_ci ASC');
		$stmt->execute();
		$res1 = $stmt->fetchAll();                 
        foreach($res1 as $row) {
					
					
                        ?>

                        <option value="<?=$row['name']?>"><?=$row['name']?></option>

                    <?php


                    }

                    ?>

                </select>
            </div>
        </div>

    </div>
</div>


<?php } ?>







<div class="control-group">
    <div class="controls">
        <div class="form-group" id="for_msg">
            <label for="msg" class="col-sm-2 control-label"><small><?=lang('NEW_MSG');?>:</small></label>
            <div class="col-sm-10">
                <textarea data-toggle="popover" data-html="true" data-trigger="manual" data-placement="right" data-content="<small><?=lang('NEW_MSG_msg');?></small>" placeholder="<?=lang('NEW_MSG_ph');?>" class="form-control input-sm animated" name="msg" id="msg" rows="3" required="" data-validation-required-message="Укажите сообщение" aria-invalid="false"></textarea>
            </div>
        </div>
        <div class="help-block"></div></div></div>


<?php if ($CONF['file_uploads'] == true) { ?>
<div class="control-group">
    <div class="controls">
    <div class="form-group">
    
    <label for="" class="col-sm-2 control-label"><small><?=lang('TICKET_file_add');?>:</small></label>

    <div class="col-sm-10">
        <div id="fileuploader"><?=lang('TICKET_file_upload');?></div>
    </div>
    </div>
</div>
</div>
<?php } ?>

<div class="col-md-2"></div>
<div class="col-md-10">
    <div class="btn-group btn-group-justified">
        <div class="btn-group">
            <button id="enter_ticket" class="btn btn-success" type="button"><i class="fa fa-check-circle-o"></i> <?=lang('NEW_button_create');?></button>
        </div>
        <div class="btn-group">
            <a id="reset_ticket" class="btn btn-default" type="submit" href="create"><i class="fa fa-eraser"></i> <?=lang('NEW_button_reset');?></a>
        </div>
    </div>
	<input type="hidden" id="file_array" value="">
    <input type="hidden" id="client_id_param" value="">
    <input type="hidden" id="hashname" value="<?=md5(time());?>">
    <input type="hidden" id="status_action" value="">
    <input type="hidden" id="prio" value="1">
    <input type="hidden" value="<?php echo $_SESSION['helpdesk_user_id']; ?>" id="user_init_id">




</div>


</form>
</div>
</div>
<br>
</div>
<div class="col-md-4">

    <div class="panel panel-success" id="user_info" style="display: block;">






    </div>
    <div id="alert_add">
    </div>



</div>



</div>





</div>

</div>
<?php
 include("footer.inc.php");
?>



<?php
	}
	}
else {
    include 'auth.php';
}
?>