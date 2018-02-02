<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CV Mihaela Bednikova</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=$request->createAbsoluteUrl('css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=$request->createAbsoluteUrl('css/sb-admin.css')?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?=$request->createAbsoluteUrl('css/plugins/morris.css')?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=$request->createAbsoluteUrl('font-awesome-4.1.0/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
					<?php if (!empty($error)) { ?>
					<div class="alert alert-danger">
						<button type="button" class="close" aria-hidden="true">&times;</button>
						<i class="fa fa-info-circle"></i>  <?=$error?>
					</div>
					<?php } ?>
                    <div class="panel-body">
                        <form role="form" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
								<?php if (!empty($message)) { ?>
                                <div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<i class="fa fa-info-circle"></i> <?=$message?>
								</div>
								<?php } ?>
                                <!-- Change this to a button or input when using this as a form -->
                                <input class="btn btn-lg btn-success" type="submit" value='Login'/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="<?=$request->createAbsoluteUrl('js/jquery-1.11.0.js')?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?=$request->createAbsoluteUrl('js/plugins/morris/raphael.min.js')?>"></script>
    <script src="<?=$request->createAbsoluteUrl('js/plugins/morris/morris.min.js')?>"></script>
    <script src="<?=$request->createAbsoluteUrl('js/plugins/morris/morris-data.js')?>"></script>

</body>

</html>
