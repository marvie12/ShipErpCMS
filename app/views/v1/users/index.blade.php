@section('body')
<div class="row defPad collapse">
	<div class="large-6 columns">
		<h4>Manage Users</h4>
	</div>
	<div class="large-6 columns text-right">
		<a href="{{ url('/users/add') }}" class="small success button">Add New User</a>
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
            <input type="text" placeholder="Search for user..." id="search" name="search" value="{{Input::get('search')}}">
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
				    <th class="text-center" width="100">{{ StringHelper::makeSortingHeader('id', 'ID', 'user.index') }}</th>
				    <th>{{ StringHelper::makeSortingHeader('username', 'Username', 'user.index') }}</th>
				    <th>{{ StringHelper::makeSortingHeader('name', 'Name', 'user.index') }}</th>
				    <th>{{ StringHelper::makeSortingHeader('email', 'Email', 'user.index') }}</th>
				    <th>{{ StringHelper::makeSortingHeader('date', 'Date Created', 'user.index') }}</th>
				    <th class="text-center">Options</th>
			    </tr>
		  	</thead>
		  	<tbody>
				<?php
				if(count($users)>0):
					foreach ($users as $userEO) :
				?>
				<tr>
					<td class="text-center">{{ $userEO['id']  }}</td>
					<td>{{ $userEO['username']  }}</td>
					<td>{{ $userEO['name']  }}</td>
					<td>{{ $userEO['email']  }}</td>
					<td>{{ date('Y-m-d H:i:s', $userEO['created_at'])  }}</td>
					<td class="text-center">
						<a href="{{ url('users/edit/'.$userEO['id']) }}" title="Edit" alt="Edit"><i class="fi-page-edit small"></i></a>
						<a href="javascript:void()" data-id="{{ $userEO['id'] }}" class="deleterow" title="Delete" alt="Delete"><i class="fi-x small"></i></a>
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

		<?php echo (count($users)>0) ? $pagi : '';  ?>
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
							var url = "{{ url('users/delete') }}";
							$.ajax({
								type: "POST",
								url: url,
								data: parameter,
								success: function(originalRequest){
									if(originalRequest=='1'){
										Swal.fire({
											title: 'Record successfully deleted',
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
        var url = "{{ url('users?search') }}"+"="+keyword;
        window.location = url;
    });

    $('#search').keypress(function (e) {
       if(e.which ==13)
        $('#btnSearch').trigger('click');
    });
    </script>

@stop