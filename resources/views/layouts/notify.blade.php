@section('notification-js')
@if (session()->has('msg'))
    Snackbar.show({ text: '{{ session()->get('msg') }}' ,
		pos: 'bottom-right' 
		});
@endif
@stop