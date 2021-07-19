 <?php if(!empty($proformaNotLinkedList)){ ?>
    <?php foreach ($proformaNotLinkedList as $proformaInv){ ?>
<input type="checkbox" value="<?=$proformaInv->inv_id?>" name="proformaToLink[]" id="<?=$proformaInv->inv_unique_id?>" <?=in_array($proformaInv->inv_id, $proformaLinkedList)?' checked ':''?>/>
  <label for="<?=$proformaInv->inv_unique_id?>"><?=$proformaInv->inv_unique_id?></label> &nbsp; &nbsp;
    <?php }?>
  <?php }else{?>
  <h6>Proforma invoice not available.</h6>
  <?php }?>