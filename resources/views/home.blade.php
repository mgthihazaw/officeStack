@extends('app_layouts.app')

@section('title','Microstack')
@section('styles')
	<link rel="stylesheet" href="{{asset('css/app.css') }}">
	<style>
		@font-face {
			font-family: "Zawgyi";
			src: url("{{ asset('fonts/Zawgyi-One.ttf') }}");
		}
		@font-face{
			font-family : "myUbuntu";
			src : url(" {{ asset('fonts/Ubuntu.ttf') }}");
		}
	</style>    
@endsection

@section('content')

	<div class="row">
		<div class="col-12">
			<router-view></router-view>
		</div>
	</div>

@endsection

@section('scripts')
	<script src="{{ asset('js/app.js') }}"></script>

	<script>
		
	</script>
@endsection