@extends('layouts.skeleton')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-1">
                        <i class="pe-7s-users"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count">{{ count($users) }}</span></div>
                            <div class="stat-heading">Users</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-2">
                        <i class="pe-7s-timer"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count">{{ count($trainers) }}</span></div>
                            <div class="stat-heading">Trainers</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-3">
                        <i class="pe-7s-albums"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count">{{ count($bookings) }}</span></div>
                            <div class="stat-heading">Bookings</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-4">
                        <i class="pe-7s-cash"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count">{{ count($payments) }}</span></div>
                            <div class="stat-heading">Payments</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- table starts here --}}

<div class="ui-typography">
    <div class="row">
        <div class="col-md-12">


            <div class="card">
                <div class="card-header">
                    <strong class="card-title" v-if="headerText">Users</strong>

                </div>

                <div class="card-body">
                    {{-- table starts here --}}
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="serial">#</th>
                                    <th class="avatar">Avatar</th>
                                    {{-- <th>ID</th> --}}
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>Is Active</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($all as $user)
                                <tr>
                                    <td class="serial">{{ $user->id }}</td>
                                    <td class="avatar">
                                        <div class="round-img">
                                            <a href="#"><img class="rounded-circle" src="images/avatar/1.jpg"
                                                    alt=""></a>
                                        </div>
                                    </td>
                                    <td> <span class="name">{{ $user->name }}</span> </td>
                                    <td> <span class="product">{{ $user->email }}</span> </td>
                                    <td> <span class="product">
                                            @if ($user->is_active == 1)
                                            <span class="rounded-pill  bg-success p-1 "></span>
                                            @else
                                            <span class="rounded-pill  bg-danger p-1 "></span>
                                            @endif </span> </td>
                                    <td> <span class="product"><a class="fa fa-eye"
                                                href="/users/{{ $user->id }}"></a></span> </td>
                                    <td> <span class="product"><a class="fa fa-edit"
                                                href="/users/{{ $user->id }}/edit"></a></span> </td>
                                    <td> <span class="product"><a class="fa fa-trash" class="btn btn-primary mb-1"
                                                data-toggle="modal" data-target="#smallmodal{{ $user->id }}"
                                                href="/"></a></span> </td>
                                </tr>
                                <div class="modal fade" id="smallmodal{{ $user->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="smallmodalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="smallmodalLabel">Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Would you like to delete "<b>{{ $user->name }}</b>"?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <form action="{{ url('/users', ['id' => $user->id]) }}" method="post">
                                                    <input class="btn btn-danger" type="submit" value="Delete" />
                                                    {!! method_field('delete') !!}
                                                    {!! csrf_field() !!}
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                    {{-- table ends here --}}
                    <div class="row justify-content-center">
                        {{ $all->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
{{-- table ends here --}}
@endsection