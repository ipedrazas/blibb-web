<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title><?php echo $title ?></title>
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="/css/font-awesome.css">
		<script>window.jQuery || document.write('<script src="/js/jquery-1.8.0.min.js"><\/script>')</script>

<style type="text/css">
.entryBox{
	width: 300px;
	clear: both;
	margin-top: 30px;
}
.tags{
	margin:0;
	padding:0;
	list-style:none;
	margin-left: 30px;
	}

.tags li, .tags a{
	float:left;
	height:20px;
	line-height:20px;
	position:relative;
	font-size:11px;
	}

.tags a{
	margin-left:20px;
	padding:0 10px 0 12px;
	background:#0089e0;
	color:#fff;
	text-decoration:none;
	-moz-border-radius-bottomright:4px;
	-webkit-border-bottom-right-radius:4px;
	border-bottom-right-radius:4px;
	-moz-border-radius-topright:4px;
	-webkit-border-top-right-radius:4px;
	border-top-right-radius:4px;
	}

.tags a:before{
	content:"";
	float:left;
	position:absolute;
	top:0;
	left:-10px;
	width:0;
	height:0;
	border-color:transparent #0089e0 transparent transparent;
	border-style:solid;
	border-width:10px 10px 10px 0;
	}

.tags a:after{
	content:"";
	position:absolute;
	top:10px;
	left:0;
	float:left;
	width:4px;
	height:4px;
	-moz-border-radius:2px;
	-webkit-border-radius:2px;
	border-radius:2px;
	background:#fff;
	-moz-box-shadow:-1px -1px 2px #004977;
	-webkit-box-shadow:-1px -1px 2px #004977;
	box-shadow:-1px -1px 2px #004977;
	}

.tags a:hover{background:#555;}

.tags a:hover:before{border-color:transparent #555 transparent transparent;}

.commentsbox{
	clear: both;
	margin: auto;
	padding-top: 10px;
	padding-bottom: 10px;


}
.comments{
	display: none;
}
h4{
	clear: both;
}
#imgprofile{
	float: right;
}
.write_comment{
		margin: 15px;
}
</style>

<link rel="stylesheet" href="/css/notes.css">
<link type="text/css" href="/css/blitzer/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script src="/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="/js/libs/jquery.ui.core.js"></script>
<script type="text/javascript" src="/js/libs/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/js/libs/jquery.ui.datepicker.js"></script>
 <script type="text/javascript" src="/js/offline?b=<?php echo $bid ?>" ></script>
	</head>
	<body>
		<?php
			echo $content;
		?>
		 <a href="#" id="submit" class="btn btn-primary">Add Item</a>
		<div id="addBox">
			<?php
				echo $wb;
			?>
		</div>
		<div id="results"></div>

	<footer>
		 <p>Locally stored items: <span id="local-count">0</span></p>
        <p>You are working: <span id="status" class="offline">Offline</span></p>
    </footer>
	</body>

</html>

