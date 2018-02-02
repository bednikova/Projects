<?php
/* @var $request \Pragmatic\Request */

/* @var $paginator \Pragmatic\DBAL\Paginator */
$paginator = $data['paginator'];

/* @var $users App\Model\User\Customer[] */
$users = $data['users'];
?>
<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Contacts <small> with Mihaela Bednikova</small>
                        </h1>
                       
                    </div>
                </div>
 

                <div class="row">
		<div class="col-lg-12">
                      
                            
			<br/>
                                                                
                                                                
                                <div class="table-responsive">
                                    <div class="jumbotron">
                                        <div align="center">         
                                  <?php foreach ($users as $user) { ?>
                                        <p><a href="#"><img src="img\icons\address.png">    <?=$user->getAddress()?></a></p>
                                        
                                        <p><a href="#"><img src="img\icons\mail.png">    <?=$user->getEmail()?></a></p>
                                        
                                        <p><a href="#"><img src="img\icons\phone.png">     <?=$user->getPhone()?></a></p>
                                   <?php } ?>       
                                         
                                        </div>
                                    </div>
                                </div>
                                
                                </div>
                              
                            </div>
                        </div>
                   