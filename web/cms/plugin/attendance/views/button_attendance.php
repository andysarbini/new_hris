<div class="text-center">
<?php if(!@if_empty($att_id)){ ?>
      <input type="hidden" id="att_id" value="<?php echo $att_id; ?>" />
<?php } ?>
    <button style="border-radius: 12px;background-color: #1ab394;color: white;padding: 20px; text-align: center;
  text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;" 
  class="button" id="btnAbsensi" onclick="getLocation()" class="btn btn-info">
        ABSENSI
    </button>
</div>