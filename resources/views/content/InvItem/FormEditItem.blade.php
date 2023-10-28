@inject('InvItem', 'App\Http\Controllers\InvItemController')
@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="card">
    <div class="card-body">
        <a href="/inv-item" class="btn btn-primary"> < kembali</a>
      <h5 class="card-title fw-semibold mb-4 text-center">Edit Items</h5>
      <div class="container">
        <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h1>
            </div>
            <div class="modal-body">
              <form method="post" action="{{ route('process-add-item') }}">
                @csrf
                <div class="mb-3">
                  <label class="form-label">Nama Barang</label>
                  <input type="text" class="form-control" name="item_name" id="item_name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipe Lama</label>
                    <input type="text" class="form-control" name="item_name" id="item_name">
                  </div>
                <div class="d-grid gap-2">
                  <label for="" class="form-label">Tipe Baru</label>
                  <select class="js-example-basic-single" id="item_type_id" name="item_type_id">
                    <option value="0">--pilih type--</option>
                    @foreach($invitemtype as $item)
                    <option value="{{ $item->item_type_id }}">{{ $item->item_type_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="d-grid gap-2">
                  <label for="" class="form-label" hidden>Satuan</label>
                  <input type="text" hidden class="form-control" name="item_unit_id" id="item_unit_id" value="1">
                </div>
                <div class="mb-3">
                  <label class="form-label">Harga</label>
                  <input type="number" class="form-control" name="item_unit_price" id="item_unit_price">
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
              </form>
            </div>
        </div>
      </div>

      @endsection