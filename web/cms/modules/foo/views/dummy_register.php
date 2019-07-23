    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name"><img src="<?php echo base_url();?>/inconis.png"></h1>

            </div>
            <h3>Applikasi Absensi</h3>
            <p>Project Telkom Akses.</p>
            
			
            
            <form class="m-t" role="form" action="login.html">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nomor Induk Karyawan" required="">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nomor Kartu Tanda Penduduk" required="">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="">
                </div>
                
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Sudah Punya Akun ?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="<?php echo base_url();?>/login">Login</a>
            </form>
            <p class="m-t"> <small>Smartelco Apps &copy; 2019</small> </p>
        </div>
    </div>
