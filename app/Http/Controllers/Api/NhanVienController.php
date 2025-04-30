<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NhanVien;
use Illuminate\Support\Facades\Validator;

class NhanVienController extends Controller
{
    public function index()
    {
        $nhanviens = NhanVien::all();

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => $nhanviens
            ]);
        }

        return view('nhanvien.index', compact('nhanviens'));
    }

    public function create()
    {
        return view('nhanvien.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hoten' => 'required|max:255',
            'email' => 'required|email|unique:nhanvien,email'
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $nhanvien = NhanVien::create($request->all());

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Nhân viên đã được thêm thành công',
                'data' => $nhanvien
            ], 201);
        }

        return redirect()->route('nhanvien.index')
            ->with('success', 'Nhân viên đã được thêm thành công');
    }

    public function show($id)
    {
        $nhanvien = NhanVien::find($id);

        if (!$nhanvien) {
            if (request()->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Không tìm thấy nhân viên'
                ], 404);
            }

            return redirect()->route('nhanvien.index')
                ->with('error', 'Không tìm thấy nhân viên');
        }

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => $nhanvien
            ]);
        }

        return view('nhanvien.show', compact('nhanvien'));
    }

    public function edit($id)
    {
        $nhanvien = NhanVien::find($id);

        if (!$nhanvien) {
            return redirect()->route('nhanvien.index')
                ->with('error', 'Không tìm thấy nhân viên');
        }

        return view('nhanvien.edit', compact('nhanvien'));
    }

    public function update(Request $request, $id)
    {
        $nhanvien = NhanVien::find($id);

        if (!$nhanvien) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Không tìm thấy nhân viên'
                ], 404);
            }

            return redirect()->route('nhanvien.index')
                ->with('error', 'Không tìm thấy nhân viên');
        }

        $validator = Validator::make($request->all(), [
            'hoten' => 'required|max:255',
            'email' => 'required|email|unique:nhanvien,email,' . $id
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $nhanvien->update($request->all());

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Thông tin nhân viên đã được cập nhật',
                'data' => $nhanvien
            ]);
        }

        return redirect()->route('nhanvien.index')
            ->with('success', 'Thông tin nhân viên đã được cập nhật');
    }

    public function destroy($id)
    {
        $nhanvien = NhanVien::find($id);

        if (!$nhanvien) {
            if (request()->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Không tìm thấy nhân viên'
                ], 404);
            }

            return redirect()->route('nhanvien.index')
                ->with('error', 'Không tìm thấy nhân viên');
        }

        $nhanvien->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Nhân viên đã được xóa thành công'
            ]);
        }

        return redirect()->route('nhanvien.index')
            ->with('success', 'Nhân viên đã được xóa thành công');
    }
}