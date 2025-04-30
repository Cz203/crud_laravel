<!DOCTYPE html>
<html>

<head>
    <title>Thêm nhân viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Thêm nhân viên mới</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('nhanvien.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="hoten" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="hoten" name="hoten" value="{{ old('hoten') }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="{{ route('nhanvien.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>