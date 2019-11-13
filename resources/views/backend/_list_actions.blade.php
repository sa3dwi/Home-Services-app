@if(!empty($active))
	<a href="{{route($active, $pk)}}" class="btn
    @if($row->is_active ==1)
			btn-success
			@else
			btn-danger
			@endif
			btn-sm">
		@if($row->is_active ==1)
			{{trans('backend.is_active')}}
		@else
			{{trans('backend.not_active')}}
		@endif
	</a>
@endif
<a href="{{route($edit, $pk)}}" class="btn btn-default btn-sm btn-icon icon-left">
	<i class="entypo-pencil"></i>
	{{trans('backend.general.edit')}}
</a>
@if(!empty($destroy))
	<a href="{{route($destroy, $pk)}}" class="btn btn-danger btn-sm btn-icon icon-left delete-btn">
		<i class="entypo-cancel"></i>
		{{trans('backend.general.delete')}}
	</a>
@endif
@section('footer')
	<script type="text/javascript">
		jQuery(document).ready(function () {
			jQuery('.delete-btn').click(function () {
				replay = confirm('{{trans('backend.general.confirm_delete')}}');
				if (!replay) {
					return false;
				}
			});
		});
	</script>
@stop