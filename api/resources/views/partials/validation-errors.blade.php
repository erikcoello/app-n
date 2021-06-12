@if($errors->any())
<div class="alert alert-danger alert-dismissible" data-auto-dismiss="3000">
	 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	  <h4><i class="icon fa fa-check"></i> Mensaje del sistema</h4>
<ul>
  @foreach($errors->all() as $error)
  <li>{{$error}} </li>
  @endforeach
</ul>
</div>
@endif
