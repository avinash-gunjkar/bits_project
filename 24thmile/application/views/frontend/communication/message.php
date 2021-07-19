 <div class="messageinner" data-messageId = "<?=$message->id?>" >
    
<div style=" text-align:<?=$from_user_id==$message->from_user_id?'right':'left'?>;">
    <strong><?php echo $message->from_name?> &nbsp;</strong>
    <small>(<?php echo printFormatedDateTime($message->created_at)?>)</small>:
    
</div>
<div class="<?=$from_user_id==$message->from_user_id?'from-user':'to-user'?>" ><?=$message->message?> 
     </div>
</div>
