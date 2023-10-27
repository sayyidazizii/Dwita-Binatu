@inject('InvItem', 'App\Http\Controllers\InvItemController')
@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4 text-center">List Items</h5>
      <div class="container">
         <!-- Button trigger modal -->
         <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
          + Tambah Data Item
        </button>
        <div class="table-responsive">
          <table id="tabel-data" class="table table-bordered table-advance table-hover">
            <thead class="thead-light bg-primary text-light">
              <tr>
                <th>No</th>
                <th>Item</th>
                <th>Tipe</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
              $total = 0;
              $no = 1;
              $subtotal_amount =0;

              @endphp
              @foreach($items as $key => $item)
             
              <tr>
                <td>{{ $no }}</td>
                <td>{{ $item->item_name }}</td>
                <td>{{ $InvItem->getTypeName($item->item_type_id) }}</td>
                <td>{{ $InvItem->getItemUnitName($item->item_unit_id) }}</td>
                <td>{{ $item->item_unit_price }}</td>
                <td>
                  <a href="{{ url('/edit-barang/'.$item->item_id) }}" class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a>
                  <a href="{{route('hapus-item', ['item_id' => $item->item_id])}}" name='Reset' class='btn btn-danger btn-sm'onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")'><i class="ti ti-trash"></i></a>
                </td>
              </tr>
              @php
              $total_no = $no;
              $no++;
              @endphp
              @endforeach
            </tbody>
          </table>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                @csrf
                <div class="mb-3">
                  <label class="form-label">Nama Barang</label>
                  <input type="text" class="form-control" name="item_name" id="item_name">
                </div>
                <div class="d-grid gap-2">
                  <label for="" class="form-label">Nama Tipe</label>
                  <select class="js-example-basic-single" id="item_type_id" name="item_type_id">
                    @foreach($invitemtype as $item)
                    <option value="{{ $item->item_type_id }}">{{ $item->item_type_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="d-grid gap-2">
                  <label for="" class="form-label">Satuan</label>
                  <select class="js-example-basic-single" id="item_type_id" name="item_type_id">
                    @foreach($invitemunit as $item)
                    <option value="{{ $item->item_unit_id }}">{{ $item->item_unit_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">Harga</label>
                  <input type="number" class="form-control" name="stok" id="stok">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
              </form>
            </div>
          </div>
        </div>

        

      @endsection