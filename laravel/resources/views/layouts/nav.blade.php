@if (Auth::check())
<div style="width: 80%; height: 50px; background: lightblue; position: fixed; bottom: 0px;">
	This is navigation bar blade file 
	<div style="float:right;">
		<a href="#"> {{ Auth::user()->name }} </a>
	</div>
</div>
@else
<div style="width: 80%; height: 50px; background: lightblue; position: fixed; bottom: 0px;">This is navigation bar blade file</div>
@endif