<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\AjaxRouteController as AjaxRoute;

use Validator;

use App\Siswa;

class MyController extends Controller
{
    public function index(AjaxRoute $ajax, Request $r = null)
    {
      $blade = "siswa";
      $data = ['data' => Siswa::orderBy('created_at', 'DESC')->get()];
      if ($r->ajax()) {
        $view = $ajax->route($blade, $data);
        return response()->json($view);
      }
      else {
        return view($blade)->with($data);
      }
    }

    public function form_tambah(AjaxRoute $ajax, Request $r = null)
    {
      $blade = "tambah";
      if ($r->ajax()) {
        $view = $ajax->route($blade);
        return response()->json($view);
      }
      else {
        return view($blade);
      }
    }

    public function store(Request $r)
    {
      $validator = Validator::make($r->all(), [
        'nama' => 'required',
        'kelas' => 'required'
      ]);

      if ($validator->fails()) {
        $response['success'] = 0;
        $response['message'] = "masih ada data yang kosong";
        return response()->json($response);
      }

      $siswa = new Siswa;
      $siswa->nama = $r->input('nama');
      $siswa->kelas = $r->input('kelas');
      $siswa->save();

      $response['success'] = 1;
      $response['message'] = "berhasil menyimpan data";
      return response()->json($response);
    }

    public function drop(Request $r)
    {
      $siswa = Siswa::find($r->input('id'));
      if (count($siswa)==0) {
        $response['success'] = 0;
        $response['message'] = "terjadi kesalahan, siswa tidak ditemukan";
      }
      else {
        $siswa->delete();
        $response['success'] = 1;
        $response['message'] = "berhasil menghapus siswa";
      }

      return response()->json($response);
    }

    public function edit(Request $r = null, AjaxRoute $ajax)
    {
      if ($r->input('id')) {
        $id = $r->input('id');

        $siswa = Siswa::find($id);
        if (count($siswa)==0) {
          $response['success'] = 0;
          $response['message'] = "terjadi kesalahan, data tidak ditemukan";
        }
        else {
          $data = ['data' => $siswa];

          $blade = "ubah";
          $view = $ajax->route($blade, $data);
          return response()->json($view);
        }

        return response()->json($response);
      }
      else {
        return redirect(url('/'));
      }
    }

    public function update(Request $r)
    {
      $siswa = Siswa::find($r->input('id'));

      if (count($siswa)==0) {
        $response['success'] = 0;
        $response['message'] = "terjadi kesalahan";
      }
      else {
        $siswa->nama = $r->input('nama');
        $siswa->kelas = $r->input('kelas');
        $siswa->save();

        $response['success'] = 1;
        $response['message'] = "berhasil mengubah data";
      }

      return response()->json($response);
    }

    public function search(Request $r)
    {
      $data = Siswa::orderBy('created_at', 'DESC')->where('nama', 'LIKE', '%'.$r->input('nama').'%')->get();
      if (count($data)==0) {
        $response['success'] = 0;
        $response['message'] = "Data tidak ditemukan";
      }
      else {
        $response['success'] = 1;
        $response['siswa'] = $data;
      }

      return response()->json($response);
    }
}
