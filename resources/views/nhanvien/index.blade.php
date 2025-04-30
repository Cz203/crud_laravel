<!DOCTYPE html>
<html>

<head>
    <title>Danh sách nhân viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Danh sách nhân viên</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <a href="{{ route('nhanvien.create') }}" class="btn btn-primary mb-3">Thêm nhân viên</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nhanviens as $nhanvien)
                <tr>
                    <td>{{ $nhanvien->id }}</td>
                    <td>{{ $nhanvien->hoten }}</td>
                    <td>{{ $nhanvien->email }}</td>
                    <td>
                        <a href="{{ route('nhanvien.edit', $nhanvien->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('nhanvien.destroy', $nhanvien->id) }}" method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>