@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Danh sách user</h4>
                    @php
                        $message = Session::get('message');
                        
                        if ($message) {
                            echo '<div class="alert alert-danger">
                    ' .
                                $message .
                                '
                    </div>';
                            Session::put('message', null);
                        }
                    @endphp

                    @php
                        $success = Session::get('success');
                        
                        if ($success) {
                            echo '<div class="alert alert-success">
                                      ' .
                                $success .
                                '
                                    </div>';
                            Session::put('success', null);
                        }
                    @endphp
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        <table id="row-select" class="display table table-borderd table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Tên user</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Mật khẩu</th>
                                    <th>Auth</th>
                                    <th>Admin</th>
                                    <th>User</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($admin as $user)
                                    <form action="{{ route('assign-roles') }}" method="POST">
                                        @csrf
                                        <tr>
                                            <td><label class="i-checks m-b-none" for=""><input type="checkbox"
                                                        name="post[]"><i></i></label></td>
                                            {{-- <td>{{ $user->id }}</td> --}}

                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}
                                                <input type="hidden" name="email" value="{{ $user->email }}">
                                                <input type="hidden" name="id" value="{{ $user->id }}">

                                            </td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->password }}</td>
                                            <td>
                                                <input type="checkbox" name="auth_role"
                                                    {{ $user->hasRole('auth') ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="admin_role"
                                                    {{ $user->hasRole('admin') ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="user_role"
                                                    {{ $user->hasRole('user') ? 'checked' : '' }}>
                                            </td>

                                            <td>
                                                <button type="submit" class="btn btn-sm btn-primary" value="Sửa">Phân quyền</button>
                                                
                                                <form action="#" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                <a onclick="return confirm('Bạn có muốn xóa user này không')" href="{{ url('/admin/deleteUser_role/'.$user->id) }}" class="btn btn-sm btn-danger">Xóa</a>
                                                <a  href="{{ url('/admin/impersonate/'.$user->id) }}" class="btn btn-sm btn-check">Chuyển quyền</a>
                                                
                                            </form>
                                            </td>
                                           


                                        </tr>
                                    </form>
                                @endforeach


                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <!-- /# card -->
        </div>
        <!-- /# column -->

        <!-- /# column -->
    </div>
@endsection
