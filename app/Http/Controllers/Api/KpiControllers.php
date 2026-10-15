<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\kpi;
use App\Models\ttl_inspected;
use App\Models\item_detail;
use App\Http\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Response;
use PhpParser\Node\Stmt\TryCatch;

class KpiControllers extends Controller
{
    protected $ResponseHelper;

    public function __construct(ResponseHelper $ResponseHelper)
    {
        $this->ResponseHelper = $ResponseHelper;
    }

    public function index()
    {
        $paginator =  kpi::where("deleted_at",null)->paginate(10);
        return $this->ResponseHelper->pagination(
            $paginator,
            $paginator->items()
        );
    }

    public function store(Request $request)
    {
 
        $dataKpi = [
            'line' => $request->line,
            'year' => $request->year,
            'style' => $request->style,
            'month' => $request->month,
            'week' => $request->week,
            'day' => $request->day,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        $kpi = kpi::create($dataKpi);

        $data_inspected = [
            'kpi_id'            => $kpi->id,
            'inspedted'         => $request->ttl_inspected,
            'dispacted_1'       => $request->defect_1,
            'persen_dispacted_1' => $request->persentase_1,
            'dispacted_2'        => $request->pcs_dispact_2,
            'persen_dispacted_2' => $request->persentase_2,
        ];

        $ttl = ttl_inspected::create($data_inspected);

        foreach($request->item as $val){
            $item = [
                'inspected_id' => $ttl->id,
                'code'         => $val['code'],
                'name'         => $val['name'],
                'qty'          => $val['pcs'],
                'persen'       => $val['persen']
            ];

            $item = item_detail::create($item);
        }

        return $this->ResponseHelper->successResponse("Berhasil simpan data");

    }

    public function show($id){
        $kpi = kpi::where('id',$id)->first();
        $inspected =  ttl_inspected::where('kpi_id',$kpi->id)->first();
        $item = item_detail::where('inspected_id',$inspected->id)->get();

        $response = [
            'status'  => 200,
            'message' => "Berhasil mendapatkan data !",
            'result'  => [
                "kpi"       => $kpi,
                "inspected" => $inspected,
                "item"      => $item
            ]
        ];

        return Response::json($response);

    }

    public function update(Request $request, $id)
    {   
    
        try {
            $cekdata = kpi::where('id',$id)->first();
            if ($cekdata) {
                $dataKpi = [
                    'line'       => $request->line,
                    'year'       => $request->year,
                    'style'      => $request->style,
                    'month'      => $request->month,
                    'week'       => $request->week,
                    'day'        => $request->day,
                    'start_date' => $request->start_date,
                    'end_date'   => $request->end_date,
                    'updated_at' => now()
                ];

                $updateKpi = kpi::where('id',$id)->update($dataKpi);

                if ($updateKpi) {
                    $inspected= ttl_inspected::where('kpi_id',$id)->first();
                    if ($inspected) {
                        $data_inspected = [
                            'kpi_id'            => $id,
                            'inspedted'         => $request->ttl_inspected,
                            'dispacted_1'       => $request->defect_1,
                            'persen_dispacted_1' => $request->persentase_1,
                            'dispacted_2'        => $request->pcs_dispact_2,
                            'persen_dispacted_2' => $request->persentase_2,
                            'updated_at'         => now()
                        ];
                        $updateInspected = ttl_inspected::where('id',$inspected->id)->update($data_inspected);

                        if ($updateInspected) {
                            $items = item_detail::where('inspected_id',$inspected->id)->get();

                            foreach($items as $i => $key){
                                if (isset($request->item[$i])) {
                                    $val = $request->item[$i];
                                    $item = [
                                        "name"   => $val['name'],
                                        "code"   => $val['code'],
                                        "qty"    => $val['pcs'],
                                        "persen" => $val['persen']
                                    ];
                                     item_detail::where('id',$key->id)->update($item);
                                }
                            }
                        }
                    }
                
                }
            }
            
            $response = [
                'status'  => 200,
                'message' => "Berhasil update data !"

            ];

            return Response::json($response);
        } catch (\Throwable $th) {
            $response = [
                'status'  => 200,
                'message' => $th->getMessage()

            ];
            return Response::json($response);
        }
    }

    public function delete($id)
    {
        $delete = ['deleted_at' => now()];
        $data = kpi::where('id',$id)->update($delete);
        
        return $this->ResponseHelper->successResponse("Berhasil Hapus data !");
    } 
}
