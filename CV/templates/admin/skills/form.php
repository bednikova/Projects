<?php

/* @var $request \Pragmatic\Request */

?>
				<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Skills 
							<small>
								<?php if ($request->getCurrentAction() == 'create') { ?> 
								Create Skills 
								<?php } else { ?> 
								Edit Skills
								<?php } ?>
							</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
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

                <div class="row">
					<div class="col-lg-6">
						<form role="form" action="<?= $request->createUrl() ?>" method="POST">

                            <div class="form-group">
                                <label>Language</label>
                                <input required pattern="<?= \App\Model\Skills::VALID_NAME_REGEX ?>" placeholder="Language" name="language" value="<?=$data['language']?>" class="form-control">
                            </div>
							
							<div class="form-group">
                                <label>Description</label>
                                <input placeholder="Level" name="level" value="<?=$data['level']?>" class="form-control">
                            </div>
							
			    <input type="hidden" name='id' value='<?=$data['id']?>'/>
                            <button class="btn btn-default" type="submit">Submit Button</button>
                            <button class="btn btn-default" type="reset">Reset Button</button>

                        </form>
                    </div>
				</div>

