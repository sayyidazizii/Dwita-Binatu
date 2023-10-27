<?php

namespace App\Http\Controllers;

use App\Models\core_customer;
use App\Models\InvItem;
use App\Models\InvItemType;
use App\Models\InvItemUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = InvItem::select('*')
        ->where('data_state',0)
        ->get();

        $invitemtype =  InvItemType::select('*')
        ->get(); 

        $invitemunit =  InvItemUnit::select('*')
        ->get(); 

        return view('content/InvItem/ListInvItem', compact('items','invitemtype','invitemunit'));
    }

    //simpan data 
    public function processAddBarang(Request $request)
    {
        $barang = array(
            'item_name' => $request->item_name,
            'item_type_id' => $request->item_type_id,
            'item_unit_id' => $request->item_unit_id,
            'item_unit_price' => $request->item_unit_price,
        );
        $data = InvItem::create($barang);
        if ($data) {
            return redirect('/inv-item');
        } else {
            return redirect('/inv-item');
        }
    }
    public function EditBarang($item_id)
    {
        $data = InvItem::find($item_id);
        return view('barang.editbarang', compact('data'));
    }

    public function processEditBarang(Request $request)
    {
       $data = DB::table('inv_items')
              ->where('item_id', $request->item_id)
              ->update([
                'item_name' => $request->item_name,
                'item_type_id' => $request->item_type_id,
                'item_unit_id' => $request->item_unit_id,
                'item_unit_price' => $request->item_unit_price,
              ]
                );   
            return redirect('/inv-item');

    }
    public function deleteBarang($item_id)
    {
        $data = DB::table('inv_items')
        ->where('item_id', $item_id)
        ->update([
          'data_state' => 1,
        ]
          );
        if ($data) {
            $msg = 'Hapus Item Berhasil';
            return redirect('/inv-item')->with('msg', $msg);
        } else {
            $msg = 'Hapus Item Gagal';
            return redirect('/inv-item')->with('msg', $msg);
        }
    }

    public function getItemName($item_id)
    {
        $name = InvItem::select('inv_items.item_id', 'inv_items.item_name', DB::raw('CONCAT(inv_items.item_name, " ", inv_item_types.item_type_name) AS name'))
            ->join('inv_item_types', 'inv_item_types.item_type_id', 'inv_items.item_type_id')
            ->where('item_id', $item_id)
            ->first();

        return $name['name'];
    }

    public function getItemPrice($item_id)
    {
        $name = InvItem::where('item_id', $item_id)
            ->first();

        return $name['item_unit_price'];
    }

    public function getCustomerName($customer_id)
    {
        $name = core_customer::where('customer_id', $customer_id)
            ->first();

        return $name['customer_name'] ?? '';
    }

    public function getTypeId($item_id)
    {
        $name = InvItem::where('item_id', $item_id)
            ->first();

        return $name['item_type_id'] ?? '';
    }
    public function getTypeName($item_type_id)
    {
        $name = InvItemType::where('item_type_id', $item_type_id)
            ->first();

        return $name['item_type_name'] ?? '';
    }

    public function getUnitID($item_id)
    {
        $name = InvItem::where('item_id', $item_id)
            ->first();

        return $name['item_unit_id'] ?? '';
    }

    public function getItemUnitName($item_unit_id)
    {
        $name = InvItemUnit::where('item_unit_id', $item_unit_id)
            ->first();

        return $name['item_unit_name'] ?? '';
    }
    
   
}
