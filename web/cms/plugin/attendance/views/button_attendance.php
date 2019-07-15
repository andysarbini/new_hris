<input type="hidden" id="att_id" value="<?php echo @if_empty($att_id, 0); ?>" />
<div class="col-md-6 ibox float-e-margins">
    <div class="ibox-title">
        <h5>Absensi <small><?php echo @if_empty($att_id) ? 'kepulangan':'kehadiran';?> karyawan</small></h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div  role="form" class="col-sm-12 b-r">
                <div class="form-group">
                    <label>Office</label> 
                    <select class="form-control" id="office_id"><?php echo gen_option_html($offices);?></select>
                </div>
                <div>
                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs"  id="btnAbsensi" onclick="getLocation()"><strong><?php echo @if_empty($att_id) ? 'PULANG':'HADIR';?></strong></button>
                </div>
            </div>
        </div>
    </div>
</div>
