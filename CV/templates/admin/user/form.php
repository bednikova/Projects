<?php

/* @var $request \Pragmatic\Request */

?>
				<!-- Page Heading -->
                
             
				<?php if (!empty($message)) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Error</strong> <?=$message?>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<?php } ?>

            