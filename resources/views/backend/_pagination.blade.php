@if(@$rows->lastPage() > 1)
	<div class="row">
		<div class="col-lg-1 col-xs-1">
			<select id="change_rows_count">
				@foreach (range(10, 100, 10) as $number)
					<option value="{{$number}}" @if(\Input::get('count',@$rows->perPage())==$number)
					selected
							@endif>{{$number}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-lg-9 col-xs-9">
			{!!$rows->appends(\Input::except('page'))->render() !!}
		</div>
		<div class="col-lg-2 col-xs-2">
			<div class="input-group" style="max-width: 150px;">
				<input id="page_number" class="form-control" name="page_number" type="number" value="{{(\Input::get('page')<1)?1:\Input::get('page')}}">
		<span class="input-group-btn">
			<button id="go_to_page_number" class="btn btn-success" type="button">Go!</button>
		</span>
			</div>
		</div>
	</div>
@endif