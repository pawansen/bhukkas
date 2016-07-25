
<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/partnerlist" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>

<!--<a href="javascript:;" rel="rptPartnerList" class="export_btn uk-button"><?php //echo t("Export")?></a>-->

</div>

<div class="spacer"></div>

<form id="frm_table_list" method="POST" >
<input type="hidden" name="action" id="action" value="merchantContactList">
<input type="hidden" name="tbl" id="tbl" value="partner">
<input type="hidden" name="clear_tbl"  id="clear_tbl" value="clear_tbl">
<input type="hidden" name="whereid"  id="whereid" value="pid">
<input type="hidden" name="slug" id="slug" value="partnerlist">
<table id="table_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">  
   <thead>
        <tr>
            <th width="2%"><?php echo Yii::t("default","ID")?></th>
            <th width="4%"><?php echo Yii::t("default","Name")?></th> 
            <th width="4%"><?php echo Yii::t("default","Email address")?></th> 
            <th width="4%"><?php echo Yii::t("default","Contact No.")?></th> 
            <th width="4%"><?php echo Yii::t("default","Restaurant Name")?></th>   
            <th width="4%"><?php echo Yii::t("default","Address")?></th>  
            <th width="3%"><?php echo Yii::t("default","City")?></th>
            <th width="4%"><?php echo Yii::t("default","Comment")?></th>   
            <th width="4%"><?php echo Yii::t("default","Date Created")?></th>
        </tr>
    </thead>
    <tbody>    
    </tbody>
</table>
<div class="clear"></div>
</form>