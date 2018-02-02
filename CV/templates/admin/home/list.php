<?php
/* @var $request \Pragmatic\Request */

/* @var $paginator \Pragmatic\DBAL\Paginator */
$paginator = $data['paginator'];

/* @var $home \App\Model\[] */
$home = $data['home'];
?>
<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Home <small>Mihaela Bednikova</small>
                        </h1>
                        
                    </div>
                </div>
             
				
		

            
                              <br/>
                                <div class="table-responsive">
                                    <div class="jumbotron">
                                         <img src="img\my.jpg" width="196" height="260" align="left"  hspace="80">
                                         
                                         <?php foreach ($home as $homes) { ?>
                                         <p><?=$homes->getFirstName()?>  <?=$homes->getLastName() ?></p>
                                         <p>Date of birth: <?=$homes->getDateOfBirth() ?></p>
                                         <p>Country: <?=$homes->getAddress() ?></p>
                                         <p>Phone: <?=$homes->getPhone() ?></p>
                                         <p>Email: <?=$homes->getEmail() ?></p>
                                         <?php } ?>
                                    </div>
                                </div>				
                            
                        
        

