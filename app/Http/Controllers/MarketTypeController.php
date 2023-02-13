<?php

namespace App\Http\Controllers;

use App\Models\MarketType;
use App\Http\Requests\StoreMarketTypeRequest;
use App\Http\Requests\UpdateMarketTypeRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class MarketTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $market_types = MarketType::orderByDesc('id')->get();
        if ($request->ajax()) {
            $market_types = MarketType::orderByDesc('id')->get();
            return Datatables::of($market_types)
                ->addIndexColumn()

                ->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'market_types';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->addColumn('action', function ($row) {
                    $id                     = $row->id;
                    $module                 = 'market-type';
                    $tbl_name               = 'market_types';
                    $tbl_foreign_id         = 'market_type_id';
                    $tbl_foreign_tbl_name   = 'suppliers';
                    return view('destroy.destroy', compact(['id', 'module', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        return view('market_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('market_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMarketTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarketTypeRequest $request)
    {
        $market_type = new MarketType();
        $market_type->name      = $request->name;
        $market_type->title     = $request->title;
        $market_type->slug      = Str::slug($request->name);
        $market_type->save();

        notify()->success("Market Type Created Successfully", "Success");
        return redirect()->route('market-type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MarketType  $marketType
     * @return \Illuminate\Http\Response
     */
    public function show(MarketType $marketType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MarketType  $marketType
     * @return \Illuminate\Http\Response
     */
    public function edit(MarketType $marketType)
    {
        return view('market_type.edit', compact('marketType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMarketTypeRequest  $request
     * @param  \App\Models\MarketType  $marketType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MarketType $marketType)
    {
        $request->validate([
            'name'  => 'required|min:3|max:100|alpha|unique:market_types,name,'.$marketType->id,
            'title' => 'max:100'
        ]);

        $marketType->findOrFail($marketType->id);
        $marketType->name      = $request->name;
        $marketType->title     = $request->title;
        $marketType->slug      = Str::slug($request->name);
        $marketType->status    = ($request->status == 'on') ? 1 : 0;
        $marketType->save();

        notify()->success("Market Type Update Successfully", "Success");
        return redirect()->route('market-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MarketType  $marketType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarketType $marketType)
    {
        //
    }
}
