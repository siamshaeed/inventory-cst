<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDue;
use App\Models\Stock;
use App\Models\Supplier;
use App\Traits\OrderItemDestroyTrait;
use App\Traits\PurchaseDueDestroyTrait;
use App\Traits\PurchaseItemDestroyTrait;
use App\Traits\SalePaymentDestoryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class DestroyController extends Controller
{
    use PurchaseDueDestroyTrait;
    use PurchaseItemDestroyTrait;
    use OrderItemDestroyTrait;
    use SalePaymentDestoryTrait;

    //--Destroy
    public function destroy(Request $request) {

        //dd($request->all());
        $id                     = $request->tbl_id;
        $tbl_name               = $request->tbl_name;
        $tbl_foreign_id         = $request->tbl_foreign_id;
        $tbl_foreign_tbl_name   = $request->tbl_foreign_tbl_name;


        // PurchaseDue Calculation
        if($tbl_name == 'purchase_dues'){
            $this->dueDestroy($id, $tbl_foreign_id);
        }
        // PurchaseItem Calculation
        if($tbl_name == 'purchase_items'){
            $this->purchaseItemDestroy($id, $tbl_foreign_id);
        }
        // OrderItems Delete and Order Calculate
        if($tbl_name == 'order_items'){
            $this->itemDestroy($id);
        }
        // SalePayment Calculation
        if($tbl_name == 'sale_payments'){
            $this->salePaymentDestroy($id, $tbl_foreign_id);
        }


        //Destroy: Dependency table checked for data destroy
        if(!is_null($tbl_foreign_id) && !is_null($tbl_foreign_tbl_name)){
            $foreign_table = DB::table($tbl_foreign_tbl_name)->where('id', $id)->get();
            if(!$foreign_table->isEmpty()){
                notify()->warning("Already Used!", "Warning");
                return back();
            }
        }

        //Destroy: Data is deleted
        $data = DB::table($tbl_name)->where('id', $id)->delete();
        if($data){
            notify()->success("Deleted Successfully", "Success");
            return back();
        }else{
            notify()->warning("Data Not Deleted", "warning");
            return back();
        }

    }
}
