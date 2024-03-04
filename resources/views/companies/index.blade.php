@extends('layouts.master')

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Companies</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                {{-- <li class="breadcrumb-item"><a href="#">Companies</a></li> --}}
                <li class="breadcrumb-item">Companies</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                @can('companies.create')
                    <div class="card-header">
                        {{-- <h3 class="card-title">Companies List</h3> --}}
                        <div style="text-align: right">
                            <a class="btn btn-default" href="{{route('companies.create')}}">
                                <i class="fa fa-plus"></i> Add Company
                            </a>
                        </div>
                    </div>
                @endcan
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr class="bg-cyan-950 text-stone-100">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                                {{-- @if(auth('web'))
                                    <th>Options</th>
                                @endif --}}
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($companies  as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                @if ($company->status === 'approved')
                                    <td class="text-success">{{ $company->status }}</td>
                                @else
                                    <td class="text-danger">{{ $company->status }}</td>
                                @endif
                                <td>
                                    @if ($company->status === 'approved')
                                        <h4>
                                            <a href="{{ route('company.approve', $company->id) }}"><span class="badge bg-danger">Draft</span></a>
                                        </h4>
                                    @endif
                                    @if ($company->status === 'draft')
                                        <h4><a href="{{ route('company.draft', $company->id) }}"><span class="badge bg-success">Approve</span></a></h4>
                                    @endif
                                </td>
                                {{-- <td>
                                    @can('companies.view')
                                        <a href="{{ route('companies.show',$company->id) }}" class="btn btn-warning">View</a>
                                    @endcan
                                    @can('companies.edit')
                                        <a href="{{ route('companies.edit',$company->id) }}" class="btn btn-info">Edit</a>
                                    @endcan
                                    @can('companies.delete')
                                        <button class="btn btn-danger delete-confirm" data-id="{{ $company->id }}">Delete</button>
                                    @endcan
                                </td> --}}
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });

        $(".delete-confirm").click(function () {
            var id = $(this).data("id");
            console.log('Clicking Delete',id);

            $.confirm({
                title: 'Warning!',
                icon: 'fa fa-warning',
                content: 'Are you sure? You wont be able to revert this!',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Click Here',
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                method: 'POST',
                                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                                url: '/companies/delete/' + id,
                                success: function (response) {
                                    if(response.msg){
                                        console.log(response.msg,"ajax success response.msg")
                                        location.reload()
                                    }
                                }
                            })
                        }
                    },
                    close: function () {
                    }
                }
            });
        });
    </script>


@endsection