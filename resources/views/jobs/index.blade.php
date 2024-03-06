@extends('layouts.master')

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Jobs</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Jobs</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Jobs List</h3>
                    @can('create', \App\Models\Job::class)
                        <div style="text-align: right">
                            <a class="btn btn-primary" href="{{route('jobs.create')}}">
                                <i class="fa fa-plus"></i> Add Job
                            </a>
                        </div>
                    @endcan
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr class="bg-cyan-950 text-stone-100">
                                <th>Title</th>
                                <th>Post</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Salary</th>
                                <th>Vacancy</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs  as $job)
                                <tr>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ $job->post }}</td>
                                    <td>{{ $job->description }}</td>
                                    @if ($job->status === 'approved')
                                        <td class="text-success">{{ $job->status }}</td>
                                    @else
                                        <td class="text-danger">{{ $job->status }}</td>
                                    @endif
                                    <td>{{ $job->salary_min }} - {{ $job->salary_max }}</td>
                                    <td>{{ $job->vacancy }}</td>
                                    <td>
                                        @can('update', $job)
                                            <a href="{{ route('jobs.edit',$job->id) }}" class="btn btn-info">Edit</a>
                                        @endcan
                                        @can('view', $job)
                                            <a href="{{ route('jobs.show',$job->id) }}" class="btn btn-warning">View</a>
                                        @endcan
                                        @can('delete', $job)
                                            <button class="btn btn-danger delete-confirm" data-id="{{ $job->id }}">Delete</button>
                                        @endcan
                                    </td>
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
                                url: '/jobs/delete/' + id,
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