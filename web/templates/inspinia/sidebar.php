<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="mailbox.html">Mailbox</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url()."logout"?>">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    
					

<?php 
foreach($menus as $var=>$v):
$_fa = array("fa fa-sitemap", "fa fa-sitemap", "fa fa-sitemap", "fa fa-sitemap", "fa fa-sitemap", "fa fa-sitemap");
?>
<?php 
$string = $v['title']; 
$convert_last_url = preg_replace('/[^A-Za-z0-9\-&_]/',' ', $string);
$convert_last_url = str_replace(' ', '-', $convert_last_url); 
$convert_last_url = strtolower($convert_last_url);
?>
            <?php ?>
            <li class="special_link">
            
                
                <?php if(isset($v['childs_1'])): ?>
                <div data-toggle="collapse" data-target="#bs-collapse-<?php echo $convert_last_url;?>" aria-expanded="false" aria-controls="bs-collapse-<?php echo $convert_last_url;?>">
                    <span class="fas fa-caret-down"></span>
                </div>
                <a href="<?php echo gen_url_by_type_nav($v, $v["type_id"]);?>"><!--1st--> <?php echo $v["title"];?></a>
                <?php else: ?>
                <a href="<?php echo gen_url_by_type_nav($v, $v["type_id"]);?>"><!--1st--> <?php echo $v["title"];?></a>
                <?php endif; ?>
                
                <?php if(isset($v["childs_1"]) && count($v["childs_1"]) > 0): ?>
                <?php $temp_parent_id = $v['id']; ?>
                <div id="bs-collapse-<?php echo $convert_last_url;?>" class="collapse" aria-labelledby="bs-collapse-<?php echo $convert_last_url;?>" data-parent="#accordion">   
                    <ul>
                    <?php foreach($v["childs_1"] as $cvar=>$c): ?>
                        <?php if(isset($c["childs_2"]) && count($c["childs_2"]) > 0): ?>
                        <?php $temp_parent_id2 = $c['id']; ?>
                        <?php 
                        $string2 = $c['title'];
                        $convert_last_url2 = preg_replace('/[^A-Za-z0-9\-&_]/','', $string2); 
                        $convert_last_url2 = str_replace('&', '-', $convert_last_url2);
                        $convert_last_url2 = strtolower($convert_last_url2);
                        ?>
                        <li> 
                        <div class="icon-right" data-toggle="collapse" data-target="#bs-collapse-<?php echo $convert_last_url2;?>" aria-expanded="false" aria-controls="bs-collapse-<?php echo $convert_last_url2;?>">
					        <span class="fas fa-caret-down"></span>
				        </div>
				        <a href="<?php echo gen_url_by_type_nav($c, $c["type_id"]);?>"><!--2nd--> <?php echo $c["title"];?></a>    
                        <div id="bs-collapse-<?php echo $convert_last_url2;?>" class="collapse" aria-labelledby="bs-collapse-<?php echo $convert_last_url2;?>" data-parent="#accordion">    
                            <ul>
                            <?php foreach($c["childs_2"] as $cvar2=>$c2): ?>
                                <!-- INI CHILD PALING BONTOT -->
                                <li><a href="<?php echo gen_url_by_type_nav($c2, $c2["type_id"]);?>"><!--3rd--> <?php echo $c2["title"];?></a></li>
                            <?php endforeach;?>
                            </ul>
                        </div>
                        </li>
                        <?php else: ?>
                        <li>
                            <a href="<?php echo gen_url_by_type_nav($c, $c["type_id"]);?>"><!--2nd--> <?php echo $c["title"];?></a>
                        </li>
                        <?php endif; ?>
                    <?php endforeach;?>
                    </ul>
                </div>
                <?php endif; ?>
                
            </li>
            <?php endforeach; ?>
        
		
		
		
                    
                </ul>

            </div>
        </nav>