@section('body')
<div class="row defPad collapse">
	<div class="large-6 columns">
		<h4>Manage Providers</h4>
	</div>
	<div class="large-6 columns text-right">
		<a href="{{ url('/provider/add') }}" class="small success button">Add New Provider</a>
	</div>
</div>
<?php if(Session::get('message')!="") { ?>
<div class="row defPad">
	<div class="large-12 large-centered">
		<div data-alert="" class="alert-box">
			{{ Session::get('message') }}
			<a href="#" class="close">×</a>
		</div>
	</div>
</div>
<?php } ?>
<div class="row collapse">
        <div class="medium-10 columns">
            <input type="text" placeholder="Search for name..." id="search" name="search" value="{{Input::get('search')}}">
        </div>
        <div class="medium-2 columns">
            <a role="button" class="button postfix" id="btnSearch" name="search">Search</a>
        </div>
    </div>

<div class="container">
    <div class="row">
        <table class="wid100">
		  	<thead>
			    <tr>
				    <th class="text-center" width="100">{{ StringHelper::makeSortingHeader('id', 'ID', 'provider.index') }}</th>
				    <th>{{ StringHelper::makeSortingHeader('name', 'Name', 'provider.index') }}</th>
				    <th>{{ StringHelper::makeSortingHeader('url', 'URL', 'provider.index') }}</th>
				    <th class="text-center">Options</th>
			    </tr>
		  	</thead>
		  	<tbody>
				<?php
				if(count($provider)>0):
					foreach ($provider as $providerInfo) :
				?>
				<tr>
					<td class="text-center">{{ $providerInfo['id']  }}</td>
					<td>{{ $providerInfo['name']  }}</td>
					<td>{{ $providerInfo['url']  }}</td>
					<td class="text-center">
						<a href="{{ url('provider/edit/'.$providerInfo['id']) }}" title="Edit" alt="Edit"><i class="fi-page-edit small"></i></a>
						<a href="javascript:void()" data-id="{{ $providerInfo['id'] }}" class="deleterow" title="Delete" alt="Delete"><i class="fi-x small"></i></a>
					</td>
				</tr>
				<?php
					endforeach;
					else:
				?>
					<tr>
						<td colspan="8" class="text-center"><strong>{{ $noRecord }}</strong></td>
					</tr>
				<?php
				endif;
				?>
		  	</tbody>
		</table>

		<?php echo (count($provider)>0) ? $pagi : '';  ?>
	</div>
</div>
@stop


@section('footer.javascripts')

	<script type="text/javascript">
        $(document).ready(function(){
            // delete row in a table
            if($('.deleterow').length > 0) {
                $(document).on('click','.deleterow', function(){
					Swal.fire({
						title: 'Continue delete?',
						text: 'This action cannot be undone.',
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
						if (result.isConfirmed) {
							var ids = $(this).attr('data-id');
							var parameter = "id="+ids;
							var url = "{{ url('provider/delete') }}";
							$.ajax({
								type: "POST",
								url: url,
								data: parameter,
								success: function(originalRequest){
									if(originalRequest=='1'){
										Swal.fire({
											title: 'Record deleted?',
											text: '',
											icon: 'success',
											showConfirmButton: false
										});

										setTimeout(function() {
											location.reload();
										}, 1000);

									} else {
										Swal.fire({
											title: 'Record cannot be deleted!',
											text: '',
											icon: 'error',
											confirmButtonColor: '#3085d6'
										});
									}
								}
							});
						}
					});
					return false;
				});
            }
        });

        $('#btnSearch').click(function(e){
        var keyword = $('#search').val();
        var url = "{{ url('provider?search') }}"+"="+keyword;
        window.location = url;
    });

    $('#search').keypress(function (e) {
       if(e.which ==13)
        $('#btnSearch').trigger('click');
    });
    </script>

@stop