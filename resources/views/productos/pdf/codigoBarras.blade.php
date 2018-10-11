
	<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Tiket</title>
			<link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
	</head>
	<body>
		
	@for($i = 1; $i <= $cantidad; $i++)
	<div style="width: 33%; float: left;">
			{!!DNS1D::getBarcodeHTML($producto->sku, "C128",1,20)!!}
			 {{$producto->sku}}
		</div> 
		@if($i%3 == 0)
			 <br/><br/> <br/><br/>  <br/><br/>
		@endif
	@endfor
	</div>
	</body>
	</html>

