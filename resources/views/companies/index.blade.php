@extends('layouts.master')

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Companies</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
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
@endsection