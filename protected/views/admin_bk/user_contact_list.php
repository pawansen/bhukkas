
<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/contactlist" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>

<!--<a href="javascript:;" rel="rptPartnerList" class="export_btn uk-button"><?php //echo t("Export")?></a>-->

</div>

<div class="spacer"></div>

<form id="frm_table_list" method="POST" >
<input type="hidden" name="action" id="action" value="userContactList">
<input type="hidden" name="tbl" id="tbl" value="contact_us">
<input type="hidden" name="clear_tbl"  id="clear_tbl" value="clear_tbl">
<input type="hidden" name="whereid"  id="whereid" value="contact_id">
<input type="hidden" name="slug" id="slug" value="contactlist">
<table id="table_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">  
   <thead>
        <tr>
            <th width="2%"><?php echo Yii::t("default","ID")?></th>
            <th width="4%"><?php echo Yii::t("default","Name")?></th> 
            <th width="4%"><?php echo Yii::t("default","Email address")?></th> 
            <th width="4%"><?php echo Yii::t("default","Contact No.")?></th> 
            <th width="4%"><?php echo Yii::t("default","Country")?></th>   
            <th width="4%"><?php echo Yii::t("default","Message")?></th> 
            <th width="4%"><?php echo Yii::t("default","Date Created")?></th>
        </tr>
    </thead>
    <tbody>    
    </tbody>
</table>
<div class="clear"></div>
</form>