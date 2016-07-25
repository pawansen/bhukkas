<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/favouriteList" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
</div>

<form id="frm_table_list" method="POST" >
<input type="hidden" name="action" id="action" value="favouriteList">
<input type="hidden" name="tbl" id="tbl" value="favourite">
<input type="hidden" name="clear_tbl"  id="clear_tbl" value="clear_tbl">
<input type="hidden" name="whereid"  id="whereid" value="fav_id">
<input type="hidden" name="slug" id="slug" value="favouriteList">
<table id="table_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">

   <thead>
        <tr>            
            <th width="5%"><?php echo Yii::t('default',"ID")?></th>
            <th width="4%"><?php echo Yii::t('default',"Name")?></th>            
            <th width="4%"><?php echo Yii::t('default',"Email")?></th>
            <th width="4%"><?php echo Yii::t('default',"City")?></th>
            <th width="4%"><?php echo Yii::t('default',"Create Date")?></th>
        </tr>
    </thead>
    <tbody>    
    </tbody>
</table>
<div class="clear"></div>
</form>