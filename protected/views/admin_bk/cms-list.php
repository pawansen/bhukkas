
<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/cmsList/Do/Add" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/cmsList" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
</div>

<form id="frm_table_list" method="POST" >
<input type="hidden" name="action" id="action" value="cmsList">
<input type="hidden" name="tbl" id="tbl" value="cms">
<input type="hidden" name="clear_tbl"  id="clear_tbl" value="clear_tbl">
<input type="hidden" name="whereid"  id="whereid" value="cms_id">
<input type="hidden" name="slug" id="slug" value="cmsList">
<table id="table_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
  <!--<caption>Merchant List</caption>-->
   <thead>
        <tr>
            <th width="5%"><?php echo Yii::t("default","cms code")?></th>  
            <th width="3%"><?php echo Yii::t("default","cms title")?></th>
                      
            <th width="7%"><?php echo Yii::t("default","cms description")?></th>            
<!--            <th width="5%"><?php echo Yii::t("default","date created")?></th>            -->
        </tr>
    </thead>
    <tbody>    
    </tbody>
</table>
<div class="clear"></div>

</form>
